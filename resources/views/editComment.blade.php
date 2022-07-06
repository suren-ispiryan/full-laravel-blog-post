@extends('.dashboard')
@section('editComment')
    <div class="container update-comment-form-parent">
        <form class="update-comment-form" action="/update-comment/{{$comment->id}}" method="POST">
            <h3>Update comment</h3>
            @csrf
            <input
                type="text"
                value="{{$comment->comment}}"
                class="form-control my-4"
                name="commentEdit"
            >
            <button
                type="submit"
                class="btn btn-success"
            >
                Update
            </button>
        </form>
    </div>
@endsection
