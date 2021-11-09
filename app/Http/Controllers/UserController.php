<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('team', 'games')->paginate(50);

        return view('app.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('app.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('app.users.edit', compact('user'));
    }

    public function update(User $user)
    {
        return false;
    }

    public function archive(User $user)
    {
        return false;
    }

    public function restore(User $user)
    {
        return false;
    }
}
