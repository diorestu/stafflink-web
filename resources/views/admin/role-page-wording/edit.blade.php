@extends('admin.layout')

@section('page-title', 'Edit Role Page Copy')

@section('content')
    @php
        $sections = old('sections', $copy['sections'] ?? []);
        if (!is_array($sections)) {
            $sections = [];
        }
    @endphp
    <div class="space-y-6">
        <div class="rounded-lg border border-[#d7e8df] bg-[#f6faf8] p-5">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-[#1f5f46]">Live Preview</h3>
                    <p class="mt-1 text-sm text-[#5a5a55]">Preview ini mengikuti perubahan form secara langsung sebelum disimpan.</p>
                </div>
                <button type="button" id="toggle-role-preview"
                    class="rounded-lg border border-[#287854] px-4 py-2 text-sm font-semibold text-[#287854] hover:bg-[#ecf7f1]">
                    Hide Preview
                </button>
            </div>
            <div id="role-page-preview" class="mt-4 rounded-[28px] bg-[radial-gradient(circle_at_top,_#ffffff_0%,_#f4f5f3_52%,_#e6f1ec_100%)] p-5">
                <div class="mx-auto max-w-5xl space-y-8">
                    <section class="rounded-[30px] bg-[#1f5f46] p-8 text-white shadow-[0_20px_50px_rgba(31,95,70,0.2)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-[#e9d29d]" data-preview-badge></p>
                        <h1 class="mt-4 text-3xl font-semibold leading-tight md:text-4xl" data-preview-title></h1>
                        <p class="mt-5 max-w-3xl text-sm leading-relaxed text-white/85" data-preview-subtitle></p>
                        <div class="mt-7 flex flex-wrap gap-3">
                            <a href="#" class="inline-flex rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#1f5f46]" data-preview-primary-cta></a>
                            <a href="#" class="inline-flex rounded-full border border-white px-6 py-3 text-sm font-semibold text-white" data-preview-secondary-cta></a>
                        </div>
                    </section>
                    <div id="role-preview-sections" class="space-y-6"></div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl rounded-lg bg-white shadow">
        <div class="border-b p-6">
            <h3 class="text-lg font-semibold">{{ $roleTitle }}</h3>
            <p class="mt-1 text-sm text-gray-500">Edit copy untuk halaman role `/services/roles/{{ $roleSlug }}`.</p>
        </div>

        <form action="{{ route('admin.role-page-wording.update', $roleSlug) }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="hero_badge" class="mb-2 block text-sm font-semibold text-gray-700">Hero Badge</label>
                    <input id="hero_badge" name="hero_badge" type="text" value="{{ old('hero_badge', $copy['hero_badge'] ?? '') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                </div>
                <div>
                    <label for="hero_title" class="mb-2 block text-sm font-semibold text-gray-700">Hero Title</label>
                    <input id="hero_title" name="hero_title" type="text" value="{{ old('hero_title', $copy['hero_title'] ?? '') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                </div>
            </div>

            <div>
                <label for="hero_subtitle" class="mb-2 block text-sm font-semibold text-gray-700">Hero Subtitle</label>
                <textarea id="hero_subtitle" name="hero_subtitle" rows="4"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">{{ old('hero_subtitle', $copy['hero_subtitle'] ?? '') }}</textarea>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-lg border border-gray-200 p-4">
                    <p class="text-sm font-semibold text-gray-700">Primary CTA</p>
                    <div class="mt-4 space-y-4">
                        <div>
                            <label for="primary_cta_label" class="mb-2 block text-sm text-gray-600">Label</label>
                            <input id="primary_cta_label" name="primary_cta_label" type="text" value="{{ old('primary_cta_label', $copy['primary_cta_label'] ?? '') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                        </div>
                        <div>
                            <label for="primary_cta_url" class="mb-2 block text-sm text-gray-600">URL</label>
                            <input id="primary_cta_url" name="primary_cta_url" type="text" value="{{ old('primary_cta_url', $copy['primary_cta_url'] ?? '') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-gray-200 p-4">
                    <p class="text-sm font-semibold text-gray-700">Secondary CTA</p>
                    <div class="mt-4 space-y-4">
                        <div>
                            <label for="secondary_cta_label" class="mb-2 block text-sm text-gray-600">Label</label>
                            <input id="secondary_cta_label" name="secondary_cta_label" type="text" value="{{ old('secondary_cta_label', $copy['secondary_cta_label'] ?? '') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                        </div>
                        <div>
                            <label for="secondary_cta_url" class="mb-2 block text-sm text-gray-600">URL</label>
                            <input id="secondary_cta_url" name="secondary_cta_url" type="text" value="{{ old('secondary_cta_url', $copy['secondary_cta_url'] ?? '') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="mb-3 flex items-center justify-between gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Page Sections</label>
                        <p class="mt-1 text-xs text-gray-500">Tambah section lalu pilih layout `Text` atau `Cards`. Tidak perlu edit JSON manual.</p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" data-add-section="text"
                            class="rounded-lg border border-[#287854] px-4 py-2 text-sm font-semibold text-[#287854] hover:bg-[#ecf7f1]">
                            Add Text Section
                        </button>
                        <button type="button" data-add-section="cards"
                            class="rounded-lg bg-[#287854] px-4 py-2 text-sm font-semibold text-white hover:bg-[#1f5f46]">
                            Add Cards Section
                        </button>
                        <button type="button" data-add-section="split_image"
                            class="rounded-lg border border-[#1f5f46] px-4 py-2 text-sm font-semibold text-[#1f5f46] hover:bg-white">
                            Add Image Section
                        </button>
                    </div>
                </div>

                <div id="sections-builder" class="space-y-4">
                    @foreach ($sections as $sectionIndex => $section)
                        @php
                            $layout = in_array(($section['layout'] ?? 'text'), ['cards', 'split_image'], true) ? $section['layout'] : 'text';
                            $title = $section['title'] ?? '';
                            $columnsValue = (string) ($section['columns'] ?? '3');
                            $columns = in_array($columnsValue, ['2', '3', '4'], true) ? $columnsValue : '3';
                            $paragraphs = is_array($section['paragraphs'] ?? null) ? $section['paragraphs'] : [''];
                            $items = is_array($section['items'] ?? null) ? $section['items'] : [['title' => '', 'body' => '']];
                            $imagePath = $section['image_path'] ?? '';
                            $imagePositionValue = (string) ($section['image_position'] ?? 'right');
                            $imagePosition = in_array($imagePositionValue, ['left', 'right'], true) ? $imagePositionValue : 'right';
                            $imageAlt = $section['image_alt'] ?? '';
                            $imageFitValue = (string) ($section['image_fit'] ?? 'cover');
                            $imageFit = in_array($imageFitValue, ['cover', 'contain'], true) ? $imageFitValue : 'cover';
                            $imageHeightValue = (string) ($section['image_height'] ?? 'md');
                            $imageHeight = in_array($imageHeightValue, ['sm', 'md', 'lg'], true) ? $imageHeightValue : 'md';
                        @endphp
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4" data-section data-layout="{{ $layout }}"
                            draggable="true"
                            data-section-index="{{ $sectionIndex }}"
                            data-next-paragraph-index="{{ count($paragraphs) }}"
                            data-next-card-index="{{ count($items) }}">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <button type="button" class="cursor-grab rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50" data-drag-section-handle>
                                        Drag
                                    </button>
                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-gray-600" data-section-label>
                                        {{ $layout === 'cards' ? 'Cards Section' : ($layout === 'split_image' ? 'Image Section' : 'Text Section') }}
                                    </span>
                                    <select name="sections[{{ $sectionIndex }}][layout]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-section-layout>
                                        <option value="text" @selected($layout === 'text')>Text</option>
                                        <option value="cards" @selected($layout === 'cards')>Cards</option>
                                        <option value="split_image" @selected($layout === 'split_image')>Image Split</option>
                                    </select>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" class="rounded-lg border border-[#287854] px-3 py-2 text-sm font-semibold text-[#287854] hover:bg-white" data-duplicate-section>
                                        Duplicate Section
                                    </button>
                                    <button type="button" class="rounded-lg border border-red-300 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-section>
                                        Remove Section
                                    </button>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="mb-2 block text-sm font-semibold text-gray-700">Section Title</label>
                                <input type="text" name="sections[{{ $sectionIndex }}][title]" value="{{ $title }}"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" placeholder="Section heading">
                            </div>

                            <div class="mt-4 space-y-3" data-text-fields @if ($layout === 'cards') style="display:none;" @endif>
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-sm font-semibold text-gray-700">Paragraphs</p>
                                    <button type="button" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-white" data-add-paragraph>
                                        Add Paragraph
                                    </button>
                                </div>
                                <div class="space-y-3" data-paragraphs-list>
                                    @foreach ($paragraphs as $paragraphIndex => $paragraph)
                                        <div class="rounded-lg border border-gray-200 bg-white p-3" data-paragraph-row>
                                            <div class="flex justify-end">
                                                <button type="button" class="text-xs font-semibold text-red-600 hover:text-red-700" data-remove-paragraph>
                                                    Remove
                                                </button>
                                            </div>
                                            <textarea name="sections[{{ $sectionIndex }}][paragraphs][{{ $paragraphIndex }}]" rows="3"
                                                class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm"
                                                placeholder="Paragraph text">{{ $paragraph }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-4 space-y-3" data-cards-fields @if ($layout !== 'cards') style="display:none;" @endif>
                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-gray-700">Columns</label>
                                    <select name="sections[{{ $sectionIndex }}][columns]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-columns-select>
                                        <option value="2" @selected($columns === '2')>2 Columns</option>
                                        <option value="3" @selected($columns === '3')>3 Columns</option>
                                        <option value="4" @selected($columns === '4')>4 Columns</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-sm font-semibold text-gray-700">Cards</p>
                                    <button type="button" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-white" data-add-card>
                                        Add Card
                                    </button>
                                </div>
                                <div class="space-y-3" data-cards-list>
                                    @foreach ($items as $itemIndex => $item)
                                        <div class="rounded-lg border border-gray-200 bg-white p-4" data-card-row draggable="true">
                                            <div class="flex justify-end">
                                                <div class="flex gap-3">
                                                    <button type="button" class="cursor-grab text-xs font-semibold text-gray-500 hover:text-gray-700" data-drag-card-handle>
                                                        Drag
                                                    </button>
                                                    <button type="button" class="text-xs font-semibold text-[#287854] hover:text-[#1f5f46]" data-duplicate-card>
                                                        Duplicate
                                                    </button>
                                                    <button type="button" class="text-xs font-semibold text-red-600 hover:text-red-700" data-remove-card>
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <label class="mb-2 block text-sm font-semibold text-gray-700">Card Title</label>
                                                <input type="text" name="sections[{{ $sectionIndex }}][items][{{ $itemIndex }}][title]" value="{{ $item['title'] ?? '' }}"
                                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" placeholder="Card title">
                                            </div>
                                            <div class="mt-4">
                                                <label class="mb-2 block text-sm font-semibold text-gray-700">Card Body</label>
                                                <textarea name="sections[{{ $sectionIndex }}][items][{{ $itemIndex }}][body]" rows="3"
                                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm"
                                                    placeholder="Card description">{{ $item['body'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-4 space-y-3" data-image-fields @if ($layout !== 'split_image') style="display:none;" @endif>
                                <div class="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-semibold text-gray-700">Image Position</label>
                                        <select name="sections[{{ $sectionIndex }}][image_position]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-image-position-select>
                                            <option value="right" @selected($imagePosition === 'right')>Right</option>
                                            <option value="left" @selected($imagePosition === 'left')>Left</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-semibold text-gray-700">Alt Text</label>
                                        <input type="text" name="sections[{{ $sectionIndex }}][image_alt]" value="{{ $imageAlt }}"
                                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" placeholder="Describe the image for SEO/accessibility">
                                    </div>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="mb-2 block text-sm font-semibold text-gray-700">Image Fit</label>
                                        <select name="sections[{{ $sectionIndex }}][image_fit]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-image-fit-select>
                                            <option value="cover" @selected($imageFit === 'cover')>Cover</option>
                                            <option value="contain" @selected($imageFit === 'contain')>Contain</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-semibold text-gray-700">Image Height</label>
                                        <select name="sections[{{ $sectionIndex }}][image_height]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-image-height-select>
                                            <option value="sm" @selected($imageHeight === 'sm')>Small</option>
                                            <option value="md" @selected($imageHeight === 'md')>Medium</option>
                                            <option value="lg" @selected($imageHeight === 'lg')>Large</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-gray-700">Image</label>
                                    <input type="hidden" name="sections[{{ $sectionIndex }}][image_path]" value="{{ $imagePath }}" data-image-path-input>
                                    <input type="hidden" name="sections[{{ $sectionIndex }}][remove_image]" value="0" data-remove-image-input>
                                    <input type="file" name="section_images[{{ $sectionIndex }}]" accept="image/*"
                                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-image-upload>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" class="rounded-lg border border-red-300 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-current-image>
                                        Remove Current Image
                                    </button>
                                </div>
                                <div class="overflow-hidden rounded-2xl border border-[#dfe8e3] bg-white">
                                    <img src="{{ $imagePath !== '' ? \Illuminate\Support\Facades\Storage::url($imagePath) : asset('images/img_hero.webp') }}"
                                        alt="Section image preview" class="h-56 w-full object-cover" data-section-image-preview
                                        data-default-src="{{ asset('images/img_hero.webp') }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($errors->has('sections') || $errors->has('sections.*.title') || $errors->has('sections.*.paragraphs.*') || $errors->has('sections.*.items.*.title') || $errors->has('sections.*.items.*.body'))
                    <p class="mt-2 text-sm text-red-600">Please check the section fields. Some values are invalid.</p>
                @endif
            </div>

            <div class="flex items-center justify-between border-t pt-6">
                <a href="{{ route('admin.role-page-wording.index') }}"
                    class="rounded-lg border border-gray-300 px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Back
                </a>
                <button type="submit" class="rounded-lg bg-[#287854] px-6 py-2 text-sm font-medium text-white hover:bg-[#1f5f46]">
                    Save Role Copy
                </button>
            </div>
        </form>
    </div>
    </div>

    <template id="section-template">
        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4" data-section data-layout="__LAYOUT__"
            draggable="true"
            data-section-index="__SECTION_INDEX__" data-next-paragraph-index="0" data-next-card-index="0">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <button type="button" class="cursor-grab rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-semibold text-gray-500 hover:bg-gray-50" data-drag-section-handle>
                        Drag
                    </button>
                    <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-gray-600" data-section-label>__LABEL__</span>
                    <select name="sections[__SECTION_INDEX__][layout]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-section-layout>
                        <option value="text" __TEXT_SELECTED__>Text</option>
                        <option value="cards" __CARDS_SELECTED__>Cards</option>
                        <option value="split_image" __IMAGE_SELECTED__>Image Split</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="button" class="rounded-lg border border-[#287854] px-3 py-2 text-sm font-semibold text-[#287854] hover:bg-white" data-duplicate-section>
                        Duplicate Section
                    </button>
                    <button type="button" class="rounded-lg border border-red-300 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-section>
                        Remove Section
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <label class="mb-2 block text-sm font-semibold text-gray-700">Section Title</label>
                <input type="text" name="sections[__SECTION_INDEX__][title]" class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" placeholder="Section heading">
            </div>

            <div class="mt-4 space-y-3" data-text-fields __TEXT_STYLE__>
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold text-gray-700">Paragraphs</p>
                    <button type="button" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-white" data-add-paragraph>
                        Add Paragraph
                    </button>
                </div>
                <div class="space-y-3" data-paragraphs-list></div>
            </div>

            <div class="mt-4 space-y-3" data-cards-fields __CARDS_STYLE__>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Columns</label>
                    <select name="sections[__SECTION_INDEX__][columns]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-columns-select>
                        <option value="2">2 Columns</option>
                        <option value="3" selected>3 Columns</option>
                        <option value="4">4 Columns</option>
                    </select>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold text-gray-700">Cards</p>
                    <button type="button" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-white" data-add-card>
                        Add Card
                    </button>
                </div>
                <div class="space-y-3" data-cards-list></div>
            </div>

            <div class="mt-4 space-y-3" data-image-fields __IMAGE_STYLE__>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Image Position</label>
                        <select name="sections[__SECTION_INDEX__][image_position]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-image-position-select>
                            <option value="right" selected>Right</option>
                            <option value="left">Left</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Alt Text</label>
                        <input type="text" name="sections[__SECTION_INDEX__][image_alt]"
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" placeholder="Describe the image for SEO/accessibility">
                    </div>
                </div>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Image Fit</label>
                        <select name="sections[__SECTION_INDEX__][image_fit]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-image-fit-select>
                            <option value="cover" selected>Cover</option>
                            <option value="contain">Contain</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">Image Height</label>
                        <select name="sections[__SECTION_INDEX__][image_height]" class="rounded-lg border border-gray-300 px-3 py-2 text-sm" data-image-height-select>
                            <option value="sm">Small</option>
                            <option value="md" selected>Medium</option>
                            <option value="lg">Large</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Image</label>
                    <input type="hidden" name="sections[__SECTION_INDEX__][image_path]" value="" data-image-path-input>
                    <input type="hidden" name="sections[__SECTION_INDEX__][remove_image]" value="0" data-remove-image-input>
                    <input type="file" name="section_images[__SECTION_INDEX__]" accept="image/*"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" data-image-upload>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="rounded-lg border border-red-300 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50" data-remove-current-image>
                        Remove Current Image
                    </button>
                </div>
                <div class="overflow-hidden rounded-2xl border border-[#dfe8e3] bg-white">
                    <img src="{{ asset('images/img_hero.webp') }}" alt="Section image preview"
                        class="h-56 w-full object-cover" data-section-image-preview
                        data-default-src="{{ asset('images/img_hero.webp') }}">
                </div>
            </div>
        </div>
    </template>

    <template id="paragraph-template">
        <div class="rounded-lg border border-gray-200 bg-white p-3" data-paragraph-row>
            <div class="flex justify-end">
                <button type="button" class="text-xs font-semibold text-red-600 hover:text-red-700" data-remove-paragraph>
                    Remove
                </button>
            </div>
            <textarea name="sections[__SECTION_INDEX__][paragraphs][__PARAGRAPH_INDEX__]" rows="3"
                class="mt-2 w-full rounded-lg border border-gray-300 px-4 py-3 text-sm"
                placeholder="Paragraph text"></textarea>
        </div>
    </template>

    <template id="card-template">
        <div class="rounded-lg border border-gray-200 bg-white p-4" data-card-row draggable="true">
            <div class="flex justify-end">
                <div class="flex gap-3">
                    <button type="button" class="cursor-grab text-xs font-semibold text-gray-500 hover:text-gray-700" data-drag-card-handle>
                        Drag
                    </button>
                    <button type="button" class="text-xs font-semibold text-[#287854] hover:text-[#1f5f46]" data-duplicate-card>
                        Duplicate
                    </button>
                    <button type="button" class="text-xs font-semibold text-red-600 hover:text-red-700" data-remove-card>
                        Remove
                    </button>
                </div>
            </div>
            <div class="mt-2">
                <label class="mb-2 block text-sm font-semibold text-gray-700">Card Title</label>
                <input type="text" name="sections[__SECTION_INDEX__][items][__ITEM_INDEX__][title]"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm" placeholder="Card title">
            </div>
            <div class="mt-4">
                <label class="mb-2 block text-sm font-semibold text-gray-700">Card Body</label>
                <textarea name="sections[__SECTION_INDEX__][items][__ITEM_INDEX__][body]" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm"
                    placeholder="Card description"></textarea>
            </div>
        </div>
    </template>

    <script>
        (() => {
            const builder = document.getElementById('sections-builder');
            if (!builder) return;

            const sectionTemplate = document.getElementById('section-template');
            const paragraphTemplate = document.getElementById('paragraph-template');
            const cardTemplate = document.getElementById('card-template');
            const previewWrap = document.getElementById('role-page-preview');
            const togglePreviewButton = document.getElementById('toggle-role-preview');
            const previewBadge = document.querySelector('[data-preview-badge]');
            const previewTitle = document.querySelector('[data-preview-title]');
            const previewSubtitle = document.querySelector('[data-preview-subtitle]');
            const previewPrimaryCta = document.querySelector('[data-preview-primary-cta]');
            const previewSecondaryCta = document.querySelector('[data-preview-secondary-cta]');
            const previewSections = document.getElementById('role-preview-sections');
            const heroBadgeInput = document.getElementById('hero_badge');
            const heroTitleInput = document.getElementById('hero_title');
            const heroSubtitleInput = document.getElementById('hero_subtitle');
            const primaryCtaLabelInput = document.getElementById('primary_cta_label');
            const secondaryCtaLabelInput = document.getElementById('secondary_cta_label');
            let draggedSection = null;
            let draggedCard = null;

            let sectionCounter = Array.from(builder.querySelectorAll('[data-section]'))
                .map((section) => Number(section.getAttribute('data-section-index') || '0'))
                .reduce((max, value) => Math.max(max, value), -1) + 1;

            const nextSectionIndex = () => {
                const next = sectionCounter;
                sectionCounter += 1;
                return next;
            };

            const createSection = (layout) => {
                const index = nextSectionIndex();
                const label = layout === 'cards'
                    ? 'Cards Section'
                    : (layout === 'split_image' ? 'Image Section' : 'Text Section');
                const html = sectionTemplate.innerHTML
                    .replaceAll('__SECTION_INDEX__', String(index))
                    .replaceAll('__LAYOUT__', layout)
                    .replaceAll('__LABEL__', label)
                    .replaceAll('__TEXT_SELECTED__', layout === 'text' ? 'selected' : '')
                    .replaceAll('__CARDS_SELECTED__', layout === 'cards' ? 'selected' : '')
                    .replaceAll('__IMAGE_SELECTED__', layout === 'split_image' ? 'selected' : '')
                    .replaceAll('__TEXT_STYLE__', layout === 'cards' ? 'style="display:none;"' : '')
                    .replaceAll('__CARDS_STYLE__', layout === 'cards' ? '' : 'style="display:none;"')
                    .replaceAll('__IMAGE_STYLE__', layout === 'split_image' ? '' : 'style="display:none;"');

                const wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                const section = wrapper.firstElementChild;
                builder.appendChild(section);

                if (layout === 'text' || layout === 'split_image') {
                    addParagraph(section);
                }

                if (layout === 'cards') {
                    addCard(section);
                }

                renderPreview();
            };

            const addParagraph = (section) => {
                const list = section.querySelector('[data-paragraphs-list]');
                const sectionIndex = Number(section.getAttribute('data-section-index') || '0');
                const paragraphIndex = Number(section.getAttribute('data-next-paragraph-index') || '0');
                section.setAttribute('data-next-paragraph-index', String(paragraphIndex + 1));
                const html = paragraphTemplate.innerHTML
                    .replaceAll('__SECTION_INDEX__', String(sectionIndex))
                    .replaceAll('__PARAGRAPH_INDEX__', String(paragraphIndex));
                const wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                list.appendChild(wrapper.firstElementChild);
                renderPreview();
            };

            const addCard = (section) => {
                const list = section.querySelector('[data-cards-list]');
                const sectionIndex = Number(section.getAttribute('data-section-index') || '0');
                const itemIndex = Number(section.getAttribute('data-next-card-index') || '0');
                section.setAttribute('data-next-card-index', String(itemIndex + 1));
                const html = cardTemplate.innerHTML
                    .replaceAll('__SECTION_INDEX__', String(sectionIndex))
                    .replaceAll('__ITEM_INDEX__', String(itemIndex));
                const wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                list.appendChild(wrapper.firstElementChild);
                renderPreview();
            };

            const updateSectionVisibility = (section, layout) => {
                section.dataset.layout = layout;
                section.querySelector('[data-section-label]').textContent = layout === 'cards' ? 'Cards Section' : (layout === 'split_image' ? 'Image Section' : 'Text Section');
                section.querySelector('[data-text-fields]').style.display = layout === 'cards' ? 'none' : '';
                section.querySelector('[data-cards-fields]').style.display = layout === 'cards' ? '' : 'none';
                section.querySelector('[data-image-fields]').style.display = layout === 'split_image' ? '' : 'none';

                if ((layout === 'text' || layout === 'split_image') && section.querySelectorAll('[data-paragraph-row]').length === 0) {
                    addParagraph(section);
                    return;
                }

                if (layout === 'cards' && section.querySelectorAll('[data-card-row]').length === 0) {
                    addCard(section);
                    return;
                }

                renderPreview();
            };

            const reindexCards = (section) => {
                const sectionIndex = Number(section.getAttribute('data-section-index') || '0');
                section.querySelectorAll('[data-card-row]').forEach((cardRow, cardIndex) => {
                    cardRow.querySelectorAll('input, textarea').forEach((field) => {
                        if (!(field instanceof HTMLInputElement || field instanceof HTMLTextAreaElement)) return;
                        field.name = field.name.replace(/sections\[\d+\]\[items\]\[\d+\]/, `sections[${sectionIndex}][items][${cardIndex}]`);
                    });
                });
            };

            const reindexParagraphs = (section) => {
                const sectionIndex = Number(section.getAttribute('data-section-index') || '0');
                section.querySelectorAll('[data-paragraph-row]').forEach((row, paragraphIndex) => {
                    row.querySelectorAll('textarea').forEach((field) => {
                        if (!(field instanceof HTMLTextAreaElement)) return;
                        field.name = `sections[${sectionIndex}][paragraphs][${paragraphIndex}]`;
                    });
                });
            };

            const reindexSections = () => {
                builder.querySelectorAll('[data-section]').forEach((section, sectionIndex) => {
                    const currentIndex = Number(section.getAttribute('data-section-index') || sectionIndex);
                    section.setAttribute('data-section-index', String(sectionIndex));
                    section.querySelectorAll('input, textarea, select').forEach((field) => {
                        if (!(field instanceof HTMLInputElement || field instanceof HTMLTextAreaElement || field instanceof HTMLSelectElement)) return;
                        field.name = field.name.replace(/sections\[\d+\]/, `sections[${sectionIndex}]`);
                        if (field.name.startsWith('section_images[')) {
                            field.name = `section_images[${sectionIndex}]`;
                        }
                    });

                    if (currentIndex !== sectionIndex) {
                        reindexParagraphs(section);
                        reindexCards(section);
                    } else {
                        reindexParagraphs(section);
                        reindexCards(section);
                    }
                });

                renderPreview();
            };

            const escapeHtml = (value) => String(value ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');

            const cloneSection = (section) => {
                const sectionLayout = section.getAttribute('data-layout');
                const layout = sectionLayout === 'cards' || sectionLayout === 'split_image' ? sectionLayout : 'text';
                const title = section.querySelector('input[name*="[title]"]')?.value ?? '';
                createSection(layout);
                const clonedSection = builder.lastElementChild;
                if (!(clonedSection instanceof HTMLElement)) return;

                const titleInput = clonedSection.querySelector('input[name*="[title]"]');
                if (titleInput instanceof HTMLInputElement) {
                    titleInput.value = title;
                }

                const columnsSelect = section.querySelector('[data-columns-select]');
                const clonedColumnsSelect = clonedSection.querySelector('[data-columns-select]');
                if (columnsSelect instanceof HTMLSelectElement && clonedColumnsSelect instanceof HTMLSelectElement) {
                    clonedColumnsSelect.value = columnsSelect.value;
                }

                if (layout === 'text') {
                    const existingRows = clonedSection.querySelectorAll('[data-paragraph-row]');
                    existingRows.forEach((row) => row.remove());
                    clonedSection.setAttribute('data-next-paragraph-index', '0');
                    const values = Array.from(section.querySelectorAll('[data-paragraph-row] textarea')).map((textarea) => textarea.value);
                    values.forEach((value) => {
                        addParagraph(clonedSection);
                        const rows = clonedSection.querySelectorAll('[data-paragraph-row] textarea');
                        rows[rows.length - 1].value = value;
                    });
                } else if (layout === 'cards') {
                    const existingRows = clonedSection.querySelectorAll('[data-card-row]');
                    existingRows.forEach((row) => row.remove());
                    clonedSection.setAttribute('data-next-card-index', '0');
                    const cards = Array.from(section.querySelectorAll('[data-card-row]')).map((row) => ({
                        title: row.querySelector('input')?.value ?? '',
                        body: row.querySelector('textarea')?.value ?? '',
                    }));
                    cards.forEach((card) => {
                        addCard(clonedSection);
                        const rows = clonedSection.querySelectorAll('[data-card-row]');
                        const latest = rows[rows.length - 1];
                        latest.querySelector('input').value = card.title;
                        latest.querySelector('textarea').value = card.body;
                    });
                } else if (layout === 'split_image') {
                    const existingRows = clonedSection.querySelectorAll('[data-paragraph-row]');
                    existingRows.forEach((row) => row.remove());
                    clonedSection.setAttribute('data-next-paragraph-index', '0');
                    const values = Array.from(section.querySelectorAll('[data-paragraph-row] textarea')).map((textarea) => textarea.value);
                    values.forEach((value) => {
                        addParagraph(clonedSection);
                        const rows = clonedSection.querySelectorAll('[data-paragraph-row] textarea');
                        rows[rows.length - 1].value = value;
                    });

                    const sourceImageInput = section.querySelector('[data-image-path-input]');
                    const clonedImageInput = clonedSection.querySelector('[data-image-path-input]');
                    const sourceImagePreview = section.querySelector('[data-section-image-preview]');
                    const clonedImagePreview = clonedSection.querySelector('[data-section-image-preview]');
                    if (sourceImageInput instanceof HTMLInputElement && clonedImageInput instanceof HTMLInputElement) {
                        clonedImageInput.value = sourceImageInput.value;
                    }
                    if (sourceImagePreview instanceof HTMLImageElement && clonedImagePreview instanceof HTMLImageElement) {
                        clonedImagePreview.src = sourceImagePreview.src;
                    }
                    const sourcePosition = section.querySelector('[data-image-position-select]');
                    const clonedPosition = clonedSection.querySelector('[data-image-position-select]');
                    if (sourcePosition instanceof HTMLSelectElement && clonedPosition instanceof HTMLSelectElement) {
                        clonedPosition.value = sourcePosition.value;
                    }
                    const sourceFit = section.querySelector('[data-image-fit-select]');
                    const clonedFit = clonedSection.querySelector('[data-image-fit-select]');
                    if (sourceFit instanceof HTMLSelectElement && clonedFit instanceof HTMLSelectElement) {
                        clonedFit.value = sourceFit.value;
                    }
                    const sourceHeight = section.querySelector('[data-image-height-select]');
                    const clonedHeight = clonedSection.querySelector('[data-image-height-select]');
                    if (sourceHeight instanceof HTMLSelectElement && clonedHeight instanceof HTMLSelectElement) {
                        clonedHeight.value = sourceHeight.value;
                    }
                    const sourceAlt = section.querySelector('input[name*="[image_alt]"]');
                    const clonedAlt = clonedSection.querySelector('input[name*="[image_alt]"]');
                    if (sourceAlt instanceof HTMLInputElement && clonedAlt instanceof HTMLInputElement) {
                        clonedAlt.value = sourceAlt.value;
                    }
                }

                renderPreview();
            };

            const duplicateCard = (section, cardRow) => {
                addCard(section);
                const cards = section.querySelectorAll('[data-card-row]');
                const latest = cards[cards.length - 1];
                latest.querySelector('input').value = cardRow.querySelector('input')?.value ?? '';
                latest.querySelector('textarea').value = cardRow.querySelector('textarea')?.value ?? '';
                renderPreview();
            };

            const renderPreview = () => {
                previewBadge.textContent = heroBadgeInput?.value || 'Role';
                previewTitle.textContent = heroTitleInput?.value || '{{ $roleTitle }}';
                previewSubtitle.textContent = heroSubtitleInput?.value || '';
                previewPrimaryCta.textContent = primaryCtaLabelInput?.value || 'Primary CTA';
                previewSecondaryCta.textContent = secondaryCtaLabelInput?.value || 'Secondary CTA';

                const sectionsHtml = Array.from(builder.querySelectorAll('[data-section]')).map((section) => {
                    const sectionLayout = section.getAttribute('data-layout');
                    const layout = sectionLayout === 'cards' || sectionLayout === 'split_image' ? sectionLayout : 'text';
                    const title = section.querySelector('input[name*="[title]"]')?.value ?? '';

                    if (layout === 'cards') {
                        const columns = section.querySelector('[data-columns-select]')?.value || '3';
                        const previewGridClass = columns === '2'
                            ? 'grid gap-4 md:grid-cols-2'
                            : (columns === '4' ? 'grid gap-4 md:grid-cols-2 xl:grid-cols-4' : 'grid gap-4 lg:grid-cols-3');
                        const cards = Array.from(section.querySelectorAll('[data-card-row]')).map((row) => {
                            const cardTitle = row.querySelector('input')?.value ?? '';
                            const cardBody = row.querySelector('textarea')?.value ?? '';

                            return `
                                <article class="rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] p-6">
                                    ${cardTitle ? `<h3 class="text-xl font-semibold text-[#1f5f46]">${escapeHtml(cardTitle)}</h3>` : ''}
                                    ${cardBody ? `<p class="mt-3 text-sm leading-relaxed text-[#5a5a55]">${escapeHtml(cardBody)}</p>` : ''}
                                </article>
                            `;
                        }).join('');

                        return `
                            <section class="space-y-6 rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]">
                                ${title ? `<h2 class="text-3xl font-semibold text-[#1b1b18]">${escapeHtml(title)}</h2>` : ''}
                                <div class="${previewGridClass}">${cards}</div>
                            </section>
                        `;
                    }

                    if (layout === 'split_image') {
                        const imagePreview = section.querySelector('[data-section-image-preview]');
                        const imagePosition = section.querySelector('[data-image-position-select]')?.value || 'right';
                        const imageAltInput = section.querySelector('input[name*="[image_alt]"]');
                        const imageAltValue = imageAltInput instanceof HTMLInputElement ? imageAltInput.value : '';
                        const imageFit = section.querySelector('[data-image-fit-select]')?.value || 'cover';
                        const imageHeight = section.querySelector('[data-image-height-select]')?.value || 'md';
                        const imageSrc = imagePreview instanceof HTMLImageElement ? imagePreview.src : '{{ asset('images/img_hero.webp') }}';
                        const imageFirstClass = imagePosition === 'left' ? 'lg:order-1' : 'lg:order-2';
                        const textFirstClass = imagePosition === 'left' ? 'lg:order-2' : 'lg:order-1';
                        const imageFitClass = imageFit === 'contain' ? 'object-contain' : 'object-cover';
                        const imageHeightClass = imageHeight === 'sm' ? 'h-64' : (imageHeight === 'lg' ? 'h-[28rem]' : 'h-80');
                        const paragraphs = Array.from(section.querySelectorAll('[data-paragraph-row] textarea')).map((textarea) => {
                            const value = textarea.value ?? '';
                            return value ? `<p class="text-sm leading-relaxed text-[#5a5a55]">${escapeHtml(value)}</p>` : '';
                        }).join('');

                        return `
                            <section class="rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]">
                                <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
                                    <div class="space-y-4 ${textFirstClass}">
                                        ${title ? `<h2 class="text-3xl font-semibold text-[#1b1b18]">${escapeHtml(title)}</h2>` : ''}
                                        ${paragraphs}
                                    </div>
                                    <div class="overflow-hidden rounded-2xl border border-[#dfe8e3] bg-[#f7faf8] ${imageFirstClass}">
                                        <img src="${escapeHtml(imageSrc)}" alt="${escapeHtml(imageAltValue || title || 'Role section image')}" class="${imageHeightClass} w-full ${imageFitClass}" />
                                    </div>
                                </div>
                            </section>
                        `;
                    }

                    const paragraphs = Array.from(section.querySelectorAll('[data-paragraph-row] textarea')).map((textarea) => {
                        const value = textarea.value ?? '';
                        return value ? `<p class="text-sm leading-relaxed text-[#5a5a55]">${escapeHtml(value)}</p>` : '';
                    }).join('');

                    return `
                        <section class="space-y-4 rounded-[28px] bg-white p-8 shadow-[0_20px_50px_rgba(31,95,70,0.12)]">
                            ${title ? `<h2 class="text-3xl font-semibold text-[#1b1b18]">${escapeHtml(title)}</h2>` : ''}
                            ${paragraphs}
                        </section>
                    `;
                }).join('');

                previewSections.innerHTML = sectionsHtml;
            };

            document.querySelectorAll('[data-add-section]').forEach((button) => {
                button.addEventListener('click', () => createSection(button.dataset.addSection));
            });

            togglePreviewButton?.addEventListener('click', () => {
                const isHidden = previewWrap.style.display === 'none';
                previewWrap.style.display = isHidden ? '' : 'none';
                togglePreviewButton.textContent = isHidden ? 'Hide Preview' : 'Show Preview';
            });

            builder.addEventListener('click', (event) => {
                const target = event.target;
                if (!(target instanceof HTMLElement)) return;

                const section = target.closest('[data-section]');

                if (target.matches('[data-remove-section]')) {
                    section?.remove();
                    renderPreview();
                    return;
                }

                if (target.matches('[data-duplicate-section]') && section) {
                    cloneSection(section);
                    return;
                }

                if (target.matches('[data-add-paragraph]') && section) {
                    addParagraph(section);
                    return;
                }

                if (target.matches('[data-remove-paragraph]')) {
                    target.closest('[data-paragraph-row]')?.remove();
                    renderPreview();
                    return;
                }

                if (target.matches('[data-add-card]') && section) {
                    addCard(section);
                    return;
                }

                if (target.matches('[data-duplicate-card]') && section) {
                    const cardRow = target.closest('[data-card-row]');
                    if (cardRow instanceof HTMLElement) {
                        duplicateCard(section, cardRow);
                    }
                    return;
                }

                if (target.matches('[data-remove-card]')) {
                    target.closest('[data-card-row]')?.remove();
                    renderPreview();
                    return;
                }

                if (target.matches('[data-remove-current-image]')) {
                    const section = target.closest('[data-section]');
                    const previewImage = section?.querySelector('[data-section-image-preview]');
                    const hiddenInput = section?.querySelector('[data-image-path-input]');
                    const removeInput = section?.querySelector('[data-remove-image-input]');
                    const fileInput = section?.querySelector('[data-image-upload]');

                    if (previewImage instanceof HTMLImageElement) {
                        previewImage.src = previewImage.dataset.defaultSrc || '{{ asset('images/img_hero.webp') }}';
                    }
                    if (hiddenInput instanceof HTMLInputElement) {
                        hiddenInput.value = '';
                    }
                    if (removeInput instanceof HTMLInputElement) {
                        removeInput.value = '1';
                    }
                    if (fileInput instanceof HTMLInputElement) {
                        fileInput.value = '';
                    }
                    renderPreview();
                }
            });

            builder.addEventListener('change', (event) => {
                const target = event.target;
                if (!(target instanceof HTMLSelectElement) || !target.matches('[data-section-layout]')) return;

                const section = target.closest('[data-section]');
                if (!section) return;

                updateSectionVisibility(section, ['cards', 'split_image'].includes(target.value) ? target.value : 'text');
            });

            document.addEventListener('input', (event) => {
                const target = event.target;
                if (!(target instanceof HTMLElement)) return;

                if (target.closest('form')) {
                    renderPreview();
                }
            });

            builder.addEventListener('change', (event) => {
                const target = event.target;
                if (!(target instanceof HTMLInputElement) || !target.matches('[data-image-upload]')) return;

                const section = target.closest('[data-section]');
                const previewImage = section?.querySelector('[data-section-image-preview]');
                const hiddenInput = section?.querySelector('[data-image-path-input]');
                const file = target.files?.[0];

                if (!(previewImage instanceof HTMLImageElement)) return;

                if (!file) {
                    previewImage.src = previewImage.dataset.defaultSrc || '{{ asset('images/img_hero.webp') }}';
                    if (hiddenInput instanceof HTMLInputElement && hiddenInput.value === '') {
                        renderPreview();
                    }
                    return;
                }

                const removeInput = section?.querySelector('[data-remove-image-input]');
                if (removeInput instanceof HTMLInputElement) {
                    removeInput.value = '0';
                }

                const reader = new FileReader();
                reader.onload = () => {
                    previewImage.src = typeof reader.result === 'string' ? reader.result : (previewImage.dataset.defaultSrc || '{{ asset('images/img_hero.webp') }}');
                    renderPreview();
                };
                reader.readAsDataURL(file);
            });

            builder.addEventListener('dragstart', (event) => {
                const target = event.target;
                if (!(target instanceof HTMLElement)) return;

                const section = target.closest('[data-section]');
                const card = target.closest('[data-card-row]');

                if (section && !card) {
                    draggedSection = section;
                    section.classList.add('opacity-60');
                }

                if (card) {
                    draggedCard = card;
                    card.classList.add('opacity-60');
                }
            });

            builder.addEventListener('dragend', () => {
                if (draggedSection instanceof HTMLElement) {
                    draggedSection.classList.remove('opacity-60');
                }
                if (draggedCard instanceof HTMLElement) {
                    draggedCard.classList.remove('opacity-60');
                }
                draggedSection = null;
                draggedCard = null;
            });

            builder.addEventListener('dragover', (event) => {
                event.preventDefault();

                const target = event.target;
                if (!(target instanceof HTMLElement)) return;

                if (draggedCard) {
                    const targetCard = target.closest('[data-card-row]');
                    if (targetCard && targetCard !== draggedCard) {
                        const cardsList = targetCard.parentElement;
                        if (!cardsList) return;
                        const rect = targetCard.getBoundingClientRect();
                        const before = event.clientY < rect.top + rect.height / 2;
                        cardsList.insertBefore(draggedCard, before ? targetCard : targetCard.nextSibling);
                        const section = targetCard.closest('[data-section]');
                        if (section) {
                            reindexCards(section);
                            renderPreview();
                        }
                    }
                    return;
                }

                if (draggedSection) {
                    const targetSection = target.closest('[data-section]');
                    if (targetSection && targetSection !== draggedSection) {
                        const rect = targetSection.getBoundingClientRect();
                        const before = event.clientY < rect.top + rect.height / 2;
                        builder.insertBefore(draggedSection, before ? targetSection : targetSection.nextSibling);
                        reindexSections();
                    }
                }
            });

            renderPreview();
        })();
    </script>
@endsection
