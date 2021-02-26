<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="icon" type="image/png" href="{{ asset('/public/icon/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/frontend/css/style.css') }}">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}

    <title>Product Review</title>
    <style>
        .toastr{
            position : absolute;
            right : 10px;
            top : 65px;
        }
    </style>
  </head>
  <body>
    <div id="ajax-loading-main" class="">
        <div class="d-flex justify-content-center">
            <img style="margin-top: 30vh" src="{{ asset('/public/icon/loading.png') }}" alt="">
        </div>
    </div>
    {{ view('frontend/header') }}
    <?php
        $msg = Session::get('msg');
        $error = Session::get('error');
    ?>
    @if($msg)
        <div class="toastr alert alert-success">
            {{ $msg }}
        </div>
    @endif
    @if($error)
        <div class="toastr alert alert-danger">
            {{ $error }}
        </div>
    @endif
    <span class="toastr"></span>
    <span class="alert-danger"></span>
    <div style="min-height:500px">
        @yield('content')
    </div>
    {{ view('frontend/footer') }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="{{ asset('/public/frontend/js/main.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  <script
            src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
            integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
            crossorigin="anonymous"></script>
    <script>
         $(document).ready(function(){
                setTimeout(() => {
                  $('.toastr').hide();
                  $('.alert-danger').hide();
                }, 4000);
            })
    </script>

  </body>
</html>
