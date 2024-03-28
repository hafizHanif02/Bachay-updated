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
    <section class="user-profile-section section-gap pt-0">
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
                                            data-message="{{ translate('want_to_delete_this_account?') }}"
                                            data-typename="">
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
                                <h4 class="name mb-lg-2">{{ $customer_info->f_name }} {{ $customer_info->l_name }}
                                </h4>
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
                            $wish_list_count = \App\Models\Wishlist::where(
                                'customer_id',
                                auth('customer')->user()->id,
                            )
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
                        <a href="{{ route('parenting-profile') }}"
                            class="nav-link active">{{ translate('profile') }}</a>
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
                            class="nav-link {{ Request::is('user-coupons') || Request::is('user-coupons*') ? 'active' : '' }}">{{ translate('my_favourite_names') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('parenting-bookmarks') }}"
                            class="nav-link {{ Request::is('parenting-bookmarks') || Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                    </li>


                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active __chat-area">
                    <div class="personal-details mb-4">
                        <div
                            class="d-flex flex-wrap justify-content-between align-items-center column-gap-4 row-gap-2 mb-4 ">
                            <h4 class="subtitle m-0 text-capitalize">{{ translate('edit_personal_details') }}</h4>
                            <a href="{{ route('user-profile') }}"
                                class="cmn-btn __btn-outline rounded-full align-content-center">
                                <i class="bi bi-chevron-left "></i>{{ translate('go_back') }}
                            </a>
                        </div>
                        <div>
                            <div class="">
                                <form action="{{ route('user-update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4 ">
                                        <div class="col-sm-6 text-capitalize">
                                            <label class="form--label mb-2"
                                                for="f-name">{{ translate('first_name') }}</label>
                                            <input type="text" value="{{ $customer_detail['f_name'] }}"
                                                name="f_name" class="form-control"
                                                placeholder="{{ translate('ex') }} : {{ translate('Jhone') }}">
                                        </div>
                                        <div class="col-sm-6 text-capitalize">
                                            <label class="form--label mb-2"
                                                for="l-name">{{ translate('last_name') }}</label>
                                            <input type="text" id="l-name"
                                                value="{{ $customer_detail['l_name'] }}" name="l_name"
                                                class="form-control"
                                                placeholder="{{ translate('ex') }} : {{ translate('Doe') }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form--label mb-2"
                                                for="email">{{ translate('phone') }}</label>
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                value="{{ $customer_detail['phone'] }}"
                                                placeholder="{{ translate('enter_phone_number') }}" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form--label mb-2"
                                                for="email">{{ translate('email') }}</label>
                                            <input type="text" id="email" class="form-control"
                                                value="{{ $customer_detail['email'] }}"
                                                placeholder="{{ translate('enter_email_number') }}" readonly>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <div class="upload-wrapper">
                                                <div class="thumb">
                                                    <img loading="lazy"
                                                        src="{{ theme_asset('assets/img/upload-img.png') }}"
                                                        alt="{{ translate('upload') }}">
                                                </div>
                                                <div class="remove-img">
                                                    <i class="bi bi-x-lg"></i>
                                                </div>
                                                <label>
                                                    <input type="file" class="profile-pic-upload" name="image"
                                                        hidden="">
                                                </label>
                                            </div>
                                            <div class="ps-3 ps-sm-4 text-text-2 w-0 flex-grow-1">
                                                <small>{{ translate('image_ration') }} {{ translate('1') }}
                                                    :{{ translate('1') }}</small>
                                                <small class="font-italic">
                                                    {{ translate('NB') }}:{{ translate('image_size_must_be_within_2MB') }}
                                                    <br>
                                                    {{ translate('image_format_jpg_jpeg_png') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div
                                                class="d-flex flex-column flex-sm-row jusitfy-content-between align-items-center gap-3 ">
                                                <button type="reset"
                                                    class="btn btn-base __btn-outline form-control reset_button min-w-180 ms-auto go-step-3">
                                                    {{ translate('reset') }}
                                                </button>
                                                <button type="submit"
                                                    class="btn btn-base form-control min-w-180 ms-auto go-step-2 text-capitalize seller_reg">
                                                    {{ translate('update_profile') }}
                                                </button>
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
    </section>
@endsection
@push('script')
    <script src="{{ theme_asset('assets/js/user-profile-edit.js') }}"></script>
    <script>
        "use strict";
        function checkPasswordMatch() {
            var password = $("#password2").val();
            var confirmPassword = $("#confirm_password2").val();
            console.log(confirmPassword);
            $("#message").removeAttr("style");
            $("#message").html("");
            if (confirmPassword == "") {
                $("#message").attr("style", "color:black");
                $("#message").html("{{ translate('please_retype_password') }}");
            } else if (password == "") {
                $("#message").removeAttr("style");
                $("#message").html("");
            } else if (password != confirmPassword) {
                $("#message").html("{{ translate('passwords_do_not_match') }}!");
                $("#message").attr("style", "color:red");
            } else if (confirmPassword.length <= 7) {
                $("#message").html("{{ translate('password_must_be_8_character') }}");
                $("#message").attr("style", "color:red");
            } else {
                $("#message").html("{{ translate('passwords_match') }}.");
                $("#message").attr("style", "color:green");
            }
        }

        $(".reset_button").on('click', function() {
            $('.thumb').empty().html(
                `<img src="{{ theme_asset('assets/img/upload-img.png') }}" alt="{{ translate('upload') }}">`);
            $('.remove-img').addClass('d-none')
        })
    </script>
@endpush
