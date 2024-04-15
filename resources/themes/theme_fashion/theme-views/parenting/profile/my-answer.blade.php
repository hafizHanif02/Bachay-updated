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
    .my-ans {
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
        .my-ans {
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
                        class="nav-link {{ Request::is('parenting-profile') || Request::is('parenting-profile') || Request::is('parenting-question') ? 'active' : '' }}">{{ translate('profile') }}
                    </a>
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
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-topics') }}"
                        class="nav-link {{ Request::is('parenting-topics') ? 'active' : '' }}">{{ translate('my_topics') }}</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-memories') }}"
                        class="nav-link {{ Request::is('parenting-memories') || Request::is('parenting-memories') ? 'active' : '' }}">{{ translate('my_memories') }}</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('parenting-quick-reads') }}"
                        class="nav-link {{ Request::is('parenting-quick-reads') || Request::is('parenting-quick-reads') ? 'active' : '' }}">{{ translate('my_quick_reads') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-milestones') }}"
                        class="nav-link {{ Request::is('parenting-milestones') || Request::is('parenting-milestones') ? 'active' : '' }}">{{ translate('my_milestons') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bumpie') }}"
                        class="nav-link {{ Request::is('parenting-bumpie') || Request::is('parenting-bumpie') ? 'active' : '' }}">{{ translate('my_bumpie') }}</a>
                </li> --}}
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
        <div class="my-ans">
            <h3 class="mt-4">My Answers</h3>
            <hr>
            @if(empty($myanswers))
            <div class="ask-question text-center mt-5">
                <h4 class="mt-4 mb-2">No Answers posted, yet!</h4>
                <p class="font-poppins mb-2">Parents like you are looking for help on their parenting problems. Your answers
                    and experiences would be invaluable for them. View the Community Home Page and share your answers.</p>
                <!-- Button trigger modal -->
                <button type="button" class="btn_clr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Answer a Question
                </button>
                <!-- Ask a Question Modal -->
                {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content pb-2 ps-2 pe-2">
                            <form action="{{ route('Q&A.answer.store') }}" method="POST">
                                @csrf
                                @auth('customer')
                                    <input type="hidden" name="user_id" value="{{ Auth::guard('customer')->user()->id }}">
                                @endauth
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ask a Question</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <div class="write-comment-container">
                                        <div class="form-group position-relative">
                                            <textarea id="post_answer_text" name="question" rows="4" cols="50" class="form-control comment-box"
                                                placeholder="Write your Question here"></textarea>
                                            <input type="file" id="attachment" name="attachment"
                                                class="position-absolute start-0 opacity-0"
                                                style="height: 100%; width: 100%;">
                                            <label for="attachment"
                                                class="btn btn-outline-primary position-absolute bottom-0 start-0 mb-2 me-2"
                                                style="border: none; color: inherit; background-color: transparent;"> <i
                                                    class="bi bi-paperclip"></i> Attach File</label>
                                        </div>
                                        <p class="text-start mt-3">This question is being
                                            asked for: </p>
                                        @auth('customer')
                                            <?php
                                            $childs = \App\Models\FamilyRelation::where('user_id', Auth::guard('customer')->user()->id)->get();
                                            ?>
                                            <div class="outer_child_container text-start">
                                                @if (!$childs->isEmpty())
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
                                                        if ($diff->y == 0 && $diff->m == 0) {
                                                            $formattedAge = 'New Born';
                                                        }
                                                        ?>
                                                        <label class="child_inner_container">
                                                            <input type="radio" class="dev_radiobuttons custom-radio-button"
                                                                name="child_selection" name="child_id"
                                                                value="{{ $child->id }}" style="width: fit-content;">
                                                            <span class="child-info-ask-quest"><span
                                                                    class="R14_42">{{ $child->name }}</span><span
                                                                    class="R11_75"> {{ $formattedAge }}</span></span>
                                                        </label>
                                                    @endforeach
                                            </div>
                                            @endif
                                        @endauth
                                        <p class="your-identity text-start">Your identity will not be revealed</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn_clr ps-5 pe-5">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
            @else
                @foreach($myanswers as $answer)
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex gap-3">
                            <span>
                                <img class="rounded-circle" src="{{ asset('storage/app/public/profile/'.$answer->user->image) }}" alt=""
                                    width="50px" height="50px">
                            </span>
                            <div>
                                <p class="m-0 fw-bold">{{ $answer->user->f_name. ' '. $answer->user->l_name }}</p>
                                {{-- <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p> --}}
                            </div>
                        </div>
                        <p class="quesion-icon">{{ $answer->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> {{ $answer->answer }} </p>
                    <div class="answer-parent-container d-flex justify-content-between mt-3">
    
    
                        <div class="like-button" onclick="toggleLike()">
                            <i class="bi bi-hand-thumbs-up like-icon"></i>
                            <span class="like-count quesion-icon">0</span>
                            <span class="like-text quesion-icon"> Like</span>
                        </div>
    
    
    
    
                        <div class="dropdown">
                            <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-0">
                                <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                                </li>
                            </ul>
                        </div>
    
    
                    </div>

                </div>
                @endforeach
            @endif
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
                        class="nav-link {{ Request::is('parenting-profile') ? 'active' : '' }}">{{ translate('profile') }}
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
            </ul>
        </div>
    </div>
@endsection
