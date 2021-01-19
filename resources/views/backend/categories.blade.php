@extends('backend/master')
@section('content')
    <div class="row categories g-0">
        <div class="main_category col-4">
            <div class="p-3">
                <form action="{{ URL::to('admin/main/category') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Main Category</label>
                        <input class="form-control mb-2" type="text" name="main_category" placeholder="Enter Main Category">
                    </div>
                    <button class="btn w-100 btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
        <div class="sub_category col-4">
            <div class="p-3">
                <form action="{{ URL::to('admin/sub/category') }}" method="POST">
                    @csrf
                    <select class="form-select mb-2" name="main_category_id" id="main_category">
                        <option value="">--Select Main Category--</option>
                        @foreach($main as $data)
                            <option value="{{ $data->id }}">{{ $data->main_category }}</option>
                        @endforeach

                    </select>
                    <div class="form-group">
                        <label for="">Sub Category</label>
                        <input class="form-control mb-2" type="text" name="sub_category" placeholder="Enter Sub Category">
                    </div>
                    <button class="btn w-100 btn-success" type="submit">Save</button>
                </form>
            </div>
        </div>
        <div class="tiny_category col-4">
            <div class="p-3">
                <form action="{{ URL::to('admin/tiny/category') }}" method="POST">
                    @csrf
                    <select class="form-select mb-2" name="main_category_id" id="main">
                        <option value="">--Select Main Category--</option>
                        @foreach($main as $data)
                            <option value="{{ $data->id }}">{{ $data->main_category }}</option>
                        @endforeach
                    </select>
                    <select class="form-select mb-2" name="sub_category_id" id="sub">
                        <option value="">--Select Sub Category--</option>
                    </select>
                    <div class="form-group">
                        <label for="">Tiny Category</label>
                        <input class="form-control mb-2" type="text" name="tiny_category" placeholder="Enter Tiny Category">
                    </div>
                    <button class="btn w-100 btn-info" type="submit">Save</button>
                </form>

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
