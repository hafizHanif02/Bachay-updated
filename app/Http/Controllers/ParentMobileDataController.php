<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ParentMobileData;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ParentMobileDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parent_mobile_data = ParentMobileData::paginate(10);
        return view('admin-views.parent_mobile.list',compact(['parent_mobile_data']));
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
            'image' => 'required',
            'type' => 'required',
        ]);
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/parent_mobile'), $filename);
        }else{
            $filename = null;
        }
         ParentMobileData::create([
            'image' => $filename,
            'type' => $request->type,
            'link' => $request->link,
            'width' => $request->width,
            'margin_bottom' => $request->margin_bottom,
        ]);
        Toastr::success('Parent Mobile Data has Been Created !');
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
        $parenting_data = ParentMobileData::where('id',$id)->first();
        return view('admin-views.parent_mobile.edit',compact(['parenting_data']));
    }


    public function ParentMobileStatus(Request $request)
    {
        if ($request->status) {
            ParentMobileData::where('id', $request->id)->update([
                'status' => $request->status
            ]);
        } else {
            ParentMobileData::where('id', $request->id)->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'type' => 'required',
        ]);
        $parent_mobile_data =  ParentMobileData::where('id',$request->id)->first();

        $directory = public_path('assets/images/parent_mobile');
        $oldImage = $parent_mobile_data->image;
        if ($oldImage) {
            Storage::delete($directory . '/' . $oldImage);
        }
    

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/parent_mobile'), $filename);
        }else{
            $filename = null;
        }
        $parent_mobile_data->update([
            'image' => $filename,
            'type' => $request->type,
            'link' => $request->link,
            'width' => $request->width,
            'margin_bottom' => $request->margin_bottom,
        ]);

        
        
        Toastr::success('Parent Mobile Data has Been Updated !');
        return redirect()->route('admin.parent_mobile.list');
    }

    public function destroy(string $id)
    {
        $poll = ParentMobileData::find($id);
        $poll->delete();
        Toastr::success('Parent Mobile Data Been Deleted !');
        return back();
    }
}
