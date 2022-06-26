<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('settings.profile.edit', [
            'user' => user(),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        user()
            ->fill($request->handleRequest())
            ->save();

        return back()->with('message', 'Profile has been updated successfully.');
    }
}
