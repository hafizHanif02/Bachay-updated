<style>
      .custom-main-container {
      display: flex;
      flex-wrap: wrap;
    }

    .column {
      flex: 0 0 20%; 
    }

    .column a {
      display: block;
      text-align: center;
      text-decoration: none;
      color: #333;
    }

    .column img {
      max-width: 100%;
      height: 90px;
      margin-bottom: 5px;
    }

   
</style>
{{-- {{ dd($custom_pages) }} --}}
<div class="container">
    <div class="custom-main-container mt-2 mb-2 d-lg-none d-xl-none ">
        @foreach ($custom_pages as $custom_page)
        <div class="column">
          <a href="{{ route('custom_page') }}">
            <img src="{{ asset('public/assets/images/custom_page/'.$custom_page->image) }}" alt="Image 1">

            {{-- <h6 class="font-poppins">{{ $custom_page->title }}</h6> --}}
          </a>
        </div>
        @endforeach
        
        
       

    </div>
</div>