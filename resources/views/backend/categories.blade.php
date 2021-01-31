@extends('backend/master')
@section('content')
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="row categories g-0 m-3 bg-light rounded">
        <div class="main_category col-4">
            <div class="p-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="text-center border-bottom pb-1">Main Category</h3>
                        <form id="main_form" action="{{ URL::to('admin/main/category') }}" method="POST">
                            @csrf
                            <div class="form-group">

                                <input class="form-control mb-2" type="text" name="main_category" placeholder="Enter Main Category">
                            </div>
                            <button id="main_submit" class="btn w-100 btn-primary" type="submit">Save</button>
                        </form>
                    </div>
                  </div>

            </div>
        </div>
        <div class="sub_category col-4">
            <div class="p-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="text-center border-bottom pb-1">Sub Category</h3>
                        <form id="sub_form" action="{{ URL::to('admin/sub/category') }}" method="POST">
                            @csrf
                            <select class="form-select mb-2 sub_main_category_select" name="main_category_id" id="main_category">
                                <option value="0">--Select Main Category--</option>
                                @foreach($main as $data)
                                    <option value="{{ $data->id }}">{{ $data->main_category }}</option>
                                @endforeach

                            </select>
                            <div class="form-group">

                                <input class="form-control mb-2" type="text" name="sub_category" placeholder="Enter Sub Category">
                            </div>
                            <button id="sub_submit" class="btn w-100 btn-success" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tiny_category col-4">
            <div class="p-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="text-center border-bottom pb-1">Tiny Category</h3>
                        <form id="tiny_form" action="{{ URL::to('admin/tiny/category') }}" method="POST">
                            @csrf
                            <select class="form-select mb-2 tiny_main_category_select" name="main_category_id" id="main">
                                <option value="0">--Select Main Category--</option>
                                @foreach($main as $data)
                                    <option value="{{ $data->id }}">{{ $data->main_category }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mb-2 tiny_sub_category_select" name="sub_category_id" id="sub">
                                <option value="0">--Select Sub Category--</option>
                            </select>
                            <div class="form-group">

                                <input class="form-control mb-2" type="text" name="tiny_category" placeholder="Enter Tiny Category">
                            </div>
                            <button class="btn w-100 btn-info" type="submit">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        let main_form = document.getElementById('main_form');
        let main_input = document.querySelector("input[name='main_category']");
        main_form.addEventListener('submit',function(e){
            if(main_input.value.length <= 1){
                main_input.style.border = "2px solid red";
                e.preventDefault();
            }
        })

        let sub_form = document.getElementById('sub_form');
        sub_form.addEventListener('submit',function(e){
            let main = document.querySelector('.sub_main_category_select');
            let sub = document.querySelector("input[name='sub_category']");
            if(main.value==0){
                main.style.border = "2px solid red";
                e.preventDefault();
            }else{
                main.style.border = "1px solid #CED4DA";
            }

            if(sub.value.length <= 1){
                sub.style.border = "2px solid red";
                e.preventDefault();
            }else{
                sub.style.border = "2px solid #CED4DA";
            }
            if(main.value != 0 && sub.value != ''){
                e.preventDefault();
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    $.ajax({
                        type: 'POST',
                        url: '{{ URL::to('admin/sub/category') }}',
                        data: {
                            "main_category_id":main.value,
                            "sub_category":sub.value
                        },
                        success: function(data){
                            $("input[name='sub_category']").val('');
                            $("body").append('<div class="toastr alert alert-success">Sub Category Added</div>');
                            setTimeout(() => {
                                $('.toastr').hide();
                            }, 1000);

                        }
                    })
                })


            }


        })
        let tiny_form = document.getElementById('tiny_form');
        tiny_form.addEventListener('submit',function(e){
            let main = document.querySelector('.tiny_main_category_select');
            let sub = document.querySelector('.tiny_sub_category_select');
            let tiny = document.querySelector("input[name='tiny_category']");


            if(main.value==0){
                main.style.border = "2px solid red";
                e.preventDefault();
            }else{
                main.style.border = "1px solid #CED4DA";
            }
            if(sub.value==0){
                sub.style.border = "2px solid red";
                e.preventDefault();
            }else{
                sub.style.border = "1px solid #CED4DA";
            }

            if(tiny.value.length <= 1){
                tiny.style.border = "2px solid red";
                e.preventDefault();
            }else{
                tiny.style.border = "2px solid #CED4DA";
            }
            if(main.value != 0 && sub.value != '' && tiny.value != ''){
                e.preventDefault();
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    $.ajax({
                        type: 'POST',
                        url: '{{ URL::to('admin/tiny/category') }}',
                        data: {
                            "main_category_id":main.value,
                            "sub_category_id":sub.value,
                            "tiny_category":tiny.value
                        },
                        success: function(data){
                            $("input[name='tiny_category']").val('');
                            $("body").append('<div class="toastr alert alert-success">Tiny Category Added</div>');
                            setTimeout(() => {
                                $('.toastr').hide();
                            }, 1000);

                        }
                    })
                })


            }
        })


    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
            $(document).on('change','#main',function(){
                var val = $(this).val();
                $("#sub").html('<option value="">--Select Sub Category--</option>');

                // console.log(val);

                if(val != ''){
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/sub/")}}/'+val,

                        success: function(data){
                            data.forEach((item) => {
                                $("#sub").append('<option  value="'+item.id+'">'+item.sub_category+'</option>')
                            });
                            // console.log(data);
                        }
                    })
                }

            })
        })

    </script>
@endsection
