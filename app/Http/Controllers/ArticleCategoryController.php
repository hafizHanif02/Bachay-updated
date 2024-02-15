<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = ArticleCategory::paginate(10);
        if($request->search){
            $categories = ArticleCategory::where('name','like','%'.$request->search.'%')->orderBy('id','desc')->paginate(10);
        }
        return view('admin-views.article-category.category',compact('categories'));
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
            $file->move(public_path('assets/images/articles/category/thumbnail'), $filename);
        }
        DB::table('article_category')->insert([
            'name' => $request->name,
            'tag_line' => $request->tag_line,
            'image' => ($filename ?? ''),
        ]);
        Toastr::success('Article Category Added');
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
        $category = ArticleCategory::where('id',$id)->first();
        return view('admin-views.article-category.edit',compact('category'));
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
            $file->move(public_path('assets/images/articles/category/thumbnail'), $filename);
        }
        DB::table('article_category')->where('id', $request->id)->update([
            'name' => $request->name,
            'tag_line' => $request->tag_line,
            'image' => ($filename ?? ''),
        ]);
        Toastr::success('Article Category Updated');
        return redirect()->route('admin.article.category.list');
    }


    public function ArticleCategoryStatus(Request $request){
        if($request->status){
            DB::table('article_category')->where('id',$request->id)->update([
                'status' => $request->status
            ]);
        }else{
            ArticleCategory::where('id',$request->id)->update([
                'status' => 0
            ]);
        }
        Toastr::success('Article Category Status Changed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $article = ArticleCategory::find($request->id);
        $article->delete();
        Toastr::success('Article Category Deleted');
        return redirect()->back();
    }
}
