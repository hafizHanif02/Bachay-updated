<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $articles = Article::with('articlecategory')->orderBy('id','desc')->paginate(10);
        $categories = ArticleCategory::where('status','1')->get();
        if($request->search){
            $articles = Article::with('articlecategory')->where('title','like','%'.$request->search.'%')->orderBy('id','desc')->paginate(10);
        }
        // $categories = ArticleCategory::with('articles')->get();
        return view('admin-views.article.article',compact('articles','categories'));
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
            'text' => 'required|string',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'article_category_id' => 'required|integer|exists:article_category,id',
        ]);
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/articles/thumbnail'), $filename);
        }
        DB::table('articles')->insert([
            'title' => $request->title,
            'text' => $request->text,
            'thumbnail' => ($filename ?? ''),
            'article_category_id' => $request->article_category_id,
        ]);

        Toastr::success('Article Added !');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::where('id',$id)->with('articlecategory')->first();
        $categories = DB::table('article_category')->where('status','1')->orderBy('id','desc')->get();
        // $terms_condition = BusinessSetting::where('type', 'article')->first();
        return view('admin-views.article.edit',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/articles/thumbnail'), $filename);
        }
        DB::table('articles')->where('id',$request->id)->update([
            'title' => $request->title,
            'text' => $request->text,
            'thumbnail' => ($filename ?? ''),
            'article_category_id' => $request->category_id,
        ]);
        Toastr::success('Article Updated !');
        return redirect()->route('admin.article.list');
    }


    public function ArticleStatus(Request $request){
        if($request->status){
            DB::table('articles')->where('id',$request->id)->update([
                'status' => $request->status
            ]);
        }else{
            Article::where('id',$request->id)->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request){
        $article = Article::find($request->id);
        $article->delete();
        return redirect()->back();
    }
}
