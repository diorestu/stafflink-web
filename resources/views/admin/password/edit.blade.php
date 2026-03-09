@extends('admin.layout')

@section('page-title', 'Change Password')

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="rounded-t-xl border-b bg-gray-50/60 px-8 py-6">
                <h3 class="text-lg font-semibold text-gray-900">Change Password</h3>
                <p class="mt-1 text-sm text-gray-500">Update your admin account password.</p>
            </div>

            <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-8 p-8">
                @csrf
                @method('PUT')

                <div class="grid gap-6">
                    <div>
                        <label for="current_password" class="mb-2 block text-sm font-medium text-gray-700">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-[#287854] focus:outline-none focus:ring-2 focus:ring-[#287854]/20"
                        >
                        @error('current_password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-700">New Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-[#287854] focus:outline-none focus:ring-2 focus:ring-[#287854]/20"
                        >
                        <p class="mt-2 text-sm text-gray-500">Use at least 8 characters.</p>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-[#287854] focus:outline-none focus:ring-2 focus:ring-[#287854]/20"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between border-t pt-6">
                    <a href="{{ route('admin.dashboard') }}" class="font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                    <button type="submit" class="rounded-lg bg-[#287854] px-6 py-2.5 font-medium text-white hover:bg-[#1f5f46]">
                        Save Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
