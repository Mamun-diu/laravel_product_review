@extends('frontend/master')

@section('content')

   <div class="filter-page">

        <div style="background:#224230;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul class="filter">
                            @foreach($subcat as $sub)
                            <li class="list " data-sub="{{ $sub->id }}" data-filter="{{ substr($sub->sub_category,0,3) }}">{{ $sub->sub_category }}</li>
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
                                        <ul class="list-group collapse tiny-category" id="category">
                                            {{-- <li class="active list-group-item" data-filter="All">All</li>
                                            @foreach($tinycat as $data)
                                            <li style="cursor: pointer;" class="list-group-item">{{ $data->tiny_category }}</li>
                                            @endforeach --}}


                                        </ul>
                                        <li style="border-bottom:2px solid #59811b; font-weight:bold" class="list-group-item" data-bs-toggle="collapse" href="#brand" role="button" aria-expanded="false" aria-controls="brand">Brand</li>
                                        <ul class="list-group collapse" id="brand">


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
                                                   <div class="track"></div>

                                                   
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

                        @include('frontend.filter_product')

                    </div>
                    <input type="hidden" name="sub_id" >
                    <input type="hidden" name="tiny_id" >

                </div>
            </div>
        </div>
   </div>



  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>

   <script>



         $(document).ready(function(){
             var sub_id;
             var tiny_id;
             var brand;
             var newMin;
             var newMax;
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


                $(".ui-slider-handle").on('mousedown mouseup',function(){
                    // console.log($('#amount').attr('min'));
                    newMin = $( "#slider-range" ).slider( "values", 0 );
                    newMax = $( "#slider-range" ).slider( "values", 1 );
                    var priceUrl;
                    if(newMin && newMax && sub_id && tiny_id && brand){
                        priceUrl = '/get/price/sub/tiny/brand/filter';
                    }else if(newMin && sub_id && tiny_id){
                        priceUrl = '/get/price/sub/tiny/filter';
                    }else if(newMin && sub_id && brand){
                        priceUrl = '/get/price/sub/brand/filter';
                    }else if(newMin && sub_id){
                        priceUrl = '/get/price/sub/filter';
                    }else{
                        priceUrl = '/get/price/filter';
                    }
                    $('#ajax-loading-main').addClass('ajax-loading-main');
                    $('#ajax-loading-main img').show();
                    $('body').css('overflow','hidden');
                        $.ajax({
                            type:"GET",
                            url: '{{ URL::to("/")}}'+priceUrl,
                            data:{
                                min : newMin,
                                max : newMax,
                                s_id : sub_id,
                                t_id : tiny_id,
                                brand : brand
                            },
                            success: function(data){
                                $('#ajax-loading-main').removeClass('ajax-loading-main');
                                $('#ajax-loading-main img').hide();
                                $('body').css('overflow-y','auto');

                                $('.product-body-inner').html(data);
                                // console.log(data);


                            }
                        })




                })
                }
                filters();

            $(document).on('click','.pagination a',function(event){
                event.preventDefault();
                $('#ajax-loading-main').addClass('ajax-loading-main')
                $('#ajax-loading-main img').show();
                $('body').css('overflow','hidden');
                var page = $(this).attr('href').split('page=')[1];
                // var sub_id = $('input[name="sub_id"]').val();
                // var tiny_id = $('input[name="tiny_id"]').val();
                if(sub_id && tiny_id && brand){
                    sub_tiny_brand(page,sub_id,tiny_id,brand);
                }
                else if(sub_id && tiny_id){
                    sub_tiny(page,sub_id,tiny_id);
                }else if(sub_id){
                    sub(page,sub_id);
                }
                else{
                    fetch_data(page);
                }

            })
            function fetch_data(page){
                $.ajax({
                    type: "GET",
                    url:"{{ URL::to('/pagination/fetch_product') }}",
                    data:{
                        page: page
                    },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').hide();
                        $('body').css('overflow-y','auto');

                        $('.product-body-inner').html(data);
                    }
                })
            }
            function sub_tiny(page,sub_id,tiny_id){
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('/get/sub-tiny/filter') }}",
                        data: {
                            page : page,
                            s_id : sub_id,
                            t_id : tiny_id
                        },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').hide();
                        $('body').css('overflow-y','auto');

                        $('.product-body-inner').html(data);
                    }
                })
            }
            function sub_tiny_brand(page,sub_id,tiny_id,brand){
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('/get/sub-tiny-brand/filter') }}",
                        data: {
                            page : page,
                            s_id : sub_id,
                            t_id : tiny_id,
                            brand : brand
                        },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').hide();
                        $('body').css('overflow-y','auto');

                        $('.product-body-inner').html(data);
                    }
                })
            }
            function sub(page,sub_id){
                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('get/sub/filter/') }}',
                        data: {
                            page : page,
                            s_id : sub_id
                        },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').hide();
                        $('body').css('overflow-y','auto');

                        $('.product-body-inner').html(data);
                    }
                })
            }

            $('.list').click(function(e){
                tiny_id = '';
                brand = '';
                $('#ajax-loading-main').addClass('ajax-loading-main')
                $('#ajax-loading-main img').show();
                $('body').css('overflow','hidden');
                var id = $(this).data('sub');
                // $('input[name="sub_id"]').val(id);
                 sub_id = id;
                $(e.target).addClass('active');
                $(e.target).siblings().removeClass('active');
                $.ajax({
                    type: 'GET',
                    url: '{{ URL::to('get/sub/filter/') }}',
                    data:{
                        s_id : sub_id
                    },
                    success: function(data){

                        $('.product-body-inner').html(data);
                    }
                })
                $.ajax({
                    type:'GET',
                    url: '{{ URL::to("get/tiny/filter/category") }}',
                    data:{
                        s_id : sub_id
                    },
                    success:function(data){

                        $('.tiny-category').text('');

                        data.forEach(value =>{

                            $('.tiny-category').append(
                                '<li style="cursor: pointer;" class="list-group-item tiny-category-item" data-tiny="'+value.id+'">'+value.tiny_category+'</li>'
                            );

                        })
                    }
                })
                $.ajax({
                    type:'GET',
                    url: '{{ URL::to("get/sub/brand/filter/") }}',
                    data:{
                        s_id : sub_id
                    },
                    success:function(data){

                        $('#brand').text('');

                        data.forEach(value =>{

                            $('#brand').append(
                                '<li style="cursor: pointer;" class="list-group-item  brand-item" data-brand="'+value.brand+'">'+value.brand+'</li>'
                            );

                        })
                    }
                })
                $.ajax({
                    type:'GET',
                    url: '{{ URL::to("get/sub/price/filter/") }}',
                    data:{
                        s_id : sub_id
                    },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').css('display','none');
                        $('body').css('overflow-y','auto');

                        $("#input-left").attr({
                        "max" : data[1],
                        "min" : data[0],
                        "value" : data[0]
                    });
                    $("#input-right").attr({
                        "max" : data[1],
                        "min" : data[0],
                        "value" : data[1]
                    });
                    filters();

                    }
                })
            })
            $(document).on('click','.tiny-category-item',function(e){
                brand='';
                $('#ajax-loading-main').addClass('ajax-loading-main')
                $('#ajax-loading-main img').show();
                $('body').css('overflow','hidden')
                var id = $(e.target).data('tiny');
                $(e.target).addClass('active');
                $(e.target).siblings().removeClass('active');

                tiny_id = $('.tiny-category-item.active').data('tiny');

                if(sub_id  && tiny_id ){
                    $.ajax({
                        type:"GET",
                        url: "{{ URL::to('/get/sub-tiny/filter') }}",
                        data: {
                            s_id : sub_id,
                            t_id : tiny_id
                        },
                        success: function(data){
                            $('.product-body-inner').html(data);


                        }
                    })
                        $.ajax({
                        type:'GET',
                        url: '{{ URL::to("get/tiny/brand/filter/") }}',
                        data:{
                            s_id : sub_id,
                            t_id : tiny_id
                        },
                        success:function(data){
                            $('#brand').text('');

                            data.forEach(value =>{

                                $('#brand').append(
                                    '<li style="cursor: pointer;" class="list-group-item  brand-item" data-brand="'+value.brand+'">'+value.brand+'</li>'
                                );

                            })
                        }
                    })
                    $.ajax({
                    type:'GET',
                    url: '{{ URL::to("get/sub-tiny/price/filter/") }}',
                    data:{
                        s_id : sub_id,
                        t_id : tiny_id
                    },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').css('display','none');
                        $('body').css('overflow-y','auto');


                        $("#input-left").attr({
                        "max" : data[1],
                        "min" : data[0],
                        "value" : data[0]
                        });
                        $("#input-right").attr({
                            "max" : data[1],
                            "min" : data[0],
                            "value" : data[1]
                        });
                        filters();

                    }
                    })
                }
            })

            $(document).on('click','.brand-item',function(e){
                $('#ajax-loading-main').addClass('ajax-loading-main')
                $('#ajax-loading-main img').show();
                $('body').css('overflow','hidden')
                $(e.target).addClass('active');
                $(e.target).siblings().removeClass('active');
                brand = $('#brand .brand-item.active').data('brand');
                if(brand){
                    $.ajax({
                        type:"GET",
                        url: (sub_id && tiny_id)? "{{ URL::to('/get/sub-tiny/brand/product') }}" : "{{ URL::to('/get/brand/product') }}",
                        data:{
                            brand : brand,
                            s_id : sub_id,
                            t_id : tiny_id
                        },
                        success: function(data){
                            $('#ajax-loading-main').removeClass('ajax-loading-main')
                            $('#ajax-loading-main img').hide();
                            $('body').css('overflow-y','auto')
                            $('.product-body-inner').html(data);

                        }
                    })
                    $.ajax({
                    type:'GET',
                    url: (sub_id && tiny_id)? "{{ URL::to('get/sub-tiny-brand/price/filter/') }}" : "{{ URL::to('get/sub-brand/price/filter/') }}",

                    data:{
                        brand : brand,
                        s_id : sub_id,
                        t_id : tiny_id
                    },
                    success:function(data){
                        $('#ajax-loading-main').removeClass('ajax-loading-main')
                        $('#ajax-loading-main img').css('display','none');
                        $('body').css('overflow-y','auto');


                        $("#input-left").attr({
                        "max" : data[1],
                        "min" : data[0],
                        "value" : data[0]
                        });
                        $("#input-right").attr({
                            "max" : data[1],
                            "min" : data[0],
                            "value" : data[1]
                        });
                        filters();

                    }
                    })
                }

            })

        })



   </script>
@endsection
