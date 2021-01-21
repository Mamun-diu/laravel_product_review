@extends('backend/master')
@section('content')
<div class="container ">
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <form id="form" action="{{ URL::to('/admin/store/price') }}" method="POST">
        @csrf
        <div class="row g-0 p-2 rounded bg-light m-2">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="text-center border-bottom pb-1">Select Product</h3>
                        <select class="form-select mb-2 main_category_select" name="main_category_id">
                            <option value="0">--Select Main Category--</option>
                            @foreach($main_cat as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->main_category }}</option>
                            @endforeach
                        </select>
                        <select class=" form-select mb-2 sub_category_select" name="sub_category_id">
                            <option value="0">--Select Sub Category--</option>
                        </select>
                        <select class=" form-select mb-2 tiny_category_select" name="tiny_category_id">
                            <option value="0">--Select Tiny Category--</option>
                        </select>
                        <select class=" form-select mb-2 product_select" name="product_id">
                            <option value="0">--Select Product--</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
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
                        <button type="submit" class="btn btn-outline-primary w-100">Submit</button>
                    </div>
                </div>
            </div>
        </div>


    </form>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    let form = document.getElementById('form');
    form.addEventListener('submit',function(e){

        let main = document.querySelector('.main_category_select');
        let sub = document.querySelector('.sub_category_select');
        let tiny = document.querySelector(".tiny_category_select");
        let product = document.querySelector(".product_select");
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
        if(product.value==0){
            product.style.border = "2px solid red";
            e.preventDefault();
        }else{
            product.style.border = "1px solid #CED4DA";
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
        $(document).on('change','.tiny_category_select',function(){
            let val = $(this).val();
            $(".product_select").html('<option value="">--Select Product--</option>');

            // console.log(val);

            if(val != ''){
                $.ajax({
                    type: 'GET',
                    url: '{{URL::to("/admin/find/product/")}}/'+val,

                    success: function(data){
                        data.forEach((item) => {
                            $(".product_select").append('<option  value="'+item.id+'">'+item.name+'</option>')
                        });
                        // console.log(data);
                    }
                })
            }

        })
    })

</script>
@endsection
