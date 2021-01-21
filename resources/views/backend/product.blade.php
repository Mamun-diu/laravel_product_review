@extends('backend/master')
@section('content')

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif
<form id="form" action="{{ URL::to('admin/product/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-0 m-3 bg-light rounded">

        <div class=" col-4">
            <div class="p-2">
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <h3 class="text-center border-bottom pb-1">Select Category</h3>


                        <select class="form-select mb-2 main_category_select" name="main_category_id">
                            <option value="0">--Select Main Category--</option>
                            @foreach($main as $data)
                                <option value="{{ $data->id }}">{{ $data->main_category }}</option>
                            @endforeach
                        </select>
                        <select class=" form-select mb-2 sub_category_select" name="sub_category_id">
                            <option value="0">--Select Sub Category--</option>
                        </select>
                        <select class=" form-select mb-2 tiny_category_select" name="tiny_category_id">
                            <option value="0">--Select Tiny Category--</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 p-2">
            <div class="form-group">
                <input class="form-control mb-2" type="text" name="name" placeholder="Enter Product Name">
            </div>
            <div class="form-group">
                <input class="form-control mb-2" type="text" name="product_model" placeholder="Enter Product Model">
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control required">
            </div>
        </div>
        <div class="col-4 p-2">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-1">Add Price</h3>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" name="web_name" placeholder="Enter Website Name">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control mb-2" name="price" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" name="web_link" placeholder="Enter Website Link">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row g-0 m-3 bg-light rounded p-2">
        <div class="col-12">
            <textarea name="details" id="mytextarea" cols="30" rows="10"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-50 m-3 float-end mt-0">Save Product</button>
</form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script>
        let form = document.getElementById('form');
        form.addEventListener('submit',function(e){

            let main = document.querySelector('.main_category_select');
            let sub = document.querySelector('.sub_category_select');
            let tiny = document.querySelector(".tiny_category_select");
            let product_name = document.querySelector("input[name='name']");
            let product_model = document.querySelector("input[name='product_model']");
            let textarea = document.getElementById('mytextarea');

            let web_name = document.querySelector("input[name='web_name']");
            let price = document.querySelector("input[name='price']");
            let web_link = document.querySelector("input[name='web_link']");
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
            if(tiny.value==0){
                tiny.style.border = "2px solid red";
                e.preventDefault();
            }else{
                tiny.style.border = "1px solid #CED4DA";
            }
            if(product_name.value.length <= 1){
                product_name.style.border = "2px solid red";
                e.preventDefault();
            }else{
                product_name.style.border = "1px solid #CED4DA";
            }
            if(product_model.value.length <= 1){
                product_model.style.border = "2px solid red";
                e.preventDefault();
            }else{
                product_model.style.border = "1px solid #CED4DA";
            }
            if(textarea.value.length <= 1){
                textarea.style.border = "2px solid red";
                e.preventDefault();
            }else{
                textarea.style.border = "1px solid #CED4DA";
            }
            if(web_name.value.length <= 1){
            web_name.style.border = "2px solid red";
            e.preventDefault();
        }else{
            web_name.style.border = "1px solid #CED4DA";
        }
        if(price.value.length <= 0){
            price.style.border = "2px solid red";
            e.preventDefault();
        }else{
            price.style.border = "1px solid #CED4DA";
        }
        if(web_link.value.length <= 10){
            web_link.style.border = "2px solid red";
            e.preventDefault();
        }else{
            web_link.style.border = "1px solid #CED4DA";
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
            $(document).on('change','.main_category_select',function(){
                let val = $(this).val();
                $(".sub_category_select").html('<option value="">--Select Sub Category--</option>');

                // console.log(val);

                if(val != ''){
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/sub/")}}/'+val,

                        success: function(data){
                            data.forEach((item) => {
                                $(".sub_category_select").append('<option  value="'+item.id+'">'+item.sub_category+'</option>')
                            });
                            // console.log(data);
                        }
                    })
                }

            })

            $(document).on('change','.sub_category_select',function(){
                let val = $(this).val();
                $(".tiny_category_select").html('<option value="">--Select Sub Category--</option>');

                // console.log(val);

                if(val != ''){
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/tiny/")}}/'+val,

                        success: function(data){
                            data.forEach((item) => {
                                $(".tiny_category_select").append('<option  value="'+item.id+'">'+item.tiny_category+'</option>')
                            });
                            // console.log(data);
                        }
                    })
                }

            })
        })

    </script>
@endsection
