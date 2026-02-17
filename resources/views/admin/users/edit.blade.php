@extends('admin.layout')

@section('page-title', 'Edit User')

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="rounded-t-xl border-b bg-gray-50/60 px-8 py-6">
                <h3 class="text-lg font-semibold text-gray-900">Edit User</h3>
                <p class="mt-1 text-sm text-gray-500">Update profile and role settings.</p>
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-8 p-8">
                @csrf
                @method('PUT')
                @include('admin.users._form', ['user' => $user])

                <div class="flex items-center justify-between border-t pt-6">
                    <a href="{{ route('admin.users.index') }}" class="font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                    <button type="submit" class="rounded-lg bg-[#287854] px-6 py-2.5 font-medium text-white hover:bg-[#1f5f46]">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
