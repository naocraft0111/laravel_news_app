@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">管理側TOP</div>
        <div class="card-body">
            <div>
                <a href="{{ url('admin/user_list') }}" class="btn btn-primary">ユーザー一覧</a>
                <a href="{{ url('admin/user/create') }}" class="btn btn-primary">ユーザー作成</a>
            </div>

            <form method="post" action="{{ url('admin/logout') }}">
            @csrf
                <input class="btn btn-danger" type="submit" value="ログアウト" />
        </div>
    </div>
</div>
@endsection
