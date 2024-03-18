<div class="modal fade __sign-in-modal" id="ChildModel" tabindex="-1" aria-labelledby="ChildModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="child-container ps-3 pe-3">
                        <h3 class="text-center child-heading">
                            Switch User
                        </h3>
                        <a
                        @if(Auth::guard('customer')->check())
                         href="{{ route('my-child.list') }}"
                         @else
                         href="javascript:"
                         class="customer_login_register_modal"
                         @endif
                         >
                            <div class="d-flex align-items-center justify-content-between gap-3 mt-4 mb-4">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="baby_circle_child">
                                        <img class="child-img" src="{{ asset('public/images/plus.png') }}" alt="">
                    
                                    </div>
                                    
                                        <h3 class="child-heading">
                                            Add Child
                                        </h3>
    
                                </div>
                            </div>
                        </a>
                        <div class="d-flex align-items-center justify-content-between gap-3 mt-4 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="baby_circle_child">
                                    <img class="child-img" src="{{ asset('public/images/all.jpg') }}" alt="">
                
                                </div>
                                
                                    <h3 class="child-heading">
                                        ALL
                                    </h3>

                            </div>
                            <form action="{{ route('unswitch') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Switch</button>
                            </form>
                            
                        </div>
                        @auth('customer')
                            <?php $childs = \App\Models\FamilyRelation::where('user_id', Auth::guard('customer')->user()->id)->get();
                            ?>
                            @if(!$childs->isEmpty())
                                @foreach($childs as $child)
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
                                <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="baby_circle_child">
                                            <img class="child-img" src="{{asset('public/assets/images/customers/child/'.$child->profile_picture)}}" alt=""> 
                                        </div>
                                        <div>
                                            <h3 class="child-heading">
                                                {{ $child->name }} 
                                            </h3>
                                            <p class="m-0">
                                                Age: {{ $formattedAge }}
                                            </p>
                                        </div>
                                        
                                    </div>
                                    <form action="{{ route('switch_child', $child->id) }}" method="get">
                                        @csrf
                                    <button class="btn btn-{{ $child->gender == 'male' ? 'primary' : 'custom-pink' }}">Switch</button>
                                    </form>
                                </div>
                                @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-between gap-3 mt-4 mb-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="baby_circle_child">
                                                <img class="child-img" src="{{ asset('public/images/boy.jpg') }}" alt="">
                            
                                            </div>
                                            
                                                <h3 class="child-heading">
                                                    Boy
                                                </h3>
            
                                        </div>
                                        <form action="{{ route('switch_male') }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Switch</button>
                                        </form>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between gap-3 mt-4 mb-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="baby_circle_child">
                                                <img class="child-img" src="{{ asset('public/images/girl.jpg') }}" alt="">
                            
                                            </div>
                                            
                                                <h3 class="child-heading">
                                                    Girl
                                                </h3>
            
                                        </div>
                                        <form action="{{ route('switch_female') }}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-custom-pink">Switch</button>
                                        </form>
                                    </div>
                            @endif
                        @endauth
                        @guest('customer')
                        <div class="d-flex align-items-center justify-content-between gap-3 mt-4 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="baby_circle_child">
                                    <img class="child-img" src="{{ asset('public/images/boy.jpg') }}" alt="">
                
                                </div>
                                
                                    <h3 class="child-heading">
                                        Boy
                                    </h3>

                            </div>
                            <form action="{{ route('switch_male') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary">Switch</button>
                            </form>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 mt-4 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="baby_circle_child">
                                    <img class="child-img" src="{{ asset('public/images/girl.jpg') }}" alt="">
                
                                </div>
                                
                                    <h3 class="child-heading">
                                        Girl
                                    </h3>

                            </div>
                            <form action="{{ route('switch_female') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-custom-pink">Switch</button>
                            </form>
                        </div>
                        @endguest
                    </div>
                </div>
        </div>
    </div>
</div>
<style>
    .btn-custom-pink {
        color: #fff;
        background-color: #ff69b4; 
        border-color: #ff69b4; 
    }

    .btn-custom-pink:hover {
        background-color: #ff5aa8; 
        border-color: #ff5aa8; 
    }
</style>

<style>
    
    iframe{
        border-radius: 20px;
    }
    .video-container{
        padding: 30px 20px;
        border-radius: 20px;
        border: 1px solid #ebeaea;
        width: 60%;
    }
    .child-container{
       width: 100% !important;
        border: 1px solid #ebeaea;
        border-radius: 20px;
        padding: 10px 30px;
        padding-bottom: 0;
    background-image: url(https://cdn.cdnparenting.com/brainbees/community/preact/public/media/Personalization_BG.png);
    background-repeat: no-repeat;
    background-size: cover;
    background-origin: content-box;
    background-position: bottom;
    height: 90vh;
    overflow-y: auto;
    }
    .video_heading , .child-heading , .child-heading{
        font-family: 'poppins';
    }
    .baby_circle_child{
        width: 70px;
    height: 70px;
    float: left;
    border: 2px solid #fff;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    }
    .child-img{
        max-width: 100%;
    }

@media screen and (min-width: 1024px) and (max-width: 1199px) {
  /* Styles for larger tablets, laptops, and desktops */
  .video-container{
    width: 100%;
  }
  
}

@media screen and (min-width: 768px) and (max-width: 1023px) {
  /* Styles for tablets and small laptops */
  .video-container{
    width: 100%;
    padding: 0;

  }
}

@media screen and (min-width: 320px) and (max-width: 767px) {
  /* Styles for phones and small tablets */
  .video-container{
    width: 100%;
    padding: 0;
    border: none;
  }
  iframe{
        height: 280px;
    }
}


</style>
