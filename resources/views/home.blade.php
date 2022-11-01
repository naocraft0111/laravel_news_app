@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ url('/news/create') }}" class="btn btn-primary">記事作成</a>
                    </div>

                    <ul class="list-group">
                        @foreach ($news_list as $news)
                        <li class="list-group-item">
                            <a href="{{ url('news/edit/' . $news->id) }}">
                                <h5>{{ $news->title }}</h5>
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
                                    <p class="text-right">
                                        <a href="{{ url('u/' . $user->display_name . '/' . $news->id) }}" class="btn btn-outline-secondary">確認</a>
                                    </p>
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
    </div>
</div>
@endsection
