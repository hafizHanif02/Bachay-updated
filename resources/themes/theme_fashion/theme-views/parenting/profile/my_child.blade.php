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
                                        data-message="{{ translate('want_to_delete_this_account?') }}" data-typename="">
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
                            <h4 class="name mb-lg-2">{{ $customer_info->f_name }} {{ $customer_info->l_name }}</h4>
                            <?php 
                                $boys = \App\Models\FamilyRelation::where(['user_id'=> auth('customer')->id(),'gender'=> 'male'])->count();
                                $girls = \App\Models\FamilyRelation::where(['user_id'=> auth('customer')->id(),'gender'=> 'female'])->count();
                            ?>
                            <span>Parent of {{ ($boys > 0 ? $boys.' Boys'.($girls > 0 ? ' & ' : '') : '') }}{{ ($girls > 0 ? $girls.' Girls' : '') }}</span>

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
                @php
                    $child = \App\Models\FamilyRelation::where('user_id', auth('customer')->id())->count();
                @endphp
                <div class="user-order-count {{ !Request::is('user-profile') ? 'd-none d-md-flex' : '' }}">
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ $child }}</h3>
                        <span>{{ translate('Total_child') }}</span>
                    </div>

                    @php
                        $questions = \App\Models\QnaQuestion::where('user_id', auth('customer')->id())->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle wishlist_count_status">{{ $questions }}</h3>
                        <span>{{ translate('Total_questions') }}</span>
                    </div>
                    @php
                        $answers = \App\Models\QnaAnswer::where('user_id', auth('customer')->id())->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ $answers }}</h3>
                        <span>{{ translate('Total_answers') }}</span>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-flex">
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}" class="nav-link {{ Request::is('parenting-profile') ? 'active' : '' }}">Overview</a>
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
                    <a href="{{ route('favourite-names-parenting') }}"
                        class="nav-link {{ Request::is('user-coupons') || Request::is('user-coupons*') ? 'active' : '' }}">{{ translate('my_favourite_names') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bookmarks') }}"
                        class="nav-link {{ Request::is('parenting-bookmarks') || Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-my-child') }}"
                        class="nav-link {{ Request::is('parenting-my-child') ? 'active' : '' }}">My Childs</a>
                </li>
            </ul>
        </div>
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
@endsection
