<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPasswordController extends Controller
{
    public function edit()
    {
        return view('admin.password.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ]);

        $user = $request->user();
        $user->update([
            'password' => $validated['password'],
        ]);

        Auth::logoutOtherDevices($validated['password']);
        $request->session()->regenerate();

        return redirect()
            ->route('admin.password.edit')
            ->with('success', 'Password updated successfully.');
    }
}
