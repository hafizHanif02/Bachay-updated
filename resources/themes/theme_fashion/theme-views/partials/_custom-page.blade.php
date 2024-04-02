<style>
      .custom-main-container {
      display: flex;
      flex-wrap: wrap;
    }

    .column {
      flex: 0 0 25%; 
    }

    .column a {
      display: block;
      text-align: center;
      text-decoration: none;
      color: #333;
    }

    .column img {
      max-width: 100%;
      height: auto;
      margin-bottom: 5px;
    }

   
</style>

<div class="container">
    <div class="custom-main-container mt-3 mb-2 d-lg-none d-xl-none ">
        @foreach ($custom_pages->take(4) as $custom_page)
        <div class="column">
            <a href="{{ route('custom_page', ['id' => $custom_page->id]) }}">
                <img src="{{ asset('public/assets/images/custom_page/'.$custom_page->image) }}" alt="Image 1">
                
                {{-- <h6 class="font-poppins">{{ $custom_page->title }}</h6> --}}
            </a>
        </div>
    @endforeach
    
        
        
       

    </div>
</div>