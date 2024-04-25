<head>
    <style>
        .parenting_menu_scroll.active {
            border-bottom: 3px solid #f56996;

        }

        .parenting_menu_scroll {
            margin: 0 8px 0 0;
            color: #000;
            padding: 0 0 5px 0;
            font-weight: 600;
            font-size: 16px;
        }

        .nav_parenting {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3) !important;
            margin: 26px 0 0 0;
        }

        .scroll-container {
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }
    </style>

</head>

<body>

    <section class="scroll-container nav_parenting ps-3">

        <a href="{{ route('parenting-user') }}"
            class="parenting_menu_scroll {{ Request::routeIs('parenting-user') ? 'active' : '' }}">Home</a>
        <a href="{{ route('Q&A') }}" class="parenting_menu_scroll {{ Request::routeIs('Q&A') ? 'active' : '' }}">Q&A</a>
        <a href="{{ route('vaccination-growth-tracker') }}"
            class="parenting_menu_scroll {{ Request::routeIs('vaccination-growth-tracker') ? 'active' : '' }}">Vaccination
            & growth tracker</a>
        <a href="{{ route('vaccination-growth-tracker') }}"
            class="parenting_menu_scroll {{ Request::routeIs('Quiz') ? 'active' : '' }}">Quiz</a>
    </section>
</body>
