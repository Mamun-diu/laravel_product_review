@extends('frontend/master')

@section('content')
<div class="product-body-full p-3 ">
    <div class="container ">
        <h2 class="display-4 text-center text-muted">Your Rated Item</h2>
        <div class="product-body-inner p-2 d-flex flex-wrap justify-content-center">
            @if(!empty($product[0]->product_id))
                @foreach($product as $item)
                <a href="{{  URL::to('/product/info') }}/{{ $item->product->id }} " class="text-decoration-none" style="position : relative">
                    <div class="card product-index m-1 shadow" style="">
                        <img height="250px" src="{{ asset('public/images/') }}/{{ $item->product->image }}" class="card-img-top" alt="image">
                        <div class="card-body">
                        <h5 class="text-primary fw-bold">{{  substr($item->product->name, 0, 30) }} {{(strlen($item->product->name) >30)?'....':''}}</h5>

                        <p>Price : {{ $item->product->price['price'] }}tk</p>
                        </div>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <p style="background : rgb(119, 8, 245);color : #eee; margin-bottom : 0; padding:5px 10px;display: inline-block;position : absolute;right : 5px;top : 5px;">Rate: {{ $item->rate }}</p>
                </a>

                @endforeach

            @else
                <h1 class="alert alert-danger">Sorry! No item available.</h1>
            @endif

        </div>
        <div class="bg-secondary d-flex justify-content-center align-items-center m-0 pt-2 pb-0">
            <div class="mt-2 p-0">{{ $product->links() }}</div>
        </div>
    </div>
</div>
@endsection

