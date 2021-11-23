<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

Trait Stepable
{
    public function storeFirstStep($request)
    {
        if(isset($data['name'])) {
            auth()->user()->update([
                'name' => $data['name'],
            ]);
        }

        if ($request->hasFile('profilpic')) {
            $name = Str::uuid() . '.' . $request->file('profilpic')->extension();
            $request->file('profilpic')->storeAs('images', $name);
            auth()->user()
                ->addMedia(storage_path('app/public/images/' . $name))
                ->toMediaCollection('user_profil_pic');
        }
        if ($request->hasFile('bannerpic')) {
            $name = Str::uuid() . '.' . $request->file('bannerpic')->extension();
            $request->file('bannerpic')->storeAs('images', $name);
            auth()->user()
                ->addMedia(storage_path('app/public/images/' . $name))
                ->toMediaCollection('user_banner_pic');
        }

        Cookie::queue('has-done-step-1', true, 60 * 60 * 24 * 365 * 10);
    }
}
