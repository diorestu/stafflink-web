<footer class="bg-white px-6 py-8 shadow-[0_-10px_30px_rgba(31,95,70,0.08)]" data-aos="fade-up">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-6">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="StaffLink logo" class="h-10 w-auto" draggable="false" />
        </div>
        <nav class="flex items-center gap-6 text-sm text-[#4a4a45]">
            <a href="#" class="transition hover:text-[#1b1b18]">Terms &amp; Condition</a>
            <a href="#" class="transition hover:text-[#1b1b18]">Privacy Policy</a>
        </nav>
        <p class="text-xs text-[#9c9c96]">© 2026 StaffLink. All rights reserved.</p>
    </div>
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style>
    @keyframes stafflink-toast-pop {
        0% {
            opacity: 0;
            transform: translateY(-10px) scale(0.98);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .stafflink-toast {
        box-shadow: 0 10px 30px rgba(31, 95, 70, 0.12) !important;
        animation: stafflink-toast-pop 260ms ease-out;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    (() => {
        if (!window.Toastify) return;

        const success = @json(session('success'));
        const error = @json(session('error'));
        const info = @json(session('info'));
        const warnings = @json(session('warning'));
        const errors = @json($errors->all());

        const showToast = (text, type = 'success') => {
            if (!text) return;
            Toastify({
                text,
                duration: 4000,
                gravity: 'top',
                position: 'center',
                close: true,
                stopOnFocus: true,
                className: 'stafflink-toast',
                style: {
                    background: '#ffffff',
                    color: '#1b1b18',
                    border: '1px solid #287854',
                    borderRadius: '20px',
                },
            }).showToast();
        };

        showToast(success, 'success');
        showToast(error, 'error');
        showToast(info, 'info');
        showToast(warnings, 'warning');
        (errors || []).forEach((msg) => showToast(msg, 'error'));
    })();
</script>
