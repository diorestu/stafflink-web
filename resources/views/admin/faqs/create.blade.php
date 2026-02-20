@extends('admin.layout')

@section('page-title', 'Add FAQ')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-8 py-6 border-b bg-gray-50/60 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-900">Create FAQ</h3>
                <p class="text-sm text-gray-500 mt-1">Add frequently asked questions for landing page SEO and user clarity.</p>
            </div>
            <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                @include('admin.faqs._form')

                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2.5 rounded-lg font-medium">
                        Create FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
