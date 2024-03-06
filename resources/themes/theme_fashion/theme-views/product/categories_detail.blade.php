
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
  /* .arrow-down {
    width: 0; 
    height: 0; 
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid black;
  } */
  .accordion-open .arrow-down {
    transform: rotate(180deg);
  }
  .accordion-header-2{
    display: flex;
    gap: 15px;
    align-items: center;

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
          <li>Tiny Preemie</li>
          <li>New Born</li>
          <li>3 to 6 Months</li>
          <li>6 to 9 Months</li>
          <li>Item 5</li>
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
            <li>Adorable Onsies and Rompers</li>
            <li>Matchy Sets</li>
            <li>Cool T-shirts</li>
            <li>Classy T-shirts</li>
            <li>Breezy shorts</li>
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
            <li>Casual Shoes</li>
            <li>Formal And Party Wear</li>
            <li>Clogs</li>
            <li>Sandles</li>
            <li>Booties</li>
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
            <li>T-shirts under 399</li>
            <li>Bottom Wear 499 </li>
            <li>Night wear 499</li>
            <li>Onises and Rompers 599</li>
            <li>Sets and Cords</li>
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
            <li>Traditional kurta pajamaas</li>
            <li>Party suits</li>
            <li>Ethicin Kurtas</li>
            <li>Partyn footwear</li>
            <li>Dhooti Kurta</li>
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
            <li>Woolens Cap</li>
            <li>Air Muf and Mufflers</li>
            <li>Mittens And Booties</li>
            <li>Belts and Suspendors</li>
            <li>Summer Caps</li>
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
            <li>Blankets Quilts</li>
            <li>Wrappers and sandles</li>
            <li>Multi-pack Blanlets</li>
            <li>Sleeping Bags</li>
            
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
