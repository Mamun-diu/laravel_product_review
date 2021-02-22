<?php
    use App\Http\Controllers\MainCategoryController;
    $cat = MainCategoryController::mainCategory();
    // print_r($cat[0]->main_category);
    // die();
?>
<header>
    <div class="containe px-3">
        <a href="{{ URL::to('/') }}" class="company" for="">Review</a>
        <ul class="main-cat">
            <li class="float-start d-none d-lg-inline-block"><a href="">Category</a>
                <ul class="long-cat">
                    @foreach($cat as $value)
                        <li data-main="{{ $value->id }}" class=""><a href="{{ URL::to('/product/filter/') }}/{{ $value->id }}">{{ $value->main_category }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <form id="form" class="d-none d-sm-inline-block mt-0 " id="searchForm" action="{{ URL::to('/search/result') }}" method="get" >
            @csrf
            <div id="main_search" class="input-group ">
                <input id="search"  class="form-control" type="text" placeholder="What are you looking for?" autocomplete="off" name="search" value="" >

                <!--<button id="go" type="submit" class="input-group-text">Go</button> -->

                <i class="fas fa-search"></i>

            </div>
        </form>


        <div class="d-inline-block d-lg-none float-end m-2 res-btn">
            <i class="fas fa-bars"></i>
        </div>

        <ul class="d-none d-lg-inline-block float-end like main-cat">
            <li class="float-start pt-2" id="fav" ><a  href="{{ URL::to('user/favourite') }}" ><i data-bs-toggle="tooltip" title="Favourite" class="fas fa-heart" ></i></a></li>
            <li class="float-start pt-2"><a href="{{ URL::to('user/rated') }}"><i data-bs-toggle="tooltip" title="Rated" class="fas fa-star"></i></a></li>
            <!-- <li><a href="#">Home</a></li> -->
            @if(Session::has('user'))
                <li class="float-start pt-2"><a href="#">{{ Session::get('user.fname', 'default') }}</a></li>
                <button class="btn btn-outline-secondary dropdown-toggle setting" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ URL::to('/user/profile') }}">Profile</a></li>

                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="{{ URL::to('/logout') }}">Logout</a></li>
                </ul>
            @else
                <li class="float-start pt-2"><a href="{{ URL::to('/login') }}">Login</a></li>
            @endif
        </ul>

    </div>
</header>
<div class="res-menu">

</div>
<div class="right-menu">
    <ul class="like">
        <form id="formR" class="d-inline-block d-sm-none mt-0" id="searchForm" action="{{ URL::to('/search/result') }}" method="get" >
            @csrf
            <div id="main_searchR" class="input-group ">
                <input id="searchR"  class="form-control" type="text" placeholder="What are you looking for?" autocomplete="off" name="search" value="" >

                <!--<button id="go" type="submit" class="input-group-text">Go</button> -->

                <i class="fas fa-search"></i>

            </div>
        </form>
        <li class="" id="fav" ><a class=""  href="{{ URL::to('user/favourite') }}" >View Your Favourite</a></li>
        <li class=""><a class="" href="{{ URL::to('user/rated') }}">View Your Rated</a></li>
        <!-- <li><a href="#">Home</a></li> -->
        @if(Session::has('user'))
            <div style="position : relative">
                <li><a href="#">{{ Session::get('user.fname', 'default') }}</a></li>
                <button class="btn btn-outline-secondary dropdown-toggle setting" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></button>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ URL::to('/user/profile') }}">Profile</a></li>

                    <li><hr class="dropdown-divider"></li>

                    <li><a class="dropdown-item" href="{{ URL::to('/logout') }}">Logout</a></li>
                </ul>
            </div>
        @else
            <li class=""><a href="{{ URL::to('/login') }}">Login</a></li>
        @endif
    </ul>

    <h4 class="border-bottom p-2 mt-3">Category</h4>
    <ul class="category">
        @foreach($cat as $value)
            <li data-main="{{ $value->id }}" class=""><a href="{{ URL::to('/product/filter/') }}/{{ $value->id }}">{{ $value->main_category }}</a></li>
        @endforeach
    </ul>
</div>

<script>

    let res_btn = document.querySelector('.res-btn i');
    let res_menu = document.querySelector('.res-menu');
    let right_menu = document.querySelector('.right-menu');
    res_btn.addEventListener('click',function(){
        res_menu.style.display = 'block';
        right_menu.style.display = 'block';
        document.querySelector('body').style.overflowY = 'hidden';
        var pos = -300;
        var timer = setInterval(() => {
            if(pos==0){
                clearInterval(timer);
            }else{
                pos+=3;
                right_menu.style.right = pos+'px';
            }
        }, 1);
    });
    res_menu.addEventListener('click',function(){
        var pos = 0;
        var timer = setInterval(() => {
            if(pos==-300){
                clearInterval(timer);
                res_menu.style.display = 'none';
                right_menu.style.display = 'none';
                 document.querySelector('body').style.overflowY = 'scroll';
            }else{
                pos-=3;
                right_menu.style.right = pos+'px';
            }
        }, 1);
    })


</script>
