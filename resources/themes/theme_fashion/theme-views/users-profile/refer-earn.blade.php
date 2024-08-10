@extends('theme-views.layouts.app')

@section('title', translate('refer_&_Earn').' | '.$web_config['name']->value.' '.translate('ecommerce'))

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
                <div class="tab-pane fade show active" >
                    <div class="personal-details mb-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center column-gap-4 row-gap-2 mb-4">
                            <h4 class="subtitle m-0 text-capitalize">{{ translate('refer_&_Earn') }}</h4>
                        </div>

                        <div class="refer_and_earn_section">
                            <div class="d-flex justify-content-center align-items-center py-2 mb-3">
                                <div class="banner-img">
                                    <img loading="lazy" class="img-fluid"
                                    src="{{ theme_asset('assets/img/refer-and-earn.png') }}" alt="{{ translate('refer_and_earn') }}" width="300">
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5 class="primary-heading mb-2">{{ translate('invite_Your_Friends_&_Businesses') }}</h5>
                                <p class="secondary-heading">{{ translate('copy_your_code_and_share_your_friends') }}</p>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <h6 class="text-secondary-color">{{ translate('your_personal_code') }}</h6>
                                    <div class="refer_code_box">
                                        <div class="refer_code click_to_copy_function" data-copycode="{{ $customer_detail->referral_code }}">{{ $customer_detail->referral_code }}</div>
                                        <span class="refer_code_copy click_to_copy_function" data-copycode="{{ $customer_detail->referral_code }}">
                                            <img loading="lazy" class="w-100" src="{{ theme_asset('assets/img/icons/solar_copy-bold-duotone.png') }}" alt="{{ translate('copy') }}">
                                        </span>
                                    </div>

                                    <h4 class="share-icons-heading">{{ translate('oR_SHARE') }}</h4>
                                    <div class="d-flex justify-content-center align-items-center share-on-social">
                                        @php
                                            $text = "Greetings,".$web_config['name']->value." is the best e-commerce platform in the country.If you are new to this website dont forget to use " . $customer_detail->referral_code . " " ."as the referral code while sign up into 6valley.";
                                            $link = url('/');
                                        @endphp
                                        <a href="https://api.whatsapp.com/send?text={{$text}}.{{$link}}" target="_blank">
                                            <img loading="lazy" src="{{ theme_asset('assets/img/icons/whatsapp.png') }}" alt="{{ translate('whatsapp') }}">
                                        </a>
                                        <a href="mailto:recipient@example.com?subject=Referral%20Code%20Text&body={{$text}}%20Link:%20{{$link}}" target="_blank">
                                            <img loading="lazy" src="{{ theme_asset('assets/img/icons/gmail.png') }}" alt="{{ translate('gmail') }}">
                                        </a>
                                        <span class="click_to_copy_function" data-copycode="{{ route('home') }}?referral_code={{ $customer_detail->referral_code }}">
                                            <img loading="lazy" src="{{ theme_asset('assets/img/icons/share.png') }}" alt="{{ translate('share') }}">
                                        </span>
                                    </div>
                                </div>

                                <div class="information-section col-md-8">
                                    <h4 class="text-bold d-flex align-items-center"> <span class="custom-info-icon">i</span> {{ translate('how_you_it_works') }}?</h4>

                                    <ul>
                                        <li>
                                            <span class="item-custom-index">{{ translate('1') }}</span>
                                            <span class="item-custom-text">{{ translate('invite_your_friends_&_businesses') }}</span>
                                        </li>
                                        <li>
                                            <span class="item-custom-index">{{ translate('2') }}</span>
                                            <span class="item-custom-text">{{ translate('they_register').' '.$web_config['name']->value.' '.translate('with_special_offer') }}</span>
                                        </li>
                                        <li>
                                            <span class="item-custom-index">{{ translate('3') }}</span>
                                            <span class="item-custom-text">{{ translate('you_made_your_earning') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
