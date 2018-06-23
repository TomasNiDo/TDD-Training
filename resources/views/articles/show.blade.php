@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">{{ $article->title }}</div>

                <div class="card-body">
                    {{ $article->content }}
                </div>
            </div>

            @can('update', $article)
                <a href="{{ url('/articles/' . $article->id . '/edit') }}" class="btn btn-primary">Update</a>
            @endcan

            @can('delete', $article)
                <form action="{{ url('/articles/' . $article->id . '') }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection
