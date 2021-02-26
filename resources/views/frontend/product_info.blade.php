@extends('frontend/master')

@section('content')
<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
   <div class="p-info">
        <div class="border-bottom">
            {{-- <div class="container">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb m-0 mt-2 p-1">
                      <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="#">Laptop</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Notebook</li>
                    </ol>
                </nav>
            </div> --}}
        </div>
        <div class="container my-2">
            <div class="row">
                <div style="position : relative;" class="col-md-4  border">
                    <img width="100%" src="{{ asset('public/images/') }}/{{ $product->image }}" alt="">
                    <p style="background : rgb(119, 8, 245);color : #eee; margin-bottom : 0; padding:5px 10px;display: inline-block;position : absolute;right : 0;top : 0;">{{ $product->brand }}</p>
                </div>
                <div class="offset-lg-1 col-md-6">
                    <h4 class="text-secondary lh-base">{{ $product->name }}</h4>

                    <div class="product-rating mt-3 mb-1 d-flex ">
                        <?php $mod = (double)$rating-(int)$rating; ?>
                        @for($i = 1; $i <= 5; $i++)

                            @if($rating>=$i)
                                <i class="fas fa-star fa-2x text-primary"></i>
                            @elseif($mod>=0.5)
                                <i class="fas fa-star-half-alt fa-2x text-primary"></i>
                                <?php $mod = 0; ?>
                            @else
                            <i class="fas fa-star fa-2x text-secondary"></i>
                            @endif
                        @endfor

                        <h3 class="rating-count">({{ $rating_count }})</h3>
                    </div>
                    <div class="d-flex justify-content-left mt-n2 align-items-center mb-2">
                        <i class="fas fa-heart fa-2x me-2 mt-n1 text-primary"></i><h2 class=""> (<span>{{ $fav_count }}</span>)</h2>
                    </div>
                    <div class="favourite">
                        @if(Session::has('user'))
                            @if($favourite)
                                <button class="remove-from-favourite-btn btn btn-danger  d-flex justify-content-center align-items-center"><i class="fas fa-heart me-3"></i>Remove from favourite</button>
                            @else
                                <button class="add-to-favourite-btn btn btn-primary  d-flex justify-content-center align-items-center"><i class="fas fa-heart me-3"></i>Add to favourite</button>
                            @endif
                        @else
                        <button  type="button" class=" btn btn-primary  d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#favouriteModal"><i class="fas fa-heart me-3"></i>
                            Add to Favourite
                        </button>
                        @endif


                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-md-6">

                    <div class="review rounded mb-3" style="background : #eee">
                        <p class="lead p-3 border-bottom text-success">Your Review</p>
                        <div class="container p-3 pt-1">
                            <form id="rating-form" action="{{ URL::to('user/store/rating') }}" method="post" >
                                @csrf
                                <div class="review-rating mb-3">

                                    {{-- <input type="hidden" name="user_id" value="{{ (Session::has('user'))?Session::get('user')['id']:'' }}"> --}}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <label class="r" for="rating1"><i  class="rating-1 fas fa-star fa-2x text-secondary"></i></label>
                                    <input  id="rating1" type="radio" value='1' name="rating" checked>
                                    <label class="r" for="rating2"><i  class="rating-2 fas fa-star fa-2x text-secondary"></i></label>
                                    <input id="rating2" type="radio" value='2' name="rating">
                                    <label class="r" for="rating3"><i  class="rating-3 fas fa-star fa-2x text-secondary"></i></label>
                                    <input id="rating3" type="radio" value='3' name="rating">
                                    <label class="r" for="rating4"><i  class="rating-4 fas fa-star fa-2x text-secondary"></i></label>
                                    <input id="rating4" type="radio" value='4' name="rating">
                                    <label class="r" for="rating5"><i  class="rating-5 fas fa-star fa-2x text-secondary"></i></label>
                                    <input id="rating5" type="radio" value='5' name="rating">
                                    {{-- <i  class="rating-2 fas fa-star fa-2x text-secondary"></i>
                                    <i  class="rating-3 fas fa-star fa-2x text-secondary"></i>
                                    <i  class="rating-4 fas fa-star fa-2x text-secondary"></i>
                                    <i  class="rating-5 fas fa-star fa-2x text-secondary"></i> --}}
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Your Name</label>
                                    <input class="form-control" name='name' type="text">
                                    <small style="display: none" class="name-field text-danger"></small>
                                </div>
                                <div class="form-group my-3">
                                    <label for="">Enter Your Review</label>
                                    <textarea class="form-control" name="review" id=""></textarea>
                                    <small style="display: none" class="review-field text-danger"></small>
                                </div>
                                @if(Session::has('user'))
                                <button type="submit" class="btn btn-info w-100">Submit</button>
                                @else
                                    <!-- Button trigger modal -->
                                    <button id="instant-login" type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Submit
                                    </button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="price ">
                        <table class="table table-striped ">
                            <tr>
                                <th>Web Name</th>
                                <th>Price</th>
                                <th>Link</th>
                            </tr>

                            @foreach($price as $taka)
                            <tr>
                                <td>{{ $taka->website_name }}</td>
                                <td>{{ $taka->price }}</td>
                                <td><a class="btn btn-sm btn-primary" target="_blank" href="{{ $taka->link }}">View</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-lg-6">
                    <h2 class="text-center bg-secondary text-light p-2">Product Specification</h2>
                    <div style="overflow: scroll">
                        <div style="width : 1200px">
                            <?php echo $product->details;?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" style="background : #eee">
                    <h2 class="text-center bg-secondary text-light p-2">See All Review</h2>
                    @if($review != '[]')
                        {{-- {{ $review }} --}}
                        @foreach($review as $data)
                        <div class="all-review bg-white rounded m-2 p-2">
                            <div class="border-bottom mb-2">
                                <h4 class="d-inline-block me-3">{{ $data->user->fname }} {{ $data->user->lname }}</h4>
                                <span class="text-danger">{{ time_elapsed_string($data->created_at) }}</span>
                            </div>

                            <p class="lead text-secondary">{{ $data->comment }}</p>
                        </div>
                        @endforeach
                    @else
                    <div class="all-review bg-white rounded m-2 p-2">
                        <h4>Sorry!</h4>
                        <p class="lead text-secondary">No review available</p>
                    </div>
                    @endif

                </div>

            </div>
        </div>
   </div>

