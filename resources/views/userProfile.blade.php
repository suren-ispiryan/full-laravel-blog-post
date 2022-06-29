@extends('dashboard')
@section('userProfile')
    <div class="container">

        {{-- profile data --}}
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-primary profile-sections-heading">Profile data</h3>
            </div>
            <div class="col-md-5 mt-3">
                <img
                    class="img-fluid user-image"
                    src="{{URL::asset('/assets/user-profile-image/user-avatar.jpg')}}"
                    alt="profile Pic"
                    height="200"
                    width="200"
                >
            </div>

            <div class="col-md-7 mt-5 user-data">
                <p><span class="text-primary">Name: </span>{{$data[0]->user->name}}</p>
                <p><span class="text-primary">Surname: </span>{{$data[0]->user->surname}}</p>
                <p><span class="text-primary">Email: </span>{{$data[0]->user->email}}</p>
                @if(!request()->is('my-profile/*'))
                    <a href="/follow/{{$data[0]->user->id}}">
                        <button class="btn btn-primary mt-2">Follow</button>
                    </a>
                    <a href="/unfollow/{{$data[0]->user->id}}">
                        <button class="btn btn-primary mt-2">Unfollow</button>
                    </a>
                @endif
                @if(request()->is('my-profile/*'))
                    <div class="row">
                       <div class="col-md-6">
                           <form action="/change-password" method="POST">
                               @csrf

                               <input
                                   type="password"
                                   class="form-control mt-2"
                                    name="passwordChange"
                                   placeholder="Write a new password"
                               >
                               <input
                                   type="password"
                                   class="form-control mt-2"
                                   name="repeatPasswordChange"
                                   placeholder="Repeat a new password"
                               >
                               <button
                                   class="btn btn-warning mt-2"
                               >
                                   Change password
                               </button>
                           </form>
                       </div>
                        <div class="col-md-6"></div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Posts --}}
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-primary profile-sections-heading">Blog posts</h3>
            </div>

            <div class="row posts-parent profile-posts-parent">
                @foreach($data as $post)
                    <div class="col-md-3 post mx-4">
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
                            <div class="col-md-12 text-success mx-3">
                                {{ $post->content }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
