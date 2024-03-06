
@extends('theme-views.layouts.app')

@section('title', translate('all_Categories'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Categories of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Categories of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
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
  .accordion-content ul{
    padding: 0;
    line-height: 30px;
  }
  .accordion-content ul li{
    list-style: none;
  }
  .category_banner_full_w-bottom{
    margin-bottom: 140px;
  }
 
  .accordion-open .arrow-down {
    transform: rotate(180deg);
  }
  .accordion-header-2{
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
<div class="category_banner_full_w">
    <img src="{{ asset('public/images/cate1.webp') }}" alt="" width="100%">
</div>
<div class="accordion">
    <div class="accordion-item">
      <div class="accordion-header">
          <div class="accordion-header-2">
              <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
              <p class="m-0">
                  Baby boys cloth
        
              </p>
  
          </div>
        <div class="arrow-down">
            <i class="bi bi-chevron-down"></i>
        </div>
      </div>
      <div class="accordion-content">
        <ul>
          <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Tiny Preemie</a></li>
          <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">New Born</a></li>
          <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">3 to 6 Months</a></li>
          <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">6 to 9 Months</a></li>
          <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Item 5</a></li>
        </ul>
      </div>
    </div>
    <div class="accordion-item">
        <div class="accordion-header">
            <div class="accordion-header-2">
                <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
                <p class="m-0">
                    Spring It On
          
                </p>
    
            </div>
          <div class="arrow-down">
              <i class="bi bi-chevron-down"></i>
          </div>
        </div>
        <div class="accordion-content">
          <ul>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Adorable Onsies and Rompers</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Matchy Sets</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Cool T-shirts</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Classy T-shirts</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Breezy shorts</a></li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">
            <div class="accordion-header-2">
                <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
                <p class="m-0">
                    Foot Wear
          
                </p>
    
            </div>
          <div class="arrow-down">
              <i class="bi bi-chevron-down"></i>
          </div>
        </div>
        <div class="accordion-content">
          <ul>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Casual Shoes</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Formal And Party Wear</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Clogs</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Sandles</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Booties</a></li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">
            <div class="accordion-header-2">
                <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
                <p class="m-0">
                    Budget Store
          
                </p>
    
            </div>
          <div class="arrow-down">
              <i class="bi bi-chevron-down"></i>
          </div>
        </div>
        <div class="accordion-content">
          <ul>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">T-shirts under 399</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Bottom Wear 499 </a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Night wear 499</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Onises and Rompers 599</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Sets and Cords</a></li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">
            <div class="accordion-header-2">
                <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
                <p class="m-0">
                   Ocaissonal Wear
          
                </p>
    
            </div>
          <div class="arrow-down">
              <i class="bi bi-chevron-down"></i>
          </div>
        </div>
        <div class="accordion-content">
          <ul>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Traditional kurta pajamaas</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Party suits</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Ethicin Kurtas</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Partyn footwear</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Dhooti Kurta</a></li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">
            <div class="accordion-header-2">
                <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
                <p class="m-0">
                    Acceseries
          
                </p>
    
            </div>
          <div class="arrow-down">
              <i class="bi bi-chevron-down"></i>
          </div>
        </div>
        <div class="accordion-content">
          <ul>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Woolens Cap</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Air Muf and Mufflers</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Mittens And Booties</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Belts and Suspendors</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Summer Caps</a></li>
          </ul>
        </div>
      </div>
      <div class="accordion-item">
        <div class="accordion-header">
            <div class="accordion-header-2">
                <img src="{{ asset('public/images/02-Baby.jpg') }}" alt="Image" width="50px" height="50px">
                <p class="m-0">
                    Nursery Essentials
          
                </p>
    
            </div>
          <div class="arrow-down">
              <i class="bi bi-chevron-down"></i>
          </div>
        </div>
        <div class="accordion-content">
          <ul>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Blankets Quilts</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Wrappers and sandles</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Multi-pack Blanlets</a></li>
            <li><a href="https://bachay.com/products?id=1&data_from=category&page=1">Sleeping Bags</a></li>
            
          </ul>
        </div>
      </div>
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
