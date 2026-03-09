@extends('admin.layout')

@section('page-title', 'Header and Footer')

@section('content')
    @php
        $aboutLinks = old('about_links', $settings['about_links'] ?? []);
        $servicesLinks = old('services_links', $settings['services_links'] ?? []);

        if (!is_array($aboutLinks) || $aboutLinks === []) {
            $aboutLinks = [['label' => '', 'url' => '']];
        }

        if (!is_array($servicesLinks) || $servicesLinks === []) {
            $servicesLinks = [['label' => '', 'url' => '']];
        }
    @endphp

    <div class="max-w-5xl">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Header and Footer Settings</h3>
                <p class="text-sm text-gray-500 mt-1">Manage header buttons and dropdown pages from one place.</p>
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

                <div class="rounded-xl border border-[#d7e8df] p-5">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h4 class="text-base font-semibold text-[#1f5f46]">About Us Dropdown Pages</h4>
                            <p class="mt-1 text-sm text-gray-500">Add or edit links shown under the About us menu.</p>
                        </div>
                        <button type="button" class="rounded-lg border border-[#287854] px-4 py-2 text-sm font-semibold text-[#287854] hover:bg-[#ecf7f1]" data-add-link-row="about-links-list">
                            Add Page
                        </button>
                    </div>
                    <div id="about-links-list" class="mt-4 space-y-3" data-link-list data-name-prefix="about_links">
                        @foreach ($aboutLinks as $index => $link)
                            <div class="grid gap-3 rounded-lg border border-gray-200 bg-gray-50 p-4 md:grid-cols-[1fr_1fr_auto]" data-link-row>
                                <input type="text" name="about_links[{{ $index }}][label]" value="{{ $link['label'] ?? '' }}" placeholder="Label"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-link-field="label">
                                <input type="text" name="about_links[{{ $index }}][url]" value="{{ $link['url'] ?? '' }}" placeholder="/page-url"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-link-field="url">
                                <button type="button" class="rounded-lg border border-red-300 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-link-row>
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-xl border border-[#d7e8df] p-5">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <h4 class="text-base font-semibold text-[#1f5f46]">Services Dropdown Pages</h4>
                            <p class="mt-1 text-sm text-gray-500">Add or edit featured pages shown under the Services menu.</p>
                        </div>
                        <button type="button" class="rounded-lg border border-[#287854] px-4 py-2 text-sm font-semibold text-[#287854] hover:bg-[#ecf7f1]" data-add-link-row="services-links-list">
                            Add Page
                        </button>
                    </div>
                    <div id="services-links-list" class="mt-4 space-y-3" data-link-list data-name-prefix="services_links">
                        @foreach ($servicesLinks as $index => $link)
                            <div class="grid gap-3 rounded-lg border border-gray-200 bg-gray-50 p-4 md:grid-cols-[1fr_1fr_auto]" data-link-row>
                                <input type="text" name="services_links[{{ $index }}][label]" value="{{ $link['label'] ?? '' }}" placeholder="Label"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-link-field="label">
                                <input type="text" name="services_links[{{ $index }}][url]" value="{{ $link['url'] ?? '' }}" placeholder="/page-url"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-link-field="url">
                                <button type="button" class="rounded-lg border border-red-300 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-link-row>
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    </div>
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

    <template id="header-link-row-template">
        <div class="grid gap-3 rounded-lg border border-gray-200 bg-gray-50 p-4 md:grid-cols-[1fr_1fr_auto]" data-link-row>
            <input type="text" placeholder="Label"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-link-field="label">
            <input type="text" placeholder="/page-url"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-link-field="url">
            <button type="button" class="rounded-lg border border-red-300 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-link-row>
                Remove
            </button>
        </div>
    </template>

    <script>
        (() => {
            const template = document.getElementById('header-link-row-template');
            if (!template) return;

            const renumberRows = (list) => {
                const prefix = list.dataset.namePrefix;
                Array.from(list.querySelectorAll('[data-link-row]')).forEach((row, index) => {
                    row.querySelectorAll('[data-link-field]').forEach((field) => {
                        field.name = `${prefix}[${index}][${field.dataset.linkField}]`;
                    });
                });
            };

            document.querySelectorAll('[data-link-list]').forEach((list) => renumberRows(list));

            document.querySelectorAll('[data-add-link-row]').forEach((button) => {
                button.addEventListener('click', () => {
                    const list = document.getElementById(button.dataset.addLinkRow);
                    if (!list) return;

                    list.appendChild(template.content.cloneNode(true));
                    renumberRows(list);
                });
            });

            document.addEventListener('click', (event) => {
                const removeButton = event.target.closest('[data-remove-link-row]');
                if (!removeButton) return;

                const row = removeButton.closest('[data-link-row]');
                const list = removeButton.closest('[data-link-list]');
                if (!row || !list) return;

                if (list.querySelectorAll('[data-link-row]').length === 1) {
                    row.querySelectorAll('input').forEach((input) => input.value = '');
                    renumberRows(list);
                    return;
                }

                row.remove();
                renumberRows(list);
            });
        })();
    </script>
@endsection
