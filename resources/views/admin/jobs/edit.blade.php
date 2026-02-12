@extends('admin.layout')

@section('page-title', 'Edit Job')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Job Details</h3>
            </div>
            <form action="{{ route('admin.jobs.update', $job) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                        placeholder="e.g. Senior Software Engineer">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description *</label>
                    <textarea name="description" id="description" rows="8" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                        placeholder="Describe the role, responsibilities, and requirements...">{{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="e.g. Remote, New York, NY">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                        <select name="type" id="type" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                            <option value="full-time" {{ old('type', $job->type) === 'full-time' ? 'selected' : '' }}>
                                Full-time</option>
                            <option value="part-time" {{ old('type', $job->type) === 'part-time' ? 'selected' : '' }}>
                                Part-time</option>
                            <option value="contract" {{ old('type', $job->type) === 'contract' ? 'selected' : '' }}>Contract
                            </option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="salary_range" class="block text-sm font-medium text-gray-700 mb-2">Salary Range</label>
                        <input type="text" name="salary_range" id="salary_range"
                            value="{{ old('salary_range', $job->salary_range) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent"
                            placeholder="e.g. $80,000 - $120,000">
                        @error('salary_range')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#287854] focus:border-transparent">
                            <option value="draft" {{ old('status', $job->status) === 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published" {{ old('status', $job->status) === 'published' ? 'selected' : '' }}>
                                Published</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('admin.jobs.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2 rounded-lg font-medium">
                        Update Job
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
