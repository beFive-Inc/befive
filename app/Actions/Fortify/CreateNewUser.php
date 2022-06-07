<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'pseudo' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'pseudo' => $input['pseudo'],
            'slug' => Str::slug($input['pseudo']),
            'uuid' => Str::uuid(),
            'hashtag' => '3333',
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->status()
            ->create([
                'user_id' => $user->id,
                'type_id' => 1
            ]);

        return $user;
    }
}
