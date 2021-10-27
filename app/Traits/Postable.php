<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

trait Postable
{
    public function createPost($body)
    {
        $friendship = (new Post())->fill([
            'body' => $body,
            'status' => Post::PUBLIC,
        ]);

        $this->posts()->save($friendship);

        return $friendship;
    }

    public function updatePost(Model $post, $content = [])
    {
        return $post->update([
           'body' => isset($content['body']) ? $content['body'] : $post->body,
           'status' => isset($content['status']) ? $content['status'] : $post->status,
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
