@extends('.dashboard')
@section('deletedPosts')
    <h2 class="all-posts-heading">Deleted posts</h2>

    <div class="row deleted-posts-parent mt-2">
        <div class="col-md-1 deleted-posts-columns">
            <p>#</p>
        </div>
        <div class="col-md-2 deleted-posts-columns">
            <p>Heading</p>
        </div>
        <div class="col-md-5 deleted-posts-columns">
            <p>Content</p>
        </div>
        <div class="col-md-2 deleted-posts-columns">
            <p>Picture</p>
        </div>
        <div class="col-md-2 deleted-posts-columns">
            <p>Action</p>
        </div>
    </div>

    @foreach($authUserTrashedPosts as $post)
        <div class="row deleted-posts-parent mt-2">
            <div class="col-md-1 deleted-posts-columns">
                <p>{{ $post->id }}</p>
            </div>
            <div class="col-md-2 deleted-posts-columns">
                <p>{{ $post->heading }}</p>
            </div>
            <div class="col-md-5 deleted-posts-columns">
                <p>{{ $post->content }}</p>
            </div>
            <div class="col-md-2 deleted-posts-columns">
                <img
                    class="img-fluid mb-3"
                    src="{{URL::asset('/assets/posts-backgrounds/post-picture.jpg')}}"
                    alt="profile Pic"
                    height="80"
                    width="80"
                >
            </div>
            <div class="col-md-2 deleted-posts-action-columns">
                <p>
                    <form action="/restorePost/{{$post->id}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>

                    <form action="/deletePostForever/{{$post->id}}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete forever</button>
                    </form>
                </p>
            </div>
        </div>
    @endforeach
@endsection
