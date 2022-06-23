@extends('.dashboard')
@section('myPosts')
    <h2 class="all-posts-heading">My blog posts</h2>

    <div class="row posts-parent">
        @foreach( $authUserPosts as $post)
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
                    <div class="col-md-12 action-container text-success">
                        <form action="/update-post/{{$post->id}}" method="get">
                            <button class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                </svg>
                            </button>
                        </form>

                        <form action="/delete-post/{{$post->id}}" method="get">
                            <button class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
