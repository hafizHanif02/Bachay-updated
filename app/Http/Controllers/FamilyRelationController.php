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
        return $user;
            $childerens = FamilyRelation::where('user_id', auth('customer')->user()->id)->get();
        
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
