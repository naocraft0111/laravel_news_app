@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">記事の編集</div>
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

            <form method="post" action="{{ url('news/edit/' . $news->id ) }}"
                enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>タイトル: </label><br />
                <input class="form-control" type="text" name="title" value="{{ old('title', $news->title) }}" />
            </div>
            <div class="form-group">
                <label>概要: </label><br />
                <input class="form-control" type="text" name="description" value="{{ old('description', $news->description) }}" />
            </div>
            <div class="form-group">
                <label>本文: </label><br />
                <textarea class="form-control" name="body">{{ old('body', $news->body) }}</textarea>
            </div>
            <div class="form-group">
                <label>画像: </label><br />
                @if ($news->image_url)
                <img src="{{ Storage::url($news->image_url) }}" style="width: 150px;" />
                @endif
                <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
                <label>サムネイル: </label><br />
                @if ($news->thumbnail_url)
                <img src="{{ Storage::url($news->thumbnail_url) }}" style="width: 150px;" />
                @endif
                <input type="file" class="form-control" name="thumbnail">
                <p class="text-muted">サムネイルは画像と別に指定することができます</p>
            </div>

            <div class="mt-3">
                <input class="btn btn-primary" type="submit" value="保存" />
            </div>

            </form>

            <hr />
            <form method="post" action="{{ url('news/delete/' . $news->id) }}">
            @csrf
            <input class="btn btn-primary" type="submit" value="記事の削除" />
            </form>
        </div>
    </div>
</div>
@endsection
