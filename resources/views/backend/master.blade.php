<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" type="image/png" href="{{ asset('/public/icon/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('/public/backend/css/style.css') }}">
    <title>Product Review</title>
    <style>
        *{
            box-sizing: border-box !important;
        }
        .toastr{
            position : absolute;
            top : 60px;
            right : 10px;
            z-index: 1000;
        }
    </style>
  </head>
  <body>

    {{ view('backend/header') }}
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
    <div style="background: #F0F1F2; min-height: 500px" class="row g-0">
        <div class="col-2">
            {{ view('backend/sidebar') }}
        </div>
        <div class="col-10">
            @yield('content')
        </div>
    </div>

    {{ view('backend/footer') }}
    <script src="https://cdn.tiny.cloud/1/fmn821cfv3tm188c335yb6101el1wm9x3vp4yfkocnbtgwjy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('/public/backend/js/main.js') }}"></script>
    <script>
        tinymce.init({
          selector: '#mytextarea'
        });

        setTimeout(() => {
            document.querySelector('.toastr').style.display = 'none';
        }, 25000);
      </script>

  </body>
</html>
