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
    .categories_blogs{
        display: flex;
    }
    .parenting_blog_container{
        display: flex;
    }
    .blog_items_inside{
        display: flex;

    }

    @media only screen and (max-width: 767px) {
        .main_con_articles {
            padding: 0;
        }

        .parenting_blog_container {
            display: block !important;
        }

        .blog_item {
            width: 100%;
        }

        .categories_blogs {
            display: block !important;
        }

        .child_categories_blogs {
            width: 100%;
        }

        .blog_items_inside {
            display: block !important;
        }

        .td_module_wrap {
            display: block !important;

        }

        .child_categories_blogs_aside {
            width: 100%;
            margin-top: 20px;
        }

        .see_all_blogs {
            margin: 0 !important;
        }
        .parenting_blog_container{
            display: block;
        }
        .blog_items_inside{
                display: block;
        }
        .first_blog_title{
            font-size: 20px;
        }
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="main_con_articles">
            <h6 class="category_heading text-light font-poppins ms-4">
                <span class="trending_now_heading"> TRENDING NOW </span>
            </h6>
            <?php 
                $latest_category = $all_parent_categories->sortByDesc('id')->take(10); 
            ?>
            <?php
            $latest_categories = $all_parent_categories->sortByDesc('id')->skip(5)->take(6); 
            ?>            
            {{-- {{ dd($latest_category) }} --}}
            <div class="parenting_blog_container mt-3">
                <div class="blog_item">
                    <div class="position-relative overflow-hidden">
                        <img class="img_blogs" src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$latest_category[0]->image) }}"
                            alt="" width="100%" />
                        <div class="tag_line position-absolute bottom-0 text-light">
                            <h1 class="text-light first_blog_title">{{ $latest_category[0]->name }}</h1>
                            <p>{{ $latest_category[0]->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="blog_item">
                    @if(isset($latest_category[1]))
                    <div class="position-relative overflow-hidden">
                        <img class="img_blogs" src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$latest_category[1]->image) }}"
                            alt="" width="100%" />
                        <div class="tag_line position-absolute bottom-0 text-light">
                            <h3 class="text-light">{{ $latest_category[1]->name }}</h3>
                        </div>
                    </div>
                    @endif
                    <div class="d-flex">
                        @if(isset($latest_category[2]))
                        <div class="blog_item position-relative overflow-hidden">
                            <img class="img_blogs" src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$latest_category[2]->image) }}"
                                alt="" width="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h6 class="text-light">{{ $latest_category[2]->name }}</h6>
                            </div>
                        </div>
                        @endif
                        @if(isset($latest_category[3]))
                        <div class="blog_item position-relative overflow-hidden">
                            <img class="img_blogs" src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$latest_category[3]->image) }}"
                                alt="" width="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h6 class="text-light">{{ $latest_category[3]->name }}</h6>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @foreach($latest_categories as  $category)
            <div class="categories_blogs mt-5 gap-5">
                <div class="child_categories_blogs">
                    <h6 class="category_heading text-light font-poppins">
                        <span class="trending_now_heading"> {{ $category->name }} </span>
                    </h6>
                    <div class="blog_items_inside gap-5 mt-4">
                        <?php $parent_article = $category->articles->sortByDesc('id')->take(6); ?>
                        <div class="blog_item">
                            <a class="text-decoration-none" href="">
                                <img src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$parent_article[0]->image) }}" alt="" width="100%" />
                                <h5 class="mt-2 text-dark">
                                    {{ $parent_article[0]->title }}
                                </h5>
                                {{-- <span class="me-3 text-dark fw-bold">Mahak Arora</span> --}}
                                <span class="text_clr_title">{{ $parent_article[0]->created_at->format('F d, Y') }}/span>
                                <p class="text_clr_title">{{ $parent_article[0]->text }}
                                </p>
                            </a>
                        </div>
                        <div class="blog_item">
                            <a class="text-decoration-none" href="">
                                <img src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$parent_article[1]->image) }}" alt="" width="100%" />
                                <h5 class="mt-2 text-dark">
                                    {{ $parent_article[1]->title }}
                                </h5>
                                {{-- <span class="me-3 text-dark fw-bold">Mahak Arora</span> --}}
                                <span class="text_clr_title">{{ $parent_article[1]->created_at->format('F d, Y') }}</span>
                                <p class="text_clr_title">
                                    {{ $parent_article[1]->text }}
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="td_module_wrap">
                        <?php $lates_article = $parent_article->sortByDesc('id')->skip(4); ?>
                        @foreach($lates_article as $article)
                        <div class="">
                            <a class="text-decoration-none d-flex align-items-center gap-4" href="">
                                <img src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$article->image) }}" alt="" width="100" height="70" />
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
                        <a class="text-decoration-none" href="#">See All</a>
                    </div>
                </div>
                <div class="child_categories_blogs_aside">
                    <h6 class="category_heading text-light font-poppins">
                        <span class="trending_now_heading"> TRENDING </span>
                    </h6>
                    @if(isset($category->child[0]))
                    <div class="position-relative mt-4">
                        <a class="text-decoration-none" href="">
                            <img src="{{ asset('public/images/parenting_home/aside_tiger.jpg') }}" alt="" width="100%" />
                            <div class="position-absolute bottom-0 text-light tag_line">
                                <h6 class="m-0 text-light">
                                    {{ $category->child[0]->name }}
                                </h6>
                                <span></span> <span>{{ $category->child[0]->created_at->format('F d, Y') }}</span>
                            </div>
                        </a>
                    </div>
                    @endif
                    @php
                        $articles = \App\Models\ParentArticle::where('category_id', $category->child[0]->id)
                                                            ->orderBy('id', 'desc')
                                                            ->take(4)
                                                            ->get();
                    @endphp

                    @foreach($articles as $article)
                    <div class="mt-4">
                        <a class="text-decoration-none d-flex align-items-center gap-3" href="">
                            <img src="{{ asset('public/assets/images/parent_articles/thumbnail/'.$article->image) }}" alt="" width="80" height="60" />
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
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
