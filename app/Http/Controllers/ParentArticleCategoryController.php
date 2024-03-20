<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ParentArticleCategory;

class ParentArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = ParentArticleCategory::paginate(10);
        if($request->search){
            $categories = ParentArticleCategory::where('name','like','%'.$request->search.'%')->orderBy('id','desc')->paginate(10);
        }
        return view('admin-views.parent-article-category.category',compact('categories'));
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
            'tag_line' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/parent_articles/category/thumbnail'), $filename);
        }
        DB::table('parent_article_category')->insert([
            'name' => $request->name,
            'tag_line' => $request->tag_line,
            'image' => ($filename ?? ''),
        ]);
        Toastr::success('Parent Article Category Added');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = ParentArticleCategory::where('id',$id)->first();
        return view('admin-views.parent-article-category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'tag_line' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/parent_articles/category/thumbnail'), $filename);
        }
        DB::table('parent_article_category')->where('id', $request->id)->update([
            'name' => $request->name,
            'tag_line' => $request->tag_line,
            'image' => ($filename ?? ''),
        ]);
        Toastr::success('Parent Article Category Updated');
        return redirect()->route('admin.parent_article.category.list');
    }


    public function ParentArticleCategoryStatus(Request $request){
        if($request->status){
            DB::table('parent_article_category')->where('id',$request->id)->update([
                'status' => $request->status
            ]);
        }else{
            ParentArticleCategory::where('id',$request->id)->update([
                'status' => 0
            ]);
        }
        Toastr::success('Parent Article Category Status Changed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $article = ParentArticleCategory::find($request->id);
        $article->delete();
        Toastr::success('Parent Article Category Deleted');
        return redirect()->back();
    }
}

