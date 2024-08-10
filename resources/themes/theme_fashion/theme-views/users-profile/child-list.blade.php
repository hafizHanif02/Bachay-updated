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

            @include('theme-views.partials._child_list')

            <div class="tab-content">


                <div class="address-details px-md-4">
                    <h4 class="subtitle mb-3 mx-2 text-capitalize">{{ translate('My_Children') }}</h4>
                    <div class="row">
                        <div class="col-md-6 custom-spacing">
                            <div class="child_list">
                                <table class="table-responsive table-borderless w-100">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($childs as $child)
                                        <?php $childDob = \Carbon\Carbon::parse($child->dob);
                                        $diff = $childDob->diff(\Carbon\Carbon::now());
                                        $formattedAge = '';
                                        
                                        if ($diff->y > 0) {
                                            $formattedAge .= $diff->y . 'Y';
                                        }
                                        
                                        if ($diff->m > 0) {
                                            $formattedAge .= ($formattedAge ? ' ' : '') . $diff->m . 'M';
                                        }
                                        
                                        // If the age is less than a month, display "New Born"
                                        if ($diff->y == 0 && $diff->m == 0) {
                                            $formattedAge = 'New Born';
                                        }
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img class="rounded-circle me-2"
                                                        src="{{ asset('public/assets/images/customers/child/' . $child->profile_picture) }}"
                                                        width="50px" height="50px">
                                                </td>
                                                <td>{{ $child->name }}</td>
                                                <td>{{ $formattedAge }}</td>
                                                <td><a href="{{ route('my-child.destroy', $child->id) }}"><button
                                                            type="button" class="btn btn-danger btn-sm">Delete</button></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Create Child</h4>
                            <form action="{{ route('my-child.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- {{ dd(Auth::guard('customer')->id()) }} --}}
                                <input type="hidden" name="user_id" value="{{ Auth::guard('customer')->id() }}">
                                <div class="col-md-12 row mt-3">
                                    <label for="" class="form-label">Name</label>
                                    <input required type="text" name="name" placeholder="Enter Name"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-12 row mt-3">
                                    <label for="" class="form-label">Relation Type</label>
                                    <input required type="text" name="relation_type" placeholder="Enter Relation Type"
                                        class="form-control" required>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Profile Picture</label>
                                        <input required type="file" name="profile_picture" placeholder="Enter Image"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Date Of Birth</label>
                                        <input required type="date" name="dob" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 row mt-3">
                                    <label for="" class="form-label">Gender</label>
                                    <select class="form-control" name="gender" id="">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="row mt-3 text-center">
                                    <button type="submit" class="btn seller_reg mt-3">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($childs) <= 0)
                        <div class="text-center pt-5 w-100 custom-space">
                            <div class="text-center mb-5 custom-space">
                                <img loading="lazy" src="{{ theme_asset('assets/img/icons/no-child.svg') }}"
                                    alt="{{ translate('address') }}" width="200px" height="200px">
                                <h5 class="my-3 pt-4 text-muted">{{ translate('no_child_found') }}!</h5>
                                {{-- <p class="text-center text-muted">{{ translate('please_add_your_address_for_your_better_experience') }}</p> --}}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        </div>
        </div>
        <style>
            tbody tr td {
                padding-bottom: 10px;
            }
            @media (max-width: 767px) {
                .custom-space {
                    margin-bottom: 0 !important;
                }

                .custom-space {
                    padding-top: 0 !important;
                }

                .custom-spacing {
                    margin-bottom: 20px !important;
                }
            }
        </style>
    </section>
@endsection
