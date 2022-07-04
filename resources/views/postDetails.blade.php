@extends('.dashboard')
@section('postDetails')
    <h2 class="all-posts-heading">Blog post details</h2>

    <div class="container">
        @foreach($postData as $post)
            <div class="row">
                <div class="col-md-5 mt-3">
                    <img
                        class="img-fluid post-image"
                        src="{{URL::asset('/assets/posts-backgrounds/post-picture.jpg')}}"
                        alt="profile Pic"
                        height="200"
                        width="200"
                    >
                </div>

                <div class="col-md-7 my-3 post-data">
                    <div class="details-data-parent"><span class="mr-3 text-primary">Name: </span>{{ $post->user->name }}</div>
                    <div class="details-data-parent"><span class="mr-3 text-primary">Surname: </span>{{ $post->user->surname }}</div>
                    <div class="text-primary details-data-parent mr-3">Email:
                        <a class="post-picture" href="/user-profile/{{ $post->user->id }}">
                            <div class="d-flex align-items-">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-door-open ml-3 mb-2" viewBox="0 0 16 16">
                                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                                </svg>
                                <h5>{{ $post->user->email }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-5 post-data">
                    <p class="details-heading"><span class="text-primary">heading: </span>{{ $post->heading }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 my-1 post-data">
                    <p>
                        <h2 class="text-primary details-content">content: </h2>
                        <h5>{{ $post->content }}</h5>
                    </p>
                </div>
            </div>

            {{-- comment --}}
            <div class="row">
                <div class="col-md-12 my-1 post-data">
                    <p>
                        <h2 class="text-primary details-content">comments: </h2>

                        @auth
                        <form class="d-flex" action="/add-post/{{$post->id}}" method="POST">
                            @csrf
                            <input
                                type="text"
                                name="comment"
                                class="form-control mr-2"
                                placeholder="Comment"
                            >
                            <button
                                class="btn btn-success ml-2"
                            >
                                Comment
                            </button>
                        </form>
                        <hr>
                    @endauth
                         @foreach($comments as $comment)
                             <h6 class="mt-1">{{ $comment->user->name }}</h6>
                             <h5 class="mb-2">{{ $comment->comment }}</h5>
                             <hr>
                         @endforeach
                    </p>
                </div>
            </div>


        @endforeach
    </div>
@endsection
