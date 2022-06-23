@extends('./.layout.main')
@section('dashboard')
    <section class="container-fluid">
        <div class="row nav-parent mt-2">
            <div class="col-md-2 auth-user-greeting">
                @auth
                    Welcome {{ Auth::user()->name }}
                @endauth
                    @guest
                        Welcome as a Guest
                    @endguest
            </div>

            <div class="col-md-8 nav">
                <ul>
                    <li class="navbar-items btn">
                        <a href="/" class="{{ (request()->is('/')) ? 'active' : 'text-success' }}">All posts</a>
                    </li>
                @auth
                    <li class="navbar-items btn">
                        <a href="/create-post" class="{{ (request()->is('create-post')) ? 'active' : 'text-success' }}">Create</a>
                    </li>
                    <li class="navbar-items btn">
                        <a href="/auth-user-posts" class="{{ (request()->is('auth-user-posts')) ? 'active' : 'text-success' }}">My posts</a>
                    </li>
                    <li class="navbar-items btn">
                        <a href="/liked-user-posts" class="{{ (request()->is('liked-user-posts')) ? 'active' : 'text-success' }}">Liked posts</a>
                    <li>
                @endauth
            </div>

            <div class="col-md-2 control-buttons">
                @guest
                    <form action="/login" method="GET" class="mr-2">
                        <button class="btn btn-primary">Login -></button>
                    </form>
                @endguest
                @auth
                    <form action="/log-out" method="GET" class="mr-2">
                        <button class="btn btn-danger">Log out -></button>
                    </form>
                @endauth
            </div>
        </div>

        <hr>

        <div class="container-fluid p-3">
            @auth
                <div class="row create-parent">
                    <div class="col-md-4">
                        @yield('create')
                    </div>

                    <div class="col-md-12">
                        @yield('allPosts')
                        @yield('myPosts')
                        @yield('likedPosts')
                    </div>
                </div>
            @endauth

            @guest
                <div class="row">
                    <div class="col-md-12">
                        @yield('allPosts')
                    </div>
                </div>
            @endguest
        </div>
    </section>
@endsection
