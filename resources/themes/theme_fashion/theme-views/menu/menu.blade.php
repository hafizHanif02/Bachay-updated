<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      .acc-header {
        display: flex;
        justify-content: space-between;
      }
      .img-box {
        width: 32% !important;
        background-color: #fff;
    box-shadow: 2px 2px 7px 1px #ccc;
    border-radius: 4px;
      }
      .acc-images img {
        max-width: 100%;
      }
      .img-label {
        text-align: center;
        font-size: 12px;
        color: #424242;
        margin: 6px 0;
      }
      .acc-header{
        margin-bottom: 15px;
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
.scroll-container img{
    margin: 5px;
}
    </style>
  </head>
  <body>
    <div class="acc-wrap">
      <div class="acc-header">
        <div class="img-box" id="img00">
          <div class="acc-images">
            <img src="{{ asset('public/images/f.jpg') }}" alt="Shop By Category" title="Shop By Category" />
          </div>
          <p class="img-label">Shop By Category</p>
        </div>

        <div class="img-box" id="img01">
          <div class="acc-images">
            <img src="{{ asset('public/images/s.jpg') }}" alt="Boutiques" title="Boutiques" />
          </div>
          <p class="img-label">Boutiques</p>
        </div>

        <div class="img-box" id="img02">
          <div class="acc-images">
            <img src="{{ asset('public/images/t.jpg') }}" alt="Parenting" title="Parenting" />
          </div>
          <p class="img-label">Parenting</p>
        </div>
      </div>

      <div class="acc-body-first" id="menulevel200" style="display: none">
        <div class="scroll-container">
            <img src="{{ asset('public/images/1brand.png') }}" alt="" width="80" height="30">
            <img src="{{ asset('public/images/2brand.jpg') }}" alt="" width="80" height="30">
            <img src="{{ asset('public/images/3brand.jpg') }}" alt="" width="80" height="30">
            <img src="{{ asset('public/images/4brand.jpg') }}" alt="" width="80" height="30">
            <img src="{{ asset('public/images/5brand.jpg') }}" alt="" width="80" height="30">
            <img src="{{ asset('public/images/6brand.png') }}" alt="" width="80" height="30">

        </div>
      </div>
      <div class="acc-header">
        <div class="img-box" id="img00">
          <div class="acc-images">
            <img src="{{ asset('public/images/preschool.jpg') }}" alt="Shop By Category" title="Shop By Category" />
          </div>
          <p class="img-label">Pre School</p>
        </div>

        <div class="img-box" id="img01">
          <div class="acc-images">
            <img src="{{ asset('public/images/OfferZone.jpg') }}" alt="Boutiques" title="Boutiques" />
          </div>
          <p class="img-label">Offers</p>
        </div>

        <div class="img-box" id="img02">
          <div class="acc-images">
            <img src="{{ asset('public/images/sellwithus.jpg') }}" alt="Parenting" title="Parenting" />
          </div>
          <p class="img-label">Sell With Us</p>
        </div>
      </div>
      <div class="acc-header">
        <div class="img-box" id="img00">
          <div class="acc-images">
            <img src="{{ asset('public/images/f.jpg') }}" alt="Shop By Category" title="Shop By Category" />
          </div>
          <p class="img-label">Shop By Category</p>
        </div>

        <div class="img-box" id="img01">
          <div class="acc-images">
            <img src="{{ asset('public/images/s.jpg') }}" alt="Boutiques" title="Boutiques" />
          </div>
          <p class="img-label">Boutiques</p>
        </div>

        <div class="img-box" id="img02">
          <div class="acc-images">
            <img src="{{ asset('public/images/t.jpg') }}" alt="Parenting" title="Parenting" />
          </div>
          <p class="img-label">Parenting</p>
        </div>
      </div>
      <div class="acc-header">
        <div class="img-box" id="img00">
          <div class="acc-images">
            <img src="{{ asset('public/images/f.jpg') }}" alt="Shop By Category" title="Shop By Category" />
          </div>
          <p class="img-label">Shop By Category</p>
        </div>

        <div class="img-box" id="img01">
          <div class="acc-images">
            <img src="{{ asset('public/images/s.jpg') }}" alt="Boutiques" title="Boutiques" />
          </div>
          <p class="img-label">Boutiques</p>
        </div>

        <div class="img-box" id="img02">
          <div class="acc-images">
            <img src="{{ asset('public/images/t.jpg') }}" alt="Parenting" title="Parenting" />
          </div>
          <p class="img-label">Parenting</p>
        </div>
      </div>
      
    </div>

    <script>
      document.getElementById("img00").addEventListener("click", function () {
        var menu = document.getElementById("menulevel200");
        if (menu.style.display === "none") {
          menu.style.display = "block";
        } else {
          menu.style.display = "none";
        }
      });
    </script>
  </body>
</html>
 