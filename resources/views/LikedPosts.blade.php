@extends('.dashboard')
@section('likedPosts')
    <h2 class="all-posts-heading">Liked blog posts</h2>

    <div class="row posts-parent">
        @foreach($LikedPosts as $post)
            <div class="col-md-2 post mx-4">
                <div class="row">
                    <div class="col-md-12 text-danger all-post-heading">
                        {{ $post->heading }}
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
                        {{ $post->content }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 text-primary">
                        <form action="/unlike/{{$post->id}}" method="get">
                            <button class="btn btn-outline-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                    <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="col-md-4 user-name mt-2">
                        <a href="/user-profile/{{ $post->user->id }}">
                            <div class="d-flex align-items-center text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-door-open mr-1 mb-1" viewBox="0 0 16 16">
                                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                                </svg>
                                {{ $post->user->name }}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
