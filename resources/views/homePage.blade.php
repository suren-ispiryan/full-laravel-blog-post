@extends('dashboard')
@section('homePage')
    <h2 class="all-posts-heading">Followed Blog posts</h2>
    <div class="row posts-parent">
        @foreach($blogPosts as $post)

        @foreach($post->posts as $item)
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
                            {{ $item->content }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-success">
                            <h5 class="text-right text-primary mt-4">{{ $post->name }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection
