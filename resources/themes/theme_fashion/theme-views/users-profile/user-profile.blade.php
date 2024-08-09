@extends('theme-views.layouts.app')

@section('title', translate('my_profile') . ' | ' . $web_config['name']->value . ' ' . translate('ecommerce'))

@section('content')
    <section class="user-profile-section section-gap pt-0">
        <div class="container" style="display: flex;flex-direction: row;">
            <div style="width: 20%; " class="d-none d-md-block">
                @php
                    $customer_info = \App\Utils\customer_info();
                @endphp
            <div class="user-author-info mt-4">
                <img loading="lazy" alt="{{ translate('profile') }}"
                     src="{{ getValidImage(path: 'storage/app/public/profile/'.$customer_info->image, type:'avatar') }}">
                <div class="content">
                    <h4 class="name mb-lg-2">{{$customer_info->f_name}} {{$customer_info->l_name}}</h4>
                    <span>{{ translate('joined') }} {{date('d M, Y',strtotime($customer_info->created_at))}}</span>
                </div>
            </div>
            @php($wish_list_count = \App\Models\Wishlist::where('customer_id', auth('customer')->user()->id)->whereHas('wishlistProduct')->count())
            <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-block mt-4">
                <li class="nav-item">
                    <a href="{{ route('user-profile') }}"
                    class="nav-link {{Request::is('user-profile') || Request::is('user-account') ||Request::is('account-address-*') ? 'active' :''}}">{{ translate('profile') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('account-oder')}}"
                    class="nav-link {{Request::is('account-oder*') || Request::is('account-order-details*') || Request::is('refund-details*') || Request::is('track-order/order-wise-result-view*') ? 'active' :''}}">{{ translate('my_order') }}
                        ({{ auth('customer')->user()->orders->count()  }})</a>
                </li>
                <li class="nav-item">

                    <a href="{{route('wishlists')}}"
                    class="nav-link {{Request::is('wishlists') ? 'active' :''}}">{{ translate('my_wishlist') }}
                        ({{ $wish_list_count  }})</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('product-compare.index')}}"
                    class="nav-link {{Request::is('product-compare/index') ? 'active' :''}}">{{ translate('my_compare_list') }}</a>
                </li>
                @if ($web_config['wallet_status'] == 1)
                    <li class="nav-item">
                        <a href="{{ route('wallet') }}"
                        class="nav-link {{Request::is('wallet') || Request::is('loyalty') ? 'active' :''}} ">{{ translate('my_wallet') }}</a>
                    </li>
                @endif
                @if ($web_config['loyalty_point_status'] == 1 && $web_config['wallet_status'] != 1)
                    <li class="nav-item">
                        <a href="{{ route('loyalty') }}"
                        class="nav-link {{Request::is('loyalty') ? 'active' :''}} ">{{ translate('my_wallet') }}</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('chat', ['type' => 'seller'])}}"
                    class="nav-link {{Request::is ('chat/seller') || Request::is ('chat/delivery-man') ? 'active' : ''}}">{{ translate('inbox') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('account-tickets')}}"
                    class="nav-link {{Request::is ('account-tickets') || Request::is('support-ticket*') ? 'active' : ''}}">{{ translate('support') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('my-child.list')}}"
                    class="nav-link {{Request::is ('my-child') || Request::is('my-child*') ? 'active' : ''}}">{{ translate('my_child') }}</a>
                </li>
                
                @if ($web_config['ref_earning_status'])
                    <li class="nav-item">
                        <a href="{{route('refer-earn')}}"
                        class="nav-link {{Request::is ('refer-earn') || Request::is('refer-earn*') ? 'active' : ''}}">{{ translate('refer_&_Earn') }}</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{route('user-coupons')}}"
                    class="nav-link {{Request::is ('user-coupons') || Request::is('user-coupons*') ? 'active' : ''}}">{{ translate('coupons') }}</a>
                </li>

            </ul>
                    </div>
            
            <div style="width: 80%;">
                @include('theme-views.partials._profile-aside')

                <div class="tab-content">

                    <div class="tab-pane fade show active">
                        <div class="personal-details mb-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center column-gap-4 row-gap-2 mb-4">
                                <h4 class="subtitle m-0 text-capitalize">{{ translate('personal_details') }}</h4>
                                <div>
                                    <a href="{{ route('user-account') }}"
                                        class="cmn-btn __btn-outline rounded-full text-capitalize">
                                        {{ translate('edit_profile') }}
                                        @include('theme-views.partials.icons._profile-edit')
                                    </a>
                                    <a href="{{ route('parenting-profile') }}"
                                        class="cmn-btn __btn-outline rounded-full text-capitalize">
                                        <i class="bi bi-people-fill"></i>
                                        {{ translate('parenting_profile') }}
                                        {{-- @include('theme-views.partials.icons._profile-edit') --}}
                                    </a>                                
                                </div>
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
                        <div class="address-details px-md-4">
                            <h4 class="subtitle mb-3 mx-2 text-capitalize">{{ translate('my_address') }}</h4>
                            @foreach ($addresses as $address)
                                <div class="address-card mb-20px">
                                    <div class="address-card-header d-flex justify-content-between align-items-center">
                                        <h6 class="text-capitalize">
                                            {{ translate($address['address_type']) }}&nbsp({{ $address['is_billing'] == 1 ? translate('billing_address') : translate('shipping_address') }})
                                        </h6>
                                        <div class="d-flex align-items-center column-gap-4">
                                            <a href="{{ route('address-edit', $address->id) }}">
                                                <img loading="lazy" src="{{ theme_asset('assets/img/icons/edit.png') }}"
                                                    alt="{{ translate('address') }}">
                                            </a>
                                            <a href="javascript:" class="route_alert_function"
                                                data-routename="{{ route('address-delete', ['id' => $address->id]) }}"
                                                data-message="{{ translate('want_to_delete_this_address?') }}"
                                                data-typename="">
                                                <img loading="lazy" src="{{ theme_asset('assets/img/icons/trash.png') }}"
                                                    alt="{{ translate('trash') }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="address-card-body">
                                        <div class="row">
                                            <ul class="col-sm-6">
                                                <li>
                                                    <span class="name">{{ translate('name') }}</span>
                                                    <span class="info">{{ $address['contact_person_name'] }}</span>
                                                </li>
                                                <li>
                                                    <span class="name">{{ translate('phone') }}</span>
                                                    <span class="info">{{ $address['phone'] }}</span>
                                                </li>
                                                <li>
                                                    <span class="name">{{ translate('address') }}</span>
                                                    <span class="info">{{ $address['address'] }}</span>
                                                </li>
                                            </ul>
                                            <ul class="col-sm-6">
                                                <li>
                                                    <span class="name text-capitalize">{{ translate('zip_code') }}</span>
                                                    <span class="info">{{ $address['zip'] }}</span>
                                                </li>
                                                <li>
                                                    <span class="name">{{ translate('city') }}</span>
                                                    <span class="info">{{ $address['city'] }}</span>
                                                </li>
                                                <li>
                                                    <span class="name">{{ translate('country') }}</span>
                                                    <span class="info">{{ $address['country'] }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <div class="personal-details add-address-btn-container text-center text-md-start">
                                <a class="text-base add-address-btn text-capitalize"
                                    href="{{ route('account-address-add') }}">+{{ translate('add_address') }}</a>
                            </div>

                            @if ($addresses->count() <= 0)
                                <div class="text-center pt-5 w-100">
                                    <div class="text-center mb-5">
                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/address.svg') }}"
                                            alt="{{ translate('address') }}">
                                        <h5 class="my-3 pt-4 text-muted">{{ translate('no_Saved_Address_Found') }}!</h5>
                                        <p class="text-center text-muted">
                                            {{ translate('please_add_your_address_for_your_better_experience') }}</p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
