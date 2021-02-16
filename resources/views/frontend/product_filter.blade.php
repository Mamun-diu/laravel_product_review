@extends('frontend/master')

@section('content')

   <div class="filter-page">

        <div style="background:#224230;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="filter">
                            <li class="list active" data-filter="All">All</li>
                            @foreach($subcat as $sub)
                            <li class="list " data-filter="{{ substr($sub->sub_category,0,3) }}">{{ $sub->sub_category }}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="container">
                <div class="row mt-2">
                    <div class="col-12 col-lg-4 col-xl-3">
                        <div class="border">
                            <ul class="list-group">
                                <li style="background : #A6CE39;color : #fff; font-weight: bold;text-transform: uppercase; " class="list-group-item" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-shopping-cart me-2"></i>Filter by</li>
                                    <div class="collapse show" id="collapseExample">
                                        <li style="border-bottom:2px solid #59811b; font-weight:bold" class="list-group-item" data-bs-toggle="collapse" href="#category" role="button" aria-expanded="false" aria-controls="category">Category</li>
                                        <ul class="list-group collapse" id="category">
                                            <li class="itembox tiny active list-group-item" data-filter="All">All</li>
                                            @foreach($tinycat as $data)
                                            <li style="cursor: pointer;" class="itembox list-group-item tiny {{ substr($data->subCategory->sub_category,0,3) }} " data-filter="{{ substr($data->tiny_category,0,3) }}">{{ $data->tiny_category }}</li>
                                            @endforeach


                                        </ul>
                                        <li style="border-bottom:2px solid #59811b; font-weight:bold" class="list-group-item" data-bs-toggle="collapse" href="#brand" role="button" aria-expanded="false" aria-controls="brand">Brand</li>
                                        <ul class="list-group collapse" id="brand">
                                            <?php $brands = 'none';?>
                                            @foreach($product as $value)
                                                @if($value->brand != $brands)
                                                    <?php $brands = $value->brand;?>
                                                    <li style="cursor: pointer" class="list-group-item brand itembox tinybox {{ substr($value->tiny->tiny_category,0,3) }} {{ substr($value->sub->sub_category,0,3) }}" data-filter="{{ $value->brand }}">{{ $value->brand }}</li>
                                                @endif

                                            @endforeach

                                            {{-- <li class="list-group-item">Dell</li>
                                            <li class="list-group-item">Asus</li>
                                            <li class="list-group-item">Acer</li>
                                            <li class="list-group-item">Lenovo</li>
                                            <li class="list-group-item">Apple</li> --}}
                                        </ul>
                                        <li style="border-bottom:2px solid #59811b; font-weight:bold" class="list-group-item" data-bs-toggle="collapse" href="#priceFilter" role="button" aria-expanded="false" aria-controls="priceFilter">Price</li>
                                        <div class="middle collapse" id="priceFilter">
                                            <div style="height  : 70px;padding-top : 5px;" class="multi-range-slider">
                                                 <input type="range" id="input-left" min="{{ $minNumber }}" max="{{ $maxNumber }}" value="{{ $minNumber }}">
                                                <input type="range" id="input-right" min="{{ $minNumber }}" max="{{ $maxNumber }}" value="{{ $maxNumber }}">
                                               {{-- <div class="slider">
                                                    <div class="track"></div>
                                                    <div class="range"></div>
                                                    <div class="thumb left">
                                                        <div class="show-left-filter-price">{{ $minNumber }}</div>
                                                        <div class="show-left-filter-price-connection"></div>
                                                    </div>
                                                    <div class="thumb right">
                                                        <div class="show-right-filter-price">{{ $maxNumber }}</div>
                                                        <div class="show-right-filter-price-connection"></div>
                                                    </div>
                                                </div> --}}
                                                <p class="d-flex justify-content-start align-items-center">
                                                    <label class="" for="amount">Price: </label>
                                                    <input  type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold; width : 200px">
                                                  </p>
                                                   
                                                  <div id="slider-range"></div>

                                            </div>
                                        </div>
                                    </div>

                              </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="product-body-inner p-2 d-flex flex-wrap justify-content-center">
                            @foreach($product as $item)
                            <a href="{{  URL::to('/product/info') }}/{{ $item->id }} " class="product itembox brandbox {{ substr($item->tiny->tiny_category,0,3) }} tinybox {{ substr($item->sub->sub_category,0,3) }} text-decoration-none {{ $item->brand }}">
                                <div class="card product-index m-1 shadow" style="min-width : 170px">
                                    <img height="250px" src="{{ asset('public/images/') }}/{{ $item->image }}" class="card-img-top" alt="image">
                                    <div class="card-body">
                                      <h5 class="text-primary fw-bold">{{  substr($item->name, 0, 30) }} {{(strlen($item->name) >30)?'....':''}}</h5>

                                      <p class="d-inline">Price : <p class="product-price d-inline">{{ $item->price->price }}</p> tk</p>
                                    </div>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
   </div>



  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
 
   <script>

    

         $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
            function filters(){
            
                let mins = $('#input-left').val();
                let maxs = $('#input-right').val();
                // console.log(mins,maxs);
                
                $( "#slider-range" ).slider({
                    range: true,
                    min:  parseInt(mins),
                    max: parseInt(maxs),
                    values: [ parseInt(mins), parseInt(maxs) ],
                    slide: function( event, ui ) {
                    $( "#amount" ).val(  ui.values[ 0 ] + "tk - " + ui.values[ 1 ]+"tk" );
                    }
                });
                $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) + 
                    "tk - " + $( "#slider-range" ).slider( "values", 1 ) +"tk" );
        
                
                $(".ui-slider-handle").on('mousedown mouseup mouseout',function(){
                    // console.log($('#amount').attr('min'));
                    let newMin = $( "#slider-range" ).slider( "values", 0 );
                    let newMax = $( "#slider-range" ).slider( "values", 1 );
                    $('.product-price').each(function(){
                    let p = $(this).closest('.itembox');
                    let price = $(this).text();
                    if(price >=newMin && price <=newMax){
                        p.show(1000);
                    }else{
                        p.hide(1000);
                    }
        
                })
                })
            }
            filters();
            //price filter
            // $('#input-left,#input-right').on('input',function(){
            //     let min = $('#input-left').val();
            //     let max = $('#input-right').val();
            //     $('.show-left-filter-price').text($('#input-left').val());
            //     $('.show-right-filter-price').text($('#input-right').val());

            //     $('.product-price').each(function(){
            //         let p = $(this).closest('.itembox');
            //         let price = $(this).text();
            //         if(price >min && price <max){
            //             p.show(1000);
            //         }else{
            //             p.hide(1000);
            //         }

            //     })

            // })
            //  website filter
            $('.list').click(function(){
                const value = $(this).attr('data-filter');
                if(value == 'All'){
                $('.itembox').show('1000');
                }else{
                $('.itembox').not('.'+value).hide('1000');
                $('.itembox').filter('.'+value).show('1000');
                }
                setTimeout(() => {
                    var priceArray = [];
                    var max;
                    var min;
                    $('.product').each(function(){
                    var display =  $(this).css("display");
                    if(display!="none")
                    {
                        priceArray.push( $(this).find('.product-price').text());
                        
                    }
                    })
                    max = Math.max(...priceArray);
                    min = Math.min(...priceArray);
                    
                    $("#input-left").attr({
                        "max" : max,
                        "min" : min,
                        "value" : min
                    });
                    $("#input-right").attr({
                        "max" : max,
                        "min" : min,
                        "value" : max
                    });
                    filters();
                }, 1010);
            })
            $('.list').click(function(){
                $(this).addClass('active');
                $(this).siblings().removeClass('active')
            })

            $('.tiny').click(function(){
                const value = $(this).attr('data-filter');
                if(value == 'All'){
                $('.tinybox').show('1000');
                }else{
                $('.tinybox').not('.'+value).hide('1000');
                $('.tinybox').filter('.'+value).show('1000');
                }
                setTimeout(() => {
                    var priceArray = [];
                    var max;
                    var min;
                    $('.product').each(function(){
                    var display =  $(this).css("display");
                    if(display!="none")
                    {
                        priceArray.push( $(this).find('.product-price').text());
                        
                    }
                    })
                    max = Math.max(...priceArray);
                    min = Math.min(...priceArray);
                    
                    $("#input-left").attr({
                        "max" : max,
                        "min" : min,
                        "value" : min
                    });
                    $("#input-right").attr({
                        "max" : max,
                        "min" : min,
                        "value" : max
                    });
                    filters();
                }, 1010);
            })
            $('.tiny').click(function(){
                $(this).addClass('active');
                $(this).siblings().removeClass('active')
            })

            $('.brand').click(function(){
                
                const value = $(this).attr('data-filter');
                if(value == 'All'){
                $('.brandbox').show('1000');
                }else{
                $('.brandbox').not('.'+value).hide('1000');
                $('.brandbox').filter('.'+value).show('1000');
                }
                setTimeout(() => {
                    var priceArray = [];
                    var max;
                    var min;
                    $('.product').each(function(){
                    var display =  $(this).css("display");
                    if(display!="none")
                    {
                        priceArray.push( $(this).find('.product-price').text());
                        
                    }
                    })
                    max = Math.max(...priceArray);
                    min = Math.min(...priceArray);
                    
                    $("#input-left").attr({
                        "max" : max,
                        "min" : min,
                        "value" : min
                    });
                    $("#input-right").attr({
                        "max" : max,
                        "min" : min,
                        "value" : max
                    });
                    filters();
                }, 1010);
                
            })
            $('.brand').click(function(){
                $(this).addClass('active');
                $(this).siblings().removeClass('active')
            })


           {{--  $(document).on('click','.add-to-favourite-btn',function(){
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
                }) --}}



            })



   </script>
@endsection
