@extends('frontend/master')

@section('content')
    {{-- <div class="full-body">
        <div class="container ">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div id="register" class="register-before">
                        <div class="card" style="">
                            <div class="card-body">
                                <h5 class="card-title text-center border-bottom p-2">User Registration</h5>

                                <form id="reg" action="{{ URL::to('/user/registration') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input id="name" type="text" class="form-control mt-2" name="name" placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <input id="register_email" type="email" class="form-control mt-2" name="email" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input id="phone" type="text" class="form-control mt-2" name="phone" placeholder="Enter Mobile Number...">
                                    </div>
                                    <div class="form-group">
                                        <input id="register_password" type="password" class="form-control mt-2" name="password" placeholder="Enter Password...">
                                    </div>
                                    <div class="form-group">
                                        <input id="re_password" type="password" class="form-control mt-2" name="re_password" placeholder="Enter Re-password...">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="address" id="address" class="form-control mt-2" placeholder="Enter Address..."  rows="1"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-2">Register</button>
                                    <a class="have-account" href="{{ URL::to('/login') }}">Already have an account</a>
                                </form>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="full-body">
        <div class="containerR shadow">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="title">Registration</div>
            <div class="content">

            <form id="reg" action="{{ URL::to('/user/registration') }}" method="post">
                @csrf
                <div class="user-details">
                  <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" placeholder="Enter your name" name="fname">
                  </div>
                  <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" placeholder="Enter your name" name="lname">
                  </div>
                  <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" placeholder="Enter your username" name="username">
                  </div>
                  <div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" placeholder="Enter your email" name="email">
                  </div>
                  <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" placeholder="Enter your number" name="phone">
                  </div>
                  <div class="input-box">
                    <span class="details">Address</span>
                    <input type="text" name="address" placeholder="Enter your Address">
                  </div>
                  <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" placeholder="Enter your password" name="password">
                  </div>
                  <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" placeholder="Confirm your password" name="re_password">
                  </div>
                </div>
                <div class="gender-details">
                  <input type="radio" name="gender" id="dot-1" value="male" checked>
                  <input type="radio" name="gender" id="dot-2" value="female">
                  <input type="radio" name="gender" id="dot-3" value="unknown">
                  <span class="gender-title">Gender</span>
                  <div class="category">
                    <label for="dot-1">
                    <span class="dot one"></span>
                    <span class="gender">Male</span>
                  </label>
                  <label for="dot-2">
                    <span class="dot two"></span>
                    <span class="gender">Female</span>
                  </label>
                  <label for="dot-3">
                    <span class="dot three"></span>
                    <span class="gender">Prefer not to say</span>
                    </label>
                  </div>
                </div>
                <div class="button">
                  <input type="submit" value="Register">
                </div>
              </form>
            </div>
          </div>
    </div>

    <script>

        let reg = document.getElementById('reg');
        reg.addEventListener('submit',function(e){
            // e.preventDefault();
            let fname = document.querySelector('#reg input[name="fname"]');
            let lname = document.querySelector('#reg input[name="lname"]');
            let email = document.querySelector('#reg input[name="email"]');
            let phone = document.querySelector('#reg input[name="phone"]');
            let password = document.querySelector('#reg input[name="password"]');
            let re_password = document.querySelector('#reg input[name="re_password"]');
            let username = document.querySelector('#reg input[name="username"]');
            let address = document.querySelector('#reg input[name="address"]');
            console.log(name);

            function validate(values) {
                if(values.value == ''){
                    values.style.setProperty('border-bottom', '2px solid red', 'important');
                    e.preventDefault();
                }else{
                    values.style.setProperty('border-bottom','solid #03e9fe', 'important');
                }
            }
            validate(fname);
            validate(lname);
            validate(email);
            validate(phone);
            validate(password);
            validate(re_password);
            validate(address);
            validate(username);
            if(password.value != re_password.value){
                password.style.setProperty('border-bottom', '2px solid red', 'important');
                re_password.style.setProperty('border-bottom', '2px solid red', 'important');
                e.preventDefault();
            }

        })
    </script>
@endsection
