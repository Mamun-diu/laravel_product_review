@extends('frontend/master')

@section('content')
    <div class="container">
        <div class="top-index">
            <div class="category ">
                <div class="main_category ">
                    <ul style="height:400px; background : #ddd;" class="list-group  main_ul">
                        @foreach($cat as $value)
                            <li data-main="{{ $value->id }}" class="list-group-item main_li">{{ $value->main_category }}

                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="sub_category">
                    <ul style="height:400px; background : #ddd;" class="list-group ul sub_ul">

                    </ul>
                </div>

                <div class="tiny_category">
                    <div style="height:400px; background : #ddd;" class="list-group tiny_ul">

                    </div>
                </div>
            </div>
            <div style="height:400px" class="slider">
                <div style="height:400px" id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($product as $key => $value)
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" class="{{ ($key==0)?'active':'' }}"></li>
                        @endforeach
                      {{-- <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li> --}}
                      {{-- <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                      <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
                      <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></li>
                      <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"></li> --}}
                    </ol>
                    <div class="carousel-inner">
                        @foreach($product as $key => $data)
                        <div class="carousel-item {{ ($key==0)?'active':'' }} ">
                            <img src="{{ asset('public/images/') }}/{{ $data->image }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                              <h5 class="mb-n5">{{ $data->name }}</h5>
                            </div>
                        </div>


                        @endforeach

                      {{-- <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          <h5>Second slide label</h5>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                      </div> --}}

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </a>
                  </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        $(document).on("mouseenter",".main_li",function(){
            $(".sub_ul").html('');
            var main_id = $(this).data('main') ;
            // console.log(main_id);

            $.ajax({
                type: "GET",
                url: '{{ URL::to("/get/sub/category/") }}/'+main_id,
                success: function(data){
                    $(".sub_ul").html('');
                    data.forEach(element =>{
                        $(".sub_ul").prepend(
                        '<li data-sub="'+element.id+'" class="list-group-item sub_li">'+element.sub_category+'</li>'
                    );
                    })
                }
            })
        })

        $(document).on("mouseover",".ul .sub_li",function(){
            $(".tiny_ul").html('');
            var sub_id = $(this).data('sub');
            // console.log(sub_id);

            $.ajax({
                type: "GET",
                url: '{{ URL::to("/get/tiny/category/") }}/'+sub_id,
                success: function(data){
                    $(".tiny_ul").html('');
                    data.forEach(element =>{
                        $(".tiny_ul").prepend(
                        '<li data-tiny="'+element.id+'" class="list-group-item sub_li">'+element.tiny_category+'</li>'
                    );
                    })
                }
            })
        })

        $('.tiny_ul').hide();
        $('.sub_ul').hide();
        $(document).on('mouseleave','.category',function(){
            $('.tiny_ul').hide();
            $('.sub_ul').hide();
        })
        $(document).on('mouseover','.main_ul',function(){
            $('.sub_ul').show();
            $('.tiny_ul').hide();
        })
        $(document).on('mouseover','.sub_ul',function(){
            $('.tiny_ul').show();

        })


    })
    </script>
@endsection
