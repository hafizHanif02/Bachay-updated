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
<style>
    .breadcrumb li:not(:last-child)::after {
        content: '' !important;
        margin: 0 !important;
    }

    .qna-main {
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

    .question-block {
        border: 1px solid #ededed;
        border-radius: 3px;
        padding: 16px 20px 20px 19px;
    }

    .quesion-icon {
        color: #9e9e9e;
    }

    .child_inner_container {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        border: 1px solid #ededed;
        border-radius: 5px;
        padding: 5px 10px;
        margin: 0 5px 10px 0;
        background: #fff;
    }

    .custom-radio-button {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 15px !important;
        height: 15px;
        border-radius: 50%;
        border: 1.5px solid #ccc;
        outline: none;
        position: relative;
    }

    .custom-radio-button:checked::before {
        content: '';
        display: block;
        width: 10px;
        height: 10px;
        background-color: #f56996;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .report-dropdown :focus {
        border: none;
    }

    .like-button {
        display: inline-block;
        cursor: pointer;
    }

    .like-icon {
        color: gray;
    }

    .liked .like-icon {
        color: blue;
    }

    @media only screen and (max-width: 768px) {
        .qna-main {
            margin: 0 0 100px 0;
        }
    }
</style>
@section('content')
    <div class="container">
        <div class="qna-main">

            <h3 class="mt-4">All Answers</h3>
            <hr>
     




            <div class="question-block mt-3 pb-0">
            
                <hr>
                @foreach($answers as $answer)
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
                    <p class="fw-medium mt-2"><span class="quesion-icon">{{ $loop->iteration }}</span> {{ $answer->answer }} </p>
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
                
            </div>
           
        </div>

    </div>
@endsection
<script>
    let isLiked = false;

    function toggleLike() {
        const likeButton = document.querySelector('.like-button');
        const likeIcon = likeButton.querySelector('.like-icon');
        const likeCount = likeButton.querySelector('.like-count');

        if (isLiked) {
            likeButton.classList.remove('liked');
            likeCount.textContent = parseInt(likeCount.textContent) - 1;
        } else {
            likeButton.classList.add('liked');
            likeCount.textContent = parseInt(likeCount.textContent) + 1;
        }

        isLiked = !isLiked;
    }
</script>
