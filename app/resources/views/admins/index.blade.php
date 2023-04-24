@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">名前</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($users as $user)
                <tbody>
                    <tr>
                        <td scope="row"><a href="{{ route('admins.show', $user->id) }}">{{ $user->id }}</a></td>
                        <td>{{ $user->name }}</td>
                        <td><form action="{{route('users.destroy', $user->id)}}" method="post">
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
