<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Postable
{
    public function createPost($content = [])
    {
        $friendship = (new Post())->fill([
            'body' => $content['body'] ?? '',
            'status' => $content['status'] ?? Post::PUBLIC,
            'uuid' => Str::uuid()->toString(),
        ]);

        $this->posts()->save($friendship);

        return $friendship;
    }

    public function updatePost(Model $post, $content = [])
    {
        return $post->update([
            'body' => $content['body'] ?? $post->body,
            'status' => $content['status'] ?? $post->status,
        ]);
    }

    public function softDeletePost(Model $post)
    {
        return $post->delete();
    }

    public function restorePost(Model $post)
    {
        return $post->restore();
    }

    public function hardDeletePost(Model $post)
    {
        return $post->forceDelete();
    }

    public function hasPost()
    {

    }

    public function showPosts()
    {
        return $this->posts()->get();
    }
}
