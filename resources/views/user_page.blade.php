@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ $user->name }}からのお知らせ
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($news_list as $news)
                <li class="list-group-item">
                    <a href="{{ url('u/' . $user->display_name . '/' . $user->id) }}">
                        <h5>{{ $news->title}}</h5>
                    </a>
                    <div class="row">
                        @if ($news->thumbnail_url || $news->image_url)
                        <div class="col">
                            @if ($news->thumbnail_url)
                            <img src="{{ Storage::url($news->thumbnail_url) }}" style="width: 150px;" />
                            @elseif($news->image_url)
                            <img src="{{ Storage::url($news->image_url) }}" style="width: 150px;" />
                            @endif
                        </div>
                        @endif
                        <div class="col">
                            <p>{{ $news->description }}</p>
                            <p>create: {{ $news->created_at->format("Y-m-d H:i:s") }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="mt-3">
                {{ $news_list->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
