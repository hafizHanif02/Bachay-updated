@extends('theme-views.layouts.parenting-header')

@push('css_or_js')
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="og:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

    <meta property="twitter:card"
        content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:title" content="Welcome To {{ $web_config['name']->value }} Home" />
    <meta property="twitter:url" content="{{ config('app.url') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush
<style>
    .main_con_articles {
        padding: 0 60px;

    }

    .tag_line {
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%
    }

    .blog_item {
        width: 50%;
    }

    .img_blogs:hover {
        transform: scale(1.09);
        transition: transform 0.3s ease;
    }

    .trending_now_heading {
        background-color: #ef3b74;
        width: fit-content;
        padding: 5px;
    }

    .category_heading {
        border-bottom: 3px solid #ef3b74;
        padding: 5px 5px 5px 0 !important;
    }

    .child_categories_blogs {
        width: 66.66666667%;
    }

    .child_categories_blogs_aside {
        width: 33.33333333%;
    }

    .td_module_wrap {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .text_clr_title {
        color: #767676;
        font-size: 15px;
    }

    .aside_blog_title {
        font-size: 13px;
    }

    .see_all_blogs {
        font-weight: 600;
        margin: 10px 0 0 0;
    }

    .see_all_blogs a {
        color: #ef3b74;
    }

    .categories_blogs {
        display: flex;
    }

    .parenting_blog_container {
        display: flex;
        height: 400px;
    }

    .blog_items_inside {
        display: flex;

    }
    .first_blog_title{
        font-size: 20px;
    }
    .tag_line h3{
        font-size: 16px;

    }
    .tag_line h6{
        font-size: 15px;

    }
    
</style>

@section('content')
    <div class="container mt-5">
        <div class="main_con_articles">
            <h6 class="category_heading text-light font-poppins ms-4">
                <span class="trending_now_heading"> TRENDING NOW </span>
            </h6>
            <?php $first_article = $all_parent_articles->first(); ?>
            <?php $second_article = $all_parent_articles->skip(1)->first(); ?>
            <?php $third_article = $all_parent_articles->skip(2)->first(); ?>
            <?php $fourth_article = $all_parent_articles->skip(3)->first(); ?>
            <div class="parenting_blog_container mt-3">
                <div class="blog_item">
                    <a href="{{ route('parenting.article.detail', $first_article->id) }}"
                        style="width: 100%; text-decoration:none;">
                        <div class="position-relative overflow-hidden">
                            <img class="img_blogs"
                                src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $first_article->thumbnail) }}"
                                alt="" width="100%" height="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h1 class="text-light first_blog_title">{{ $first_article->title }}
                                    </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="blog_item">
                    <a href="{{ route('parenting.article.detail', $second_article->id) }}"
                        style="width: 100%; text-decoration:none;">
                        <div class="position-relative overflow-hidden h-50">
                            <img class="img_blogs"
                                src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $second_article->thumbnail) }}"
                                alt="" width="100%" height="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h3 class="text-light">{{ $second_article->title }} </h3>
                            </div>
                        </div>
                    </a>
                    <div class="d-flex h-50">
                        <div class="blog_item position-relative overflow-hidden h-100">
                            <a
                                href="{{ route('parenting.article.detail', $third_article->id) }}"style="width: 100%; text-decoration:none;">
                                <img class="img_blogs"
                                    src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $third_article->thumbnail) }}"
                                    alt="" width="100%" height="100%" />
                                <div class="tag_line position-absolute bottom-0 text-light">
                                    <h6 class="text-light">{{ $third_article->title }}</h6>
                                </div>
                            </a>
                        </div>
                        <div class="blog_item position-relative overflow-hidden h-100">
                            <a
                                href="{{ route('parenting.article.detail', $fourth_article->id) }}"style="width: 100%; text-decoration:none;">
                                <img class="img_blogs"
                                    src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $fourth_article->thumbnail) }}"
                                    alt="" width="100%" height="100%" />
                                <div class="tag_line position-absolute bottom-0 text-light">
                                    <h6 class="text-light">{{ $fourth_article->title }}
                                    </h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($all_parent_categories as $category)
            <div class="categories_blogs mt-5 gap-5">
                <div class="child_categories_blogs">
                    <h6 class="category_heading text-light font-poppins">
                        <span class="trending_now_heading"> {{ $category->name }} </span>
                    </h6>
                    <div class="blog_items_inside gap-5 mt-4">
                        <?php $articles = $category->articles->take(2); ?>
                        <?php $small_article = $category->articles->skip(2)->take(2); ?>
                        @foreach ($articles as $article)
                            <div class="blog_item">
                                <a class="text-decoration-none"
                                    href="{{ route('parenting.article.detail', $article->id) }}">
                                    <img src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail) }}"
                                        alt="" width="100%" />
                                    <h5 class="mt-2 text-dark">
                                        {{ $article->title }}
                                    </h5>
                                    {{-- <span class="me-3 text-dark fw-bold">Mahak Arora</span> --}}
                                    <span class="text_clr_title">{{ $article->created_at->format('F d, Y') }}</span>
                                    <p class="text_clr_title">
                                        {{ Illuminate\Support\Str::limit($article->text, $limit = 100, $end = '...') }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="td_module_wrap">
                        @foreach ($small_article as $article)
                            <div class="">
                                <a class="text-decoration-none d-flex align-items-center gap-4"
                                    href="{{ route('parenting.article.detail', $article->id) }}">
                                    <img src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail) }}"
                                        alt="" width="100" height="70" />
                                    <div>
                                        <h6 class="text-dark m-0">
                                            {{ $article->title }}
                                        </h6>
                                        <p class="text_clr_title m-0">{{ $article->created_at->format('F d, Y') }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-end see_all_blogs">
                        <a class="text-decoration-none" href="{{ route('parenting.article.category', $category->id) }}">See
                            All</a>
                    </div>
                </div>
                <div class="child_categories_blogs_aside">
                    <h6 class="category_heading text-light font-poppins">
                        <span class="trending_now_heading"> SUBCATEGORIES </span>
                    </h6>
                    <?php $sub_category = $category->child->first(); ?>
                    <?php $article = $sub_category->articles->first(); ?>
                    <div class="position-relative mt-4">
                        <a class="text-decoration-none"
                            href="{{ route('parenting.article.category', $sub_category->id) }}">
                            <img src="{{ asset('public/assets/images/parent_articles/category/thumbnail/' . $sub_category->image) }}"
                                alt="" width="100%" />
                            <div class="position-absolute bottom-0 text-light tag_line">
                                <h6 class="m-0 text-light">
                                    {{ $sub_category->name }}
                                </h6>
                                <span></span> <span>{{ $sub_category->created_at->format('F d, Y') }}</span>
                            </div>
                        </a>
                    </div>
                    @if ($article)
                        <div class="mt-4">
                            <a class="text-decoration-none d-flex align-items-center gap-3"
                                href="{{ route('parenting.article.detail', $article->id) }}">
                                <img src="{{ asset('public/assets/images/parent_articles/thumbnail/' . $article->thumbnail) }}"
                                    alt="" width="80" height="60" />
                                <div>
                                    <h6 class="m-0 aside_blog_title text-dark">
                                        {{ $article->title }}
                                    </h6>

                                    <p class="m-0 aside_blog_title" style="color: #767676">
                                        {{ $article->created_at->format('F d, Y') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection
