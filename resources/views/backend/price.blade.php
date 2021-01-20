@extends('backend/master')
@section('content')
<div class="container">
    <form action="">
        <div class="row">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center border-bottom p-2">Admin Login</h5>
                        <h3 class="text-center border-bottom pb-1">Select Category</h3>


                        <select class="form-select mb-2 main_category_select" name="main_category_id">
                            <option value="0">--Select Main Category--</option>

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
        </div>
        <div class="col-4"></div>

    </form>
</div>

@endsection
