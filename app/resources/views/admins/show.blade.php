@extends('layouts.app')

@section('content')
<div class="container">
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
                        <a href="{{ route('posts.show', $post->id) }}"><th scope="row">{{ $post->id }}</th></a>
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
