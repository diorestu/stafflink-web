@extends('admin.layout')

@section('title', 'Edit ' . $label)
@section('heading')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.dashboard') }}" class="text-[#6b6b66] transition hover:text-[#2e2e2e]">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5" />
                <path d="M12 19l-7-7 7-7" />
            </svg>
        </a>
        Edit: {{ $label }}
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.sections.update', $pageSection->section) }}" class="mx-auto max-w-4xl">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            @php $content = $pageSection->content; @endphp

            @foreach ($content as $key => $value)
                @if (is_string($value))
                    {{-- Simple text field --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <label
                            class="mb-2 block text-sm font-semibold text-[#2e2e2e]">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                        @if (strlen($value) > 100)
                            <textarea name="content[{{ $key }}]" rows="3"
                                class="w-full rounded-xl border border-[#d7d9e4] px-4 py-3 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20">{{ $value }}</textarea>
                        @else
                            <input type="text" name="content[{{ $key }}]" value="{{ $value }}"
                                class="w-full rounded-xl border border-[#d7d9e4] px-4 py-3 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20" />
                        @endif
                    </div>
                @elseif(is_array($value))
                    {{-- Array of items --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-[#b28b2e]">
                            {{ ucwords(str_replace('_', ' ', $key)) }}</h3>
                        <div class="space-y-4">
                            @foreach ($value as $i => $item)
                                @if (is_array($item))
                                    <div class="rounded-xl border border-[#e6e8ed] p-5">
                                        <div class="mb-3 flex items-center justify-between">
                                            <span class="text-xs font-semibold text-[#6b6b66]">#{{ $i + 1 }}</span>
                                        </div>
                                        <div class="grid gap-4 sm:grid-cols-2">
                                            @foreach ($item as $subKey => $subValue)
                                                @if (is_string($subValue))
                                                    <div class="{{ strlen($subValue) > 80 ? 'sm:col-span-2' : '' }}">
                                                        <label
                                                            class="mb-1.5 block text-xs font-medium text-[#6b6b66]">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                                                        @if (strlen($subValue) > 80)
                                                            <textarea name="content[{{ $key }}][{{ $i }}][{{ $subKey }}]" rows="2"
                                                                class="w-full rounded-lg border border-[#d7d9e4] px-3 py-2 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20">{{ $subValue }}</textarea>
                                                        @else
                                                            <input type="text"
                                                                name="content[{{ $key }}][{{ $i }}][{{ $subKey }}]"
                                                                value="{{ $subValue }}"
                                                                class="w-full rounded-lg border border-[#d7d9e4] px-3 py-2 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20" />
                                                        @endif
                                                    </div>
                                                @elseif(is_array($subValue))
                                                    {{-- Nested array (e.g., jobs inside staffing cards) --}}
                                                    <div class="sm:col-span-2">
                                                        <label
                                                            class="mb-2 block text-xs font-semibold text-[#b28b2e]">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                                                        <div class="space-y-3">
                                                            @foreach ($subValue as $j => $nestedItem)
                                                                @if (is_array($nestedItem))
                                                                    <div
                                                                        class="rounded-lg border border-dashed border-[#d7d9e4] bg-[#f9fafb] p-4">
                                                                        <div class="grid gap-3 sm:grid-cols-2">
                                                                            @foreach ($nestedItem as $nk => $nv)
                                                                                <div>
                                                                                    <label
                                                                                        class="mb-1 block text-xs text-[#6b6b66]">{{ ucwords(str_replace('_', ' ', $nk)) }}</label>
                                                                                    <input type="text"
                                                                                        name="content[{{ $key }}][{{ $i }}][{{ $subKey }}][{{ $j }}][{{ $nk }}]"
                                                                                        value="{{ $nv }}"
                                                                                        class="w-full rounded-lg border border-[#d7d9e4] px-3 py-2 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20" />
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif(is_string($item))
                                    {{-- Simple string item in an array --}}
                                    <div>
                                        <input type="text" name="content[{{ $key }}][{{ $i }}]"
                                            value="{{ $item }}"
                                            class="w-full rounded-lg border border-[#d7d9e4] px-3 py-2 text-sm text-[#2e2e2e] outline-none transition focus:border-[#287854] focus:ring-2 focus:ring-[#287854]/20" />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="mt-8 flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-[#287854] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1f5f46]">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                    <polyline points="17 21 17 13 7 13 7 21" />
                    <polyline points="7 3 7 8 15 8" />
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.dashboard') }}"
                class="text-sm font-medium text-[#6b6b66] transition hover:text-[#2e2e2e]">Cancel</a>
        </div>
    </form>
@endsection
