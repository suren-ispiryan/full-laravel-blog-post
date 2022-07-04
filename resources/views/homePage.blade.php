@extends('dashboard')
@section('homePage')
    <h2 class="all-posts-heading">Followed Blog posts</h2>
    <div class="row posts-parent">
        @foreach($blogPosts as $post)
            @foreach($post->posts as $item)
                <a href="/post-details/{{ $item->id }}">
                    <div class="col-md-2 post mx-4">
                        <div class="row">
                            <div class=" col-md-12 text-danger all-post-heading">
                                {{ $item->heading }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12 text-danger all-post-heading">
                                <img
                                    class="img-fluid"
                                    src="{{URL::asset('/assets/posts-backgrounds/post-picture.jpg')}}"
                                    alt="profile Pic"
                                    height="200"
                                    width="200"
                                >
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12 text-success">
                                {{ substr($item->content, 0, 10) }} ...
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-success">
                                <a href="/user-profile/{{ $post->id }}">
                                    <div class="d-flex align-items-center text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-door-open mr-1 mb-1" viewBox="0 0 16 16">
                                            <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                            <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                                        </svg>
                                        <h5 class="mt-2">{{ $post->name }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @endforeach
    </div>
@endsection
