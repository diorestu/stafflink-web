@props([
    'name' => 'check-circle',
    'class' => 'h-5 w-5',
])

@switch($name)
    @case('comments')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M7 9h10" stroke-linecap="round" />
            <path d="M7 13h6" stroke-linecap="round" />
            <path d="M5 19l2.2-2.2H18a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v9a3 3 0 0 0 2 2.83Z" stroke-linejoin="round" />
        </svg>
    @break

    @case('users')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
            <path d="M16 12a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            <path d="M3.5 18.5c0-2.2 2-4 4.5-4s4.5 1.8 4.5 4" stroke-linecap="round" />
            <path d="M13 18.5c.2-1.8 1.8-3.2 3.8-3.2 2.1 0 3.7 1.5 3.7 3.4" stroke-linecap="round" />
        </svg>
    @break

    @case('building')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="4" y="3.5" width="16" height="17" rx="2" />
            <path d="M8 8h2M14 8h2M8 12h2M14 12h2M8 16h2M14 16h2M11 20.5v-3h2v3" stroke-linecap="round" />
        </svg>
    @break

    @case('target')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <circle cx="12" cy="12" r="8" />
            <circle cx="12" cy="12" r="4" />
            <circle cx="12" cy="12" r="1.4" fill="currentColor" stroke="none" />
        </svg>
    @break

    @case('book')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M5 5.5a2.5 2.5 0 0 1 2.5-2.5H19v17H7.5A2.5 2.5 0 0 1 5 17.5v-12Z" stroke-linejoin="round" />
            <path d="M5 17.5A2.5 2.5 0 0 1 7.5 15H19" />
        </svg>
    @break

    @case('check')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="m5 12 4.2 4.2L19 6.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @break

    @case('headset')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M4 13a8 8 0 1 1 16 0" />
            <rect x="3" y="12" width="4" height="7" rx="1.5" />
            <rect x="17" y="12" width="4" height="7" rx="1.5" />
            <path d="M17 19a3 3 0 0 1-3 3h-2" stroke-linecap="round" />
        </svg>
    @break

    @case('shield')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M12 3 5 6v5.6c0 4.3 2.8 7.7 7 9.4 4.2-1.7 7-5.1 7-9.4V6l-7-3Z" stroke-linejoin="round" />
            <path d="m9 12 2 2 4-4" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @break

    @case('heart')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path d="M12 20s-7-4.6-7-10a4 4 0 0 1 7-2.5A4 4 0 0 1 19 10c0 5.4-7 10-7 10Z" stroke-linejoin="round" />
        </svg>
    @break

    @case('briefcase')
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <rect x="3" y="7" width="18" height="12" rx="2" />
            <path d="M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M3 12h18" />
        </svg>
    @break

    @default
        <svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <circle cx="12" cy="12" r="8" />
            <path d="m8.5 12 2.5 2.5L15.5 10" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
@endswitch
