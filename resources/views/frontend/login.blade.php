@extends('frontend/master')

@section('content')
    <div class="">
        {{-- <div class="container ">

            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div id="login" class="login-before">
                        <div class="card" style="">
                            <div class="card-body">
                                <h5 class="card-title text-center border-bottom p-2">User Login</h5>
                                <form action="{{ URL::to('/user/login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control mt-1" name="email" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control mt-1" name="password" placeholder="Enter Password...">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
                                    <a class="no-account" href="{{ URL::to('/user/registration') }}">I have no account!</a>
                                </form>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div> --}}
    <img class="wave" src="{{ asset('public/icon/wave.png') }}">
	<div class="containers">
		<div class="img">
			<img src="{{ asset('public/icon/bg.svg') }}">
		</div>
		<div class="login-content">
			<form action="{{ URL::to('/user/login') }}" method="post">
                @csrf
				<img src="{{ asset('public/icon/avatar.svg') }}">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email or Username</h5>
                        <input type="text" class="input"  name="email" autocomplete="off">
           		   		{{-- <input type="text" class="input"> --}}
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
                        <input type="password" class="input"  name="password" >
           		    	{{-- <input type="password" class="input"> --}}
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
                <a class="text-primary" href="{{ URL::to('/user/registration') }}">I have no account.</a>
            </form>
        </div>
    </div>
    </div>

    <script>
        const inputs = document.querySelectorAll(".input");
        function addcl(){
            let parent = this.parentNode.parentNode;
            parent.classList.add("focus");
        }

        function remcl(){
            let parent = this.parentNode.parentNode;
            if(this.value == ""){
                parent.classList.remove("focus");
            }
        }


        inputs.forEach(input => {
            input.addEventListener("focus", addcl);
            input.addEventListener("blur", remcl);
        });
    </script>
@endsection
