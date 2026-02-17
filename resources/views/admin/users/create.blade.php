@extends('admin.layout')

@section('page-title', 'Add User')

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="rounded-t-xl border-b bg-gray-50/60 px-8 py-6">
                <h3 class="text-lg font-semibold text-gray-900">Create User</h3>
                <p class="mt-1 text-sm text-gray-500">Create a new admin account and assign role.</p>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-8 p-8">
                @csrf
                @include('admin.users._form')

                <div class="flex items-center justify-between border-t pt-6">
                    <a href="{{ route('admin.users.index') }}" class="font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                    <button type="submit" class="rounded-lg bg-[#287854] px-6 py-2.5 font-medium text-white hover:bg-[#1f5f46]">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
