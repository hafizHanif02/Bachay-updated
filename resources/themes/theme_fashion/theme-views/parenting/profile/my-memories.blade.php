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
    .my-memory {
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
        .my-memory {
            margin: 0 0 100px 0;
        }
    }
</style>
@section('content')
    <div class="container">
        <div class="user-profile-wrapper bg-section text-capitalize">
            <ul class="nav nav-tabs nav--tabs-3 justify-content-start mb-0 d-none d-md-flex gap-2">
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
                <li class="nav-item">
                    <a href="{{ route('parenting-topics') }}"
                        class="nav-link {{ Request::is('parenting-topics') ? 'active' : '' }}">{{ translate('my_topics') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-memories') }}"
                        class="nav-link {{ Request::is('parenting-memories') ? 'active' : '' }}">{{ translate('my_memories') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-quick-reads') }}"
                        class="nav-link {{ Request::is('parenting-quick-reads') ? 'active' : '' }}">{{ translate('my_quick_reads') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-milestones') }}"
                        class="nav-link {{ Request::is('parenting-milestones') ? 'active' : '' }}">{{ translate('my_milestons') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('parenting-bumpie') }}"
                        class="nav-link {{ Request::is('parenting-bumpie') ? 'active' : '' }}">{{ translate('my_bumpie') }}</a>
                </li>
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
        <div class="my-memory">

            <h3 class="mt-4">My Memories</h3>
            <hr>
            <div class="ask-question">
                <h2>Show All Memories</h2>
            </div>
            <div class="ask-question text-center mt-5">
                <img src="{{ asset('public/images/memory.PNG') }}" alt="Image for Followed" class="img-fluid">
                <h4 class="mt-4 mb-2">No Memories Uploaded, yet!</h4>
                <p class="font-poppins mb-2">Seems like you haven't uploaded any photos on Memories, please upload one ...
                </p>
                <!-- Button trigger modal -->
                <button type="button" class="btn_clr " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bi bi-upload"></i>
                    Upload Your Photo
                </button>
                <!-- Ask a Question Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content pb-2 ps-2 pe-2">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Your Beautiful Memory</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f5f5f5;">
                                <div class="write-comment-container">
                                    <div class="form-group position-relative">
                                        <textarea id="post_answer_text" name="question" rows="4" cols="50" class="form-control comment-box"
                                            placeholder="I find solace in the laughter of a childhood memory."></textarea>
                                        <input type="file" id="attachment" name="attachment"
                                            class="position-absolute start-0 opacity-0" style="height: 10px; width: 100%;">
                                        <label for="attachment"
                                            class="btn btn-outline-primary position-absolute bottom-0 start-0 mb-2 me-2"
                                            style="border: none; color: inherit; background-color: transparent;">
                                            <i class="bi bi-paperclip"></i> Attach File
                                        </label>
                                    </div>
                                    <p class="text-start mt-3">Tag kids present in this memory: </p>
                                    <div class="outer_child_container text-start">
                                        <label class="child_inner_container">
                                            <input type="checkbox" class="dev_checkboxes custom-checkbox-button"
                                                name="child_selection[]" value="1" style="width: fit-content;">
                                            <span class="child-info-ask-quest">
                                                <span class="R14_42">Allow other parents to share this picture</span>
                                            </span>
                                        </label>
                                        <label class="child_inner_container">
                                            <input type="checkbox" class="dev_checkboxes custom-checkbox-button"
                                                name="child_selection[]" value="1" style="width: fit-content;">
                                            <span class="child-info-ask-quest">
                                                <span class="R14_42">Use this as my profile picture</span>
                                            </span>
                                        </label>
                                    </div>
                                    <p class="your-identity text-start mt-2">Your identity will not be revealed</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn_clr ps-5 pe-5">Post Memory</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
