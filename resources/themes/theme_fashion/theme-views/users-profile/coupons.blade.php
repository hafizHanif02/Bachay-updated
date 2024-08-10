@extends('theme-views.layouts.app')

@section('title', translate('coupons').' | '.$web_config['name']->value.' '.translate('ecommerce'))

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

            <div class="tab-content">
                <div class="tab-pane fade show active">
                    <div class="personal-details mb-4">
                        <div
                            class="d-flex flex-wrap justify-content-between align-items-center column-gap-4 row-gap-2 mb-4">
                            <h4 class="subtitle m-0 text-capitalize">{{ translate('coupons') }}</h4>
                        </div>

                        <div class="row g-3">
                            @foreach ($coupons as $item)
                                <div class="col-md-6">
                                    <div class="ticket-box">
                                        <div class="ticket-start">
                                            @if ($item->coupon_type == "free_delivery")
                                                <img loading="lazy" width="30" src="{{ theme_asset('assets/img/icons/bike.png') }}"
                                                     alt="">
                                            @elseif ($item->coupon_type != "free_delivery" && $item->discount_type == "percentage")
                                                <img loading="lazy" width="30" src="{{ theme_asset('assets/img/icons/fire.png') }}"
                                                     alt="">
                                            @elseif ($item->coupon_type != "free_delivery" && $item->discount_type == "amount")
                                                <img loading="lazy" width="30" src="{{ theme_asset('assets/img/icons/dollar.png') }}"
                                                     alt="">
                                            @endif
                                            <h2 class="ticket-amount">
                                                @if ($item->coupon_type == "free_delivery")
                                                    {{ translate('free_Delivery') }}
                                                @else
                                                    {{ ($item->discount_type == 'percentage')? $item->discount.'% Off':\App\Utils\currency_converter($item->discount)}}
                                                @endif
                                            </h2>
                                            <p>
                                                {{ translate('on') }}
                                                @if($item->seller_id == '0')
                                                    {{ translate('All_Shops') }}
                                                @elseif($item->seller_id == NULL)
                                                    <a class="shop-name" href="{{route('shopView',['id'=>0])}}">
                                                        {{ $web_config['name']->value }}
                                                    </a>
                                                @else
                                                    <a class="shop-name"
                                                       href="{{isset($item->seller->shop) ? route('shopView',['id'=>$item->seller->shop['id']]) : 'javascript:'}}">
                                                        {{ isset($item->seller->shop) ? $item->seller->shop->name : translate('shop_not_found') }}
                                                    </a>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="ticket-border"></div>
                                        <div class="ticket-end">
                                            <button class="ticket-welcome-btn couponid couponid-{{ $item->code }} click_to_copy_coupon_function"
                                                    data-copycode="{{ $item->code }}">{{ $item->code }}</button>
                                            <button
                                                class="ticket-welcome-btn couponid-hide couponhideid-{{ $item->code }} d-none">{{ translate('copied') }}</button>
                                            <h6>{{ translate('valid_till') }} {{ $item->expire_date->format('d M, Y') }}</h6>
                                            <p class="m-0">{{ translate('available_from_minimum_purchase') }} {{\App\Utils\currency_converter($item->min_purchase)}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-end w-100 overflow-auto my-3" id="paginator-ajax">
                                {{ $coupons->links() }}
                            </div>

                            @if ($coupons->count() <= 0)
                                <div class="text-center pt-5 w-100">
                                    <div class="text-center mb-5">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/empty-coupon.svg') }}" alt="{{ translate('empty') }}">
                                        <h5 class="pt-5 pb-2 text-muted">{{ translate('no_Coupon_Found') }}!</h5>
                                        <p class="text-center text-muted">{{ translate('you_have_no_coupons_yet') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection
