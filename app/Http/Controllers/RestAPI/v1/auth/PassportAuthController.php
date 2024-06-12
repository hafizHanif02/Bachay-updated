<?php

namespace App\Http\Controllers\RestAPI\v1\auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Utils\CartManager;
use App\Utils\Helpers;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Wishlist;
use App\Utils\SMS_module;
use App\Models\FamilyRelation;
use App\Models\ProductCompare;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Events\EmailVerificationEvent;
use Illuminate\Support\Facades\Session;
use App\Models\PhoneOrEmailVerification;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8',
        ], [
            'f_name.required' => 'The first name field is required.',
            'l_name.required' => 'The last name field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if ($request->referral_code){
            $refer_user = User::where(['referral_code' => $request->referral_code])->first();
        }

        $temporary_token = Str::random(40);
        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => 1,
            'password' => bcrypt($request->password),
            'temporary_token' => $temporary_token,
            'referral_code' => Helpers::generate_referer_code(),
            'referred_by' => (isset($refer_user) && $refer_user) ? $refer_user->id : null,
        ]);

        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            return response()->json(['temporary_token' => $temporary_token], 200);
        }
        if ($email_verification && !$user->is_email_verified) {
            return response()->json(['temporary_token' => $temporary_token], 200);
        }

        $token = $user->createToken('LaravelAuthApp')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:8',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user_id = $request['email'];
        if (filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $medium = 'email';
        } else {
            $count = strlen(preg_replace("/[^\d]/", "", $user_id));
            if ($count >= 9 && $count <= 15) {
                $medium = 'phone';
            } else {
                $errors = [];
                $errors[] = ['code' => 'email', 'message' => translate('invalid_email_address_or_phone_number')];
                return response()->json([
                    'errors' => $errors
                ], 403);
            }
        }

        $data = [
            $medium => $user_id,
            'password' => $request->password
        ];

        $user = User::where([$medium => $user_id])->first();
        $max_login_hit = Helpers::get_business_settings('maximum_login_hit') ?? 5;
        $temp_block_time = Helpers::get_business_settings('temporary_login_block_time') ?? 5; //minute

        if (isset($user)) {
            $user->temporary_token = Str::random(40);
            $user->save();

            $phone_verification = Helpers::get_business_settings('phone_verification');
            $email_verification = Helpers::get_business_settings('email_verification');
            if ($phone_verification && !$user->is_phone_verified) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }
            if ($email_verification && !$user->is_email_verified) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }

            if(isset($user->temp_block_time ) && Carbon::parse($user->temp_block_time)->diffInSeconds() <= $temp_block_time){
                $time = $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $errors = [];
                $errors[] = ['code' => 'auth-001', 'message' => translate('please_try_again_after').' '.CarbonInterval::seconds($time)->cascade()->forHumans()];
                return response()->json([
                    'errors' => $errors
                ], 401);
            }

            

            if($user->is_active && auth()->attempt($data)){
                $token = $user->createToken('LaravelAuthApp')->accessToken;

                $user->login_hit_count = 0;
                $user->is_temp_blocked = 0;
                $user->temp_block_time = null;
                $user->updated_at = now();
                $user->save();

                CartManager::cart_to_db($request);

                return response()->json(['token' => $token], 200);
            }else{
                //login attempt check start
                if(isset($user->temp_block_time ) && Carbon::parse($user->temp_block_time)->diffInSeconds() <= $temp_block_time){
                    $time= $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                    $errors = [];
                    $errors[] = ['code' => 'auth-001', 'message' => translate('please_try_again_after').' '.CarbonInterval::seconds($time)->cascade()->forHumans()];
                    return response()->json([
                        'errors' => $errors
                    ], 401);

                }elseif($user->is_temp_blocked == 1 && Carbon::parse($user->temp_block_time)->diffInSeconds() >= $temp_block_time){

                    $user->login_hit_count = 0;
                    $user->is_temp_blocked = 0;
                    $user->temp_block_time = null;
                    $user->updated_at = now();
                    $user->save();

                    $errors = [];
                    $errors[] = ['code' => 'auth-001', 'message' => translate('credentials_do_not_match_or_account_has_been_suspended')];
                    return response()->json([
                        'errors' => $errors
                    ], 401);

                }elseif($user->login_hit_count >= $max_login_hit &&  $user->is_temp_blocked == 0){
                    $user->is_temp_blocked = 1;
                    $user->temp_block_time = now();
                    $user->updated_at = now();
                    $user->save();

                    $time= $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                    $errors = [];
                    $errors[] = ['code' => 'auth-001', 'message' => translate('too_many_attempts'). translate('please_try_again_after').' '.CarbonInterval::seconds($time)->cascade()->forHumans()];
                    return response()->json([
                        'errors' => $errors
                    ], 401);

                }else{

                    $user->login_hit_count += 1;
                    $user->save();

                    $errors = [];
                    $errors[] = ['code' => 'auth-001', 'message' => translate('credentials_do_not_match_or_account_has_been_suspended')];
                    return response()->json([
                        'errors' => $errors
                    ], 401);
                }
                //login attempt check end
            }
        } else {
            $errors = [];
            $errors[] = ['code' => 'auth-001', 'message' => translate('customer_not_found_or_account_has_been_suspended')];
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }

    public function verifyToken(Request $request){
        $emailServices_smtp = Helpers::get_business_settings('mail_config');
        $user = User::where(['phone' => $request->user_id])->orWhere(['email' => $request->user_id])->first();
        if($user != null){
            $token = rand(1000, 9999);
            DB::table('phone_or_email_verifications')->insert([
                'phone_or_email' => $user['email'],
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);    
        }else{
            Toastr::error(translate('Phone or Email has not properly entered'));
            return redirect()->back();
        }

        

        
        $emailServices_smtp = Helpers::get_business_settings('mail_config');
        
        if ($emailServices_smtp['status'] == 1) {
            $email =  EmailVerificationEvent::dispatch($user['email'], $token);
        }
        SMS_module::send($user->phone, $token);

        return response()->json(translate('check_your_whatsapp_&_email_for_token'), 200);
        
    }

    public function TokenCheck(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'otp' => 'required',
        ]);

        $user = User::where(['phone' => $request->user_id])->orWhere(['email' => $request->user_id])->first();
        $remember = ($request['remember']) ? true : false;

        //login attempt check start
        $max_login_hit = Helpers::get_business_settings('maximum_login_hit') ?? 5;
        $temp_block_time = Helpers::get_business_settings('temporary_login_block_time') ?? 5;
        if (isset($user) == false) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url' => ''
                ]);
            } else {
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));
                return back()->withInput();
            }
        }

        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('account_phone_not_verified'),
                ]);
        }
        if ($email_verification && !$user->is_email_verified) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('account_email_not_verified'),
                ]);
        }

        if (isset($user->temp_block_time) && Carbon::parse($user->temp_block_time)->DiffInSeconds() <= $temp_block_time) {
            $time = $temp_block_time - Carbon::parse($user->temp_block_time)->DiffInSeconds();
                return response()->json([
                    'status' => 'error',
                    'message' => translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url' => ''
                ]);
        }

        $token = PhoneOrEmailVerification::where('phone_or_email', $user['email'])->latest()->first();
        if ($token->token == $request->otp) {
            Auth::guard('customer')->login($user);
        } else {
            Toastr::error(translate('Token_is_incorrect_please_enter_correct_token'));
            return redirect()->back();
        }

        if (isset($user) && $user->is_active && (Auth::guard('customer')->user() != null)) {
            $wish_list = Wishlist::whereHas('wishlistProduct', function ($q) {

                return $q;
            })->where('customer_id', auth('customer')->user()->id)->pluck('product_id')->toArray();

            $compare_list = ProductCompare::where('user_id', auth('customer')->id())->pluck('product_id')->toArray();

            session()->put('wish_list', $wish_list);
            session()->put('compare_list', $compare_list);
            Toastr::info(translate('welcome_to') . ' ' . Helpers::get_business_settings('company_name') . '!');
            // CartManager::cart_to_db();

            $user->login_hit_count = 0;
            $user->is_temp_blocked = 0;
            $user->temp_block_time = null;
            $user->updated_at = now();
            $user->save();

            $redirect_url = "";
            $previous_url = url()->previous();

            if (
                strpos($previous_url, 'checkout-complete') !== false ||
                strpos($previous_url, 'offline-payment-checkout-complete') !== false ||
                strpos($previous_url, 'track-order') !== false
            ) {
                $redirect_url = route('home');
            }

            // Generate access token
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            
            
                // Reset user attributes
                $user->login_hit_count = 0;
                $user->is_temp_blocked = 0;
                $user->temp_block_time = null;
                $user->updated_at = now();
                $user->save();
                
                // Return response with token
                return response()->json([$token], 200);
             
            

        } else {
            if (isset($user->temp_block_time) && Carbon::parse($user->temp_block_time)->diffInSeconds() <= $temp_block_time) {
                $time = $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $ajax_message = [
                    'status' => 'error',
                    'message' => translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url' => ''
                ];
                Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());

            } elseif ($user->is_temp_blocked == 1 && Carbon::parse($user->temp_block_time)->diffInSeconds() >= $temp_block_time) {

                $user->login_hit_count = 0;
                $user->is_temp_blocked = 0;
                $user->temp_block_time = null;
                $user->updated_at = now();
                $user->save();

                $ajax_message = [
                    'status' => 'error',
                    'message' => translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url' => ''
                ];
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));

            } elseif ($user->login_hit_count >= $max_login_hit && $user->is_temp_blocked == 0) {
                $user->is_temp_blocked = 1;
                $user->temp_block_time = now();
                $user->updated_at = now();
                $user->save();

                $time = $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $ajax_message = [
                    'status' => 'error',
                    'message' => translate('too_many_attempts._please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url' => ''
                ];
                Toastr::error(translate('too_many_attempts._please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
            } else {
                $ajax_message = [
                    'status' => 'error',
                    'message' => translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url' => ''
                ];
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));

                $user->login_hit_count += 1;
                $user->save();
            }
            //login attempt check end

            if ($request->ajax()) {
                return response()->json($ajax_message);
            } else {
                return back()->withInput();
            }
        }
    }

    public function logout(Request $request)
    {
        if(auth()->check()) {
            auth()->user()->token()->revoke();
            return response()->json(['message' => translate('logged_out_successfully')], 200);
        }
        return response()->json(['message'=>translate('logged_out_fail')], 403);
    }
}
