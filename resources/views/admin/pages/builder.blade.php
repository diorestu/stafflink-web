@extends('admin.layout')

@section('page-title', 'Page Builder')

@section('content')
    <div class="space-y-4">
        <div class="bg-white rounded-lg shadow p-4 flex items-center justify-between gap-4">
            <div>
                <p class="text-sm text-gray-500">Editing</p>
                <p class="font-semibold">{{ $page->title }} <span class="text-gray-500">(/p/{{ $page->slug }})</span></p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.pages.edit', $page) }}" class="px-4 py-2 border rounded-lg text-sm">Edit Details</a>
                @if($page->status === 'published')
                    <a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="px-4 py-2 bg-[#1f5f46] text-white rounded-lg text-sm">View Live</a>
                @endif
            </div>
        </div>

        <form id="builder-form" action="{{ route('admin.pages.builder.update', $page) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="content_html" id="content_html">
            <input type="hidden" name="content_css" id="content_css">
            <input type="hidden" name="builder_data" id="builder_data">
        </form>

        <div id="gjs" class="bg-white border rounded-lg" style="height: 75vh; overflow: hidden;"></div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script>
        (() => {
            const initialComponents = @json($page->builder_data['components'] ?? $page->content_html ?? '<section style="padding:40px"><h1>Start building your page</h1><p>Drag blocks from the left panel.</p></section>');
            const initialStyles = @json($page->builder_data['styles'] ?? $page->content_css ?? '');

            const editor = grapesjs.init({
                container: '#gjs',
                fromElement: false,
                height: '75vh',
                storageManager: false,
                plugins: ['gjs-preset-webpage'],
                pluginsOpts: {
                    'gjs-preset-webpage': {}
                },
            });

            editor.setComponents(initialComponents || '');
            editor.setStyle(initialStyles || '');

            editor.Panels.addButton('options', {
                id: 'save-page',
                className: 'fa fa-save',
                label: 'Save',
                command: () => {
                    document.getElementById('content_html').value = editor.getHtml();
                    document.getElementById('content_css').value = editor.getCss();
                    document.getElementById('builder_data').value = JSON.stringify({
                        components: editor.getComponents(),
                        styles: editor.getStyle(),
                    });
                    document.getElementById('builder-form').submit();
                }
            });
        })();
    </script>
@endsection
