<?php

namespace App\Http\Controllers;

use App\Models\ParentArticleCategory;
use App\Models\Vaccination;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $vaccines = Vaccination::where('name', 'like', '%' . $request->search . '%')->get();
        } else {
            $vaccines = Vaccination::get();
        }
        return view('admin-views.vaccine.list', compact('vaccines'));
    }
    public function Vaccination_home()
    {
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        return view('theme-views.vaccination-growth.vaccination-growth-tracker', compact('parent_article_categories'));
    }
    public function view_sample_cart()
    {
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        return view('theme-views.vaccination-growth.view_sample_cart', compact('parent_article_categories'));
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
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'disease' => 'required|string',
            'protest_against' => 'required|string',
            'to_be_give' => 'required|string',
            'how' => 'required|string',
        ]);

        Vaccination::create([
            'name' => $request->name,
            'age' => $request->age,
            'disease' => $request->disease,
            'protest_against' => $request->protest_against,
            'to_be_give' => $request->to_be_give,
            'how' => $request->how,
        ]);
        Toastr::success('Vaccine Added');
        return back();
    }


    public function VaccineSubmissionCreate($id)
    {
        return $id;
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
    public function edit($id)
    {
        $vaccine = Vaccination::find($id);
        return view('admin-views.vaccine.edit', compact('vaccine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'disease' => 'required|string',
            'protest_against' => 'required|string',
            'to_be_give' => 'required|string',
            'how' => 'required|string',
        ]);

        Vaccination::where('id', $request->id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'disease' => $request->disease,
            'protest_against' => $request->protest_against,
            'to_be_give' => $request->to_be_give,
            'how' => $request->how,
        ]);
        Toastr::success('Vaccine Updated');
        return redirect()->route('admin.customer.vaccine.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $vaccine = Vaccination::find($request->id);
        $vaccine->delete();
        Toastr::success('Vaccine Deleted');
        return redirect()->back();
    }
}
