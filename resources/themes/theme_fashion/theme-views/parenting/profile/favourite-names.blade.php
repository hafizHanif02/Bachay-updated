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
<style>
    .my-fav {
        margin: 0 150px 100px 150px;
    }

    .ask-question {
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 16px 20px 20px 19px;
    }

    .btn_clr {
        background: #f56996;
        border: none;
        color: #fff;
        border: 1px solid #f56996;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .btn_clr:hover {
        background: #fff;
        border: 1px solid #f56996;
        color: #f56996;
    }

    @media only screen and (max-width: 768px) {
        .my-fav {
            margin: 0 0 100px 0;
        }
    }
</style>
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
                        $child = \App\Models\FamilyRelation::where('user_id', auth('customer')->id())
                            ->count();
                    @endphp
                <div class="user-order-count {{ !Request::is('user-profile') ? 'd-none d-md-flex' : '' }}">
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ $child }}</h3>
                        <span>{{ translate('Total_child') }}</span>
                    </div>

                    @php
                        $questions = \App\Models\QnaQuestion::where('user_id', auth('customer')->id())
                            ->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle wishlist_count_status">{{ $questions }}</h3>
                        <span>{{ translate('Total_questions') }}</span>
                    </div>
                    @php
                        $answers = \App\Models\QnaAnswer::where('user_id', auth('customer')->id())
                            ->count();
                    @endphp
                    <div class="user-order-count-item">
                        <h3 class="subtitle">{{ $answers }}</h3>
                        <span>{{ translate('Total_answers') }}</span>
                    </div>
                </div>
            </div>
        </div>
            <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-flex">
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}"
                        class="nav-link {{ Request::is('parenting-profile') ? 'active' : '' }}">Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-question') }}"
                        class="nav-link {{ Request::is('parenting-question') ? 'active' : '' }}">{{ translate('my_questions') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-answer') }}"
                        class="nav-link {{ Request::is('parenting-answer') ? 'active' : '' }}">{{ translate('my_answers') }}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-topics') }}"
                        class="nav-link {{ Request::is('parenting-topics') ? 'active' : '' }}">{{ translate('my_topics') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('parenting-memories') }}"
                        class="nav-link {{ Request::is('parenting-memories') ? 'active' : '' }}">{{ translate('my_memories') }}</a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-quick-reads') }}"
                        class="nav-link {{ Request::is('parenting-quick-reads') ? 'active' : '' }}">{{ translate('my_quick_reads') }}</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-milestones') }}"
                        class="nav-link {{ Request::is('parenting-milestones') ? 'active' : '' }}">{{ translate('my_milestons') }}</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-bumpie') }}"
                        class="nav-link {{ Request::is('parenting-bumpie') ? 'active' : '' }}">{{ translate('my_bumpie') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('favourite-names-parenting') }}"
                        class="nav-link {{ Request::is('favourite-names-parenting') ? 'active' : '' }}">{{ translate('my_favourite_names') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bookmarks') }}"
                        class="nav-link {{ Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-my-child') }}"
                        class="nav-link {{ Request::is('parenting-my-child') ? 'active' : '' }}">My Childs</a>
                </li>
            </ul>
        </div>
        <div class="my-fav">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn_clr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Create <i class="bi bi-plus"></i>
                </button>
            </div>
            <!-- Ask a Question Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content pb-2 ps-2 pe-2">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Collection</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <h2 class="text-start ps-3 py-2 fs-6">Collection Name</h2>
                        <div class="modal-body" style="background-color: #f5f5f5;">
                            <div class="write-comment-container">
                                <div class="form-group position-relative">
                                    <textarea id="post_answer_text" name="question" rows="4" cols="50" class="form-control comment-box"
                                        placeholder="Family's, Father, Mother"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn_clr ps-5 pe-5">CREATE</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="ask-question text-center mt-5">
                <h4 class="mt-4 mb-2">No collection list created yet.</h4>
                <p class="font-poppins mb-2">Please create the one to shortlist the cute baby names.</p>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end text-capitalize" tabindex="-1" id="offcanvasProfile"
        aria-labelledby="offcanvasProfileLabel">
        <div class="offcanvas-header justify-content-end">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav nav-tabs nav--tabs-3 p-2 flex-column">
                <li class="nav-item">
                    <a href="{{ route('parenting-profile') }}"
                        class="nav-link {{ Request::is('parenting-profile') ? 'active' : '' }}">Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-question') }}"
                        class="nav-link {{ Request::is('parenting-question') ? 'active' : '' }}">{{ translate('my_questions') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-answer') }}"
                        class="nav-link {{ Request::is('parenting-answer') ? 'active' : '' }}">{{ translate('my_answers') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('favourite-names-parenting') }}"
                        class="nav-link {{ Request::is('favourite-names-parenting') ? 'active' : '' }}">{{ translate('my_favourite_names') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bookmarks') }}"
                        class="nav-link {{ Request::is('parenting-bookmarks') ? 'active' : '' }}">{{ translate('my_bookmarks') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-my-child') }}"
                        class="nav-link {{ Request::is('parenting-my-child') ? 'active' : '' }}">My Childs</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
