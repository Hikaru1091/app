@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="GET" action="{{ route('posts.index') }}">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control" placeholder="検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                        <button type="submit" class="input-group-text">検索</button>
                        <button class="input-group-text"><a href="{{ route('posts.index') }}" class="text">クリア</a></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($posts as $post)
                <div class="col-auto">
                    <div class="card border-primary mt-5" style="width: 20rem;">
                        <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->user->name }}</p>
                            <a href="{{route('posts.show',$post->id)}}" class="col btn btn-info">投稿詳細</a>
                            @if($like_model->like_exist(Auth::user()->id,$post->id))
                            <p class="favorite-marke">
                                <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                                <span class="likesCount">{{$post->likes_count}}</span>
                            </p>
                            @else
                            <p class="favorite-marke">
                                <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a>
                                <span class="likesCount">{{$post->likes_count}}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<style>
    .loved i {
        color: #00ff00 !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(function () {
    var like = $('.js-like-toggle');
    var likePostId;
    
    like.on('click', function () {
        console.log(likePostId);
        var $this = $(this);
        likePostId = $this.data('postid');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajaxlike',  
                type: 'POST', 
                data: {
                    'post_id': likePostId 
                },
        })
    
            .done(function (data) {
                $this.toggleClass('loved'); 
    
                $this.next('.likesCount').html(data.postLikesCount); 
    
            })
            .fail(function (data, xhr, err) {
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });
        
        return false;
    });
    });
</script>
