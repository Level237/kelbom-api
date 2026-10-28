@php
    $locales = config('locales.supported', []);
    $codes = array_keys($locales);
    $currentIndex = array_search(app()->getLocale(), $codes, true);
    $currentIndex = $currentIndex === false ? 0 : $currentIndex;
    $count = max(count($codes), 1);
    $names = [
        'fr' => 'Français',
        'en' => 'English',
    ];
@endphp

<nav
    x-data="{ index: {{ (int) $currentIndex }} }"
    aria-label="{{ __('ui.language') }}"
    class="relative"
    style="display: inline-flex; align-items: center; height: 32px; padding: 2px; border-radius: 999px; background: #f5ede0;"
>
    <span
        style="position: absolute; top: 2px; bottom: 2px; left: 2px; width: 32px; border-radius: 999px; background: #fff; box-shadow: 0 1px 2px rgba(61, 46, 36, 0.12); transition: transform 200ms ease; pointer-events: none;"
        :style="{ transform: `translateX(${index * 32}px)` }"
        aria-hidden="true"
    ></span>

    @foreach ($locales as $code => $label)
        @php
            $name = $names[$code] ?? $label;
            $flagId = 'flag-'.$code.'-'.$loop->iteration.'-'.substr(uniqid(), -5);
        @endphp
        <a
            href="{{ route('locale.switch', $code) }}"
            hreflang="{{ $code }}"
            lang="{{ $code }}"
            @click="index = {{ $loop->index }}"
            aria-label="{{ $name }}"
            @if (app()->getLocale() === $code) aria-current="true" @endif
            class="relative"
            style="z-index: 1; display: flex; width: 32px; height: 28px; align-items: center; justify-content: center;"
        >
            @if ($code === 'fr')
                <svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true">
                    <clipPath id="{{ $flagId }}"><circle cx="8" cy="8" r="8"></circle></clipPath>
                    <g clip-path="url(#{{ $flagId }})">
                        <rect width="5.34" height="16" fill="#0055A4"></rect>
                        <rect x="5.34" width="5.33" height="16" fill="#FFFFFF"></rect>
                        <rect x="10.67" width="5.33" height="16" fill="#EF4135"></rect>
                    </g>
                </svg>
            @elseif ($code === 'en')
                <svg width="16" height="16" viewBox="0 0 60 30" aria-hidden="true">
                    <clipPath id="{{ $flagId }}"><ellipse cx="30" cy="15" rx="30" ry="15"></ellipse></clipPath>
                    <g clip-path="url(#{{ $flagId }})">
                        <rect width="60" height="30" fill="#012169"></rect>
                        <path d="M0,0 L60,30 M60,0 L0,30" stroke="#FFFFFF" stroke-width="8"></path>
                        <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4"></path>
                        <path d="M30,0 V30 M0,15 H60" stroke="#FFFFFF" stroke-width="14"></path>
                        <path d="M30,0 V30 M0,15 H60" stroke="#C8102E" stroke-width="8"></path>
                    </g>
                </svg>
            @else
                <span style="font-size: 10px; font-weight: 700; color: #3d2e24;">{{ $label }}</span>
            @endif
        </a>
    @endforeach
</nav>
