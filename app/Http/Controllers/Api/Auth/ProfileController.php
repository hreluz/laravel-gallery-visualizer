<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\AuthProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @return AuthProfileResource
     */
    public function show(): AuthProfileResource
    {
        return new AuthProfileResource(auth()->user());
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,'. auth()->user()->id]
        ]);

        auth()->user()->update($validated);

        return new AuthProfileResource(auth()->user());
    }
}
