<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostService
{
    public function getAllPosts()
    {
        return Post::with('user')->get();
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
}
