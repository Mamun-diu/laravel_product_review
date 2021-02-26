@extends('frontend/master')

@section('content')
    <div class="full-width" >
        <div class="top-index particles-js" id="particles-js">
            <div class="inner-top-index ">
                <div class="middle-top-index">
                    <h1>Find Your Dream Product</h1>
                    <form class="m-0 searchDiv" action="{{ URL::to('/search/result') }}" method="get">
                        @csrf
                        <div class="input-group mb-2 search body-search">
                            <input type="text" class="form-control" name='search' autocomplete="off" placeholder="Find Product and Services" >
                            <img draggable="false" src="{{ asset('public/icon/search.png') }}" alt="search">
                            <img class="search-loading" draggable="false" src="{{ asset('public/icon/loading.png') }}" alt="search">
                            {{-- <a class="input-group-text" id="basic-addon2">@example.com</span> --}}
                            <button type="submit" class="d-none d-sm-block input-group-text">Search</button>
                        </div>
                        <button type="submit" class="d-block d-sm-none w-100 p-2 border-0">Search</button>
                    </form>
                    <div class="searchResult rounded shadow">
                        <ul>

                        </ul>
                        <span class="close"><i class="fas fa-window-close fa-2x"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-body-full p-3 ">
        <div class="top-rated">
            <div class="container">
                <div class="row">
                    <h2 class="display-4 text-center text-muted">Top Rated</h2>
                    <div class="product-body-inner-rate p-2">
                        <div class="owlCarousel owl-carousel d-flex justify-content-center align-items-center">
                            @foreach($top_rated as $item)
                            <a href="{{  URL::to('/product/info') }}/{{ $item->product->id }} " class="text-decoration-none">
                                <div class="card product-index m-1 shadow" style="position: relative;">
                                    <img height="250px" src="{{ asset('public/images/') }}/{{ $item->product->image }}" class="card-img-top" alt="image">
                                    <div class="card-body">
                                    <h5 class="text-primary fw-bold">{{  substr($item->product->name, 0, 25) }} {{(strlen($item->product->name) >25)?'....':''}}</h5>

                                    <p>Price : {{ $item->price['price'] }}tk &nbsp; </p>
                                    </div>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div style="position: absolute; top:0;right:0">
                                        <h4 style="background : blue; padding:5px 10px;color:white;"> {{ substr($item->avg,0,3) }} <i class="fas fa-star"></i></h4>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-rated">
            <div class="container">
                <div class="row">
                    <h2 class="display-4 text-center text-muted mt-5">High Choice</h2>
                    <div class="product-body-inner-rate p-2">
                        <div class="owlCarousel owl-carousel d-flex justify-content-center align-items-center">
                            @foreach($fav as $item)
                            <a href="{{  URL::to('/product/info') }}/{{ $item->product->id }} " class="text-decoration-none">
                                <div class="card product-index m-1 shadow" style="position: relative;">
                                    <img height="250px" src="{{ asset('public/images/') }}/{{ $item->product->image }}" class="card-img-top" alt="image">
                                    <div class="card-body">
                                    <h5 class="text-primary fw-bold">{{  substr($item->product->name, 0, 25) }} {{(strlen($item->product->name) >25)?'....':''}}</h5>

                                    <p>Price : {{ $item->price['price'] }}tk </p>
                                    </div>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div style="position: absolute; top:0;right:0">
                                        <h4 style="background : rgb(255, 102, 0); padding:5px 10px;color:white;"><i class="fas fa-heart"></i> {{ $item->count }} </h4>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <h2 class="display-4 text-center text-muted mt-4">New Item</h2>
            @include('frontend.new-item')

        </div>
    </div>

    <script src="{{ asset('/public/frontend/js/particles.js') }}"></script>
    <script src="{{ asset('/public/frontend/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })
        $(document).on('click','.pagination a',function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#ajax-loading-main').addClass('ajax-loading-main');
            $('#ajax-loading-main img').show();
            $('body').css('overflow','hidden');
            fetch_data(page);

        })
        function fetch_data(page){
            $.ajax({
                type: "GET",
                url:"{{ URL::to('/pagination/fetch_data') }}",
                data:{
                    page: page
                },
                success:function(data){
                    $('#ajax-loading-main').removeClass('ajax-loading-main');
                    $('#ajax-loading-main img').hide();
                    $('body').css('overflow-y','auto');

                    $('.product-body-inner').html(data);
                }
             })
        }





        $('.owl-carousel').owlCarousel({
            loop:true,
            // margin:10,
            nav:true,
            autoplay:true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1
                },
                300:{
                    items:2
                },
                440:{
                    items:3
                },
                576:{
                    items:3
                },
                768:{
                    items:3
                },
                992:{
                    items:4
                },
                1200:{
                    items:5
                }
            }
        })
        // $("#product-slider").owlCarousel({
        //     items:4,
        //     itemsDesktop:[1199,2],
        //     itemsDesktopSmall:[980,2],
        //     itemsMobile:[700,1],
        //     pagination:false,
        //     navigation:true,
        //     navigationText:["",""],
        //     autoPlay:true
        // })



        $(".body-search input[name='search']").keyup(function(){
            var search = $(this).val();
            $('.search img.search-loading').show();
            if(search != ''){
                $.ajax({
                type: "GET",
                url: "{{ URL::to('/product/search/') }}/"+search,
                success: function(data){
                    $('.search img.search-loading').hide();
                    $('.searchResult').show();
                    $('.searchResult ul').html('');
                        data.forEach(value => {
                            // console.log(value);

                            $('.searchResult ul').append(
                            '<li class="p-1"><a href="{{  URL::to('/product/info/') }}/'+value.id+'">'+value.name+'</a></li>'
                            );
                        });
                }
            })
            }
        })

        $(document).on('click','.searchResult ul li, .searchResult .close', function(){
            var product = $(this).text();
            $('input[name="search"]').val(product);
            $('.searchResult ul').html('');
            $('.searchResult').hide();
        })
    })
</script>
@endsection
