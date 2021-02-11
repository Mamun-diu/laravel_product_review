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
        <div class="container my-2">
            <div class="row">
                <div class="col-md-4  border">
                    <img width="100%" src="{{ asset('public/images/') }}/{{ $product->image }}" alt="">
                </div>
                <div class="offset-lg-1 col-md-6">
                    <h4 class="text-secondary lh-base">{{ $product->name }}</h4>
                    <div class="product-rating my-3 d-flex">
                        <i class="fas fa-star fa-2x text-primary"></i>
                        <i class="fas fa-star fa-2x text-primary"></i>
                        <i class="fas fa-star fa-2x text-primary"></i>
                        <i class="fas fa-star fa-2x text-primary"></i>
                        <i class="fas fa-star fa-2x text-primary"></i>
                        <h3 class="rating-count">(209)</h3>
                    </div>
                    <div class="favourite">
                        <button class="btn btn-primary  d-flex justify-content-center align-items-center"><i class="fas fa-heart me-3"></i>Add to favourite</button>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-md-6">
                    
                    <div class="review rounded mb-3" style="background : #eee">
                        <p class="lead p-3 border-bottom text-success">Your Review</p>
                        <div class="container p-3 pt-1">
                            <form action="">
                                <div class="review-rating mb-3">
                                    <i class="fas fa-star fa-2x text-secondary"></i>
                                    <i class="fas fa-star fa-2x text-secondary"></i>
                                    <i class="fas fa-star fa-2x text-secondary"></i>
                                    <i class="fas fa-star fa-2x text-secondary"></i>
                                    <i class="fas fa-star fa-2x text-secondary"></i>
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Your Name</label>
                                    <input class="form-control" type="text">
                                </div>
                                <div class="form-group my-3">
                                    <label for="">Enter Your Review</label>
                                    <textarea class="form-control" name="" id=""></textarea>
                                </div>
                                <button type="submit" class="btn btn-info w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="price ">
                        <table class="table table-striped ">
                            <tr>
                                <th>Web Name</th>
                                <th>Price</th>
                                <th>Link</th>
                            </tr>
                            
                            @foreach($price as $taka)
                            <tr>
                                <td>{{ $taka->website_name }}</td>
                                <td>{{ $taka->price }}</td>
                                <td><a class="btn btn-sm btn-primary" target="_blank" href="{{ $taka->link }}">View</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-lg-6" style="background : #eee">
                    <h2 class="text-center bg-secondary text-light p-2">See All Review</h2>
                    <div class="all-review bg-white rounded m-2 p-2">
                        <h4>Al-Mamun</h4>
                        <p class="lead text-secondary">This product is good, but have a isuue on this product. The color is not match that i buy with your product image</p>
                    </div>
                    <div class="all-review bg-white rounded m-2 p-2">
                        <h4>Al-Mamun</h4>
                        <p class="lead text-secondary">This product is good, but have a isuue on this product. The color is not match that i buy with your product image</p>
                    </div>
                    <div class="all-review bg-white rounded m-2 p-2">
                        <h4>Al-Mamun</h4>
                        <p class="lead text-secondary">This product is good, but have a isuue on this product. The color is not match that i buy with your product image</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="text-center bg-secondary text-light p-2">Product Specification</h2>
                    <div style="overflow: scroll">
                        <div style="width : 1200px">
                            <?php echo $product->details;?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection
