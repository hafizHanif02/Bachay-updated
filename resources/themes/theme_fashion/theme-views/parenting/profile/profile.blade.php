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
                {{-- <li class="nav-item">
                    <a href="{{ route('user-profile') }}"
                        class="nav-link {{ Request::is('user-profile') || Request::is('user-account') || Request::is('account-address-*') ? 'active' : '' }}">{{ translate('profile') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}" class="nav-link active">{{ translate('profile') }}</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('parenting-question') }}"
                        class="nav-link {{ Request::is('parenting-question') || Request::is('parenting-question') || Request::is('parenting-question') ? 'active' : '' }}">{{ translate('my_question') }}
                    </a>
                </li>
                <li class="nav-item">

                    <a href="{{ route('parenting-answer') }}"
                        class="nav-link {{ Request::is('parenting-answer') ? 'active' : '' }}">{{ translate('my_answer') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-topics') }}"
                        class="nav-link {{ Request::is('product-compare/index') ? 'active' : '' }}">{{ translate('my_topic') }}</a>
                </li>
                {{-- @if ($web_config['wallet_status'] == 1)
                    <li class="nav-item">
                        <a href="{{ route('wallet') }}"
                            class="nav-link {{ Request::is('wallet') || Request::is('loyalty') ? 'active' : '' }} ">{{ translate('my_wallet') }}</a>
                    </li>
                @endif
                @if ($web_config['loyalty_point_status'] == 1 && $web_config['wallet_status'] != 1)
                    <li class="nav-item">
                        <a href="{{ route('loyalty') }}"
                            class="nav-link {{ Request::is('loyalty') ? 'active' : '' }} ">{{ translate('my_wallet') }}</a>
                    </li>
                @endif --}}
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

                {{-- @if ($web_config['ref_earning_status'])
                    <li class="nav-item">
                        <a href="{{ route('refer-earn') }}"
                            class="nav-link {{ Request::is('refer-earn') || Request::is('refer-earn*') ? 'active' : '' }}">{{ translate('refer_&_Earn') }}</a>
                    </li>
                @endif --}}

                <li class="nav-item">
                    <a href="{{ route('parenting-bumpie') }}"
                        class="nav-link {{ Request::is('parenting-bumpie') || Request::is('parenting-bumpie') ? 'active' : '' }}">{{ translate('my_bumpie') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('favourite-names-parenting') }}"
                        class="nav-link {{ Request::is('user-coupons') || Request::is('user-coupons*') ? 'active' : '' }}">{{ translate('my_favourite_name') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bookmarks') }}"
                        class="nav-link {{ Request::is('parenting-bookmarks') || Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                </li>


            </ul>
        </div>


        {{-- <div class="offcanvas offcanvas-end text-capitalize" tabindex="-1" id="offcanvasProfile"
            aria-labelledby="offcanvasProfileLabel">
            <div class="offcanvas-header justify-content-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav nav-tabs nav--tabs-3 p-2 flex-column">
                    <li class="nav-item">
                        <a href="{{ route('user-profile') }}"
                            class="nav-link {{ Request::is('user-profile') || Request::is('user-account') || Request::is('account-address-*') ? 'active' : '' }}">{{ translate('profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account-oder') }}"
                            class="nav-link {{ Request::is('account-oder*') || Request::is('account-order-details*') || Request::is('refund-details*') || Request::is('track-order/order-wise-result-view*') ? 'active' : '' }}">{{ translate('my_order') }}
                            ({{ auth('customer')->user()->orders->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('wishlists') }}"
                            class="nav-link {{ Request::is('wishlists') ? 'active' : '' }}">{{ translate('my_wishlist') }}
                            ({{ $wish_list_count }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-compare.index') }}"
                            class="nav-link {{ Request::is('product-compare/index') ? 'active' : '' }}">{{ translate('my_compare_list') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('wallet') }}"
                            class="nav-link {{ Request::is('wallet') || Request::is('loyalty') ? 'active' : '' }} ">{{ translate('my_wallet') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('chat', ['type' => 'seller']) }}"
                            class="nav-link {{ Request::is('chat/seller') || Request::is('chat/delivery-man') ? 'active' : '' }}">{{ translate('inbox') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account-tickets') }}"
                            class="nav-link {{ Request::is('account-tickets') || Request::is('support-ticket*') ? 'active' : '' }}">{{ translate('support') }}</a>
                    </li>
                    @if ($web_config['ref_earning_status'])
                        <li class="nav-item">
                            <a href="{{ route('refer-earn') }}"
                                class="nav-link {{ Request::is('refer-earn') || Request::is('refer-earn*') ? 'active' : '' }}">{{ translate('refer_&_Earn') }}</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('user-coupons') }}"
                            class="nav-link {{ Request::is('user-coupons') || Request::is('user-coupons*') ? 'active' : '' }}">{{ translate('coupons') }}</a>
                    </li>

                    <li class="d-lg-none nav-item">
                        <a href="javascript:" class="nav-link route_alert_function"
                            data-routename="{{ route('account-delete', [$customer_info['id']]) }}"
                            data-message="{{ translate('want_to_delete_this_account?') }}" data-typename="">
                            {{ translate('Delete_My_Account') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div> --}}

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
