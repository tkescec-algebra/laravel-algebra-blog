<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!$posts = $this->postService->getAllPosts()) {
            abort(400);
        }

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // TODO: uncomment this line if method create is changed in the policy
        // Gate::authorize('create', Post::class);

        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // TODO: uncomment this line if method create is changed in the policy
        // Gate::authorize('create', Post::class);

        if (!$this->postService->storePost($request)) {
            return redirect()->back()->with('post-created', 'Post not created');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        Gate::authorize('view', $post);
        dd($post);
        //return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (!$this->postService->updatePost($request, $post)) {
            return redirect()->back()->with('post-updated', 'Post not updated');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!$this->postService->deletePost($post)) {
            return redirect()->back()->with('post-deleted', 'Post not deleted');
        }

        return redirect()->route('posts.index');
    }
}
