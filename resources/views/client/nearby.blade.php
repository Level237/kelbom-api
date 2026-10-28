<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('client.nearby.title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }
    </style>
</head>

<body class="flex min-h-screen flex-col bg-zinc-50 text-bark">
    <x-client.header />

    <main class="mx-auto w-full max-w-[1400px] flex-1 px-4 py-8 md:px-8"
        x-data="{
            locating: false,
            message: '',
            unavailable: @js(__('client.nearby.unavailable')),
            denied: @js(__('client.nearby.denied')),
            searching: @js(__('client.nearby.searching')),
            usePosition: @js(__('client.nearby.use_position')),
            locate() {
                if (!navigator.geolocation) {
                    this.message = this.unavailable;
                    return;
                }
                this.locating = true;
                this.message = '';
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const params = new URLSearchParams({
                            lat: position.coords.latitude,
                            lon: position.coords.longitude,
                        });
                        window.location = '{{ route('client.stands.nearby') }}?' + params.toString();
                    },
                    () => {
                        this.locating = false;
                        this.message = this.denied;
                    },
                    { enableHighAccuracy: false, timeout: 12000, maximumAge: 300000 }
                );
            }
        }">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-indigo-deep sm:text-3xl">{{ __('client.nearby.heading') }}</h1>
                <p class="mt-2 max-w-xl text-[15px] leading-relaxed text-harmattan">
                    @if($hasLocation)
                        {{ __('client.nearby.sorted') }}
                    @else
                        {{ __('client.nearby.prompt') }}
                    @endif
                </p>
            </div>
            <button type="button" @click="locate()" :disabled="locating"
                class="inline-flex h-11 shrink-0 items-center justify-center rounded-full bg-kola px-5 text-sm font-semibold text-white hover:bg-kola-deep disabled:opacity-60">
                <span x-text="locating ? searching : usePosition">{{ __('client.nearby.use_position') }}</span>
            </button>
        </div>
        <p class="mt-3 text-sm text-harmattan" x-text="message"></p>

        @if($stands->isEmpty())
            <p class="mt-10 text-sm text-harmattan">{{ __('client.nearby.empty') }}</p>
        @else
            <ul class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($stands as $stand)
                    <li>
                        <a href="{{ route('client.stand.show', $stand->slug) }}"
                            class="flex h-full flex-col rounded-2xl border border-[#ece7df] bg-white p-5 shadow-sm hover:border-kola">
                            <span class="text-lg font-semibold text-indigo-deep">{{ $stand->stand_name }}</span>
                            <span class="mt-1 text-sm text-harmattan">{{ $stand->city }}{{ $stand->country ? ' · '.\App\Support\Localize::line('places.'.$stand->country, $stand->country) : '' }}</span>
                            @if($stand->kind === 'service')
                                <span class="mt-3 w-fit rounded-full bg-palm/10 px-2 py-0.5 text-[11px] font-semibold text-palm">{{ __('client.nearby.service') }}</span>
                            @else
                                <span class="mt-3 w-fit rounded-full bg-kola/15 px-2 py-0.5 text-[11px] font-semibold text-kola-deep">{{ __('client.nearby.products') }}</span>
                            @endif
                            @if($stand->description)
                                <span class="mt-3 line-clamp-2 text-sm leading-relaxed text-bark">{{ \App\Support\Localize::line('stands.'.$stand->slug, $stand->description) }}</span>
                            @endif
                            <span class="mt-auto flex items-center justify-between pt-4 text-sm font-semibold">
                                @if($hasLocation && $stand->distance_km !== null)
                                    <span class="text-kola-deep">{{ $stand->distance_km < 10 ? number_format($stand->distance_km, 1, app()->getLocale() === 'en' ? '.' : ',', ' ') : number_format($stand->distance_km, 0, app()->getLocale() === 'en' ? '.' : ',', ' ') }} km</span>
                                @else
                                    <span class="text-harmattan">{{ $stand->city }}</span>
                                @endif
                                <span class="text-indigo">{{ __('client.nearby.see_stand') }}</span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>

    <x-client.footer />
</body>

</html>
