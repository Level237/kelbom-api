<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('seller.create.title') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        .field {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            border-radius: 12px;
            border: 1px solid #e6e2da;
            background: #fff;
            color: #1c1917;
            font-size: 15px;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }
        .field:focus {
            border-color: #1e3a5f;
            box-shadow: 0 0 0 4px rgba(30, 58, 95, 0.12);
        }
        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #3d2e24;
        }
    </style>
</head>

<body class="bg-[#f4f1ea] text-bark min-h-[100dvh] antialiased"
    x-data="standCreateForm({
        country: @js(old('country', '')),
        city: @js(old('city', '')),
        kind: @js(old('kind', 'product')),
        categoryId: @js((string) old('category_id', '')),
        categories: @js($categories),
        geocodeUrl: @js(route('seller.geocode.reverse')),
        copy: {
            logoAlt: @js(__('seller.create.logo_alt')),
            changeLogo: @js(__('seller.create.change_logo')),
            addLogo: @js(__('seller.create.add_logo')),
            geoDefault: @js(__('seller.create.geo_default')),
            geoUnavailable: @js(__('seller.create.geo_unavailable')),
            geoSearching: @js(__('seller.create.geo_searching')),
            geoDetected: @js(__('seller.create.geo_detected')),
            geoCountryMissing: @js(__('seller.create.geo_country_missing')),
            geoDenied: @js(__('seller.create.geo_denied')),
        },
    })"
    x-init="detectLocation()">

    <div class="min-h-[100dvh]">
        <aside class="fixed inset-y-0 left-0 z-20 hidden w-[420px] flex-col justify-between overflow-hidden bg-indigo-deep px-10 py-10 text-shea lg:flex">
            <div class="absolute -top-24 -right-16 h-72 w-72 rounded-full bg-laterite/20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-56 w-56 rounded-full bg-kola/10 blur-3xl"></div>

            <a href="/" class="relative flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-lg font-bold">K</span>
                <span class="text-lg font-semibold tracking-tight">Kelbom<span class="text-kola">.</span></span>
            </a>

            <div class="relative space-y-6">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-shea/60">{{ __('seller.create.space') }}</p>
                <h1 class="text-[2.6rem] font-semibold leading-[1.1] tracking-tight">{{ __('seller.create.headline') }}</h1>
                <p class="max-w-sm text-[15px] leading-relaxed text-shea/75">
                    {{ __('seller.create.intro') }}
                </p>
            </div>

            <p class="relative text-xs text-shea/45">Kelbom</p>
        </aside>

        <main class="px-4 py-8 sm:px-8 lg:ml-[420px] lg:px-14 lg:py-12">
            <div class="mx-auto w-full max-w-[640px]">
                <div class="mb-6 flex justify-end">
                    <x-locale-switch />
                </div>
                <div class="mb-8 lg:hidden">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-harmattan">{{ __('seller.create.mobile_brand') }}</p>
                    <h1 class="mt-2 text-2xl font-semibold tracking-tight text-indigo-deep">{{ __('seller.create.mobile_title') }}</h1>
                </div>

                <div class="mb-8 hidden lg:block">
                    <h2 class="text-2xl font-semibold tracking-tight text-indigo-deep">{{ __('seller.create.desktop_title') }}</h2>
                    <p class="mt-1 text-sm text-harmattan">{{ __('seller.create.desktop_hint') }}</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-semibold mb-1">{{ __('seller.create.check') }}</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('info'))
                    <div class="mb-6 rounded-2xl border border-indigo/15 bg-white px-4 py-3 text-sm text-indigo">
                        {{ session('info') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('seller.create.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="latitude" x-model="latitude">
                    <input type="hidden" name="longitude" x-model="longitude">

                    <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-[0_1px_2px_rgba(28,25,23,0.04)]">
                        <label class="mb-6 flex cursor-pointer flex-col items-center gap-4 rounded-2xl border border-dashed border-[#cfc8bc] bg-[#faf8f4] px-5 py-6 text-center transition hover:border-indigo hover:bg-white sm:flex-row sm:text-left">
                            <span class="relative flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-full border-4 border-white bg-white shadow-[0_8px_24px_-12px_rgba(30,58,95,0.45)]">
                                <template x-if="logoPreview">
                                    <img :src="logoPreview" :alt="copy.logoAlt" class="h-full w-full object-cover">
                                </template>
                                <template x-if="!logoPreview">
                                    <span class="flex flex-col items-center text-indigo">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-.9H8.982a2.192 2.192 0 00-1.736.9l-.419.669z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                                    </span>
                                </template>
                            </span>
                            <span class="min-w-0">
                                <span class="block text-base font-semibold text-indigo-deep">{{ __('seller.create.logo_title') }}</span>
                                <span class="mt-1 block text-sm text-harmattan">{{ __('seller.create.logo_hint') }}</span>
                                <span class="mt-3 inline-flex h-9 items-center rounded-lg bg-indigo px-3 text-xs font-semibold text-shea" x-text="logoPreview ? copy.changeLogo : copy.addLogo"></span>
                            </span>
                            <input type="file" name="logo" accept="image/*" class="sr-only" @change="previewLogo($event)">
                        </label>

                        <div class="mb-5">
                            <h3 class="text-sm font-semibold text-indigo-deep">{{ __('seller.create.identity') }}</h3>
                            <p class="mt-0.5 text-xs text-harmattan">{{ __('seller.create.identity_hint') }}</p>
                        </div>

                        <fieldset class="mb-5">
                            <legend class="field-label">{{ __('seller.create.offer_legend') }}</legend>
                            <div class="grid gap-3 sm:grid-cols-2">
                                <label class="flex cursor-pointer items-start gap-3 rounded-xl border p-3 transition" :class="kind === 'product' ? 'border-indigo bg-indigo/5' : 'border-[#e6e2da]'">
                                    <input type="radio" name="kind" value="product" x-model="kind" @change="categoryId = ''" class="mt-1" required>
                                    <span>
                                        <span class="block text-sm font-semibold text-indigo-deep">{{ __('seller.create.products') }}</span>
                                        <span class="mt-0.5 block text-xs text-harmattan">{{ __('seller.create.products_hint') }}</span>
                                    </span>
                                </label>
                                <label class="flex cursor-pointer items-start gap-3 rounded-xl border p-3 transition" :class="kind === 'service' ? 'border-indigo bg-indigo/5' : 'border-[#e6e2da]'">
                                    <input type="radio" name="kind" value="service" x-model="kind" @change="categoryId = ''" class="mt-1">
                                    <span>
                                        <span class="block text-sm font-semibold text-indigo-deep">{{ __('seller.create.service') }}</span>
                                        <span class="mt-0.5 block text-xs text-harmattan">{{ __('seller.create.service_hint') }}</span>
                                    </span>
                                </label>
                            </div>
                        </fieldset>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="field-label">{{ __('seller.create.your_name') }}</label>
                                <input id="name" type="text" name="name" required value="{{ old('name', $user?->name) }}" class="field" autocomplete="name">
                            </div>
                            <div>
                                <label for="stand_name" class="field-label">{{ __('seller.create.stand_name') }}</label>
                                <input id="stand_name" type="text" name="stand_name" required value="{{ old('stand_name') }}" placeholder="{{ __('seller.create.stand_name_placeholder') }}" class="field">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="category_id" class="field-label">{{ __('seller.create.category') }}</label>
                                <select id="category_id" name="category_id" required x-model="categoryId" class="field">
                                    <option value="">{{ __('seller.create.choose_category') }}</option>
                                    <template x-for="category in visibleCategories" :key="category.id">
                                        <option :value="String(category.id)" x-text="category.label"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-[0_1px_2px_rgba(28,25,23,0.04)]">
                        <div class="mb-5 flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-sm font-semibold text-indigo-deep">{{ __('seller.create.location') }}</h3>
                                <p class="mt-0.5 text-xs text-harmattan" x-text="geoMessage || copy.geoDefault"></p>
                            </div>
                            <button type="button" @click="detectLocation()"
                                class="shrink-0 rounded-full border border-[#e6e2da] px-3 py-1.5 text-xs font-semibold text-indigo hover:bg-[#faf8f4]">
                                {{ __('seller.create.detect') }}
                            </button>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="country" class="field-label">{{ __('seller.create.country') }}</label>
                                <select id="country" name="country" required x-model="country" class="field">
                                    <option value="">{{ __('seller.create.select') }}</option>
                                    @foreach ($countries as $countryName)
                                        <option value="{{ $countryName }}">{{ $countryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="city" class="field-label">{{ __('seller.create.city') }}</label>
                                <input id="city" type="text" name="city" required x-model="city" placeholder="{{ __('seller.create.city_placeholder') }}" class="field" autocomplete="address-level2">
                            </div>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-[#e7e2d8] bg-white p-5 sm:p-6 shadow-[0_1px_2px_rgba(28,25,23,0.04)]">
                        <div class="mb-5">
                            <h3 class="text-sm font-semibold text-indigo-deep">{{ __('seller.create.contact') }} @guest {{ __('seller.create.and_access') }} @endguest</h3>
                            <p class="mt-0.5 text-xs text-harmattan">{{ __('seller.create.contact_hint') }}</p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="phone_number" class="field-label">{{ __('seller.create.phone') }}</label>
                                <input id="phone_number" type="tel" name="phone_number" required value="{{ old('phone_number', $user?->phone_number) }}" placeholder="{{ __('seller.create.phone_placeholder') }}" class="field" autocomplete="tel">
                            </div>
                            <div>
                                <label for="email" class="field-label">{{ __('seller.create.email') }} <span class="font-normal text-harmattan">{{ __('seller.create.optional') }}</span></label>
                                <input id="email" type="email" name="email" value="{{ old('email', $user?->email) }}" class="field @error('email') border-red-500 @enderror" autocomplete="email">
                                @error('email')
                                    <p class="mt-1.5 text-sm text-red-700">{{ $message }}</p>
                                @enderror
                            </div>
                            @guest
                                <div>
                                    <label for="password" class="field-label">{{ __('seller.create.password') }}</label>
                                    <input id="password" type="password" name="password" required autocomplete="new-password" class="field" placeholder="{{ __('seller.create.password_placeholder') }}">
                                </div>
                                <div>
                                    <label for="password_confirmation" class="field-label">{{ __('seller.create.password_confirmation') }}</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="field">
                                </div>
                            @endguest
                        </div>
                    </section>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-harmattan">
                            @auth
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-semibold text-indigo hover:underline">{{ __('seller.create.logout') }}</a>
                            @else
                                {{ __('seller.create.already') }}
                                <a href="{{ route('login') }}" class="font-semibold text-indigo hover:underline">{{ __('seller.create.login') }}</a>
                            @endauth
                        </p>
                        <button type="submit"
                            class="inline-flex h-12 items-center justify-center rounded-xl bg-indigo px-6 text-[15px] font-semibold text-shea shadow-[0_8px_20px_-10px_rgba(30,58,95,0.8)] transition hover:bg-indigo-deep active:scale-[0.99]">
                            {{ __('seller.create.submit') }}
                        </button>
                    </div>
                </form>

                @auth
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @endauth
            </div>
        </main>
    </div>

    <script>
        function standCreateForm(config) {
            return {
                country: config.country || '',
                city: config.city || '',
                kind: config.kind || 'product',
                categoryId: config.categoryId || '',
                categories: config.categories || [],
                get visibleCategories() {
                    return this.categories.filter((category) => category.kind === this.kind);
                },
                latitude: '',
                longitude: '',
                logoPreview: null,
                geoMessage: '',
                geocodeUrl: config.geocodeUrl,
                copy: config.copy || {},

                previewLogo(event) {
                    const file = event.target.files[0];
                    if (file) this.logoPreview = URL.createObjectURL(file);
                },

                matchCountry(detected) {
                    if (!detected) return;
                    const select = document.getElementById('country');
                    if (!select) return;
                    const normalized = detected.toLowerCase();
                    for (const option of select.options) {
                        if (option.value && option.value.toLowerCase() === normalized) {
                            this.country = option.value;
                            return;
                        }
                    }
                    const aliases = {
                        "cote d'ivoire": "Côte d'Ivoire",
                        "côte d'ivoire": "Côte d'Ivoire",
                        'ivory coast': "Côte d'Ivoire",
                    };
                    if (aliases[normalized]) this.country = aliases[normalized];
                },

                async detectLocation() {
                    if (!navigator.geolocation) {
                        this.geoMessage = this.copy.geoUnavailable;
                        return;
                    }
                    this.geoMessage = this.copy.geoSearching;
                    navigator.geolocation.getCurrentPosition(
                        async (position) => {
                            this.latitude = position.coords.latitude;
                            this.longitude = position.coords.longitude;
                            try {
                                const url = new URL(this.geocodeUrl);
                                url.searchParams.set('lat', this.latitude);
                                url.searchParams.set('lon', this.longitude);
                                const response = await fetch(url, {
                                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                                });
                                if (!response.ok) throw new Error('Geocode failed');
                                const data = await response.json();
                                if (data.country) this.matchCountry(data.country);
                                if (data.city && !this.city) this.city = data.city;
                                this.geoMessage = this.copy.geoDetected;
                            } catch (e) {
                                this.geoMessage = this.copy.geoCountryMissing;
                            }
                        },
                        () => { this.geoMessage = this.copy.geoDenied; },
                        { enableHighAccuracy: false, timeout: 12000, maximumAge: 300000 }
                    );
                },
            };
        }
    </script>
</body>

</html>
