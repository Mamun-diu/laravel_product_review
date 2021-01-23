@extends('backend/master')
@section('content')
    <div class="product m-2 p-2 bg-light rounded">
        <table class="table table-bordered table-success table-striped">
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
                <td>{{ $data->status }}</td>
                <td><button class="btn btn-sm btn-success category" data-bs-toggle="modal" data-bs-target="#category" data-id="{{ $data->id }}">Check Category</button></td>
                <td><button class="btn btn-sm btn-success price" data-bs-toggle="modal" data-bs-target="#price" data-id="{{ $data->id }}">Check Price</button></td>

                <td>
                    <a class="btn btn-sm btn-primary" href="#">Show</a>
                    <a class="btn btn-sm btn-info" href="#">Edit</a>
                    <a class="btn btn-sm btn-danger" href="#">Delete</a>
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
                var id = $(this).data('id');
                    $.ajax({
                        type: 'GET',
                        url: '{{URL::to("/admin/find/price/")}}/'+id,

                        success: function(data){
                            // console.log(data);

                            data.forEach(price => {
                                $('.price_table').append('<tr><td>'+price.website_name+'</td><td>'+price.price+'</td><td><a class="btn btn-sm btn-primary" target="_blank" href="'+price.link+'">Go</a></td></tr>');
                            });
                        }
                    })
                })
            })

    </script>
@endsection
