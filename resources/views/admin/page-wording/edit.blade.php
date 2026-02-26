@extends('admin.layout')

@section('page-title', 'Page Wording')

@section('content')
    <div class="max-w-6xl rounded-lg bg-white shadow">
        <div class="border-b p-6">
            <h3 class="text-lg font-semibold">Page Wording</h3>
            <p class="mt-1 text-sm text-gray-500">Edit wording per halaman dalam format JSON object. Setiap key akan dipakai sebagai fallback di view terkait.</p>
        </div>

        <form action="{{ route('admin.page-wording.update') }}" method="POST" class="space-y-6 p-6">
            @csrf
            @method('PUT')

            @foreach ($pageKeys as $pageKey)
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">{{ $pageKey }}</label>
                    <textarea name="wordings[{{ $pageKey }}]" rows="8" class="w-full rounded-lg border border-gray-300 px-4 py-3 font-mono text-xs">{{ old("wordings.$pageKey", json_encode($wordings[$pageKey] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)) }}</textarea>
                </div>
            @endforeach

            <div class="flex justify-end border-t pt-6">
                <button type="submit" class="rounded-lg bg-[#287854] px-6 py-2 text-sm font-medium text-white hover:bg-[#1f5f46]">Save Wording</button>
            </div>
        </form>
    </div>
@endsection
