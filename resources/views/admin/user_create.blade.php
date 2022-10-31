@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">ユーザー新規登録</div>
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

            <form method="post" action="{{ url('admin/user/create') }}">
            @csrf
            <div class="form-group">
                名前: <input class="form-control" type="text" name="name" value="" />
                <p class="text-muted">表示名は自由に設定できます</p>
            </div>
            <div class="form-group">
                Email: <input class="form-control" type="email" name="email" value="" />
            </div>
            <div class="form-group">
                表示名: <input class="form-control" type="email" name="display_name" value="" />
                <p class="text-muted">半角英数字(30文字以内)</p>
            </div>
            <div class="form-group">
                ログインパスワード: <input class="form-control" type="password" name="password" value="" />
            </div>
            <div class="form-group">
                ログインパスワード (確認) : <input class="form-control" type="password" name="password_confirmation" value="" />
            </div>
            <div class="mt-3">
                <input class="btn btn-primary" type="submit" value="作成" />
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
