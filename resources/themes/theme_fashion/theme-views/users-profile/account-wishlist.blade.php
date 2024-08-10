@extends('theme-views.layouts.app')

@section('title', translate('my_wishlists').' | '.$web_config['name']->value.' '.translate('ecommerce'))

@section('content')
    <section class="user-profile-section section-gap pt-0">
        <div class="container" style="display: flex;flex-direction: row;">
            <div style="width: 20%; " class="d-none d-md-block">
                @php
                    $customer_info = \App\Utils\customer_info();
                @endphp
                <div class="user-author-info mt-4">
                    <img loading="lazy" alt="{{ translate('profile') }}"
                        src="{{ getValidImage(path: 'storage/app/public/profile/' . $customer_info->image, type: 'avatar') }}">
                    <div class="content">
                        <h4 class="name mb-lg-2">{{ $customer_info->f_name }} {{ $customer_info->l_name }}</h4>
                        <span>{{ translate('joined') }} {{ date('d M, Y', strtotime($customer_info->created_at)) }}</span>
                    </div>
                </div>
                @php($wish_list_count = \App\Models\Wishlist::where('customer_id', auth('customer')->user()->id)->whereHas('wishlistProduct')->count())
                <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-block mt-4">
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
                            ({{ $wish_list_count }})</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-compare.index') }}"
                            class="nav-link {{ Request::is('product-compare/index') ? 'active' : '' }}">{{ translate('my_compare_list') }}</a>
                    </li>
                    @if ($web_config['wallet_status'] == 1)
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
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('chat', ['type' => 'seller']) }}"
                            class="nav-link {{ Request::is('chat/seller') || Request::is('chat/delivery-man') ? 'active' : '' }}">{{ translate('inbox') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account-tickets') }}"
                            class="nav-link {{ Request::is('account-tickets') || Request::is('support-ticket*') ? 'active' : '' }}">{{ translate('support') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('my-child.list') }}"
                            class="nav-link {{ Request::is('my-child') || Request::is('my-child*') ? 'active' : '' }}">{{ translate('my_child') }}</a>
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

                </ul>
            </div>
            <div style="width: 80%;">
            @include('theme-views.partials._profile-aside')
            <div class="mb-4">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="search-form-2 search-form-mobile">
                        <span class="icon d-flex">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" placeholder="{{ translate('search_by_name_or_category') }}" name="search" class="form-control" value="{{ request('search') }}">
                        <button type="submit" class="clear border-0">
                            @if (request('search') != null)
                                <a href="{{route('wishlists')}}" class="text-danger title" >{{translate('clear')}}</a>
                            @else
                                <span class="text-title">{{translate('search')}}</span>
                            @endif
                        </button>
                    </div>
                </form>
            </div>
            @if($wishlists->count()>0)
                @if (request('search') == null)
                    <div class="cart-title-area"><h6 class="title text-capitalize">{{ translate('all_wishing_product_list') }} (<span class="wishlist_count_status">{{ $wishlists->total()  }}</span>)</h6>
                        <a href="javascript:" class="text-text-2 route_alert_function"
                        data-routename="{{ route('delete-wishlist-all') }}"
                        data-message="{{ translate('want_to_clear_all_wishlist?') }}"
                        data-typename="">{{translate('remove_all')}}</a>
                    </div>
                @endif

            @include('theme-views.partials._wish-list-data',['wishlists'=>$wishlists])

            <div class="d-flex justify-content-end w-100 overflow-auto mt-3" id="paginator-ajax">
                {{ $wishlists->links() }}
            </div>
            @endif
            @if($wishlists->count()==0)
                <div class="text-center pt-5 w-100">
                    <div class="text-center mb-5">
                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/wishlist.svg') }}" alt="{{ translate('wishlist') }}">
                        <h5 class="my-3 text-muted">{{translate('no_Saved_Products_Found')}}!</h5>
                        <p class="text-center text-muted">{{ translate('you_have_not_add_any_products_in_Wishlist ') }}</p>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </section>
@endsection
