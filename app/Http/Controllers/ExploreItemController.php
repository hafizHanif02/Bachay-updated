<?php

namespace App\Http\Controllers;

use App\Models\ExploreItem;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ExploreItemController extends Controller
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
        $item = ExploreItem::where('id', $id)->first();
        if($item){
            $item->delete();
            return redirect()->back();
            Toastr::success('Your Item has been deleted');
        }else{
            return redirect()->back();
            Toastr::error('Item not found');
        }

    }
}
