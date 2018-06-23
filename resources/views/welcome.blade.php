@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">Articles</h1>

            @foreach ($articles as $article)
            <div class="card mb-3">
                <div class="card-header">
                    <a href="{{ url('/articles/' . $article->id) }}">{{ $article->title }}</a>
                </div>

                <div class="card-body">
                    {{ $article->content }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
