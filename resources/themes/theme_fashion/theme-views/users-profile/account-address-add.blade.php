@extends('theme-views.layouts.app')

@section('title', translate('add_address') . ' | ' . $web_config['name']->value . ' ' . translate('ecommerce'))

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
                    <form action="{{ route('address-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6 ">
                                <h6 class="form--label mb-3">{{ translate('choose_label') }}</h6>
                                <ul class="d-flex flex-wrap gap-4 address-label-area">
                                    <li>
                                        <div class="d-flex align-items-center gap-2 item">
                                            <label class="form-check-size">
                                                <input type="radio" name="addressAs" value="home" checked>
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
                                                <input type="radio" name="addressAs" value="permanent">
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
                                                <input type="radio" name="addressAs" value="office">
                                                <span class="form-check-label">
                                                    <i class="bi bi-briefcase"></i>
                                                    <span>{{ translate('office') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 ">
                                <h6 class="form--label mb-3">{{ translate('choose_address_type') }}</h6>
                                <ul class="d-flex flex-wrap gap-4 gap-xl-5">
                                    <li class="d-flex flex-wrap gap-2">
                                        <label class="d-flex align-items-center gap-10 text-nowrap form-check">
                                            <input type="radio" name="is_billing" value="1" checked
                                                class="form-check-input">
                                            <span class="form-check-label">{{ translate('billing_address') }}</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="d-flex align-items-center gap-10 text-nowrap form-check">
                                            <input type="radio" name="is_billing" value="0" class="form-check-input">
                                            <span class="form-check-label">{{ translate('shipping_address') }}</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="f-name">{{ translate('contact_person') }}</label>
                                <input type="text" id="f-name" name="name" class="form-control"
                                    placeholder="{{ translate('ex') }} : {{ translate('Jhone') }} {{ translate('Doe') }}"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="phone">{{ translate('phone') }}</label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="{{ translate('923123456789') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="country">{{ translate('country') }}</label>
                                <select name="country" id="country" class="form-control select_picker" required>
                                    <option value="" disabled selected>{{ translate('select_country') }}</option>
                                    @foreach ($countries as $d)
                                        <option value="{{ $d['name'] }}">{{ $d['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="city">{{ translate('city') }}</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="{{ translate('enter_your_city') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="zip_code">{{ translate('Zip_Code') }}</label>
                                @if ($zip_restrict_status)
                                    <select name="zip" id="zip_code" class="form-control select2 select_picker"
                                        data-live-search="true" required>
                                        @foreach ($zip_codes as $zip)
                                            <option value="{{ $zip->zipcode }}">{{ $zip->zipcode }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input class="form-control" type="text" id="zip_code" name="zip"
                                        placeholder="{{ translate('enter_your_zip_code') }}" required>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="form--label mb-2" for="address">{{ translate('address') }}</label>
                                <textarea name="address" id="address" class="form-control"
                                    placeholder="{{ translate('16th_St,_D.H.A._Phase 8_Defence_Housing Authority,_Karachi,_Sindh_75600') }}" required></textarea>
                            </div>
                            <div class="col-sm-12">
                                <input id="pac-input" class="controls rounded __map-input mt-1"
                                    title="{{ translate('search_your_location_here') }}" type="text"
                                    placeholder="{{ translate('search_here') }}" />
                                <div class="dark-support rounded w-100 __h-14rem mb-4" id="location_map_canvas"></div>
                            </div>
                            <input type="hidden" id="latitude" name="latitude" class="form-control d-inline"
                                value="{{ $default_location ? $default_location['lat'] : 0 }}" required readonly>
                            <input type="hidden" name="longitude" class="form-control" id="longitude"
                                value="{{ $default_location ? $default_location['lng'] : 0 }}" required>
                        </div>
                        <div class="col-sm-12">
                            <div class="d-flex flex-wrap justify-content-end gap-3 ">
                                <button type="submit"
                                    class="btn btn-base w-auto form-control min-w-180 flex-grow-0">{{ translate('add_address') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>

    <span id="shippingaddress-storage" data-latitude="{{ $default_location ? $default_location['lat'] : '-33.8688' }}"
        data-longitude="{{ $default_location ? $default_location['lng'] : '151.2195' }}">
    </span>

@endsection

@push('script')
    <script src="{{ asset('public/assets/select2/js/select2.min.js') }}"></script>
    <script src="{{ theme_asset('assets/js/account-address-add.js') }}"></script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ getWebConfig(name: 'map_api_key') }}&callback=initAutocomplete&libraries=places&v=3.49"
        defer></script>
@endpush
