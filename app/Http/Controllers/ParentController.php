<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Growth;
use App\Models\Customer;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\VaccinationSubmission;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
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
            Toastr::error($validator);
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
        //
    }
}
