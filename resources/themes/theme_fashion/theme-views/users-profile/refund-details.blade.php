@extends('theme-views.layouts.app')

@section('title', translate('my_order_details').' | '.$web_config['name']->value.' '.translate('ecommerce'))

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

            <div class="card bg-section border-0">
                <div class="card-body p-lg-5">
                    <div class="mb-4">
                        <h1 class="modal-title fs-5 text-capitalize" id="refundModalLabel">{{ translate('refund_details')}}</h1>
                    </div>
                    <div class="modal-body span--inline">
                        <div class="d-flex flex-column flex-sm-row flex-wrap gap-4 justify-content-between mb-4">
                            <div class="media align-items-center gap-3">
                                <div class="cart-product">
                                    <label class="form-check">
                                        <img loading="lazy" alt="{{ translate('products') }}"
                                        src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'.$product['thumbnail'], type: 'product') }}">
                                    </label>
                                    <div class="cont">
                                        <a href="{{route('product',[$product['slug']])}}" class="name text-title">{{isset($product['name']) ? Str::limit($product['name'],40) : ''}}</a>
                                        <div class="d-flex column-gap-1">
                                            <span>{{translate('price')}}</span> <span>:</span> <strong>{{\App\Utils\currency_converter($order_details->price)}}</strong>
                                        </div>
                                        @if ($product['product_type'] == "physical" && !empty(json_decode($order_details['variation'])))
                                            <div class="d-flex flex-wrap column-gap-3">
                                                @foreach (json_decode($order_details['variation']) as $key => $value)
                                                <div class="d-flex column-gap-1">
                                                    <span>{{translate($key)}} </span> <span>:&nbsp;{{ucwords($value)}}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-1 fs-12">
                                <span> <span>{{ translate('Qty')}}</span> <span>:</span> <span>{{$order_details->qty}}</span></span>
                                <span> <span>{{ translate('Price')}}</span> <span>:</span> <span>{{\App\Utils\currency_converter($order_details->price)}}</span></span>
                                <span> <span>{{ translate('Discount')}}</span> <span>:</span> <span>{{\App\Utils\currency_converter($order_details->discount)}}</span></span>
                                <span> <span>{{ translate('Tax')}}</span> <span>:</span> <span>{{\App\Utils\currency_converter($order_details->tax)}}</span></span>
                            </div>
                            <?php
                                $total_product_price = 0;
                                foreach ($order->details as $key => $or_d) {
                                    $total_product_price += ($or_d->qty * $or_d->price) + $or_d->tax - $or_d->discount;
                                }
                                $refund_amount = 0;
                                $subtotal = ($order_details->price * $order_details->qty) - $order_details->discount + $order_details->tax;
                                $coupon_discount = ($order->discount_amount * $subtotal) / $total_product_price;
                                $refund_amount = $subtotal - $coupon_discount;
                            ?>
                            <div class="d-flex flex-column gap-1 fs-12">
                                <span><span>{{translate('subtotal')}}</span> <span>:</span> <span> {{\App\Utils\currency_converter($subtotal)}}</span></span>
                                <span><span>{{translate('coupon_discount')}}</span> <span>:</span> <span> {{\App\Utils\currency_converter($coupon_discount)}}</span></span>
                                <span><span>{{translate('total_refundable_amount')}}</span> <span>:</span> <span>{{\App\Utils\currency_converter($refund_amount)}}</span></span>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label for="comment" class="form--label mb-2">{{translate('refund_reason')}}</label>
                            <p>{{$refund->refund_reason}}</p>
                        </div>
                        <div class="form-group">
                            <h6 class="mb-2">{{translate('attachment')}}</h6>
                            <div class="d-flex flex-column gap-3">
                                @if ($refund->images !=null)
                                    <div class="gallery">
                                        @foreach (json_decode($refund->images) as $key => $photo)
                                            <a href="{{asset('storage/app/public/refund')}}/{{$photo}}" class="custom-image-popup">
                                                <img loading="lazy" src="{{asset('storage/app/public/refund')}}/{{$photo}}" alt="{{ translate('refund') }}" class="img-w-h-100">
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-capitalize">{{translate('no_attachment_found')}}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
@endsection
