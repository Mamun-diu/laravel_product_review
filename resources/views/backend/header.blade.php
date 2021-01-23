<nav id="nav" class="sticky-top">
    <a href="#">Review</a>
    <ul>
        <li><a href="#">{{ Str::ucfirst(Session::get('admin.name')) }}</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="{{ URL::to('admin/logout') }}">Logout</a></li>
    </ul>
</nav>
