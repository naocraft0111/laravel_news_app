@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/user_list') }}">ユーザー一覧</a> &gt; ユーザー詳細
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
            @endif

            <form method="post" action="{{ url('admin/user/' . $user->id) }}">
            @csrf
                <ul class="list-group">
                    <li class="list-group-item">
                        <label>名前: </label>
                        <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" />
                    </li>
                    <li class="list-group-item">
                        <label>メール: </label>
                        <input class="form-control" type="text" name="email" value="{{ old('email', $user->email) }}" />
                    </li>
                    <li class="list-group-item">
                        <label>表示名: </label>
                        <input class="form-control" type="text" name="display_name" value="{{ old('display_name', $user->display_name) }}" />
                    </li>
                    <li class="list-group-item">作成日: {{ $user->created_at->format('Y/m/d H:i:s') }}</li>
                    <li class="list-group-item">更新日: {{ $user->updated_at->format('Y/m/d H:i:s') }}</li>
                </ul>
                <div class="mt-3 text-center">
                    <input class="btn btn-primary" type="submit" value="変更" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
