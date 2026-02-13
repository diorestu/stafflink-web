@extends('admin.layout')

@section('page-title', 'Edit Page')

@section('content')
    <div class="max-w-4xl space-y-4">
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.pages.builder', $page) }}" class="bg-[#1f5f46] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#287854]">
                Open Builder
            </a>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Page Details</h3>
            </div>
            @include('admin.pages._form', ['page' => $page])
        </div>
    </div>
@endsection
