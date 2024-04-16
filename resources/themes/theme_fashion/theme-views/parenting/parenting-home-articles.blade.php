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
    }

    .blog_items_inside {
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

        .parenting_blog_container {
            display: block;
        }

        .blog_items_inside {
            display: block;
        }

        .first_blog_title ,.tag_line h3 {
            font-size: 14px;
        }
        .tag_line h6 {
            font-size: 10px;
        }
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="main_con_articles">
            <h6 class="category_heading text-light font-poppins ms-4">
                <span class="trending_now_heading"> TRENDING NOW </span>
            </h6>
            <div class="parenting_blog_container mt-3">
                <div class="blog_item">
                    <a href="https://bachay.com/parenting/article/66" style="width: 100%; text-decoration:none;">
                        <div class="position-relative overflow-hidden">
                            <img class="img_blogs" src="{{ asset('public/images/parenting_home/parent-blogs.jpg') }}"
                                alt="" width="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h1 class="text-light first_blog_title">7 Delicious Recipes for Ramadan You Should Try for
                                    Your Family and Friends
                                    </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="blog_item">
                    <a href="https://bachay.com/parenting/article/67" style="width: 100%; text-decoration:none;">
                        <div class="position-relative overflow-hidden">
                            <img class="img_blogs" src="{{ asset('public/images/parenting_home/parenting-eid.jpg') }}"
                                alt="" width="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h3 class="text-light">Ramadan – How to Explain the Holy Month to Your Kids </h3>
                            </div>
                    </a>
                </div>
                <div class="d-flex">
                    <div class="blog_item position-relative overflow-hidden">
                        <a href="https://bachay.com/parenting/article/93"style="width: 100%; text-decoration:none;">
                            <img class="img_blogs" src="{{ asset('public/images/parenting_home/parenting-world.jpg') }}"
                                alt="" width="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h6 class="text-light">Your 18 Week Old Baby – Development, Milestones & Care</h6>
                            </div>
                        </a>
                    </div>
                    <div class="blog_item position-relative overflow-hidden">
                        <a href="https://bachay.com/parenting/article/99"style="width: 100%; text-decoration:none;">
                            <img class="img_blogs" src="{{ asset('public/images/parenting_home/parenting-crowd.jpg') }}"
                                alt="" width="100%" />
                            <div class="tag_line position-absolute bottom-0 text-light">
                                <h6 class="text-light">Impact of Television (TV) on Children – Positive & Negative Effects
                                </h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="categories_blogs mt-5 gap-5">
            <div class="child_categories_blogs">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> GETTING PREGNANT </span>
                </h6>
                <div class="blog_items_inside gap-5 mt-4">
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/87">
                            <img src="{{ asset('public/images/parenting_home/cate.jpg') }}" alt=""
                                width="100%" />
                            <h5 class="mt-2 text-dark">
                                Can Antibiotics Stop You From Getting Pregnant?
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Are your kids fasting this Ramadan? Here is what you need to
                                know about maintaining their health while fasting! As is well
                                known to Muslims across...
                            </p>
                        </a>
                    </div>
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/135">
                            <img src="{{ asset('public/images/parenting_home/categ1.jpg') }}" alt=""
                                width="100%" />
                            <h5 class="mt-2 text-dark">
                                Calendar Method of Family Planning
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Your child is bored of drawing some figures and sketches on
                                paper and pass it off as greeting cards. After the age of 6...
                            </p>
                        </a>
                    </div>
                </div>
                <div class="td_module_wrap">
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/87">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/svcvxcb.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Can Antibiotics Stop You From Getting Pregnant?
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/134">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/XGFH.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Can Antibiotics Stop You From Getting Pregnant?
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="float-end see_all_blogs">
                    <a class="text-decoration-none" href="https://bachay.com/parenting/article/category/45">See All</a>
                </div>
            </div>
            <div class="child_categories_blogs_aside">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> SUBCATEGORIES </span>
                </h6>
                <div class="position-relative mt-4">
                    <a class="text-decoration-none" href="">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/FUTGUYHG.jpg"
                            alt="" width="100%" />
                        <div class="position-absolute bottom-0 text-light tag_line">
                            <h6 class="m-0 text-light">
                                Trying To Conceive Articles
                            </h6>
                            <span>Bachay Editorial</span> <span>June 29, 2021</span>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/89">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/cxvxcb.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Pregnancy Test at Home with Toothpaste – Method & Effectiveness
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="categories_blogs mt-5 gap-5">
            <div class="child_categories_blogs">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> PREGNANT </span>
                </h6>
                <div class="blog_items_inside gap-5 mt-4">
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/79">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/adfad.jpg"
                                alt="" width="100%" />
                            <h5 class="mt-2 text-dark">
                                10 Tips to Stay Healthy during a Summer Pregnancy
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Are your kids fasting this Ramadan? Here is what you need to
                                know about maintaining their health while fasting! As is well
                                known to Muslims across...
                            </p>
                        </a>
                    </div>
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/132">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/GXXGFXC.jpg"
                                alt="" width="100%" />
                            <h5 class="mt-2 text-dark">
                                Should a Pregnant Woman Fast During Ramadan?
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Your child is bored of drawing some figures and sketches on
                                paper and pass it off as greeting cards. After the age of 6...
                            </p>
                        </a>
                    </div>
                </div>
                <div class="td_module_wrap">
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/133">
                            <img src="{{ asset('public/images/parenting_home/category-child.jpg') }}" alt=""
                                width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Ramadan Recipes for Kids – Best Iftar & Suhoor Dishes
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="float-end see_all_blogs">
                    <a class="text-decoration-none" href="#">See All</a>
                </div>
            </div>
            <div class="child_categories_blogs_aside">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> TRENDING </span>
                </h6>
                <div class="position-relative mt-4">
                    <a class="text-decoration-none" href="https://bachay.com/parenting/article/80">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/dvvfb.jpg"
                            alt="" width="100%" />
                        <div class="position-absolute bottom-0 text-light tag_line">
                            <h6 class="m-0 text-light">
                                2 Weeks Pregnant – What to Expect?
                            </h6>
                            <span>Bachay Editorial</span> <span>June 29, 2021</span>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/108">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/hgcgh.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                16 Weeks Pregnant Ultrasound
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/81">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/dsvfdbgfcn.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Using Baking Soda During Pregnancy – Is It Safe?
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/110">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/fht.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                10 Activities to Avoid During Pregnancy
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/82">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/xxvxb.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Second Baby Pregnancy – Know the Signs and Symptoms
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="categories_blogs mt-5 gap-5">
            <div class="child_categories_blogs">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> TODDLER </span>
                </h6>
                <div class="blog_items_inside gap-5 mt-4">
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/64">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/ffb.jpg"
                                alt="" width="100%" />
                            <h5 class="mt-2 text-dark">
                                Typhoid Vaccine for Kids
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Are your kids fasting this Ramadan? Here is what you need to
                                know about maintaining their health while fasting! As is well
                                known to Muslims across...
                            </p>
                        </a>
                    </div>
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/82">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/vczvxcbxcvb.jpg"
                                alt="" width="100%" />
                            <h5 class="mt-2 text-dark">
                                Worm Infection in Babies – Causes, Symptoms & Treatment
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Your child is bored of drawing some figures and sketches on
                                paper and pass it off as greeting cards. After the age of 6...
                            </p>
                        </a>
                    </div>
                </div>
                <div class="td_module_wrap">
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/141">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/XCDXZCX.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Second Baby Pregnancy – Know the Signs and Symptoms
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/66">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/vzvzcv.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    7 Delicious Recipes for Ramadan You Should Try for Your Family and Friends
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/67">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/dfadgfd.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Ramadan – How to Explain the Holy Month to Your Kids
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/140">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/CVZDFDSGSDG.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    24 Months Old Baby Food – Ideas, Chart, and Recipes
                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="float-end see_all_blogs">
                    <a class="text-decoration-none" href="https://bachay.com/parenting/article/category/22">See All</a>
                </div>
            </div>
            <div class="child_categories_blogs_aside">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> TRENDING </span>
                </h6>
                <div class="position-relative mt-4">
                    <a class="text-decoration-none" href="">
                        <img src="{{ asset('public/images/parenting_home/aside_tiger.jpg') }}" alt=""
                            width="100%" />
                        <div class="position-absolute bottom-0 text-light tag_line">
                            <h6 class="m-0 text-light">
                                Interesting Tiger Facts & Information for Kids
                            </h6>
                            <span>Bachay Editorial</span> <span>June 29, 2021</span>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/category/25">
                        <img src="{{ asset('public/images/parenting_home/aside1.jpg') }}" alt="" width="80"
                            height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Importance and Tips to Go Plastic Free with Your Kids
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/category/25">
                        <img src="{{ asset('public/images/parenting_home/asie2.jpg') }}" alt="" width="80"
                            height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Importance and Tips to Go Plastic Free with Your Kids
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="categories_blogs mt-5 gap-5">
            <div class="child_categories_blogs">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> BABY </span>
                </h6>
                <div class="blog_items_inside gap-5 mt-4">
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/68s">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/sfcb.jpg"
                                alt="" width="100%" />
                            <h5 class="mt-2 text-dark">
                                Dressing your Baby Smartly for Winter – Top 8 Tips

                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Are your kids fasting this Ramadan? Here is what you need to
                                know about maintaining their health while fasting! As is well
                                known to Muslims across...
                            </p>
                        </a>
                    </div>
                    <div class="blog_item">
                        <a class="text-decoration-none" href="https://bachay.com/parenting/article/130">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/RFCFC.jpg"
                                alt="" width="100%" />
                            <h5 class="mt-2 text-dark">
                                150+ Cool Baby Names Inspired From Movies & TV Shows
                            </h5>
                            <span class="me-3 text-dark fw-bold">Mahak Arora</span>
                            <span class="text_clr_title">April 18, 2018</span>
                            <p class="text_clr_title">
                                Your child is bored of drawing some figures and sketches on
                                paper and pass it off as greeting cards. After the age of 6...
                            </p>
                        </a>
                    </div>
                </div>
                <div class="td_module_wrap">
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/131">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/SAERSRGF.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    60 Cool Baby Names Inspired From Movies & TV Shows

                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/69">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/zvczv.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Your 19 Week Old Baby – Development, Milestones & Care

                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/92">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/gfg.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    Your 34 Week Old Baby – Development, Milestones & Care

                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                    <div class="">
                        <a class="text-decoration-none d-flex align-items-center gap-4"
                            href="https://bachay.com/parenting/article/70">
                            <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/gfgd.jpg"
                                alt="" width="100" height="70" />
                            <div>
                                <h6 class="text-dark m-0">
                                    9 Must-have Items To Ensure Your Baby Has a Comfortable Summer

                                </h6>
                                <p class="text_clr_title m-0">April 16, 2020</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="float-end see_all_blogs">
                    <a class="text-decoration-none" href="#">See All</a>
                </div>
            </div>
            <div class="child_categories_blogs_aside">
                <h6 class="category_heading text-light font-poppins">
                    <span class="trending_now_heading"> TRENDING </span>
                </h6>
                <div class="position-relative mt-4">
                    <a class="text-decoration-none" href="https://bachay.com/parenting/article/96">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/bfb.jpg"
                            alt="" width="100%" />
                        <div class="position-absolute bottom-0 text-light tag_line">
                            <h6 class="m-0 text-light">
                                Newborn Baby Weight Gain – What’s Normal and What’s Not

                            </h6>
                            <span>Bachay Editorial</span> <span>June 29, 2021</span>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/73">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/wdsvb.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Child Immunization & Vaccination Schedule

                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/103">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/440009740-H-696x476.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                6 Months Old Baby Food Ideas

                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/76">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/zcvzdvxh.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                13 Months Old Baby Food – Ideas, Chart and Recipes
                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
                <div class="mt-4">
                    <a class="text-decoration-none d-flex align-items-center gap-3"
                        href="https://bachay.com/parenting/article/106">
                        <img src="https://bachay.com/public/assets/images/parent_articles/thumbnail/sfdv.jpg"
                            alt="" width="80" height="60" />
                        <div>
                            <h6 class="m-0 aside_blog_title text-dark">
                                Baby Sleeping Position – What is Safe?

                            </h6>

                            <p class="m-0 aside_blog_title" style="color: #767676">
                                June 29, 2021
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
