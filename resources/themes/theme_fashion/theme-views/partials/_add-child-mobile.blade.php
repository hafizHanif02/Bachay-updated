<style>
    .add_child_con {
        /* position: relative; */
    }

    .show-div {
        /* visibility: hidden; */
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #FFFFFF;
        padding: 10px;
        box-sizing: border-box;
        padding-top: 24px;
        transition: top 0.3s ease;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3) !important;
    }

    .close-btn-add {
        position: absolute;
        top: 0;
        right: 5px;
        cursor: pointer;
        z-index: 999;
    }

    #slider_part {
        display: flex;
    }

    .slider_child p,
    .slider_child button p,
    .slider_child form button {
        font-size: 10px;
        text-align: center;
        font-weight: 600;
        margin: 0;
        color: #000;
    }

    .child_mobile_btn {
        background: transparent;
        border: none;
        font-size: 10px;
        text-align: center;
        font-weight: 600;
        margin: 0;
        color: #000;
        padding: 0;
    }

    .mainCon {
        .scroll-cards {
            position: relative;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            width: 100%;
            height: auto;
            cursor: default;
            overflow: scroll hidden;
            scroll-snap-type: x mandatory;
            scroll-padding: 0px 1.25rem;
            scrollbar-width: none;

            &::-webkit-scrollbar {
                display: none;
            }

            &.active {
                cursor: grab;
                cursor: -webkit-grab;
            }

            .circleCard {
                text-decoration: none;
                width: auto;
                height: 72px;
                flex: 0 0 auto;
                margin: 0 0.5rem;
                border: none;
                outline: none;
                border-radius: 50px;

                &-image {
                    position: relative;
                    display: block;
                    width: 100%;
                    height: auto;
                    padding-top: 110%;

                    img.responsive {
                        position: absolute;
                        display: block;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }

                &-inner {
                    width: 100%;
                    height: auto;
                    padding: 1rem;
                }
            }
        }
    }
</style>



<div class="container show-div d-lg-none d-xl-none" id="showDiv">
    <span class="close-btn-add" onclick="hideDiv()"><i class="bi bi-x-lg"></i></span>
    <div class="mainCon">
        <div id="slider_part" class="scroll-cards">
            <a href="{{ route('my-child.list') }}">
                <div class="slider_child circleCard">
                    <img alt="Add Child" class="static_img gastaticimage"
                        src="{{ asset('public/images/plus-blue.png') }}" width="50px">
                    <p class="R11_42">Add Child</p>
                </div>
            </a>

            <div class="slider_child circleCard">

                <form action="{{ route('unswitch') }}" method="get">
                    @csrf
                    <button type="submit" class="child_mobile_btn w-100">
                        <div>
                            <img alt="Shop for Kids" title="Shop for Kids" class="static_img gastaticimage"
                                src="{{ asset('public/images/all_p_icon.png') }}" width="50px">
                        </div>All
                    </button>
                </form>
            </div>

            @auth('customer')
                <?php $childs = \App\Models\FamilyRelation::where('user_id', Auth::guard('customer')->user()->id)->get();
                ?>
                @if (!$childs->isEmpty())
                    @foreach ($childs as $child)
                        <div class="slider_child circleCard">

                            <form action="{{ route('switch_child', $child->id) }}" method="get">
                                @csrf
                                <button
                                    class="btn {{ $child->gender == 'male' ? 'primary' : 'child_mobile_btn' }} w-100 p-0 text-center">
                                    <div>
                                        <img alt="boy" class="static_img gastaticimage rounded-circle"
                                            src="{{ asset('public/assets/images/customers/child/' . $child->profile_picture) }}"
                                            width="50px" height="50px">
                                    </div>{{ $child->name }}
                                </button>
                            </form>

                        </div>
                    @endforeach
                @else
                    <div class="slider_child circleCard">
                        <form action="{{ route('switch_male') }}" method="get">
                            @csrf
                            <button type="submit" class="child_mobile_btn w-100">
                                <div>
                                    <img alt="boy" class="static_img gastaticimage"
                                        src="{{ asset('public/images/boy_p_icon.png') }}" width="50px">
                                </div>
                                Boy
                            </button>
                        </form>
                    </div>
                    <div class="slider_child circleCard">
                        <form action="{{ route('switch_female') }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-custom-pink w-100 p-0">
                                <div>
                                    <img alt="girl" class="static_img gastaticimage"
                                        src="{{ asset('public/images/girl_p_icon.png') }}" width="50px">
                                </div>
                                Girl
                            </button>
                        </form>
                    </div>
                    <div class="slider_child circleCard">
                        <div>
                            <img alt="expecting" class="static_img gastaticimage"
                                src="{{ asset('public/images/add-child1.png') }}" width="50px">
                        </div>
                        <p class="R11_42 text-center">Expecting</p>
                    </div>
                @endif
            @endauth
            @guest('customer')
                <div class="slider_child circleCard">
                    <form action="{{ route('switch_male') }}" method="get">
                        @csrf
                        <button type="submit" class="child_mobile_btn w-100">
                            <div><img alt="boy" class="static_img gastaticimage"
                                    src="{{ asset('public/images/boy_p_icon.png') }}" width="50px"></div>
                            Boy
                        </button>
                    </form>
                </div>
                <div class="slider_child circleCard">

                    <p class="R11_42">
                    <form action="{{ route('switch_female') }}" method="get">
                        @csrf
                        <button type="submit" class="child_mobile_btn w-100">
                            <div>

                                <img alt="girl" class="static_img gastaticimage"
                                    src="{{ asset('public/images/girl_p_icon.png') }}" width="50px">
                            </div>
                            Girl
                        </button>
                    </form>
                    </p>
                </div>
                <div class="slider_child circleCard">
                    <div>
                        <img alt="expecting" class="static_img gastaticimage"
                            src="{{ asset('public/images/add-child1.png') }}" width="50px">
                        <p class="R11_42">Expecting</p>
                    </div>
                </div>
            @endguest
        </div>

    </div>
</div>
<script>
    let isShownDiv = true;

    function showDiv() {
        console.log("shown = " + isShownDiv);
        if (!isShownDiv) {

            var anchor = document.querySelector('.add_child_con');
            var div = document.getElementById('showDiv');
            var anchorRect = anchor.getBoundingClientRect();
            // div.style.top = (anchorRect.bottom + window.scrollY) + 'px';
            div.style.display = 'block';
            isShownDiv = true;
        } else {
            hideDiv();
            isShownDiv = false;
        }
    }

    function hideDiv() {
        var div = document.getElementById('showDiv');
        setTimeout(function() {
            div.style.display = 'none';
        }, );
    }

    document.querySelector('.add_child_con').addEventListener('click', function() {
        showDiv();
    });



    const scroll = document.querySelector(".scroll-cards");
    var isDown = false;
    var scrollX;
    var scrollLeft;

    // Mouse Up Function
    scroll.addEventListener("mouseup", () => {
        isDown = false;
        scroll.classList.remove("active");
    });

    // Mouse Leave Function
    scroll.addEventListener("mouseleave", () => {
        isDown = false;
        scroll.classList.remove("active");
    });

    // Mouse Down Function
    scroll.addEventListener("mousedown", (e) => {
        e.preventDefault();
        isDown = true;
        scroll.classList.add("active");
        scrollX = e.pageX - scroll.offsetLeft;
        scrollLeft = scroll.scrollLeft;
    });

    // Mouse Move Function
    scroll.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        var element = e.pageX - scroll.offsetLeft;
        var scrolling = (element - scrollX) * 2;
        scroll.scrollLeft = scrollLeft - scrolling;
    });
</script>
