@extends('frontend/master')

@section('content')

   <div class="p-info">
        <div class="border-bottom">
            <div class="container">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb m-0 mt-2 p-1">
                      <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="#">Laptop</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Notebook</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="container">
            <div class="row d-flex flex-wrap">
                <div class="col-12">
                    <ul class="filter">
                        <li class="list " data-filter="">Mobile</li>
                        <li class="list " data-filter="">Laptop</li>
                        <li class="list " data-filter="">Keyboard</li>
                        <li class="list " data-filter="">Mouse</li>
                        <li class="list " data-filter="">Monitor</li>
                        <li class="list " data-filter="">Hard disk</li>
                        <li class="list " data-filter="">Optical drive</li>
                        <li class="list " data-filter="">Processor</li>
                        <li class="list " data-filter="">Graphics card</li>
                        <li class="list " data-filter="">Charger</li>
                        <li class="list " data-filter="">Light</li>
                        <li class="list " data-filter="">Cooler</li>
                    </ul>
                </div>
            </div>
        </div>
   </div>



  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script>

      {{--   $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
            $(document).on('click','.add-to-favourite-btn',function(){
                let product_id = {{ $product->id }}
                let add = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ URL::to('user/add/favourite') }}',
                    data: {
                        "product_id":product_id

                    },
                    success: function(data){
                        $('.favourite').empty();
                        $('.favourite').append('<button class="remove-from-favourite-btn btn btn-danger  d-flex justify-content-center align-items-center"><i class="fas fa-heart me-3"></i>Remove from favourite</button>');

                        // $("input[name='sub_category']").val('');
                        // $("body").append('<div class="toastr alert alert-success">Sub Category Added</div>');
                        // setTimeout(() => {
                        //     $('.toastr').hide();
                        // }, 1000);

                    }
                    // ,
                    // error: function (data) {
                    //     if(data.status===422){
                    //         $("input[name='sub_category']").val('');
                    //         console.log('something wrong');

                    //     }

                    // }
                    })
                })



            })
        --}}


   </script>
@endsection
