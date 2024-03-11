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

<div class="container">
    <div class="custom-main-container mt-2 mb-2 d-md-none d-lg-none d-xl-none ">
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/custom-page1.webp') }}" alt="Image 1">

            {{-- <h3>Heading 1</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/custom-page2.webp') }}" alt="Image 1">
    
            {{-- <h3>Heading 2</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/custom-page3.webp') }}" alt="Image 1">
    
            {{-- <h3>Heading 3</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/custom-page4.webp') }}" alt="Image 1">
    
            {{-- <h3>Heading 4</h3> --}}
          </a>
        </div>
        <div class="column">
          <a href="#">
            <img src="{{ asset('public/images/custom-page5.webp') }}" alt="Image 1">
    
            {{-- <h3>Heading 5</h3> --}}
          </a>
        </div>
        
       

    </div>
  </div>