<?php

namespace App\Http\Controllers;

use App\Models\Explore;
use App\Models\Product;
use App\Models\ExploreItem;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $explores = Explore::paginate(10);
        $products = Product::all();
        if($request->search){
            $explores = Explore::where('title','like','%'.$request->search.'%')->orderBy('id','desc')->paginate(10);
        }
        return view('admin-views.explore.list',compact(['explores','products']));
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
            'title' => 'required|string|max:255',
            'media' => 'required|file',
            'products' => 'required|array', // Assuming products is an array
            'products.*' => 'exists:products,id', // Assuming products exist in your database
        ]);
    
        // Ensure file upload is successful before moving
        if ($request->file('media')->isValid()) {
            $file = $request->file('media');
            $filename = uniqid().'.'.$file->getClientOriginalExtension(); // Generating a unique filename
            $file->move(public_path('assets/images/explore/media'), $filename);
        } else {
            // Handle file upload failure
            return back()->withErrors(['media' => 'Failed to upload media']);
        }
    
        // Create Explore record
        $explore = Explore::create([
            'title' => $request->title,
            'media' => $filename,
            'tags' => $request->tags,
        ]);
    
        $exploreId = $explore->id;
    
        // Create ExploreItem records for each product
        foreach ($request->products as $product) {
            ExploreItem::create([
                'explore_id' => $exploreId,
                'product_id' => $product,
            ]);
        }
    
        // Assuming Toastr is properly configured, otherwise replace with appropriate logic
        Toastr::success('Explore has Been Added !');
        return back();
    }
    


    public function show(string $id)
    {
        //
    }

    public function ExploreStatus(Request $request)
    {
        if ($request->status) {
            Explore::where('id', $request->id)->update([
                'status' => $request->status
            ]);
        } else {
            Explore::where('id', $request->id)->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $explore = Explore::where('id',$id)->with('items.product')->first();
        $products = Product::all();
        return view('admin-views.explore.edit',compact(['explore','products']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $explore = Explore::find($id);
        $filePath = public_path('assets/images/explore/media') . '/' . $explore->media;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        if ($request->file('media')) {
            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/explore/media'), $filename);
        }
        $explore->update([
            'title' => $request->title,
            'media' => $filename,
            'tags' => $request->tags,
        ]);
        Toastr::success('Explore has Been Updated !');
        return redirect()->route('admin.explore.list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $explore = Explore::find($id);
        $filePath = public_path('assets/images/explore/media') . '/' . $explore->media;
        if (file_exists($filePath)) {
            Storage::delete($filePath);
        }
        $explore->delete();
        Toastr::success('Explore has Been Deleted !');
        return back();

    }




    public function explore(){
        $explore = Explore::with('items.product')->get();
        
        return view(VIEW_FILE_NAMES['explore'], compact('explore'));

    }
}
