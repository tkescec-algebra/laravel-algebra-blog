<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    public function getAllPosts()
    {
        if(auth()->user()->cannot('viewAny', Post::class)) {
            return Post::with('user')
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }

        return Post::with('user')->orderBy('created_at', 'desc')->paginate(5);
    }

    public function storePost(FormRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->getKey();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            Post::create($data);

            return true;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function updatePost(FormRequest $request, Post $post)
    {
        try {
            $data = $request->validated();
            //$user_id = $request->user()->getKey();

            if ($request->hasFile('image')) {
                $oldImage = $post->image;
                if ($oldImage) {
                    //unlink(storage_path('app/public/' . $oldImage));
                    Storage::disk('public')->delete($oldImage);
                }
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            $post->update($data);

            return true;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function deletePost(Post $post)
    {
        try {

            $post->delete();

            return true;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
