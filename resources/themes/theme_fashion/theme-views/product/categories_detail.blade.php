@extends('theme-views.layouts.app')

@section('title', translate('all_Categories'))

@push('css_or_js')
    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="og:title" content="Categories of {{ $web_config['name']->value }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
    <meta property="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:title" content="Categories of {{ $web_config['name']->value }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush
<style>
    .accordion {
        max-width: 400px;
        margin: 0 auto;
    }

    .accordion-item {
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }

    .accordion-header {
        background-color: #f4f4f4;
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .accordion-header img {
        border-radius: 50%;

    }

    .accordion-content {
        display: none;
        padding: 10px;
    }

    .accordion-content ul {
        padding: 0;
        line-height: 30px;
    }

    .accordion-content ul li {
        list-style: none;
    }

    .category_banner_full_w-bottom {
        margin-bottom: 140px;
    }

    .accordion-open .arrow-down {
        transform: rotate(180deg);
    }

    .accordion-header-2 {
        display: flex;
        gap: 15px;
        align-items: center;

    }

    .accordion-header-2 p {
        font-size: 14px;
        font-weight: 600;
    }

    .accordion-content ul li a {
        color: #000;
        font-family: 'poppins'
    }

    .accordion-content ul li a:hover {
        color: #835ec1;
    }
</style>
@section('content')
    @if($banner != null)
    <div class="category_banner_full_w">
        <img src="{{ asset('/storage/app/public/banner/'.($banner->mobile_photo != null ? $banner->mobile_photo : $banner->photo)) }}" alt="" width="100%">
    </div>
    @else
    <div class="category_banner_full_w">
      <img src="{{ asset('public/images/cate1.webp') }}" alt="" width="100%">
  </div>
    @endif
    <div class="accordion">
      @foreach($category->nav_views as $nav_view)
        <div class="accordion-item">
            <div class="accordion-header">
                <div class="accordion-header-2">
                    <img src="{{ asset('public/assets/images/category/nav_category/'.$nav_view->image) }}" alt="Image" width="50px" height="50px">
                    <p class="m-0">
                        {{ $nav_view->title }}
                    </p>
                </div>
                <div class="arrow-down">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>
            <div class="accordion-content">
                <ul>
                  @foreach($nav_view->nav_subs as $nav_sub)
                    <li><a href="{{ $nav_sub->url }}">{{ $nav_sub->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
      @endforeach
    </div>
    <div class="category_banner_full_w-bottom">
        <img src="{{ asset('public/images/categ.webp') }}" alt="" width="100%">
    </div>
@endsection

@push('script')
    <script>
        const accordionItems = document.querySelectorAll('.accordion-item');

        accordionItems.forEach(item => {
            item.querySelector('.accordion-header').addEventListener('click', () => {
                const content = item.querySelector('.accordion-content');
                const isOpen = item.classList.contains('accordion-open');

                accordionItems.forEach(item => {
                    item.classList.remove('accordion-open');
                    item.querySelector('.accordion-content').style.display = 'none';
                });

                if (!isOpen) {
                    content.style.display = 'block';
                    item.classList.add('accordion-open');
                }
            });
        });
    </script>
    <script src="{{ asset('public/assets/front-end/js/categories.js') }}"></script>
@endpush
