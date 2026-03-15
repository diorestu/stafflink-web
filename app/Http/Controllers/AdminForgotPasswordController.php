<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminForgotPasswordController extends Controller
{
    private const ALLOWED_ADMIN_ROLES = ['super_admin', 'admin', 'booking_checker'];

    public function showLinkRequestForm(): View
    {
        return view('admin.password.forgot');
    }

    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = trim((string) $validated['email']);
        $isAdminAccount = User::query()
            ->where('email', $email)
            ->whereIn('role', self::ALLOWED_ADMIN_ROLES)
            ->exists();

        if (! $isAdminAccount) {
            return back()->with('status', 'If your email is registered, we have sent a password reset link.');
        }

        $status = Password::broker('users')->sendResetLink([
            'email' => $email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Reset password link has been sent to your email.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $this->forgotPasswordStatusMessage($status)]);
    }

    public function showResetForm(Request $request, string $token): View
    {
        return view('admin.password.reset', [
            'token' => $token,
            'email' => (string) $request->query('email', ''),
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $email = trim((string) $validated['email']);
        $isAdminAccount = User::query()
            ->where('email', $email)
            ->whereIn('role', self::ALLOWED_ADMIN_ROLES)
            ->exists();

        if (! $isAdminAccount) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'This account is not allowed to access the admin portal.']);
        }

        $status = Password::broker('users')->reset(
            [
                'email' => $email,
                'password' => (string) $validated['password'],
                'password_confirmation' => (string) $request->input('password_confirmation', ''),
                'token' => (string) $validated['token'],
            ],
            function (User $user, string $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', 'Password has been reset successfully. Please sign in.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => $this->resetPasswordStatusMessage($status)]);
    }

    private function forgotPasswordStatusMessage(string $status): string
    {
        return match ($status) {
            Password::RESET_THROTTLED => 'Please wait a moment before requesting another reset link.',
            Password::INVALID_USER => 'If your email is registered, we have sent a password reset link.',
            default => 'Unable to send reset link right now. Please try again.',
        };
    }

    private function resetPasswordStatusMessage(string $status): string
    {
        return match ($status) {
            Password::INVALID_TOKEN => 'This reset link is invalid or has expired. Please request a new one.',
            Password::INVALID_USER => 'The provided account cannot be reset from this portal.',
            default => 'Unable to reset password right now. Please try again.',
        };
    }
}
