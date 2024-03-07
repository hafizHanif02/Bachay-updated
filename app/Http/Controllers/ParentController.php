<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Growth;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Wishlist;
use App\Models\DeliveryMan;
use App\Models\OrderDetail;
use App\Models\Vaccination;
use App\Models\DealOfTheDay;
use App\Models\MostDemanded;
use Illuminate\Http\Request;
use App\Models\FamilyRelation;
use App\Models\ProductCompare;
use Illuminate\Support\Carbon;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\VaccinationSubmission;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    public function __construct(
        private Product      $product,
        private Order        $order,
        private OrderDetail  $order_details,
        private Category     $category,
        private Seller       $seller,
        private Review       $review,
        private DealOfTheDay $deal_of_the_day,
        private Banner       $banner,
        private MostDemanded $most_demanded,
        private DeliveryMan $deliver_man,
        private ProductCompare $compare,
        private Wishlist $wishlist,
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::with('childs')->where('id', '!=', '0')->get();
        return view('admin-views.parent.list', compact('customers'));
    }

    public function ParentView($id)
    {
        $customer = User::where('id', $id)->with('childs')->first();
        if (isset($customer)) {
            return view('admin-views.parent.view', compact('customer'));
        }
        Toastr::error(translate('customer_Not_Found'));
        return back();
    }
    public function parenting_tools()
    {
        return view(VIEW_FILE_NAMES['parenting']);
    }
    


    public function parentuser()
    {
        
        $theme_name = theme_root_path();
        $main_banner = $this->banner->where(['banner_type'=>'Parent Banner', 'theme'=>$theme_name, 'published'=> 1])->latest()->get();
        $main_section_banner = $this->banner->where(['banner_type'=> 'Main Section Banner', 'theme'=>$theme_name, 'published'=> 1])->orderBy('id', 'desc')->latest()->first();
       
        return view(VIEW_FILE_NAMES['parenting-user'],
        
            compact(
                'main_section_banner', 'main_banner',
            )
        );
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'relation_type' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'profile_picture' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        } else {
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
                $file->move(public_path('assets/images/customers/child'), $filename);
            } else {
                $filename = null;
            }
            $childId = DB::table('family_relation')->insertGetId([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'relation_type' => $request->relation_type,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'profile_picture' => ($filename ?? ''),
            ]);
            $Vaccinations = Vaccination::get();
            foreach($Vaccinations as $vaccination){
                $dateOfBirth = $request->dob;
                $carbonDateOfBirth = Carbon::parse($dateOfBirth);
                $resultDate = $carbonDateOfBirth->addWeeks($vaccination->age)->toDateString();
                VaccinationSubmission::create([
                    'user_id' => $request->user_id,
                    'child_id' => $childId,
                    'vaccination_id' => $vaccination->id,
                    'vaccination_date' => $resultDate,
                ]);
                Growth::create([
                    'user_id' => $request->user_id,
                    'child_id' => $childId,
                    'vaccination_id' => $vaccination->id,
                ]);
            }
            Toastr::success('Child Added Successfully');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::guard('customer')->check()){
            FamilyRelation::where(['id'=> $id, 'user_id'=> Auth::guard('customer')->id()])->delete();
            Toastr::success('Child Deleted Successfully');
            return back();
        }else{
            Toastr::error(translate('please_login_first'));
            return back();
        }
    }


    
}
