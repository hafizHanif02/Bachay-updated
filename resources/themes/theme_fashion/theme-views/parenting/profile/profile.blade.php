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
                <div class="user-order-count {{ !Request::is('user-profile') ? 'd-none d-md-flex' : '' }}">
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ auth('customer')->user()->orders->count() }}</h3>
                        <span>{{ translate('Memory') }}</span>
                    </div>

                    @php
                        $wish_list_count = \App\Models\Wishlist::where('customer_id', auth('customer')->user()->id)
                            ->whereHas('wishlistProduct')
                            ->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle wishlist_count_status">{{ $wish_list_count }}</h3>
                        <span>{{ translate('Follower') }}</span>
                    </div>
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ auth('customer')->user()->compare_list->count() }}</h3>
                        <span>{{ translate('Following') }}</span>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-flex gap-2">
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}" class="nav-link active">{{ translate('profile') }}</a>
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
                <li class="nav-item">
                    <a href="{{ route('parenting-topics') }}"
                        class="nav-link {{ Request::is('product-compare/index') ? 'active' : '' }}">{{ translate('my_topics') }}</a>
                </li>
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
        <div id="profileTab" class="tab-pane fade show active pb-4">
            <div class="personal-details mb-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center column-gap-4 row-gap-2 mb-4">
                    <h4 class="subtitle m-0 text-capitalize">{{ translate('personal_details') }}</h4>
                    <a href="{{ route('edit-profile-parenting') }}"
                        class="cmn-btn __btn-outline rounded-full text-capitalize">{{ translate('edit_profile') }}</a>
                </div>
                <ul class="personal-details-info">
                    <li>
                        <span class="name">{{ translate('name') }}</span> <span class="clone">:</span>
                        <strong>{{ $customer_detail['f_name'] }} {{ $customer_detail['l_name'] }}</strong>
                    </li>
                    <li class="d-md-block d-none"></li>
                    <li>
                        <span class="name">{{ translate('phone') }}</span> <span class="clone">:</span>
                        <strong>{{ $customer_detail['phone'] }}</strong>
                    </li>
                    <li class="d-md-block d-none"></li>
                    <li>
                        <span class="name">{{ translate('email') }}</span> <span class="clone">:</span>
                        <strong>{{ $customer_detail['email'] }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
