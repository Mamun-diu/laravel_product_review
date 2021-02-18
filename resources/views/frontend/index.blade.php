@extends('frontend/master')

@section('content')
    <div class="full-width">
        <div class="top-index">
            <div class="inner-top-index">
                <div class="middle-top-index">
                    <h1>Find Your Dream Product</h1>
                    <form class="m-0 searchDiv" action="">
                        <div class="input-group mb-2 search body-search">
                            <input type="text" class="form-control" name='search' autocomplete="off" placeholder="Find Product and Services" >
                            <img draggable="false" src="{{ asset('public/icon/search.png') }}" alt="search">
                            {{-- <a class="input-group-text" id="basic-addon2">@example.com</span> --}}
                            <button type="submit" class="d-none d-sm-block input-group-text">Search</button>
                        </div>
                        <button type="submit" class="d-block d-sm-none w-100 p-2 border-0">Search</button>
                    </form>
                    <div class="searchResult rounded shadow">
                        <ul>

                        </ul>
                        <span class="close"><i class="fas fa-window-close fa-2x"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-body-full p-3 ">
        <div class="container ">
            <h2 class="display-4 text-center text-muted">All Product</h2>
            <div class="product-body-inner p-2 d-flex flex-wrap justify-content-center">
                @foreach($product as $item)
                <a href="{{  URL::to('/product/info') }}/{{ $item->id }} " class="text-decoration-none">
                    <div class="card product-index m-1 shadow" style="">
                        <img height="250px" src="{{ asset('public/images/') }}/{{ $item->image }}" class="card-img-top" alt="image">
                        <div class="card-body">
                          <h5 class="text-primary fw-bold">{{  substr($item->name, 0, 30) }} {{(strlen($item->name) >30)?'....':''}}</h5>

                          <p>Price : {{ $item->price['price'] }}tk</p>
                        </div>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                @endforeach

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center bg-secondary">
        <div style="max-height: 45px; margin-top: 8px;">{{ $product->links() }}</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(".body-search input[name='search']").keyup(function(){
            var search = $(this).val();
            if(search != ''){
                $.ajax({
                type: "GET",
                url: "{{ URL::to('/product/search/') }}/"+search,
                success: function(data){
                    $('.searchResult').show();
                    $('.searchResult ul').html('');
                        data.forEach(value => {
                            // console.log(value);

                            $('.searchResult ul').append(
                            '<li class="p-1"><a href="{{  URL::to('/product/info/') }}/'+value.id+'">'+value.name+'</a></li>'
                            );
                        });
                }
            })
            }
        })

        $(document).on('click','.searchResult ul li, .searchResult .close', function(){
            var product = $(this).text();
            $('input[name="search"]').val(product);
            $('.searchResult ul').html('');
            $('.searchResult').hide();
        })
    })
</script>
@endsection
