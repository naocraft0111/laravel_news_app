@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">記事の作成</div>
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

            <form method="post" action="{{ url('news/create') }}">
            @csrf
            <div class="form-group">
                <label>タイトル: </label><br />
                <input class="form-control" type="text" name="title" value="{{ old('title') }}" />
            </div>
            <div class="form-group">
                <label>概要: </label><br />
                <input class="form-control" type="text" name="description" value="{{ old('description') }}" />
            </div>
            <div class="form-group">
                <label>本文: </label><br />
                <textarea class="form-control" name="body">{{ old('body') }}</textarea>
            </div>

            <div class="mt-3">
                <input class="btn btn-primary" type="submit" value="作成" />
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
