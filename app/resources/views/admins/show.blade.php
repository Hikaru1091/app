@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('admins.show', $id) }}">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" placeholder="検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                            <button type="submit" class="input-group-text">検索</button>
                            <button class="input-group-text"><a href="{{ route('admins.show', $id) }}" class="text">クリア</a></button>
                        </div>
                    </div>
                </div>
            </form>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">タイトル</th>
                        <th scope="col">内容</th>
                    </tr>
                </thead>
                @foreach($posts as $post)
                <tbody>
                    <tr>
                        <td scope="row"><a href="{{ route('posts.show', $post->id) }}">{{ $post->id }}</a></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                        <td><form action="{{route('admins.destroy', $post->id)}}" method="post">
                            @csrf
                            @method('delete')
                                <input type="submit" value="削除" class="btn btn-danger p-2 bd-highlight" onclick='return confirm("削除しますか");'>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
