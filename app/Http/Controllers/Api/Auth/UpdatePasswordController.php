<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use App\Http\Resources\Auth\AuthProfileResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdatePasswordController extends Controller
{
    public function __invoke(UpdatePasswordRequest $request)
    {
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages(['Wrong password']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return new AuthProfileResource(auth()->user());
    }
}
