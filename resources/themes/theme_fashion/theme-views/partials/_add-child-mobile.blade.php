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
        padding-top: 20px;
        /* z-index: 9999; */
        transition: top 0.3s ease;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3) !important;
    }

    .close-btn-add {
        position: absolute;
        top: 0;
        right: 5px;
        cursor: pointer;
    }

    #slider_part {
        display: flex;
        justify-content: space-between;
    }
    .slider_child p{
        font-size: 10px;
        text-align: center;
        font-weight: 600;
        margin: 0;
    }
</style>
<div class="show-div d-md-none d-lg-none d-xl-none" id="showDiv">
    <span class="close-btn-add" onclick="hideDiv()"><i class="bi bi-x-lg"></i></span>
    <div id="slider_part">
        <div class="slider_child">
            <img alt="Add Child" class="static_img gastaticimage" src="{{ asset('public/images/plus-blue.png') }}"
                width="50px">
            <p class="R11_42">Add Child</p>
        </div>
        
        <div class="slider_child">
            <img alt="Shop for Kids" title="Shop for Kids" class="static_img gastaticimage"
                src="{{ asset('public/images/all_p_icon.png') }}" width="50px">
            <p class="R11_42">All</p>
        </div>

        <div class="slider_child">
            <img alt="boy" class="static_img gastaticimage"
                src="{{ asset('public/images/boy_p_icon.png') }}" width="50px">
         
            <p class="R11_42">Boy</p>
        </div>
        <div class="slider_child">
            <img alt="girl" class="static_img gastaticimage"
                src="{{ asset('public/images/girl_p_icon.png') }}" width="50px">
     
            <p class="R11_42">Girl</p>
        </div>
        <div class="slider_child">
            <img alt="expecting" class="static_img gastaticimage"
                src="{{ asset('public/images/add-child1.png') }}" width="50px">
            <p class="R11_42">Expecting</p>
        </div>
    </div>
</div>
<script>
    function showDiv() {
        var anchor = document.querySelector('.add_child_con');
        var div = document.getElementById('showDiv');
        var anchorRect = anchor.getBoundingClientRect();
        // div.style.top = (anchorRect.bottom + window.scrollY) + 'px';
        div.style.display = 'block';
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
</script> 
