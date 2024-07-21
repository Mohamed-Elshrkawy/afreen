<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Notifications\ValidationEmail;


class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {

        $user = User::create(array_merge(
                    $request->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        $user->notify(new ValidationEmail());
        return response()->json([
            'message' => 'User successfully registered',
        ], 201);
    }

}
