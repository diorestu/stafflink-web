@extends('admin.layout')

@section('page-title', 'Header and Footer')

@section('content')
    <div class="max-w-5xl">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Header and Footer Settings</h3>
                <p class="text-sm text-gray-500 mt-1">Use JSON arrays for links. Format: [{"label":"Text","url":"/path"}]</p>
            </div>

            <form action="{{ route('admin.header-footer.update') }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Site Name (for page title)</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $siteIdentity['site_name'] ?? \App\Models\SiteSetting::siteName()) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apply Button Label</label>
                        <input type="text" name="apply_now_label" value="{{ old('apply_now_label', $settings['apply_now_label'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apply Button URL</label>
                        <input type="text" name="apply_now_url" value="{{ old('apply_now_url', $settings['apply_now_url'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Consultation Button Label</label>
                        <input type="text" name="consultation_label" value="{{ old('consultation_label', $settings['consultation_label'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Consultation Button URL</label>
                        <input type="text" name="consultation_url" value="{{ old('consultation_url', $settings['consultation_url'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Copyright Text</label>
                    <input type="text" name="copyright_text" value="{{ old('copyright_text', $settings['copyright_text'] ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">About Dropdown Links (JSON)</label>
                    <textarea name="about_links" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('about_links', json_encode($settings['about_links'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Main Header Links (JSON)</label>
                    <textarea name="main_links" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('main_links', json_encode($settings['main_links'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">User Dropdown Links (JSON)</label>
                    <textarea name="user_links" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('user_links', json_encode($settings['user_links'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Footer Links (JSON)</label>
                    <textarea name="footer_links" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('footer_links', json_encode($settings['footer_links'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) }}</textarea>
                </div>

                <div class="pt-6 border-t flex justify-end">
                    <button type="submit" class="bg-[#287854] hover:bg-[#1f5f46] text-white px-6 py-2 rounded-lg font-medium">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
