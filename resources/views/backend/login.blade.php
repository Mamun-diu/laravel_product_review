@extends('backend/master')

@section('content')
    <div class="full-body">
        <div class="container ">
            <div id="login" class=" d-flex justify-content-center align-items-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center border-bottom p-2">Admin Login</h5>
                        <form action="">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control mt-1" name="email" placeholder="Enter Email Address...">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control mt-1" name="password" placeholder="Enter Password...">
                            </div>
                            <button class="btn btn-primary w-100 mt-2">Login</button>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>


@endsection
