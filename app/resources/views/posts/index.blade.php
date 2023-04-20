@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="検索" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <span class="input-group-text" id="basic-addon2">検索</span>
                </div>
            </div>
        </div>
        @foreach($posts as $post)
            <div class="row justify-content-center">
                <div class="col-au">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <a href="" class="col card-text">投稿者</a>
                            <a href="{{route('posts.show',$post->id)}}" class="col btn btn-primary">投稿詳細</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
