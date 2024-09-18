@extends('layout', ['admin' => true])

@section('title', 'Posts')
@section('content')
    <div class="container">
        <h1>Posts</h1>
        <p><a href="{{ route('posts.create') }}">Create a new post</a></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->first_name }} {{ $post->user->last_name }}</td>
                        <td>{{ $post->created_at->format('d.m.Y. H:i') }}</td>
                        <td>
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form method="post" action="{{ route('posts.destroy', ['post' => $post->id]) }}" style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mx-auto my-2">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
