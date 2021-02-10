@extends('frontend/master')

@section('content')
    <div class="full-width">
        <div class="top-index">
            <div class="inner-top-index">
                <div class="middle-top-index">
                    <h1>Find Your Dream Product</h1>
                    <form class="m-0" action="">
                        <div class="input-group mb-2 search">
                            <input type="text" class="form-control" placeholder="Find Product and Services" >
                            <img draggable="false" src="{{ asset('public/icon/search.png') }}" alt="search">
                            {{-- <a class="input-group-text" id="basic-addon2">@example.com</span> --}}
                            <button type="submit" class="d-none d-sm-block input-group-text">Search</button>
                        </div>
                        <button type="submit" class="d-block d-sm-none w-100 p-2 border-0">Search</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        // $.ajaxSetup({
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //     }
        // })

        // $(document).on("mouseenter",".main_li",function(){
        //     $(".sub_ul").html('');
        //     var main_id = $(this).data('main') ;
        //     // console.log(main_id);

        //     $.ajax({
        //         type: "GET",
        //         url: '{{ URL::to("/get/sub/category/") }}/'+main_id,
        //         success: function(data){
        //             $(".sub_ul").html('');
        //             data.forEach(element =>{
        //                 $(".sub_ul").append(
        //                 '<li data-sub="'+element.id+'" class="list-group-item sub_li">'+element.sub_category+'</li>'
        //             );
        //             })
        //         }
        //     })
        // })

        // $(document).on("mouseover",".ul .sub_li",function(){
        //     $(".tiny_ul").html('');
        //     var sub_id = $(this).data('sub');
        //     // console.log(sub_id);

        //     $.ajax({
        //         type: "GET",
        //         url: '{{ URL::to("/get/tiny/category/") }}/'+sub_id,
        //         success: function(data){
        //             $(".tiny_ul").html('');
        //             data.forEach(element =>{
        //                 $(".tiny_ul").append(
        //                 '<li data-tiny="'+element.id+'" class="list-group-item sub_li">'+element.tiny_category+'</li>'
        //             );
        //             })
        //         }
        //     })
        // })

        // $('.tiny_ul').hide();
        // $('.sub_ul').hide();
        // $(document).on('mouseleave','.category',function(){
        //     $('.tiny_ul').hide();
        //     $('.sub_ul').hide();
        // })
        // $(document).on('mouseover','.main_ul',function(){
        //     $('.sub_ul').show();
        //     $('.tiny_ul').hide();
        // })
        // $(document).on('mouseover','.sub_ul',function(){
        //     $('.tiny_ul').show();

        // })


    })
    </script>
@endsection
