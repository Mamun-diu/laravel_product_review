<div class="product-body-inner p-2 d-flex flex-wrap justify-content-center" style="">
    @foreach($product as $item)
    <a href="{{  URL::to('/product/info') }}/{{ $item->id }} " class="product">
        <div class="card product-index m-1 shadow" style="">
            <img height="250px" src="{{ asset('public/images/') }}/{{ $item->image }}" class="card-img-top" alt="image">
            <div class="card-body">
              <h5 class="text-primary fw-bold">{{  substr($item->name, 0, 30) }} {{(strlen($item->name) >30)?'....':''}}</h5>

              <p class="d-inline">Price : <p class="product-price d-inline">{{ ($item->price->price)?$item->price->price:'' }}</p> tk</p>
            </div>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </a>
    @endforeach
    @if($product instanceof \Illuminate\Pagination\LengthAwarePaginator )

    <div class="d-flex justify-content-center align-items-center bg-secondary w-100 pagi">
        <div style="max-height: 45px; margin-top: 8px;">{{ $product->links() }}</div>
    </div>

    @endif


    

</div>
