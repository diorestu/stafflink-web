@php
    $hf = \App\Models\SiteSetting::headerFooter();
@endphp

<footer class="bg-white px-6 py-8 shadow-[0_-10px_30px_rgba(31,95,70,0.08)]" data-aos="fade-up">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4">
        <nav class="flex flex-wrap items-center gap-6 text-sm text-[#4a4a45]">
            @foreach (($hf['footer_links'] ?? []) as $link)
                @if (strtolower(trim((string) ($link['label'] ?? ''))) === 'apply now')
                    @continue
                @endif
                <a href="{{ $link['url'] ?? '#' }}" class="transition hover:text-[#1b1b18]">{{ $link['label'] ?? '' }}</a>
            @endforeach
            @foreach (($hf['user_links'] ?? []) as $link)
                @if (strtolower(trim((string) ($link['label'] ?? ''))) === 'apply now')
                    @continue
                @endif
                <a href="{{ $link['url'] ?? '#' }}" class="transition hover:text-[#1b1b18]">{{ $link['label'] ?? '' }}</a>
            @endforeach
        </nav>
        <p class="text-xs text-[#9c9c96]">{{ $hf['copyright_text'] ?? '' }}</p>
    </div>
</footer>
<style>
    @keyframes stafflink-toast-in {
        0% {
            opacity: 0;
            transform: translateY(-8px) scale(0.98);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .stafflink-toast-stack {
        position: fixed;
        top: 1rem;
        left: 50%;
        z-index: 60;
        display: grid;
        gap: 0.5rem;
        transform: translateX(-50%);
        pointer-events: none;
    }

    .stafflink-toast {
        min-width: 16rem;
        max-width: min(90vw, 30rem);
        border-radius: 18px;
        border: 1px solid #287854;
        background: #ffffff;
        padding: 0.625rem 0.875rem;
        color: #1b1b18;
        box-shadow: 0 10px 30px rgba(31, 95, 70, 0.12);
        animation: stafflink-toast-in 220ms ease-out;
        pointer-events: auto;
    }
</style>
<script>
    (() => {
        const success = @json(session('success'));
        const error = @json(session('error'));
        const info = @json(session('info'));
        const warning = @json(session('warning'));
        const errors = @json($errors->all());

        const queue = [];
        if (success) queue.push({ text: success, type: 'success' });
        if (error) queue.push({ text: error, type: 'error' });
        if (info) queue.push({ text: info, type: 'info' });
        if (warning) queue.push({ text: warning, type: 'warning' });
        (errors || []).forEach((message) => {
            if (message) queue.push({ text: message, type: 'error' });
        });

        const getBorderColor = (type) => {
            if (type === 'error') return '#b42318';
            if (type === 'warning') return '#b28b2e';
            if (type === 'info') return '#2f6f9f';
            return '#287854';
        };

        const getStack = () => {
            let stack = document.querySelector('.stafflink-toast-stack');
            if (stack) return stack;

            stack = document.createElement('div');
            stack.className = 'stafflink-toast-stack';
            document.body.appendChild(stack);

            return stack;
        };

        const showToast = ({ text, type }) => {
            const stack = getStack();
            const node = document.createElement('div');
            node.className = 'stafflink-toast';
            node.style.borderColor = getBorderColor(type);
            node.textContent = text;
            stack.appendChild(node);

            window.setTimeout(() => {
                node.style.opacity = '0';
                node.style.transform = 'translateY(-8px)';
                node.style.transition = 'opacity 180ms ease, transform 180ms ease';
            }, 3600);

            window.setTimeout(() => {
                node.remove();
                if (!stack.childElementCount) {
                    stack.remove();
                }
            }, 3850);
        };

        window.stafflinkToast = (text, type = 'success') => {
            if (!text) return;
            showToast({ text, type });
        };

        if (!queue.length) return;

        queue.forEach((toast, index) => {
            window.setTimeout(() => window.stafflinkToast(toast.text, toast.type), index * 120);
        });
    })();
</script>
