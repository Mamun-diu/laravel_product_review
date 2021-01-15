@extends('backend/master')

@section('content')
    <div class="full-body">
        <div class="container ">
            <div id="register" class="d-flex justify-content-center align-items-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center border-bottom p-2">Admin Registration</h5>
                        <form action="">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input id="name" type="text" class="form-control mt-1" name="name" placeholder="Enter Username...">
                            </div>
                            <div class="form-group">
                                <label for="register_email">Email</label>
                                <input id="register_email" type="email" class="form-control mt-1" name="email" placeholder="Enter Email Address...">
                            </div>
                            <div class="form-group">
                                <label for="register_password">Password</label>
                                <input id="register_password" type="password" class="form-control mt-1" name="password" placeholder="Enter Password...">
                            </div>
                            <div class="form-group">
                                <label for="re_password">Re-Password</label>
                                <input id="re_password" type="password" class="form-control mt-1" name="re_password" placeholder="Enter Re-password...">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" placeholder="Enter Address..."  rows="1"></textarea>
                            </div>
                            <button class="btn btn-primary w-100 mt-2">Register</button>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>


@endsection
