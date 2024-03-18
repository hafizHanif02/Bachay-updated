<?php

namespace App\Http\Controllers\Customer\Auth;

use App\User;
use Carbon\Carbon;
use App\Utils\Helpers;
use App\Models\Wishlist;
use App\Utils\SMS_module;
use App\Utils\CartManager;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Models\FamilyRelation;
use App\Models\ProductCompare;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Events\EmailVerificationEvent;
use Illuminate\Support\Facades\Session;
use App\Models\PhoneOrEmailVerification;

class LoginController extends Controller
{
    public $company_name;

    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function captcha(Request $request, $tmp)
    {

        $phrase = new PhraseBuilder;
        $code = $phrase->build(4);
        $builder = new CaptchaBuilder($code, $phrase);
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        $builder->build($width = 100, $height = 40, $font = null);
        $phrase = $builder->getPhrase();

        if(Session::has($request->captcha_session_id)) {
            Session::forget($request->captcha_session_id);
        }
        Session::put($request->captcha_session_id, $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    public function login()
    {
        session()->put('keep_return_url', url()->previous());

        if(theme_root_path() == 'default'){
            return view('web-views.customer-views.auth.login');
        }else{
            return redirect()->route('home');
        }
    }

    public function verifyToken(Request $request){
        // dd($request->all());
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

        return view(VIEW_FILE_NAMES['customer_auth_verify_token'], compact('user'));
    }

    public function submit(Request $request)
    {
     
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'otp' => 'required',
            // 'password' => 'required'
        ]);

        $user = User::where(['phone' => $request->user_id])->orWhere(['email' => $request->user_id])->first();
        $remember = ($request['remember']) ? true : false;

        //login attempt check start
        $max_login_hit = Helpers::get_business_settings('maximum_login_hit') ?? 5;
        $temp_block_time = Helpers::get_business_settings('temporary_login_block_time') ?? 5; //seconds
        if (isset($user) == false) {
            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url'=>''
                ]);
            }else{
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));
                return back()->withInput();
            }
        }
        //login attempt check end

        //phone or email verification check start
        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('account_phone_not_verified'),
                    'redirect_url'=>route('customer.auth.check', [$user->id]),
                ]);
            }else{
                
                return redirect(route('customer.auth.check', [$user->id]));
            }
        }
        if ($email_verification && !$user->is_email_verified) {
            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('account_email_not_verified'),
                    'redirect_url'=>route('customer.auth.check', [$user->id]),
                ]);
            }else{
               
                return redirect(route('customer.auth.check', [$user->id]));
            }
        }
        //phone or email verification check end

        if(isset($user->temp_block_time ) && Carbon::parse($user->temp_block_time)->DiffInSeconds() <= $temp_block_time){
            $time = $temp_block_time - Carbon::parse($user->temp_block_time)->DiffInSeconds();

            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url'=>''
                ]);
            }else{
                Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
                return back()->withInput();
            }
        }
        $token = PhoneOrEmailVerification::where('phone_or_email', $user['email'])->latest()->first();
        if($token->token == $request->otp){
            Auth::guard('customer')->login($user);
        }else{
            Toastr::error(translate('Token_is_incorrect_please_enter_correct_token'));
            return redirect()->back();
        }
        
        if (isset($user) && $user->is_active && (Auth::guard('customer')->user() != null)) {
            $wish_list = Wishlist::whereHas('wishlistProduct',function($q){
               
                return $q;
            })->where('customer_id', auth('customer')->user()->id)->pluck('product_id')->toArray();

            $compare_list = ProductCompare::where('user_id', auth('customer')->id())->pluck('product_id')->toArray();

            session()->put('wish_list', $wish_list);
            session()->put('compare_list', $compare_list);
            Toastr::info(translate('welcome_to') .' '. Helpers::get_business_settings('company_name') . '!');
            CartManager::cart_to_db();

            $user->login_hit_count = 0;
            $user->is_temp_blocked = 0;
            $user->temp_block_time = null;
            $user->updated_at = now();
            $user->save();

            $redirect_url = "";
            $previous_url = url()->previous();

            if (
                strpos($previous_url,'checkout-complete') !== false ||
                strpos($previous_url,'offline-payment-checkout-complete') !== false ||
                strpos($previous_url,'track-order') !== false
            ) {
                $redirect_url = route('home');
            }

            if($request->ajax()) {
               
                return response()->json([
                    'status'=>'success',
                    'message'=>translate('login_successful'),
                    'redirect_url'=> $redirect_url,
                ]);
            }elseif($request->otp){
                return redirect(route('home'));
            }else{
                
                return redirect(session('keep_return_url'));
            }

        }else{

            //login attempt check start
            if(isset($user->temp_block_time ) && Carbon::parse($user->temp_block_time)->diffInSeconds() <= $temp_block_time){
                $time= $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());

            }elseif($user->is_temp_blocked == 1 && Carbon::parse($user->temp_block_time)->diffInSeconds() >= $temp_block_time){

                $user->login_hit_count = 0;
                $user->is_temp_blocked = 0;
                $user->temp_block_time = null;
                $user->updated_at = now();
                $user->save();

                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));

            }elseif($user->login_hit_count >= $max_login_hit &&  $user->is_temp_blocked == 0){
                $user->is_temp_blocked = 1;
                $user->temp_block_time = now();
                $user->updated_at = now();
                $user->save();

                $time= $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('too_many_attempts._please_try_again_after_'). CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('too_many_attempts._please_try_again_after_'). CarbonInterval::seconds($time)->cascade()->forHumans());
            }else{
                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));

                $user->login_hit_count += 1;
                $user->save();
            }
            //login attempt check end

            if($request->ajax()) {
                return response()->json($ajax_message);
            }else{
                return back()->withInput();
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();
        session()->forget('switch_user');
        session()->forget('switch_male');
        session()->forget('switch_female');
        session()->forget('wish_list');
        Toastr::info(translate('come_back_soon').'!');
        return redirect()->route('home');
    }

    public function get_login_modal_data(Request $request)
    {
        return response()->json([
            'login_modal' => view(VIEW_FILE_NAMES['get_login_modal_data'])->render(),
            'register_modal' => view(VIEW_FILE_NAMES['get_register_modal_data'])->render(),
        ]);
    }

    public function CustomerLogin(){
        return view(VIEW_FILE_NAMES['customer_login']);
    }

    


}
