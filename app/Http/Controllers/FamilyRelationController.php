<?php

namespace App\Http\Controllers;

use App\Models\Growth;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use App\Models\FamilyRelation;
use App\Models\Vaccination;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\VaccinationSubmission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

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
    public function add_child(Request $request)
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
                    'user_id' => $request->user()->id,
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
    public function childDetail($id)
    {
        $child = FamilyRelation::where('id', $id)->with('parent','vaccination_submission.vaccination','growth')->first();
        return response()->json(['child' => $child], 200);
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
    public function update_child(Request $request, $childId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'relation_type' => 'sometimes|required|string|max:255',
            'dob' => 'sometimes|required|date',
            'gender' => 'sometimes|required|string|in:male,female,other',
            'profile_picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
    
        // Find the existing child record
        $child = DB::table('family_relation')->where('id', $childId)->first();
    
        if (!$child) {
            return response()->json(['errors' => ['message' => 'Child not found']], 404);
        }
    
        // Handle file upload if provided
        $filename = $child->profile_picture; // Default to existing profile picture
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // Generate a unique filename
            $file->move(public_path('assets/images/customers/child'), $filename);
        }
    
        // Update the child record
        DB::table('family_relation')->where('id', $childId)->update([
            'name' => $request->name ?? $child->name,
            'relation_type' => $request->relation_type ?? $child->relation_type,
            'dob' => $request->dob ?? $child->dob,
            'gender' => $request->gender ?? $child->gender,
            'profile_picture' => $filename, // This will be updated only if a new profile picture is uploaded
        ]);
    
        // Update vaccination dates if DOB is updated
        if ($request->filled('dob')) {
            $vaccinations = Vaccination::get();
            foreach ($vaccinations as $vaccination) {
                $carbonDateOfBirth = Carbon::parse($request->dob);
                $resultDate = $carbonDateOfBirth->addWeeks($vaccination->age)->toDateString();
    
                VaccinationSubmission::where('child_id', $childId)
                    ->where('vaccination_id', $vaccination->id)
                    ->update([
                        'vaccination_date' => $resultDate,
                    ]);
            }
        }
    
        return response()->json(['message' => 'Child data has been updated successfully.'], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete_child(Request $request)
    {
        FamilyRelation::where('id', $request->child_id)->delete();
        VaccinationSubmission::where('child_id', $request->child_id)->delete();
        Growth::where('child_id', $request->child_id)->delete();
        return response()->json(['message' => 'Childeren has been deleted successfully.'], 200);
        // Toastr::success('Child Deleted Successfully');
        // return back();
    }
}
