<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
   <style>
    .coming-soon img{
      width: 500px;
      
    }
    body{
      background: #B6E0F6;
    }
    .coming-soon{
      display: flex;
      justify-content: center;
      align-items: center;
    }
    @media (max-width: 768px){
      .coming-soon img{
      width: 100%;
      
    }
    }
   </style>
  </head>
  <body>
   <div class="coming-soon">

     <img src="{{ asset('public/images/coming-soon1.jpg') }}" alt="">
   </div>
   
  </body>
</html>
 