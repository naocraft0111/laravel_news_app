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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
