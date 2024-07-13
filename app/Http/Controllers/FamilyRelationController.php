<?php

namespace App\Http\Controllers;

use App\Models\Growth;
use Illuminate\Http\Request;
use App\Models\FamilyRelation;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\VaccinationSubmission;

class FamilyRelationController extends Controller
{
    public function childHome(Request $request){
        $user = $request->user();
        
            $childerens = FamilyRelation::where('user_id', $user->id)->get();
            $child = FamilyRelation::where('user_id', $user->id)->with('parent','vaccination_submission.vaccination','growth')->get();
            return $child;
        
    }
    public function index()
    {
        //
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
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
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
                'user_id' => $request->user()->id,
                'name' => $request->name,
                'relation_type' => $request->relation_type,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'profile_picture' => ($filename ?? ''),
            ]);
            $Vaccinations = Vaccination::get();
            foreach ($Vaccinations as $vaccination) {
                $dateOfBirth = $request->dob;
                $carbonDateOfBirth = Carbon::parse($dateOfBirth);
                $resultDate = $carbonDateOfBirth->addWeeks($vaccination->age)->toDateString();
                VaccinationSubmission::create([
                    'user_id' => $request->user_id,
                    'child_id' => $childId,
                    'vaccination_id' => $vaccination->id,
                    'vaccination_date' => $resultDate,
                ]);
            }
            
            return response()->json(['message' => 'New Childeren has been added successfully.'], 200);
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
    public function show($id)
    {
        $child = FamilyRelation::where('id', $id)->with('parent','vaccination_submission.vaccination','growth')->first();
        return view('admin-views.parent.child.show', compact('child'));
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
    public function destroy(Request $request)
    {
        FamilyRelation::where('id', $request->id)->delete();
        VaccinationSubmission::where('child_id', $request->id)->delete();
        Growth::where('child_id', $request->id)->delete();
        Toastr::success('Child Deleted Successfully');
        return back();
    }
}
