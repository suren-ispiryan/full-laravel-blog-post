@extends('.dashboard')
@section('create')
    <form action="/create" method="POST" class="form-create p-4">

        @csrf

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <p class="alert alert-danger my-2">{{ $error }}</p>
            @endforeach
        @endif

        @isset($successMsg)
            <p class="text-success text-center">{{ $successMsg }}</p>
        @endisset

        <h2>Create a post</h2>

        <input
            type="text"
            name="heading"
            class="form-control mt-4"
            placeholder="Heading"
        >

        <textarea
            name="content"
            class="form-control mt-4"
            placeholder="Write a post"
            rows="4" cols="50"
        ></textarea>

        <button class="btn btn-success mt-4">Create post</button>
    </form>
@endsection
