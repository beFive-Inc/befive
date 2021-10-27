<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
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

    public function edit(Post $post)
    {
        dd($post);
    }

    public function update(Request $request, Post $post)
    {
        Auth::user()->updatePost($post, [
            'body' => $request->body,
            'status' => $request->status,
        ]);

        return redirect()->route('homepage');
    }

    public function delete()
    {

    }

    public function forceDelete()
    {

    }

    public function restore()
    {

    }
}
