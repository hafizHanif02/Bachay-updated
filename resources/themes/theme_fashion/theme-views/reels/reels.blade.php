<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bachay reels</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            box-sizing: border-box;

        }

        html {
            scroll-snap-type: y mandatory;
        }

        body {
            color: white;
            background-color: black;
            height: 100vh;
            display: grid;
            place-items: center;
        }

        .app__videos {
            position: relative;
            height: 750px;
            background-color: white;
            overflow: scroll;
            width: 100%;
            max-width: 400px;
            scroll-snap-type: y mandatory;
            border-radius: 20px;
        }

        .app__videos::-webkit-scrollbar {
            display: none;
        }

        .app__videos {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .video {
            position: relative;
            height: 100%;
            width: 100%;
            background-color: white;
            scroll-snap-align: start;
            
        }

        .video__player {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 425px) {
            .app__videos {
                width: 100%;
                height: 100%;
                max-width: 100%;
                border-radius: 0;
            }
        }

        /* video header */

        .videoHeader {
            position: absolute;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .videoHeader * {
            padding: 20px;
        }

        /* video footer */

        .videoFooter {
            position: relative;
            bottom: 100px;
            margin-left: 20px;
        }

        .videoFooter__text {
            position: absolute;
            bottom: 0;
            color: white;
            display: flex;
            align-items: center;
            margin-bottom: 45px;
        }

        .user__avatar {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .videoFooter__text h3 {
            margin-left: 10px;
        }

        .videoFooter__text h3 button {
            color: white;
            font-weight: 900;
            text-transform: inherit;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            padding: 5px;
        }

        .videoFooter__ticker {
            width: 60%;
            margin-left: 30px;
            margin-bottom: 20px;
            height: fit-content;
        }

        .videoFooter__ticker marquee {
            font-size: 12px;
            padding-top: 7px;
            color: white;
        }

        .videoFooter__ticker .material-icons {
            position: absolute;
            left: 5px;
            color: white;
        }

        .videoFooter__actions {
            display: flex;
            position: absolute;
            width: 95%;
            justify-content: space-between;
            color: white;
        }

        .videoFooter__actionsLeft .material-icons {
            padding: 0 7px;
            font-size: 1.6em;
        }

        .videoFooter__actionsRight .material-icons {
            font-size: 25px;
        }

        .videoFooter__actionsRight {
            display: flex;
        }

        .videoFooter__stat {
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        .videoFooter__stat p {
            margin-left: 3px;
        }

        .scroll-container {
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
            -ms-overflow-style: none !important;
            display: flex;
        }

        .scroll-container img {
            margin-right: 5px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .parent_card_scroll {
            position: absolute;
            bottom: 10%;
            width: 100%;
            padding-left: 3%;
        }

        .before_discount {
            text-decoration: line-through !important;
            color: gray;
            font-size: 12px;
        }

        .price_product {
            margin: 0;
            font-weight: 600;
            font-size: 12px;
            text-align: center;
            overflow: hidden;
            background-color: #fff;
            color: #000;
            padding: 5px;
            margin: -5px 5px 0 0;

        }

        .shop_now_btn {
            text-align: center;
            margin: 0 5px 0 0;
            background: orange;
            color: #fff;
            font-size: 12px;
            padding: 5px;
            border-bottom-left-radius: 7px;
            border-bottom-right-radius: 7px;
        }

        .child_container_product a {
            text-decoration: none;
          
        }
        .child_container_product{
            margin-right: 5px;
        }
        
    </style>
</head>

<body>
    <div class="app__videos">

        <div class="video" id="hassan">
            <video class="video__player" src="{{ asset('public/images/videos/2.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/1.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/3.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/4.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/5.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/6.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/7.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/8.mp4') }}"></video>

            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
        <div class="video">
            <video class="video__player" src="{{ asset('public/images/videos/9.mp4') }}"></video>


            <div class="parent_card_scroll">
                <div class="scroll-container">
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-half-sleeves-unicorn-print-pack-of-2-tee-2-bottom-set-navy-pink-DTrcdl">

                            <img src="{{ asset('public/images/explore_images/1.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/zero-half-sleeves-tee-shorts-text-print-krNnsV
                        ">

                            <img src="{{ asset('public/images/explore_images/2.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/bumzee-full-sleeves-abstract-design-printed-zipper-hooded-sweatshirt-Lh5jq2
                        ">

                            <img src="{{ asset('public/images/explore_images/3.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/first-smile-interlock-full-sleeves-t-shirt-lounge-pant-set-with-penguin-applique-mulberry-blue-njTAGq
                        ">

                            <img src="{{ asset('public/images/explore_images/4.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-100-cotton-knit-half-sleeves-t-shirts-with-lion-bear-graphics-pack-of-7-VN3gpR
                        ">

                            <img src="{{ asset('public/images/explore_images/5.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/doodle-poodle-100-cotton-knit-full-sleeves-floral-tex-printed-frock-HyuZAM
                        ">

                            <img src="{{ asset('public/images/explore_images/6.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/anthrilo-full-sleeves-color-blocked-fleece-hoodie-jogger-set-TF6qVJ
                        ">

                            <img src="{{ asset('public/images/explore_images/7.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/toonyport-full-sleeves-space-theme-astronaut-printed-looper-knitted-sweatshirt-joggers-set-ChB0pU
                        ">

                            <img src="{{ asset('public/images/explore_images/8.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-cotton-knit-full-length-diaper-pants-striped-car-print-pack-of-3-17hZz0
                        ">

                            <img src="{{ asset('public/images/explore_images/9.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-hoodies-hjytFq
                        ">

                            <img src="{{ asset('public/images/explore_images/10.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/kookie-kids-full-sleeves-crab-printed-legged-swimsuit-with-attached-float-cap-pink-xfbh26
                        ">

                            <img src="{{ asset('public/images/explore_images/11.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>
                    <span class="child_container_product">
                        <a href="https://bachay.com/product/babyhug-organic-cotton-knit-full-sleeves-sweater-set-with-cap-nw6YzR">

                            <img src="{{ asset('public/images/explore_images/12.webp') }}" alt="" width="100px"
                                height="100px" />
                            <p class="price_product m-0">
                                Rs 548.39 <span class="before_discount">899</span>
                            </p>
                            <p class="shop_now_btn m-0"> SHOP NOW</p>
                        </a>

                    </span>

                </div>
            </div>
        </div>
    </div>
    <script>
        // Select all video elements on the page
        const videos = document.querySelectorAll("video");

        // Function to pause all videos except the provided one
        function pauseOtherVideos(currentVideo) {
            videos.forEach(video => {
                if (video !== currentVideo) {
                    video.pause();
                }
            });
        }

        // Function to handle click event on the video
        function handleClick(video) {
            // Check if the video is paused
            if (video.paused) {
                // Pause other videos and play this one
                pauseOtherVideos(video);
                video.play();
            } else {
                // If playing, pause the video
                video.pause();
            }
        }

        // Loop through each video element
        for (const video of videos) {
            // Add a click event listener to each video
            video.addEventListener("click", function() {
                handleClick(video);
            });
        }

        // Configure the Intersection Observer
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                // If the video is in view, play it
                if (entry.isIntersecting) {
                    const video = entry.target;
                    pauseOtherVideos(video);
                    video.play();
                }
                // If the video is not in view, pause it
                else {
                    entry.target.pause();
                }
            });
        }, {
            threshold: 0.5
        }); // Adjust threshold as needed

        // Observe each video
        videos.forEach(video => {
            observer.observe(video);
        });
    </script>
</body>

</html>
