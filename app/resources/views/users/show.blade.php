@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col w-25"><img src="{{ asset('storage/'.$user->icon) }}" class="w-25" alt="..."></div>
        </div>

        <div class="row justify-content-center">
            <div class="col">{{ $user->name }}</div>
            <div class="col">{{ $user->profile }}</div>
        </div>

            <div class="row justify-content-between">
            @foreach($posts as $post)
                <div class="colーauto">
                    <div class="card mt-3" style="width: 18rem;">
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