<!-- Favourite Modal -->
<div class="modal fade" id="favouriteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User Login Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/login/favourite') }}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="favourite_product_id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control mt-1" name="email" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control mt-1" name="password" placeholder="Enter Password...">
                </div>

            </div>
            <div class="modal-footer">
                <a style=""  href="{{ URL::to('/user/registration') }}">I have no account</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Login</button>

            </div>
        </form>

      </div>
    </div>
  </div>

  <!-- Review Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User Login Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ URL::to('/user/login/instant') }}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="instant_product_id" value="{{ $product->id }}">
                <input type="hidden" name="instant_name" value="">
                <input type="hidden" name="instant_review" value="">
                <input type="hidden" name="instant_rating" value="">
                <div class="form-group">
                    <label for="emailR">Email</label>
                    <input id="emailR" type="email" class="form-control mt-1" name="email" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                    <label for="passwordR">Password</label>
                    <input id="passwordR" type="password" class="form-control mt-1" name="password" placeholder="Enter Password...">
                </div>

            </div>
            <div class="modal-footer">
            <a style=""  href="{{ URL::to('/user/registration') }}">I have no account</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script>

        @if(!(Session::has('user')))
            let instantLoginBtn = document.querySelector('button#instant-login');
            // console.log(instantLoginBtn);

            instantLoginBtn.addEventListener('click',function(){
                let name = document.querySelector("input[name='name']").value;
                let review = document.querySelector("textarea[name='review']").value;
                let rating;
                if(document.querySelector("#rating1").checked){
                    rating = 1;
                }else if(document.querySelector("#rating2").checked){
                    rating = 2;
                }
                else if(document.querySelector("#rating3").checked){
                    rating = 3;
                }
                else if(document.querySelector("#rating4").checked){
                    rating = 4;
                }
                else if(document.querySelector("#rating5").checked){
                    rating = 5;
                }
                document.querySelector("input[name='instant_name']").value=name;
                document.querySelector("input[name='instant_review']").value=review;
                document.querySelector("input[name='instant_rating']").value=rating;
                // console.log(name,review, rating);

            })
        @endif

       let form = document.querySelector('form#rating-form');
       form.addEventListener('submit',function(e){
            if(document.querySelector("input[name='name']").value==''){
                let name = document.querySelector('.name-field');
                name.style.display = 'block';
                name.innerHTML = 'Name field is required';
                e.preventDefault();
            }
            if(document.querySelector("textarea[name='review']").value==''){
                e.preventDefault();
                let review = document.querySelector('.review-field');
                review.style.display = 'block';
                review.innerHTML = 'Review field is required';

            }
            // console.log(document.querySelector("input[name='rating']").checked.value);
       })


       let rating1 = document.querySelector('.rating-1');
       let rating2 = document.querySelector('.rating-2');
       let rating3 = document.querySelector('.rating-3');
       let rating4 = document.querySelector('.rating-4');
       let rating5 = document.querySelector('.rating-5');

       rating1.addEventListener('click',function(){
           rating1.style.setProperty("color", "blue", "important");
           rating2.style.setProperty("color", "#6C757D", "important");
           rating3.style.setProperty("color", "#6C757D", "important");
           rating4.style.setProperty("color", "#6C757D", "important");
           rating5.style.setProperty("color", "#6C757D", "important");
       })
       rating2.addEventListener('click',function(){
            rating1.style.setProperty("color", "blue", "important");
            rating2.style.setProperty("color", "blue", "important");
            rating3.style.setProperty("color", "#6C757D", "important");
            rating4.style.setProperty("color", "#6C757D", "important");
            rating5.style.setProperty("color", "#6C757D", "important");
       })
       rating3.addEventListener('click',function(){
            rating1.style.setProperty("color", "blue", "important");
            rating2.style.setProperty("color", "blue", "important");
            rating3.style.setProperty("color", "blue", "important");
            rating4.style.setProperty("color", "#6C757D", "important");
            rating5.style.setProperty("color", "#6C757D", "important");
       })
       rating4.addEventListener('click',function(){
            rating1.style.setProperty("color", "blue", "important");
            rating2.style.setProperty("color", "blue", "important");
            rating3.style.setProperty("color", "blue", "important");
            rating4.style.setProperty("color", "blue", "important");
            rating5.style.setProperty("color", "#6C757D", "important");
       })
       rating5.addEventListener('click',function(){
            rating1.style.setProperty("color", "blue", "important");
            rating2.style.setProperty("color", "blue", "important");
            rating3.style.setProperty("color", "blue", "important");
            rating4.style.setProperty("color", "blue", "important");
            rating5.style.setProperty("color", "blue", "important");
       })


       $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
            $(document).on('click','.add-to-favourite-btn',function(){
                let product_id = {{ $product->id }}
                let add = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('user/add/favourite') }}',
                    data: {
                        "product_id":product_id

                    },
                    success: function(data){
                        $('.favourite').empty();
                        $('.favourite').append('<button class="remove-from-favourite-btn btn btn-danger  d-flex justify-content-center align-items-center"><i class="fas fa-heart me-3"></i>Remove from favourite</button>');
                        var fav = $('div.d-flex.justify-content-left.mt-n2.align-items-center.mb-2 > h2 span').text();
                        $('div.d-flex.justify-content-left.mt-n2.align-items-center.mb-2 > h2 span').text(parseInt(fav)+1);

                        // $("input[name='sub_category']").val('');
                        // $("body").append('<div class="toastr alert alert-success">Sub Category Added</div>');
                        // setTimeout(() => {
                        //     $('.toastr').hide();
                        // }, 1000);

                    }
                    // ,
                    // error: function (data) {
                    //     if(data.status===422){
                    //         $("input[name='sub_category']").val('');
                    //         console.log('something wrong');

                    //     }

                    // }
                    })
                })

                $(document).on('click','.remove-from-favourite-btn',function(){
                let product_id = {{ $product->id }}

                $.ajax({
                    type: 'DELETE',
                    url: '{{ URL::to('user/remove/favourite/') }}/'+product_id,
                    data:{
                        _token : $("input[name=_token]").val()
                    },

                    success: function(data){
                        $('.favourite').empty();
                        $('.favourite').append('<button class="add-to-favourite-btn btn btn-primary  d-flex justify-content-center align-items-center"><i class="fas fa-heart me-3"></i>Add to favourite</button>');
                        var fav = $('div.d-flex.justify-content-left.mt-n2.align-items-center.mb-2 > h2 span').text();
                        $('div.d-flex.justify-content-left.mt-n2.align-items-center.mb-2 > h2 span').text(parseInt(fav)-1);
                        // $("input[name='sub_category']").val('');
                        // $("body").append('<div class="toastr alert alert-success">Sub Category Added</div>');
                        // setTimeout(() => {
                        //     $('.toastr').hide();
                        // }, 1000);

                    }
                    // ,
                    // error: function (data) {
                    //     if(data.status===422){
                    //         $("input[name='sub_category']").val('');
                    //         console.log('something wrong');

                    //     }

                    // }
                    })
                })

            })



   </script>
@endsection
