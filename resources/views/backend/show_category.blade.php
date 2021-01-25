@extends('backend/master')
@section('content')
    <div class="p-2 rounded bg-light m-2 mb-4">
        <h2 class=" text-muted text-center">Main Category</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach($main as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->main_category }}</td>
                <td>
                    <button class="btn btn-sm btn-info edit-main" data-bs-toggle="modal" data-bs-target="#editMain" data-id="{{ $data->id }}" >Edit</button>
                    <button class="btn btn-sm btn-danger" id="#deleteMain" data-id="{{ $data->id }}" >Delete</button>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            {{ $main->links() }}
        </div>
    </div>
    <div class="p-2 rounded bg-light m-2 mb-4">
        <h2 class=" text-muted text-center">Sub Category</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Main</th>
                <th>Sub</th>
                <th>Action</th>
            </tr>
            @foreach($sub as $data)

            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->mainCategory->main_category }}</td>
                <td>{{ $data->sub_category }}</td>
                <td>
                    <button class="btn btn-sm btn-info edit-sub" data-bs-toggle="modal" data-bs-target="#editSub" data-id="{{ $data->id }}" >Edit</button>
                    <button class="btn btn-sm btn-danger" id="#deleteSub" data-id="{{ $data->id }}" >Delete</button>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
            {{ $sub->links() }}
        </div>
    </div>
    <div style="position:relative" class="p-2 rounded bg-light m-2 mb-4">
        <h2 class=" text-muted text-center">Tiny Category</h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Main</th>
                <th>Sub</th>
                <th>Tiny</th>
                <th>Action</th>
            </tr>
            @foreach($tiny as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->mainCategory->main_category }}</td>
                <td>{{ $data->subCategory->sub_category }}</td>
                <td>{{ $data->tiny_category }}</td>
                <td>
                    <button class="btn btn-sm btn-info edit-tiny" data-bs-toggle="modal" data-bs-target="#editTiny" data-id="{{ $data->id }}" >Edit</button>
                    <button class="btn btn-sm btn-danger" id="#deleteTiny" data-id="{{ $data->id }}" >Delete</button>

                </td>
            </tr>
            @endforeach
        </table>

            {{ $tiny->links() }}

    </div>

    <!-- Main -->
  <div class="modal fade" id="editMain" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="staticBackdropLabel">Update Main Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card mx-auto" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-1">Main Category</h3>
                    <form id="main_form" action="{{ URL::to('admin/main/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id">
                            <input class="form-control mb-2" type="text" name="main_category" placeholder="Enter Main Category">
                        </div>
                        <button id="main_submit" class="btn w-100 btn-primary" type="submit">Update</button>
                    </form>
                </div>
              </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
  </div>

  <!-- Sub -->
  <div class="modal fade" id="editSub" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="staticBackdropLabel">Update Sub Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card mx-auto" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-1">Sub Category</h3>
                    <form id="sub_form" action="{{ URL::to('admin/sub/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id">
                            <select class="form-select mb-2 sub_main_category_select" name="main_category_id">
                                <option value="0">--Select Main Category--</option>
                                @foreach($main as $data)
                                    <option class="main-select" value="{{ $data->id }}">{{ $data->main_category }}</option>
                                @endforeach

                            </select>
                            <input class="form-control mb-2" type="text" name="sub_category" placeholder="Enter Sub Category">
                        </div>
                        <button class="btn w-100 btn-primary" type="submit">Update</button>
                    </form>
                </div>
              </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
  </div>

  <!-- Tiny -->
  <div class="modal fade" id="editTiny" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger text-light">
          <h5 class="modal-title" id="staticBackdropLabel">Update Tiny Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card mx-auto" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="text-center border-bottom pb-1">Tiny Category</h3>
                    <form id="tiny_form" action="{{ URL::to('admin/tiny/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id">
                            <select class="form-select mb-2 tiny_main_category_selects" name="main_category_id">
                                <option class="main_select" value="0">--Select Main Category--</option>
                                @foreach($main as $data)
                                    <option class="main-select" value="{{ $data->id }}">{{ $data->main_category }}</option>
                                @endforeach
                            </select>
                            <select class="form-select mb-2 tiny_sub_category_selects" name="sub_category_id">
                                <option value="0">--Select Sub Category--</option>

                            </select>
                            <input class="form-control mb-2" type="text" name="tiny_category" placeholder="Enter Tiny Category">
                        </div>
                        <button class="btn w-100 btn-primary" type="submit">Update</button>
                    </form>
                </div>
              </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
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
            $(document).on('click','.edit-main',function(){
                // $('.cat_table').html('');
                ;

                let id = $(this).data('id');
                let parent = $(this).closest('tr');
                let mainId = parent.children('td').eq(0).text();
                let data = parent.children('td').eq(1).text();
                $('input[name="id"]').val(mainId);
                $('input[name="main_category"]').val(data);
            })

            $(document).on('click','.edit-sub',function(){
                let id = $(this).data('id');

                $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/edit/sub/")}}/'+id,

                        success: function(data){
                            $('#sub_form input[name="id"]').val(data[0].id);
                            $('#sub_form input[name="sub_category"]').val(data[0].sub_category);
                            $('.main-select').each(function( index ) {
                                if($( this ).val() == data[0].main_category.id ){
                                    $(this).attr('selected','selected');

                                }else{
                                    $(this).removeAttr('selected');
                                }
                            });
                        }
                    })
            })
            $(document).on('submit','#sub_form',function(e){
                let main_select = $("#sub_form .sub_main_category_select");
                let sub_input = $('#sub_form input[name="sub_category"]');
                if(main_select.val() == 0){
                    e.preventDefault();
                    main_select.css({'border':'2px solid red'});
                }else{
                    main_select.css({'border':'1px solid green'});
                }
                if(sub_input.val() == ''){
                    e.preventDefault();
                    sub_input.css({'border':'2px solid red'});
                }else{
                    sub_input.css({'border':'1px solid green'});
                }

            })
            $(document).on('submit','#tiny_form',function(e){
                let main_select = $("#tiny_form .tiny_main_category_selects");
                let sub_select = $("#tiny_form .tiny_sub_category_selects");
                let tiny_input = $('#tiny_form input[name="tiny_category"]');
                if(main_select.val() == 0){
                    e.preventDefault();
                    main_select.css({'border':'2px solid red'});
                }else{
                    main_select.css({'border':'1px solid green'});
                }
                if(sub_select.val() == 0){
                    e.preventDefault();
                    sub_select.css({'border':'2px solid red'});
                }else{
                    sub_select.css({'border':'1px solid green'});
                }
                if(tiny_input.val() == ''){
                    e.preventDefault();
                    tiny_input.css({'border':'2px solid red'});
                }else{
                    tiny_input.css({'border':'1px solid green'});
                }
            })

            $(document).on('change','.tiny_main_category_selects',function(){
                var val = $(this).val();
                $(".tiny_sub_category_selects").html('<option value="">--Select Sub Category--</option>');

                // console.log(val);

                if(val != ''){
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/sub/")}}/'+val,

                        success: function(data){
                            data.forEach((item) => {
                                $(".tiny_sub_category_selects").append('<option  value="'+item.id+'">'+item.sub_category+'</option>')
                            });
                            // console.log(data);
                        }
                    })
                }

            })

            $(document).on('click','.edit-tiny',function(){
                let id = $(this).data('id');
                var sub_category;

                $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/edit/tiny/")}}/'+id,

                        success: function(data){
                            // console.log(data[0].sub_category.sub_category);
                            sub_category = data[0].sub_category.id;
                            $('#tiny_form input[name="id"]').val(data[0].id);
                            $('#tiny_form input[name="tiny_category"]').val(data[0].tiny_category);
                            // $('#sub_form input[name="id"]').val(data[0].id);
                            // $('#sub_form input[name="sub_category"]').val(data[0].sub_category);
                            $('#tiny_form .main-select').each(function( index ) {
                                if($( this ).val() == data[0].main_category.id ){
                                    $(this).attr('selected','selected');

                                }else{
                                    $(this).removeAttr('selected');
                                }
                            });

                            $.ajax({
                                type: 'GET',
                                url: '{{URL::to("/admin/find/sub/")}}/'+data[0].main_category.id,

                                success: function(data){
                                    $(".tiny_sub_category_selects").html('');
                                    $(".tiny_sub_category_selects").append('<option  value="0">--Sub Category Select--</option>')
                                    data.forEach(item => {
                                        if(item.id == sub_category){
                                            $(".tiny_sub_category_selects").append('<option selected class="sub_select"  value="'+item.id+'">'+item.sub_category+'</option>')
                                        }else{
                                            $(".tiny_sub_category_selects").append('<option class="sub_select"  value="'+item.id+'">'+item.sub_category+'</option>')
                                        }

                                        // console.log(element.id, element.sub_category);

                                    });

                                }
                            })



                        }
                 })
            })


        })
    </script>
@endsection
