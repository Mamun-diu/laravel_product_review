
<nav>
    <a href="{{ URL::to('/') }}" class="company" for="">Review</a>
    <form class="d-inline-block" id="searchForm" action="" >
        <div style="height:50px;" class="input-group ">
            <input id="search"  class="form-control" type="text" placeholder="What are you looking for?" autocomplete="off" name="search" value="">
            <button id="go" type="submit" class="input-group-text">Go</button>

        </div>
    </form>
    <ul>
        <li id="fav" ><a  href="#" ><i data-bs-toggle="tooltip" title="Favourite" class="fas fa-heart" ></i></a></li>
        <li><a href="#"><i data-bs-toggle="tooltip" title="Rated" class="fas fa-star"></i></a></li>
        {{-- <li><a href="#">Home</a></li> --}}
        <li><a href="{{ URL::to('/login') }}">Login</a></li>

        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
    </ul>
</nav>

