<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Postable
{
    public function createPost($content = []): Post
    {
        $newPost = (new Post())->fill([
            'body' => $content['body'] ?? '',
            'status' => $content['status'] ?? Post::PUBLIC,
            'uuid' => Str::uuid()->toString(),
        ]);

        $this->posts()->save($newPost);

        return $newPost;
    }

    public function updatePost(Post $post, $content = []): ?bool
    {
        return $post->update([
            'body' => $content['body'] ?? $post->body,
            'status' => $content['status'] ?? $post->status,
        ]);
    }

    public function archivePost(Post $post): ?bool
    {
        return $post->delete();
    }

    public function restorePost(Post $post): ?bool
    {
        return $post->restore();
    }

    public function deletePost(Post $post): ?bool
    {
        return $post->forceDelete();
    }

    public function hasPost()
    {

    }

    public function showPosts(): Collection
    {
        return $this->posts()->get();
    }

    public function showPublicStatusPosts(): Collection
    {
        return $this->posts()->get()->filter(function ($post) {
            return $post->isPublic;
        });
    }

    public function showPrivateStatusPosts(): Collection
    {
        return $this->posts()->get()->filter(function ($post) {
            return $post->isPrivate;
        });
    }

    public function showFriendsStatusPosts(): Collection
    {
        return $this->posts()->get()->filter(function ($post) {
            return $post->isFriends;
        });
    }
}
