@extends('admin.layout')

@section('page-title', 'Edit FAQ')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-8 py-6 border-b bg-gray-50/60 rounded-t-xl">
                <h3 class="text-lg font-semibold text-gray-900">Edit FAQ</h3>
                <p class="text-sm text-gray-500 mt-1">Update FAQ content and publishing state.</p>
            </div>
            <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                @include('admin.faqs._form', ['faq' => $faq])

                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.faqs.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2.5 rounded-lg font-medium">
                        Update FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
