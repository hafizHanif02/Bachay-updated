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
            <nav class="mt-3 mb-3 quesion-icon" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('parenting-user') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Questions & Answers</li>
                </ol>
            </nav>
            <h3>Q&A</h3>
            <hr>
            <div class="ask-question text-center mt-5">
                <h6 class="font-poppins mb-2">Want to share your parenting queries and get answers</h6>
                <p>Get Solutions and advice from other parents and experts</p>
                <!-- Button trigger modal -->
                <button type="button" class="btn_clr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Ask a Question
                </button>

                <!-- Ask a Question Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content pb-2 ps-2 pe-2">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ask a Question</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #f5f5f5;">
                                <div class="write-comment-container">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box" placeholder="Write your Answer here"></textarea>
                                    <p class="text-start">This question is being
                                        asked for: </p>

                                    <div class="outer_child_container text-start">
                                        <label class="child_inner_container">
                                            <input type="radio" class="dev_radiobuttons custom-radio-button"
                                                name="child_selection" value="child1" style="width: fit-content;">
                                            <span class="child-info-ask-quest"><span class="R14_42">Ali</span><span
                                                    class="R11_75"> 1 yr old</span></span>
                                        </label>
                                        <label class="child_inner_container">
                                            <input type="radio" class="dev_radiobuttons custom-radio-button"
                                                name="child_selection" value="child2" style="width: fit-content;">
                                            <span class="child-info-ask-quest"><span class="R14_42">Ali</span><span
                                                    class="R11_75"> 1 yr old</span></span>
                                        </label>
                                        <label class="child_inner_container">
                                            <input type="radio" class="dev_radiobuttons custom-radio-button"
                                                name="child_selection" value="child3" style="width: fit-content;">
                                            <span class="child-info-ask-quest"><span class="R14_42">Ali</span><span
                                                    class="R11_75"> 1 yr old</span></span>
                                        </label>

                                    </div>


                                    <p class="your-identity text-start">Your identity will not be revealed</p>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn_clr ps-5 pe-5">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question-block mt-5">
                <p class="last-online-time text-end quesion-icon">5 months ago</p>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> My Daughter is 5 year 10 months old. She talks to
                    herself a lot when she is alone and likes to play with herself. She roleplays like she is her teacher,
                    friend or whatever she watches on TV. She can talk to herself or play like this whole day. She does not
                    need any friend to play with. Also she is very shy and afraid to respond to people like if they are our
                    friends and ask her how are you or any other question. Is this a problem. I am very much worried due to
                    this behavior of her.</p>
                <div class="answer-parent-container d-flex justify-content-between">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="{{ asset('public/images/01-Infant.jpg') }}" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
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
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




            </div>
            <div class="question-block mt-3">
                <div class="d-flex justify-content-between">
                    <p class="quesion-icon">Mom of a 4 yr 2 m old boy</p>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-bold"><span class="quesion-icon">Q.</span> Apple is safe for kid???
                </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="bg-transparent border-0 quesion-icon" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-pencil" style="font-size: 20px;"></i>
                        Answer
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content pb-2 ps-2 pe-2">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add An Answer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="background-color: #f5f5f5;">
                                    <textarea id="post_answer_text" rows="4" cols="50" class="comment-box"
                                        placeholder="Write your Answer here"></textarea>

                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn_clr">Post Answer</button>
                                </div>
                            </div>
                        </div>
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
                <hr>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-3">
                        <span>
                            <img class="rounded-circle" src="http://localhost/public/images/01-Infant.jpg" alt=""
                                width="50px" height="50px">
                        </span>
                        <div>
                            <p class="m-0 fw-bold">Author of question</p>
                            <p class="m-0 quesion-icon">Mom of a 4 yr 2 m old boy</p>
                        </div>
                    </div>
                    <p class="quesion-icon">1 Year ago</p>
                </div>
                <p class="fw-medium mt-2"><span class="quesion-icon">A.</span> Yes,apple is safe for kid. </p>
                <div class="answer-parent-container d-flex justify-content-between mt-3">


                    <div class="like-button liked" onclick="toggleLike()">
                        <i class="bi bi-hand-thumbs-up like-icon"></i>
                        <span class="like-count quesion-icon">1</span>
                        <span class="like-text quesion-icon"> Like</span>
                    </div>




                    <div class="dropdown">
                        <button class="bg-transparent border-0 report-dropdown quesion-icon" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size: 20px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" style="">
                            <li><a class="dropdown-item ps-3" href="#" style="font-size: 12px;">Report Abuse</a>
                            </li>
                        </ul>
                    </div>


                </div>




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
