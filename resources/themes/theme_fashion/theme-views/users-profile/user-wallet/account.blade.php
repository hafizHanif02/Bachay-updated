@extends('theme-views.layouts.app')

@section('title', translate('account').' | '.$web_config['name']->value.' '.translate('ecommerce'))

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
            @include('theme-views.users-profile.user-wallet._partial-my-wallet-nav-tab')
            <div class="tab-content">
                <div class="tab-pane fade show active" >
                    <div class="wallet-card">
                        <div class="wallet-card-header">
                            <div class="left">
                                <img loading="lazy" src="{{ theme_asset('assets/img/checkout/card-pos.png') }}" alt="">
                                <span>{{ translate('Bank_Card') }}</span>
                            </div>
                            <a href="#add-new-card" data-bs-toggle="modal" class="text-base" type="button">+ {{ translate('Add_New_Card') }}</a>
                        </div>
                        <div class="wallet-card-body">
                            <div class="table-responsive">
                                <table class="table __table __wallet-card-table __table-sm-break">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center wallet-card-name min-w-180">
                                                    <span class="me-2 me-md-4">{{ translate('1') }}.</span>
                                                    <img loading="lazy" src="{{ theme_asset('assets/img/icons/visa.png') }}" alt="">
                                                    <div>{{ translate('Visa_Card') }}</div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="ps-max-sm-5">
                                                    {{ ('02342 ***** 4234') }}
                                                </div>
                                            </th>
                                            <th class="action-buttons">
                                                <div class=" d-flex align-items-center justify-content-end column-gap-4">
                                                    <div type="button" data-bs-toggle="modal" data-bs-target="#add-new-card">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/edit2.png') }}" alt="">
                                                    </div>
                                                    <div type="button">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/trash.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center wallet-card-name min-w-180">
                                                    <span class="me-2 me-md-4">{{ translate('2') }}.</span>
                                                    <img loading="lazy" src="{{ theme_asset('assets/img/icons/mastercard.png') }}" alt="">
                                                    <div>{{ translate('Master_Card') }}</div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="ps-max-sm-5">
                                                    {{ ('02342 ***** 4234') }}
                                                </div>
                                            </th>
                                            <th class="action-buttons">
                                                <div class=" d-flex align-items-center justify-content-end column-gap-4">
                                                    <div type="button" data-bs-toggle="modal" data-bs-target="#add-new-card">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/edit2.png') }}" alt="">
                                                    </div>
                                                    <div type="button">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/trash.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="wallet-card">
                        <div class="wallet-card-header">
                            <div class="left">
                                <img loading="lazy" src="{{ theme_asset('assets/img/icons/digital-wallet.png') }}" alt="">
                                <span>{{ ('Digital_Wallet') }}</span>
                            </div>
                            <a href="#add-new-card" data-bs-toggle="modal" class="text-base" type="button">+ {{ translate('Add_New_Card') }}</a>
                        </div>
                        <div class="wallet-card-body">
                            <div class="table-responsive">
                                <table class="table __table __wallet-card-table __table-sm-break">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center wallet-card-name min-w-180">
                                                    <span class="me-2 me-md-4">{{ translate('1') }}.</span>
                                                    <img loading="lazy" src="{{ theme_asset('assets/img/icons/bkash.png') }}" alt="">
                                                    <div>{{ translate('Bkash') }}</div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="ps-max-sm-5">
                                                    {{ translate('02342 ***** 4234') }}
                                                </div>
                                            </th>
                                            <th class="action-buttons">
                                                <div class=" d-flex align-items-center justify-content-end column-gap-4">
                                                    <div type="button" data-bs-toggle="modal" data-bs-target="#add-new-card">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/edit2.png') }}" alt="">
                                                    </div>
                                                    <div type="button">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/trash.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="d-flex align-items-center wallet-card-name min-w-180">
                                                    <span class="me-2 me-md-4">{{ translate('2') }}.</span>
                                                    <img loading="lazy" src="{{ theme_asset('assets/img/icons/nagad.png') }}" alt="">
                                                    <div>{{ translate('Nagad') }}</div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="ps-max-sm-5">
                                                    {{ translate('02342 ***** 4234') }}
                                                </div>
                                            </th>
                                            <th class="action-buttons">
                                                <div class=" d-flex align-items-center justify-content-end column-gap-4">
                                                    <div type="button" data-bs-toggle="modal" data-bs-target="#add-new-card">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/edit2.png') }}" alt="">
                                                    </div>
                                                    <div type="button">
                                                        <img loading="lazy" src="{{ theme_asset('assets/img/icons/trash.png') }}" alt="">
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="add-new-card" class="modal fade __modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="m-0">{{ translate('Add_New_Card') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label">{{ translate('Card_Holder_Name') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ translate('ex') }}: {{translate('Abu_Raihan_Rafuj')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">{{ translate('Card_Number') }}</label>
                                        <input type="number" class="form-control" placeholder="{{ translate('ex') }}: {{translate('4444_5555_2222_1111')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">{{ translate('CVV') }}</label>
                                        <input type="number" class="form-control" placeholder="{{ translate('ex') }}: {{translate('123')}}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">{{ translate('Expiry_Date') }}</label>
                                        <input type="date" class="form-control">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="btn--container">
                                            <button class="btn btn-reset" type="reset">{{ translate('Reset') }}</button>
                                            <button class="btn btn-base" type="submit">{{ translate('Add_Card') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
