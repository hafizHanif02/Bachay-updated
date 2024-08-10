@extends('theme-views.layouts.app')

@section('title', translate('edit_address') . ' | ' . $web_config['name']->value . ' ' . translate('ecommerce'))

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
            <div class="card border-0 __shadow">
                <div class="card-body p-3 p-sm-4 text-capitalize">
                    <div class="text-end">
                        <a href="{{ route('user-profile') }}" class="cmn-btn __btn-outline">
                            <i class="bi bi-chevron-left "></i>{{ translate('go_back') }}
                        </a>
                    </div>
                    <form action="{{ route('address-update') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $shippingAddress->id }}">
                        <div class="row g-4">
                            <div class="col-sm-6 ">
                                <h6 class="form--label mb-3">{{ translate('choose_label') }}</h6>
                                <ul class="d-flex flex-wrap gap-4 address-label-area">
                                    <li>
                                        <div class="d-flex align-items-center gap-2 item">
                                            <label class="form-check-size">
                                                <input type="radio" name="addressAs" value="home"
                                                    {{ $shippingAddress->address_type == 'home' ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    <i class="bi bi-house"></i>
                                                    <span>{{ translate('home') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center gap-2 item">
                                            <label class="form-check-size">
                                                <input type="radio" name="addressAs" value="permanent"
                                                    {{ $shippingAddress->address_type == 'permanent' ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    <i class="bi bi-paperclip"></i>
                                                    <span>{{ translate('permanent') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center gap-2 item">
                                            <label class="form-check-size">
                                                <input type="radio" name="addressAs" value="office"
                                                    {{ $shippingAddress->address_type == 'office' ? 'checked' : '' }}>
                                                <span class="form-check-label">
                                                    <i class="bi bi-briefcase"></i>
                                                    <span>{{ translate('office') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 ">
                                <h6 class="form--label mb-3">{{ translate('choose_address_type') }}</h6>
                                <ul class="d-flex flex-wrap gap-4 gap-xl-5">
                                    <li class="d-flex flex-wrap gap-2">
                                        <label class="d-flex align-items-center gap-10 text-nowrap">
                                            <input type="radio" name="is_billing"
                                                {{ $shippingAddress->is_billing == '1' ? 'checked' : '' }} value="1">
                                            {{ translate('billing_address') }}
                                        </label>
                                    </li>
                                    <li>
                                        <label class="d-flex align-items-center gap-10 text-nowrap">
                                            <input type="radio" name="is_billing"
                                                {{ $shippingAddress->is_billing == '0' ? 'checked' : '' }} value="0">
                                            {{ translate('shipping_address') }}
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="f-name">{{ translate('contact_person') }}</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ translate('ex') }} : {{ translate('Jhone') }} {{ translate('Doe') }}"
                                    value="{{ $shippingAddress['contact_person_name'] }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="phone">{{ translate('phone') }}</label>
                                <input type="text" id="l-name" name="phone" class="form-control"
                                    value="{{ $shippingAddress['phone'] }}" placeholder="{{ translate('923123456789') }}"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="email">{{ translate('country') }}</label>
                                <select name="country" id="country" class="form-control select_picker" required>
                                    <option value="" disabled selected>{{ translate('select_country') }}</option>
                                    @if ($country_restrict_status)
                                        @foreach ($delivery_countries as $country)
                                            <option value="{{ $country['name'] }}"
                                                {{ $country['name'] == $shippingAddress->country ? 'selected' : '' }}>
                                                {{ $country['name'] }}</option>
                                        @endforeach
                                    @else
                                        @foreach (COUNTRIES as $country)
                                            <option value="{{ $country['name'] }}"
                                                {{ $shippingAddress->country == $country['name'] ? 'selected' : '' }}>
                                                {{ $country['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="email">{{ translate('city') }}</label>
                                <input type="text" id="email" class="form-control"
                                    value="{{ $shippingAddress->city }}" name="city"
                                    placeholder="{{ translate('enter_email_address') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="email">{{ translate('zip_code') }}</label>
                                @if ($zip_restrict_status)
                                    <select name="zip" class="form-control select2 select_picker"
                                        data-live-search="true" required>
                                        @foreach ($delivery_zipcodes as $zip)
                                            <option value="{{ $zip->zipcode }}"
                                                {{ $zip->zipcode == $shippingAddress->zip ? 'selected' : '' }}>
                                                {{ $zip->zipcode }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input class="form-control" type="text" id="zip_code" name="zip"
                                        value="{{ $shippingAddress->zip }}" required>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="email">{{ translate('address') }}</label>
                                <textarea name="address" id="address" class="form-control" placeholder="{{ translate('ex_:_1216_dhaka') }}"
                                    required>{{ $shippingAddress->address }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <input id="pac-input" class=" controls rounded __map-input mt-1"
                                    title="{{ translate('search_your_location_here') }}" type="text"
                                    placeholder="{{ translate('search_here') }}" />
                                <div class="dark-support rounded w-100 __h-14rem mb-5" id="location_map_canvas"></div>
                            </div>
                            <input type="hidden" id="latitude" name="latitude" class="form-control d-inline"
                                value="{{ $shippingAddress->latitude ?? 0 }}" required readonly>
                            <input type="hidden" name="longitude" class="form-control" id="longitude"
                                value="{{ $shippingAddress->longitude ?? 0 }}" required readonly>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex flex-wrap justify-content-end gap-3 ">
                                <button type="submit"
                                    class="btn btn-base w-auto form-control min-w-180 flex-grow-0">{{ translate('update_Address') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <span id="shippingaddress-storage" data-latitude="{{ $shippingAddress->latitude ?? '' }}"
        data-longitude="{{ $shippingAddress->longitude ?? '' }}">
    </span>

@endsection
@push('script')
    <script src="{{ asset('public/assets/select2/js/select2.min.js') }}"></script>
    <script src="{{ theme_asset('assets/js/account-address-edit.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Utils\get_business_settings('map_api_key') }}&callback=initAutocomplete&libraries=places&v=3.49"
        defer></script>
@endpush
