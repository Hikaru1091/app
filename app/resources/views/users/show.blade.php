@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-6 text-center"><img src="{{ asset('storage/'.$user->icon) }}" class="w-50 rounded-circle" alt="..."></div>
        </div>

        <div class="row justify-content-center">
            <div class="col text-center mt-5 lead">{{ $user->name }}</div>
            <div class="col text-center mt-5 lead">{{ $user->profile }}</div>
        </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($posts as $post)
                <div class="col">
                    <div class="card mt-5 border-primary" style="width: 20rem;">
                        <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="{{route('posts.show',$post->id)}}" class="col btn btn-primary">投稿詳細</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
@endsection
