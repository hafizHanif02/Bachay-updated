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
        $articles = ParentArticle::with('articlecategory')->orderBy('id', 'desc')->paginate(100);
        $categories = ParentArticleCategory::where('status', '1')->get();
        if ($request->search) {
            $articles = ParentArticle::with('articlecategory')->where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(100);
        }
        // $categories = ArticleCategory::with('articles')->get();
        return view('admin-views.parent-article.article', compact('articles', 'categories'));
    }

    public function parentArticleCategory($id)
    {
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        $parent_category = ParentArticleCategory::where('id', $id)->with('articles', 'child')->first();
        return view('theme-views.parent.article_category', compact('parent_article_categories', 'parent_category'));
    }

    public function parentArticle($id)
    {
        $parent_article_categories = ParentArticleCategory::where(['status' => 1, 'parent_id' => 0])->with('child')->latest()->take(5)->get();
        $article = ParentArticle::where('status', '1')->where('id', $id)->first();
        $slidder_article = ParentArticle::orderBy('id', 'desc')->where('status', '1')->take(6)->get();
        $categories = ParentArticleCategory::where('status', '1')->get();


        return view('theme-views.parent.article', compact('article', 'slidder_article', 'categories', 'parent_article_categories'));
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

    // APi methods

    public function get_articles(Request $request)
    {
        $articles = ParentArticle::where('status', '1')->get();

        foreach ($articles as $article) {
            //http://localhost/public/assets/images/parent_articles/thumbnail/ZDVCV.jpg
            $article->thumbnail = asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail);
        }

        $modified_articles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'thumbnail' => $article->thumbnail,
                'article_category_id' => $article->article_category_id,
                'article_category' => $article->articlecategory->name,
                'created_at' => $article->created_at,
                'text' => $article->text
            ];
        });
        return response()->json([
            'articles' => $modified_articles
        ]);
    }

    public function get_article_categories(Request $request)
    {
        $categories = ParentArticleCategory::where('status', '1')->get();
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function get_trending_articles(Request $request)
    {
        $articles = ParentArticle::where('status', '1')->take(3)->get();

        foreach ($articles as $article) {
            //http://localhost/public/assets/images/parent_articles/thumbnail/ZDVCV.jpg
            $article->thumbnail = asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail);
        }

        $modified_articles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'thumbnail' => $article->thumbnail,
                'article_category_id' => $article->article_category_id,
                'article_category' => $article->articlecategory->name,
                'created_at' => $article->created_at,
                'text' => $article->text
            ];
        });
        return response()->json([
            'articles' => $modified_articles
        ]);
    }

    public function get_latest_articles(Request $request){
        
        $articles = ParentArticle::where('status', '1')
            ->orderBy('created_at', 'desc') // Sort by created_at date in descending order (latest first)
            ->take(3) // Limit to 3 articles
            ->get();

        foreach ($articles as $article) {
            // Modify the thumbnail URL
            $article->thumbnail = asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail);
        }

        // Map the articles to the desired format
        $modified_articles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'thumbnail' => $article->thumbnail,
                'article_category_id' => $article->article_category_id,
                'article_category' => $article->articlecategory->name,
                'created_at' => $article->created_at,
                'text' => $article->text
            ];
        });

        // Return the response with only the latest 3 trending articles
        return response()->json([
            'articles' => $modified_articles
        ]);
    }

    public function random_category_articles(Request $request){
        
        $count = 0;

        while ($count == 0 || $count == 1) {
            $category_articles = self::getRendomCategoryArticles($request);
            $articles_count = ParentArticle::where('status', '1')->where('article_category_id', $category_articles->id)->inRandomOrder()->count();
            $count = $articles_count;
        }
        
        

        $articles = ParentArticle::where('status', '1')->where('article_category_id', $category_articles->id)->with('articlecategory')->get();
        foreach ($articles as $article) {
            // Modify the thumbnail URL
            $article->thumbnail = asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail);
        }
        $modified_articles = $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'thumbnail' => $article->thumbnail,
                'article_category_id' => $article->article_category_id,
                'article_category' => $article->articlecategory->name,
                'created_at' => $article->created_at,
                'text' => $article->text
            ];
        });
        return response()->json([
            'category' => $category_articles,
            'articles' => $articles
        ]);
    }

    public function category_articles(Request $request, $catID)
    {
        $articles = ParentArticle::where('status', '1')->where('article_category_id', $catID)->with('articlecategory')->get();
        foreach ($articles as $article) {
            // Modify the thumbnail URL
            $article->thumbnail = asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail);
        }
        return response()->json([
            'articles' => $articles
        ]);
    }

    public function getRendomCategoryArticles(Request $request){    
        $category_articles = ParentArticleCategory::where('status','1')->inRandomOrder()->take(1)->first();
        return $category_articles;
    }

    public function detail($id){
        $article = ParentArticle::with('articlecategory')->find($id);
        $article->thumbnail = asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail);
        return response()->json([
            'article' => $article
        ]);
    }
}
