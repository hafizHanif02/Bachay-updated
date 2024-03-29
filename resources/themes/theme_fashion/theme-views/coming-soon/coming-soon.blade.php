<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            background: #B6E0F6;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .mobile-image {
            display: none;
        }

        .image-container {
            text-align: center;
        }

        @media screen and (max-width: 767px) {
            .image-container {
                text-align: center;
            }

            .desktop-image {
                display: none;
            }

            .mobile-image {
                display: block;
            }
        }
    </style>
</head>

<body>
   
    <div class="image-container desktop-image">
        <img src="{{ asset('public/images/fordesktop.jpg') }}" alt="Desktop Image">
    </div>

   
    <div class="image-container mobile-image">
        <img src="{{ asset('public/images/formobile.png') }}" alt="Mobile Image">
    </div>
</body>

</html>
