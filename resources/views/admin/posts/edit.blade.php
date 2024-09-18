@extends('layout', ['admin' => true])

@section('title')
    Edit post - {{ Str::limit($post->title, 20) }}
@endsection

@section('content')
    <div class="container">
        <h1>Edit post</h1>
        @if (session('post-updated'))
            <div class="alert alert-success">
                {{ session('post-updated') }}
            </div>
        @endif
        <form method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div>
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="max-width: 200px;" class="thumbnail">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

