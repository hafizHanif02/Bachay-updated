<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentArticle;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ParentArticleCategory;

class ParentArticleController extends Controller
{
    public function article($id)
    {

        $article = ParentArticle::where('status', '1')->where('id', $id)->first();
        $slidder_article = ParentArticle::orderBy('id', 'desc')->where('status', '1')->take(6)->get();
        $categories = ParentArticleCategory::where('status', '1')->get();


        return view(VIEW_FILE_NAMES['article'], compact('article', 'slidder_article', 'categories'));
    }
    public function articles()
    {
        $latest_article = ParentArticle::orderBy('id', 'desc')->where('status', '1')->first();
        $slidder_article = ParentArticle::orderBy('id', 'desc')->where('status', '1')->take(6)->get();
        $all_articles = ParentArticle::with('articlecategory')->where('status', '1')->get();
        $categories = ParentArticleCategory::where('status', '1')->get();
        return view(VIEW_FILE_NAMES['articles'], compact('latest_article', 'slidder_article', 'all_articles', 'categories'));
    }
    public function index(Request $request)
    {
        $articles = ParentArticle::with('articlecategory')->orderBy('id', 'desc')->paginate(10);
        $categories = ParentArticleCategory::where('status', '1')->get();
        if ($request->search) {
            $articles = ParentArticle::with('articlecategory')->where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(10);
        }
        // $categories = ArticleCategory::with('articles')->get();
        return view('admin-views.parent-article.article', compact('articles', 'categories'));
    }

    public function parentArticle($id){
        $parent_article_categories = ParentArticleCategory::where('status', 1)->with('child')->latest()->take(5)->get();
        $parent_category = ParentArticleCategory::where('id', $id)->with('articles','child')->first();
        return view('theme-views.parent.parent_article', compact('parent_article_categories','parent_category'));
    }

    public function CategoryArticle($id)
    {
        $article_category = ParentArticleCategory::where('id', $id)->with('articles')->first();
        $categories = ParentArticleCategory::where('status', '1')->get();
        return view(VIEW_FILE_NAMES['article-category'], compact('article_category', 'categories'));
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
            'text' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'article_category_id' => 'required|integer|exists:parent_article_category,id',
        ]);
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/parent_articles/thumbnail'), $filename);
        }
        ParentArticle::create([
            'title' => $request->title,
            'text' => $request->text,
            'thumbnail' => $filename,
            'article_category_id' => $request->article_category_id,
        ]);

        Toastr::success('Parent Article Added !');
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
        $article = ParentArticle::where('id', $id)->with('articlecategory')->first();
        $categories = DB::table('parent_article_category')->where('status', '1')->orderBy('id', 'desc')->get();
        // $terms_condition = BusinessSetting::where('type', 'article')->first();
        return view('admin-views.parent-article.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentArticle $article)
    {
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/parent_articles/thumbnail'), $filename);
        }
        DB::table('parent_articles')->where('id', $request->id)->update([
            'title' => $request->title,
            'text' => $request->text,
            'article_category_id' => $request->article_category_id,
            'thumbnail' => $filename,
        ]);
        Toastr::success('Article Updated !');
        return redirect()->route('admin.parent_article.list');
    }


    public function ParentArticleStatus(Request $request)
    {
        if ($request->status) {
            DB::table('parent_articles')->where('id', $request->id)->update([
                'status' => $request->status
            ]);
        } else {
            ParentArticle::where('id', $request->id)->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $article = ParentArticle::find($request->id);
        $article->delete();
        return redirect()->back();
    }
}
