@extends('frontend/master')

@section('content')
<div class="product-body-full p-3 ">
    <div class="container ">
        <h2 class="display-4 text-center text-muted">Search Result</h2>
        <div class="product-body-inner p-2 d-flex flex-wrap justify-content-center">
            @if(!empty($product[0]->name))
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

            @else
                <h1 class="alert alert-danger">Sorry! Result not found.</h1>
            @endif

        </div>
        <div class="bg-secondary d-flex justify-content-center align-items-center m-0 pt-2 pb-0">
            <div class="mt-2 p-0">{{ $product->links() }}</div>
        </div>
    </div>
</div>
@endsection
