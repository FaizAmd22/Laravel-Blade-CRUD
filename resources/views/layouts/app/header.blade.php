<header class="p-3 text-bg-dark mb-3">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-space-between justify-content-lg-start">
            <ul class="nav col-6 col-lg-auto me-lg-auto mb-2 mb-md-0">
                <li><a href="{{ url('posts') }}" class="nav-link px-2 text-secondary">Home</a></li>
            </ul>

            <div class="col-6 text-end">
                @if(!Auth::check() && Request::is('login'))
                    <a href="{{ url('register') }}" class="btn btn-outline-light me-2">Register</a>
                @elseif(!Auth::check())
                    <a href="{{ url('login') }}" class="btn btn-outline-light me-2">Login</a>
                @else
                    <a href="{{ url('logout') }}" class="btn btn-outline-light me-2">Logout</a>
                @endif
            </div>
        </div>
    </div>
</header>