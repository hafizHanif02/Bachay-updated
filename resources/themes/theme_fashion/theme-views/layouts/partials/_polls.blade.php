<head>
    <style>
        .et__cards-container {
            display: flex;
            justify-content: left;
            align-items: center;
        }

        /*==================== POLL UI ====================*/
        .et__box--wrapper {
            --clr-primary: #000000;
            --clr-bg-light: #ffffff;
            --clr-gray-100: #cccccc;
            --clr-gray-200: #e6e6e6;
            --clr-gray-300: #f0f0f0;
            --linear-gradient: linear-gradient(45deg,
                    rgba(255, 255, 255, 0.25) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, 0.25) 50%,
                    rgba(255, 255, 255, 0.25) 75%,
                    transparent 75%,
                    transparent);

            width: 100%;
            max-width: 380px;
            padding: 25px;
            border-radius: 15px;
            background-color: var(--clr-bg-light);
        }

        .et__box--wrapper header {
            font-size: 22px;
            font-weight: 700;
        }

        .et__box--wrapper .et__poll--area {
            margin: 20px 0 15px;
        }

        .et__poll--area .et__box {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
            cursor: pointer;
            border: 2px solid var(--clr-gray-200);
            transition: all 0.2s ease;
        }

        .et__poll--area .et__box:hover {
            border-color: var(--clr-primary);
        }

        .et__poll--area .et__box.et__selected {
            border-color: var(--clr-primary);
        }

        .et__poll--area .et__box .et__row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
        }

        .et__poll--area .et__box .et__row .et__column {
            display: flex;
            align-items: center;
        }

        .et__poll--area .et__box .et__row .et__circle {
            display: block;
            height: 19px;
            width: 19px;
            margin-right: 10px;
            border-radius: 50%;
            position: relative;
            border: 2px solid var(--clr-gray-100);
        }

        .et__poll--area .et__box.et__selected .et__row .et__circle {
            border-color: #ef3b74;
        }

        .et__poll--area .et__box .et__row .et__circle::after {
            display: none;
            content: "";
            height: 11px;
            width: 11px;
            border-radius: inherit;
            position: absolute;
            top: 2px;
            left: 2px;
            background-image: var(--linear-gradient);
            background-size: 0.5rem 0.5rem;
            animation: etProgressBarStripes 1s linear infinite;
            background-color: var(--clr-gray-100);
        }

        .et__poll--area .et__box:hover .et__row .et__circle::after {
            display: block;
            background-color: var(--clr-gray-200);
        }

        .et__poll--area .et__box.et__selected .et__row .et__circle::after {
            display: block;
            background-color: #ef3b74;
            left: 2.2px;
            top: 2.2px;
        }

        .et__poll--area .et__box .et__row span {
            font-size: 16px;
            font-weight: 400;
        }

        .et__percent {
            color: #ef3b74;
            font-size: 18px !important;
            font-weight: 600 !important;
        }

        .et__title {
            font-size: 18px !important;
            font-weight: 600 !important;
        }

        .et__poll--area .et__box .et__percent {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .et__poll--area .et__box.et__selectedAll .et__percent {
            visibility: visible;
            opacity: 1;
        }

        .et__poll--area .et__box .et__progress {
            height: 0px;
            width: 100%;
            position: relative;
            border-radius: 30px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease;
            background-color: var(--clr-gray-300);
        }

        .et__poll--area .et__box .et__progress::after {
            content: "";
            height: 100%;
            width: 0;
            border-radius: inherit;
            position: absolute;
            background-color: var(--clr-gray-100);
            background-image: var(--linear-gradient);
            background-size: 1rem 1rem;
            animation: etProgressBarStripes 1s linear infinite;
            transition: width 0.5s ease;
        }

        .et__poll--area .et__box.et__selectedAll .et__progress {
            height: 7px;
            margin: 8px 0 3px;
            visibility: visible;
            opacity: 1;
        }

        .et__poll--area .et__box.et__selected .et__progress::after {
            width: calc(1% * var(--w));
            background-color: #ef3b74;
        }

        @-webkit-keyframes etProgressBarStripes {
            from {
                background-position: 55px 0;
            }

            to {
                background-position: 0 0;
            }
        }

        @keyframes etProgressBarStripes {
            from {
                background-position: 55px 0;
            }

            to {
                background-position: 0 0;
            }
        }

        /*==================== MEDIA QUERIES ====================*/

        /* For small devices */
        @media screen and (min-width: 500px) {}

        /* For medium devices */
        @media screen and (min-width: 767px) {}
    </style>
</head>

<body>
    <div class="container">
        <section class="container">
            <section class="et__cards-container">
                <div class="et__box--wrapper">
                    <div class="et__poll--area">
                        <h4 class="mb-3">which language is mostly spoken in the world</h4>
                        <label for="" class="et__box">
                            <div class="et__row">
                                <div class="et__column">
                                    <span class="et__circle"></span>
                                    <span class="et__title">French</span>
                                </div>
                                <span class="et__percent">100%</span>
                            </div>
                            <div class="et__progress" style="--w:100;"></div>
                        </label>
                        <label for="" class="et__box">
                            <div class="et__row">
                                <div class="et__column">
                                    <span class="et__circle"></span>
                                    <span class="et__title">English</span>
                                </div>
                                <span class="et__percent">70%</span>
                            </div>
                            <div class="et__progress" style="--w:70;"></div>
                        </label>
                        <label for="" class="et__box">
                            <div class="et__row">
                                <div class="et__column">
                                    <span class="et__circle"></span>
                                    <span class="et__title">Japanese</span>
                                </div>
                                <span class="et__percent">60%</span>
                            </div>
                            <div class="et__progress" style="--w:60;"></div>
                        </label>
                        <label for="" class="et__box">
                            <div class="et__row">
                                <div class="et__column">
                                    <span class="et__circle"></span>
                                    <span class="et__title">Hindi</span>
                                </div>
                                <span class="et__percent">50%</span>
                            </div>
                            <div class="et__progress" style="--w:50;"></div>
                        </label>
                    </div>
                </div>

            </section>

        </section>

        <script>
            // getting all attributes
            const options = document.querySelectorAll(".et__box"),
                etProgressBar = document.querySelector(".et__percent");

            for (let i = 0; i < options.length; i++) {
                options[i].addEventListener("click", () => {
                    for (let j = 0; j < options.length; j++) {
                        if (options[j].classList.contains("et__selected")) {
                            options[j].classList.remove("et__selected");
                        }
                    }
                    options[i].classList.add("et__selected");
                    for (let k = 0; k < options.length; k++) {
                        options[i].classList.add("et__selectedAll");
                    }
                });
            }
        </script>
</body>

</html>
