@extends('backend/master')
@section('content')
    <div class="product m-2 p-2 bg-light rounded">
        <table class="table table-bordered table-success table-striped text-center">
            <tr>
                <td colspan="8"><h2 class="text-center text-secondary">Product Information</h2></td>
            </tr>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Image</th>
                <th>Status</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            @foreach($product as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->brand }}</td>
                <td><img width="50px" height="30px" src="{{ asset('public/images/'.$data->image) }}" alt=""></td>
                <td style="padding:10px" class="d-flex justify-content-between align-items-center">
                  <h5 style="color: {{ ($data->status=='publish')?'blue':'red' }} "  class="d-inline-block ">{{ $data->status }}</h5>
                  <i style="cursor: pointer" class="fas fa-sync-alt status" data-id="{{ $data->id }}"></i>
                </td>
                <td><i class="far fa-list-alt fa-2x category text-secondary" data-bs-toggle="modal" data-bs-target="#category" data-id="{{ $data->id }}"></i></td>
                <td><i class="fas fa-money-check-alt fa-2x price text-secondary" data-bs-toggle="modal" data-bs-target="#price" data-id="{{ $data->id }}"></i></td>
                {{-- <td><button class="btn btn-sm btn-success category" data-bs-toggle="modal" data-bs-target="#category" data-id="{{ $data->id }}">Check Category</button></td> --}}
                {{-- <td><button class="btn btn-sm btn-success price" data-bs-toggle="modal" data-bs-target="#price" data-id="{{ $data->id }}">Check Price</button></td> --}}

                <td>
                    <button class="btn btn-sm btn-primary show-item" data-bs-toggle="modal" data-bs-target="#show-product" data-id="{{ $data->id }}" >Show</button>
                    <a class="btn btn-sm btn-info" href="{{ URL::to('/admin/edit/product/') }}/{{ $data->id }}" >Edit</a>
                    <button class="btn btn-sm btn-danger" >Delete</button>
                </td>
            </tr>
            @endforeach
        </table>

        {{ $product->links() }}
    </div>

    <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button> --}}

  <!-- Category -->
  <div class="modal fade" id="category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-dark table-bordered">
              <tr>
                  <th>Main</th>
                  <th>Sub</th>
                  <th>Tiny</th>
              </tr>
              <tr class="cat_table">

              </tr>
          </table>

        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
  </div>


  <!-- Price -->
  <div class="modal fade" id="price" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Price</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-secondary table-bordered ">
              <tr>
                  <th>Website</th>
                  <th>Price</th>
                  <th>Link</th>
              </tr>
              <tbody class="price_table">

              </tbody>

          </table>

        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
      </div>
    </div>
  </div>

  <!-- Show Product -->
  <div class="modal fade" id="show-product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel">Product Information</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
              <div class="row border-bottom pb-5">
                  <div class="col-4">
                    <img class="image" width="100%"  alt="Image">
                  </div>
                  <div class="col-6">
                    <h2 class="name">Product Name</h2>
                    <span class="badge bg-primary brand">Brand</span>
                    <p class="getCategory"></p>


                    <table class="table table-secondary table-bordered ">
                        <tr>
                            <th>Website</th>
                            <th>Price</th>
                            <th>Link</th>
                        </tr>
                        <tbody class="price_table">

                        </tbody>

                    </table>
                  </div>
              </div>
              <div class="row mt-5">
                  <div class="col-12 description">

                  </div>
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
            $(document).on('click','.category',function(){
                $('.cat_table').html('');
                var id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/cat/")}}/'+id,

                        success: function(data){
                            data.forEach(cat => {
                                $('.cat_table').append('<td>'+cat+'</td>');
                            });
                        }
                    })
                })


            $(document).on('click','.price',function(){
                $('.price_table').html('');
                let id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/price/")}}/'+id,

                        success: function(data){
                            //  console.log(data);

                            data.forEach(price => {
                                $('.price_table').append('<tr><td>'+price.website_name+'</td><td>'+price.price+'</td><td><a class="btn btn-sm btn-primary" target="_blank" href="'+price.link+'">Go</a><button class="btn btn-sm btn-info ms-2 edit-price" data-edit="'+price.id+'">Edit</button></td></tr>');
                            });
                        }
                    })
            })

            $(document).on('click','.status',function(){
                // $('.price_table').html('');
                let id = $(this).data('id');
                var status_icon = $(this);
                $(status_icon).css({'transform': 'rotate(360deg)'});
                var status = $(this).prev();
                // console.log(status.text());


                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/change/status/")}}/'+id,

                        success: function(data){
                            $(status_icon).css({'transform': 'rotate(0deg)'});
                            if(data=='unpublish'){
                                $(status).css({'color':'red' });
                            }else{
                                $(status).css({'color':'blue' });
                            }
                            $(status).text(data);

                            // data.forEach(price => {
                            //     $('.price_table').append('<tr><td>'+price.website_name+'</td><td>'+price.price+'</td><td><a class="btn btn-sm btn-primary" target="_blank" href="'+price.link+'">Go</a></td></tr>');
                            // });
                        }
                    })
            })

            $(document).on('click','.show-item',function(){
                // $('.price_table').html('');
                let id = $(this).data('id');


                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/get/product/")}}/'+id,

                        success: function(data){
                            // console.log(data[0]);
                            // $('.getCategory').html(data[0][0]+'/'+data[0][1]+'/'+data[0][2]);
                            $('.getCategory').html('<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item">'+data[0][0]+'</li><li class="breadcrumb-item">'+data[0][1]+'</li><li class="breadcrumb-item active" aria-current="page">'+data[0][2]+'</li></ol></nav>');
                            // console.log(data[1]);
                            $('.image').attr("src", "{{ asset('public/images/') }}/"+data[1].image);
                            $('.name').text(data[1].name);
                            $('.brand').text(data[1].brand);
                            $('.description').html(data[1].details);
                            $('.price_table').html('');
                            data[2].forEach(element => {
                                $('.price_table').append('<tr><td>'+element.website_name+'</td><td>'+element.price+'</td><td><a class="btn btn-sm btn-primary" href="'+element.link+'">Go</a></td></tr>')

                            });


                            // data.forEach(price => {
                            //     $('.price_table').append('<tr><td>'+price.website_name+'</td><td>'+price.price+'</td><td><a class="btn btn-sm btn-primary" target="_blank" href="'+price.link+'">Go</a></td></tr>');
                            // });
                        }
                    })
            })

            $(document).on('click','.edit-price',function(){
                // $('.price_table').html('');
                let id = $(this).data('edit');
                let parent = $(this).closest('tr');
                let first = parent.children('td').eq(0).text();
                let second = parent.children('td').eq(1).text();
                let third = parent.find('td a').attr('href');
                // console.log(first, second, third);

                // parent.slideUp();
                 let create_html = '<form action="#" method="POST"><tr>'+
                '@csrf'+
                '<input type="hidden" name="id" value="'+id+'">'+
                '<td><input class="form-control" type="text" name="web_name" value="'+first+'"></td>'+
                '<td><input class="form-control" type="number" name="price" value="'+second+'"></td>'+
                '<td><input class="form-control" type="text" name="link" value="'+third+'"></td></tr>'+
                '<tr><td colspan="3"><button id="update_p" type="submit" class="btn btn-primary float-end">Update</button></td>'+
                '</tr></form>';
                $('.price_table').html(create_html);
                

            })

            $(document).on('click','#update_p',function(e){
                let id = $(".price_table input[name='id']").val();
                let web = $(".price_table input[name='web_name']").val();
                let price = $(".price_table input[name='price']").val();
                let link = $(".price_table input[name='link']").val();
                let webCheck = $(".price_table input[name='web_name']");
                let priceCheck = $(".price_table input[name='price']");
                let linkCheck = $(".price_table input[name='link']");
                // console.log(web, price, link);
                if(webCheck.val()==''){
                    webCheck.css({'border':'2px solid red'});
                }
                if(priceCheck.val()==''){
                    priceCheck.css({'border':'2px solid red'});
                }
                if(linkCheck.val()==''){
                    linkCheck.css({'border':'2px solid red'});
                }
                if(webCheck.val() != '' && priceCheck.val() != '' && linkCheck.val() != ''){
                    $.ajax({
                        type: 'POST',
                        url: '{{URL::to("admin/update/price/")}}',
                        data: {id: id, web: web, price: price, link: link},
                        success: function(data){
                            if(data){
                                $('.price_table').html('');

                                $.ajax({
                                    type: 'GET',
                                    url: '{{URL::to("/admin/find/price_table/")}}/'+data.id,
                                    success: function(sub_data){
                                        sub_data.forEach(price => {
                                            $('.price_table').append('<tr><td>'+price.website_name+'</td><td>'+price.price+'</td><td><a class="btn btn-sm btn-primary" target="_blank" href="'+price.link+'">Go</a><button class="btn btn-sm btn-info ms-2 edit-price" data-edit="'+price.id+'">Edit</button></td></tr>');
                                        });

                                    }
                                })
                            }
                        }
                    })
                }


            });



          })

    </script>
@endsection
