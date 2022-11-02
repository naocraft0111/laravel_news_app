@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ $user->name }}からのお知らせ
        </div>
        <div class="card-body">
            <h5>{{ $news->title }}</h5>
            @if($news->image_url)
                <img src="{{ Storage::url($news->image_url) }}" style="width: 150px;" />
            @endif
            <p>create: {{ $news->created_at->format("Y-m-d H:i:s") }}</p>
            <div>
                {!! nl2br(e($news->body)) !!}
            </div>
            <div class="mt-3 text-center">
                <a href="{{ url('u/' . $user->display_name ) }}?embed">一覧に戻る</a>
            </div>

        </div>
    </div>
</div>
<style type="text/css">
#app nav.navbar {
    display: none;
}
</style>
@endsection
