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
@php
    $customer_info = \App\Utils\customer_info();
@endphp
@section('content')
    <div class="container">
        <div class="user-profile-wrapper bg-section text-capitalize">
            <div class="d-flex justify-content-end">
                <div class="position-relative d-none d-md-block pb-2">
                    <a class="profile-delete-dot" href="javascript:">
                        <span><i class="bi bi-three-dots"></i></span>
                    </a>
                    <div class="dropdown-menu __dropdown-menu border-0 shadow-lg">
                        @if ($customer_info != null)
                            <ul>
                                <li class="px-3">
                                    <a href="javascript:" class="text-danger route_alert_function"
                                        data-routename="{{ route('account-delete', [$customer_info['id']]) }}"
                                        data-message="{{ translate('want_to_delete_this_account?') }}" data-typename="">
                                        <i class="bi bi-trash pe-1"></i> {{ translate('delete_profile') }}
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="inner-div">
                <div class="user-author-info-wrap">
                    <div class="user-author-info">
                        <img loading="lazy" alt="{{ translate('profile') }}"
                            src="{{ getValidImage(path: 'storage/app/public/profile/' . $customer_info->image, type: 'avatar') }}">
                        <div class="content">
                            <h4 class="name mb-lg-2">{{ $customer_info->f_name }} {{ $customer_info->l_name }}</h4>
                            <span>{{ translate('joined') }}
                                {{ date('d M, Y', strtotime($customer_info->created_at)) }}</span>
                        </div>
                    </div>
                    <div class="d-md-none">
                        <button
                            class="btn-circle btn btn-primary d-flex justify-content-center align-items-center size-1-2rem"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfile"
                            aria-controls="offcanvasProfile">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>
                    @php
                        $child = \App\Models\FamilyRelation::where('user_id', auth('customer')->id())
                            ->count();
                    @endphp
                <div class="user-order-count {{ !Request::is('user-profile') ? 'd-none d-md-flex' : '' }}">
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ $child }}</h3>
                        <span>{{ translate('Total_child') }}</span>
                    </div>

                    @php
                        $questions = \App\Models\QnaQuestion::where('user_id', auth('customer')->id())
                            ->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle wishlist_count_status">{{ $questions }}</h3>
                        <span>{{ translate('Total_questions') }}</span>
                    </div>
                    @php
                        $answers = \App\Models\QnaAnswer::where('user_id', auth('customer')->id())
                            ->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ $answers }}</h3>
                        <span>{{ translate('Total_answers') }}</span>
                    </div>
                </div>
            </div>
        </div>
            <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-flex">
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}"
                        class="nav-link {{ Request::is('parenting-question') || Request::is('parenting-question') || Request::is('parenting-question') ? 'active' : '' }}">Overview
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parenting-question') }}"
                        class="nav-link {{ Request::is('parenting-question') || Request::is('parenting-question') || Request::is('parenting-question') ? 'active' : '' }}">{{ translate('my_questions') }}
                    </a>
                </li>
                <li class="nav-item">

                    <a href="{{ route('parenting-answer') }}"
                        class="nav-link {{ Request::is('parenting-answer') ? 'active' : '' }}">{{ translate('my_answers') }}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-topics') }}"
                        class="nav-link {{ Request::is('parenting-topics') ? 'active' : '' }}">{{ translate('my_topics') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('parenting-memories') }}"
                        class="nav-link {{ Request::is('parenting-memories') || Request::is('parenting-memories') ? 'active' : '' }}">{{ translate('my_memories') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-quick-reads') }}"
                        class="nav-link {{ Request::is('parenting-quick-reads') || Request::is('parenting-quick-reads') ? 'active' : '' }}">{{ translate('my_quick_reads') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-milestones') }}"
                        class="nav-link {{ Request::is('parenting-milestones') || Request::is('parenting-milestones') ? 'active' : '' }}">{{ translate('my_milestons') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bumpie') }}"
                        class="nav-link {{ Request::is('parenting-bumpie') || Request::is('parenting-bumpie') ? 'active' : '' }}">{{ translate('my_bumpie') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('favourite-names-parenting') }}"
                        class="nav-link {{ Request::is('user-coupons') || Request::is('user-coupons*') ? 'active' : '' }}">{{ translate('my_favourite_names') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bookmarks') }}"
                        class="nav-link {{ Request::is('parenting-bookmarks') || Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                </li>
            </ul>
        </div>
        <div class="container mt-5">
            <h1 class="text-center mb-4">My Topics</h1>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-12 text-center mb-3">
                    <h2 class="mb-3 cursor-pointer" id="commentedHeading" onclick="toggleSection('commented')">Commented
                    </h2>
                    <img src="{{ asset('public/images/no-comment.PNG') }}" alt="Image for Commented" class="img-fluid"
                        id="commentedImage" style="display: inline-block;">
                    <p class="alert alert-info d-block" id="commentedInfo">Seems like you haven't commented on any topic on
                        Discussions</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-center mb-3">
                    <h2 class="mb-3 cursor-pointer" id="followedHeading" onclick="toggleSection('followed')">Followed
                    </h2>
                    <img src="{{ asset('public/images/no-comment.PNG') }}" alt="Image for Followed" class="img-fluid"
                        id="followedImage" style="display: none;">
                    <p class="alert alert-info d-none" id="followedInfo">Seems like you haven't followed on any topic on
                        Discussions</p>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end text-capitalize" tabindex="-1" id="offcanvasProfile"
        aria-labelledby="offcanvasProfileLabel">
        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav nav-tabs nav--tabs-3 p-2 flex-column">
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}"
                        class="nav-link {{ Request::is('parenting-profile') ? 'active' : '' }}">Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-question') }}"
                        class="nav-link {{ Request::is('parenting-question') ? 'active' : '' }}">{{ translate('my_questions') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-answer') }}"
                        class="nav-link {{ Request::is('parenting-answer') ? 'active' : '' }}">{{ translate('my_answers') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('favourite-names-parenting') }}"
                        class="nav-link {{ Request::is('favourite-names-parenting') ? 'active' : '' }}">{{ translate('my_favourite_names') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bookmarks') }}"
                        class="nav-link {{ Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-my-child') }}"
                        class="nav-link {{ Request::is('parenting-my-child') ? 'active' : '' }}">My Childs</a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        function toggleSection(section) {
            var sectionInfo = document.getElementById(section + "Info");
            var sectionImage = document.getElementById(section + "Image");
            var otherSection = (section === "commented") ? "followed" : "commented";
            var otherSectionInfo = document.getElementById(otherSection + "Info");
            var otherSectionImage = document.getElementById(otherSection + "Image");
            sectionInfo.classList.remove("d-none");
            sectionImage.style.display = "inline-block";
            otherSectionInfo.classList.add("d-none");
            otherSectionImage.style.display = "none";

            // Add underline to the clicked section and remove underline from the other section
            document.getElementById(section + "Heading").style.textDecoration = "underline";
            document.getElementById(otherSection + "Heading").style.textDecoration = "none";
        }
    </script>
@endsection
