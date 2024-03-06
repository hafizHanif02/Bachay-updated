<?php

namespace App\Http\Controllers;

use App\Models\NavCategory;
use Illuminate\Http\Request;
use App\Models\NavCategorySub;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class NavCategoryController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
        ]);

        
        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/category/nav_category'), $filename);
        }
        NavCategory::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $filename,
            'url' => ($request->url ?? ''),
        ]);

        Toastr::success('Navbar View Has Been Added');
        return back();
    }

    public function Substore(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
        ]);

        
        if ($validator->fails()) {
            Toastr::error($validator->errors()->first()); 
            return back(); 
        }
        NavCategorySub::create([
            'nav_category_id' => $request->nav_category_id,
            'title' => $request->title,
            'url' => $request->url,
        ]);
        Toastr::success('Navbar View SubCategory Has Been Added');
        return back();
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
        $nav = NavCategory::where('id', $id)->with('nav_subs')->first();
        if($nav != null){
            foreach($nav->nav_subs as $nav_subs){
                $nav_subs->delete();
            }
            $nav->delete();
            Toastr::success('Navbar View Has Been Deleted');
            return back();
        }else{
            Toastr::error('Navbar View Not Found');
            return back();
        }
    }

    public function Subdestroy($id){
        $navbar_sub = NavCategorySub::where('id', $id)->first();
        if($navbar_sub != null){
            $navbar_sub->delete();
            Toastr::success('Navbar View SubCategory Has Been Deleted');
            return back();
        } else{
            Toastr::error('Navbar View SubCategory Not Found');
            return back();
        }
    }
}
