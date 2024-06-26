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
        @foreach($explores as $explore)
            <div class="video" id="hassan">
                <video class="video__player" src="{{ asset('public/assets/images/explore/media/'.$explore->media) }}"></video>
                <div class="parent_card_scroll">
                    <div class="scroll-container">
                        @foreach($explore->items as $item)
                        <span class="child_container_product">
                            <a href="{{ route('product',$item->product->slug) }}">
                                
                                <img src="{{ asset('/storage/app/public/product/thumbnail/'.$item->product->thumbnail) }}" alt="" width="100px"
                                height="100px" />
                                <p class="price_product m-0">
                                    Rs {{ $item->product->unit_price }} <span class="before_discount"></span>
                                </p>
                                <p class="shop_now_btn m-0"> SHOP NOW</p>
                            </a>
                            
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
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
