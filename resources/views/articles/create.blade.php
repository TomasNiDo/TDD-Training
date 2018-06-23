@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Create Article</div>

                <div class="card-body">
                    <form action="{{ url('/articles') }}" method="post" class="form">
                        @csrf

                        <label>Title</label>
                        <input type="text" name="title" class="form-control">

                        <label>Content</label>
                        <textarea name="content" class="form-control"></textarea>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
