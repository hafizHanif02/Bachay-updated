<?php

namespace App\Http\Controllers;

use App\Models\Growth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\VaccinationSubmission;
use Illuminate\Support\Facades\Validator;

class VaccinationSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $vaccination_submission = VaccinationSubmission::where('id', $id)->with('vaccination.grwoth', 'user', 'child')->first();
        return view('admin-views.parent.child.vaccination_submission.create', compact('vaccination_submission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submission_date' => 'required',
            'image' => 'required',
            'head_circle' => 'required',
            'height' => 'required',
            'weight' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }
        $vaccination_submission = VaccinationSubmission::where('id', $request->id)->with('vaccination.grwoth', 'child')->first();
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/vaccine/submission'), $filename);
        }
        $vaccination_submission->update([
            'submission_date' => $request->submission_date,
            'picture' => $filename,
            'is_taken' => 1
        ]);
        Growth::where(['vaccination_id' => $vaccination_submission->vaccination->id, 'child_id' => $vaccination_submission->child->id])->update([
            'head_circle' => $request->head_circle,
            'height' => $request->height,
            'weight' => $request->weight
        ]);
        Toastr::success('Vaccination submission has been submitted !');
        return redirect()->route('admin.customer.parent.child.show', $vaccination_submission->child->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vaccination_submission = VaccinationSubmission::where('id', $id)->with('vaccination', 'user', 'child')->first();
        $growth = Growth::where(['vaccination_id' => $vaccination_submission->vaccination->id, 'child_id' => $vaccination_submission->child->id])->first();
        return view('admin-views.parent.child.vaccination_submission.show', compact('vaccination_submission','growth'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vaccination_submission = VaccinationSubmission::where('id', $id)->with('vaccination', 'user', 'child')->first();
        $growth = Growth::where(['vaccination_id' => $vaccination_submission->vaccination->id, 'child_id' => $vaccination_submission->child->id])->first();
        return view('admin-views.parent.child.vaccination_submission.edit', compact('vaccination_submission','growth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submission_date' => 'required',
            'image' => 'required',
            'head_circle' => 'required',
            'height' => 'required',
            'weight' => 'required',
        ]);

        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }
        $vaccination_submission = VaccinationSubmission::where('id', $request->id)->with('vaccination.grwoth', 'child')->first();
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/vaccine/submission'), $filename);
        }
        $vaccination_submission->update([
            'submission_date' => $request->submission_date,
            'picture' => $filename,
            'is_taken' => 1
        ]);
        Growth::where(['vaccination_id' => $vaccination_submission->vaccination->id, 'child_id' => $vaccination_submission->child->id])->update([
            'head_circle' => $request->head_circle,
            'height' => $request->height,
            'weight' => $request->weight
        ]);
        Toastr::success('Vaccination submission has been updated !');
        return redirect()->route('admin.customer.parent.child.show', $vaccination_submission->child->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
