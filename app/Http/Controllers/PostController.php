<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function store(Request $request)
    {
        Auth::user()->createPost([
            'body' => $request->body,
            'status' => $request->status,
        ]);

        return redirect()->route('homepage');
    }

    public function create()
    {
        //
    }

    public function edit(Post $post)
    {
        return view('', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        Auth::user()->updatePost($post, [
            'body' => $request->body,
            'status' => $request->status,
        ]);

        return redirect()->route('homepage');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        Auth::user()->softDeletePost($post);
    }

    public function forceDelete(Post $post)
    {
        $this->authorize('forceDelete', $post);

        Auth::user()->hardDeletePost($post);
    }

    public function restore(Post $post)
    {
        $this->authorize('restore', $post);

        Auth::user()->restorePost($post);
    }
}
