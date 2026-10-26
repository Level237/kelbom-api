<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $stand ? $stand->stand_name . ' - Kelbom' : 'Stand introuvable - Kelbom' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="flex min-h-screen flex-col bg-zinc-50 text-bark">

    <x-client.header />

    <main class="flex-grow pb-16">
        @if(!$stand)
            <div class="mx-auto max-w-xl px-4 py-24 text-center">
                <h1 class="text-3xl font-semibold tracking-tight text-indigo-deep">Stand introuvable</h1>
                <p class="mt-3 text-[15px] leading-relaxed text-harmattan">Ce stand n’existe pas ou a été désactivé.</p>
                <a href="{{ route('client.marketplace') }}"
                    class="mt-8 inline-flex h-11 items-center justify-center rounded-full bg-kola px-5 text-sm font-semibold text-white hover:bg-kola-deep">
                    Voir les stands
                </a>
            </div>
        @else
            @php
                $logo = $stand->logo_url
                    ? (str_starts_with($stand->logo_url, 'http') ? $stand->logo_url : Storage::url($stand->logo_url))
                    : null;
                $cover = $stand->cover_url
                    ? (str_starts_with($stand->cover_url, 'http') ? $stand->cover_url : Storage::url($stand->cover_url))
                    : null;
                $rating = number_format((float) $stand->rating_avg, 1, ',', ' ');
            @endphp

            <section x-data="{ activeTab: 'products', query: '' }">
                <div class="relative h-[300px] w-full overflow-hidden sm:h-[380px] lg:h-[460px]">
                    @if($cover)
                        <img src="{{ $cover }}" alt="" class="absolute inset-0 h-full w-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-indigo-deep"></div>
                    @endif
                    <div class="absolute inset-0" style="background: linear-gradient(to top, #152a45 0%, rgba(21,42,69,.55) 38%, rgba(21,42,69,.12) 100%);"></div>

                    <div class="absolute inset-x-0 bottom-0">
                        <div class="mx-auto flex max-w-[1400px] flex-col gap-5 px-4 pb-6 sm:flex-row sm:items-end sm:justify-between md:px-8 md:pb-8">
                            <div class="flex items-end gap-4">
                                <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-2xl border-2 border-[#f5ede0] bg-[#e8eaed] text-2xl font-semibold text-indigo sm:h-24 sm:w-24">
                                    @if($logo)
                                        <img src="{{ $logo }}" alt="" class="h-full w-full object-cover">
                                    @else
                                        {{ strtoupper(substr($stand->stand_name, 0, 1)) }}
                                    @endif
                                </div>
                                <div class="min-w-0 pb-1">
                                    <h1 class="text-2xl font-semibold tracking-tight text-shea sm:text-4xl">{{ $stand->stand_name }}</h1>
                                    <p class="mt-1.5 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-shea">
                                        <span>{{ $stand->city }}{{ $stand->country ? ' · '.$stand->country : '' }}</span>
                                        <span class="font-semibold text-kola">★ {{ $rating }}</span>
                                        <span>{{ $stand->total_reviews }} avis</span>
                                        @if($stand->is_verified)
                                            <span class="rounded-full bg-palm/10 px-2 py-0.5 text-[11px] font-semibold text-shea">Vérifié</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($stand->whatsapp_number)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $stand->whatsapp_number) }}" target="_blank" rel="noopener"
                                    class="inline-flex h-11 shrink-0 items-center justify-center rounded-full bg-[#25D366] px-5 text-sm font-semibold text-white hover:bg-[#1DA851]">
                                    WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mx-auto max-w-[1400px] px-4 py-6 md:px-8">
                    @if($stand->description)
                        <p class="max-w-2xl text-[15px] leading-relaxed text-harmattan">{{ $stand->description }}</p>
                    @endif

                    <div class="mt-5 flex gap-2">
                        <button type="button" @click="activeTab = 'products'"
                            :class="activeTab === 'products' ? 'bg-kola text-white' : 'bg-white text-bark hover:border-kola'"
                            class="inline-flex h-9 items-center rounded-full border border-[#ece7df] px-4 text-sm font-semibold">
                            Produits ({{ $stand->activeProducts->count() }})
                        </button>
                        <button type="button" @click="activeTab = 'reviews'"
                            :class="activeTab === 'reviews' ? 'bg-kola text-white' : 'bg-white text-bark hover:border-kola'"
                            class="inline-flex h-9 items-center rounded-full border border-[#ece7df] px-4 text-sm font-semibold">
                            Avis ({{ $stand->total_reviews }})
                        </button>
                    </div>

                <div class="mt-5 grid grid-cols-1 items-start gap-5 lg:grid-cols-[300px_minmax(0,1fr)]">
                    <aside class="rounded-[28px] border border-[#ece7df] bg-white p-5 shadow-sm">
                        <h2 class="text-sm font-semibold text-indigo-deep">À propos</h2>
                        <dl class="mt-4 space-y-3 text-sm">
                            @if($stand->address)
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-harmattan">Adresse</dt>
                                    <dd class="mt-1 text-bark">{{ $stand->address }}</dd>
                                </div>
                            @endif
                            <div>
                                <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-harmattan">Ville</dt>
                                <dd class="mt-1 text-bark">{{ $stand->city }}{{ $stand->country ? ', '.$stand->country : '' }}</dd>
                            </div>
                            @if($stand->contact_phone)
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-harmattan">Téléphone</dt>
                                    <dd class="mt-1 text-bark">{{ $stand->contact_phone }}</dd>
                                </div>
                            @endif
                            @if($stand->contact_email)
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-harmattan">Email</dt>
                                    <dd class="mt-1 break-all">
                                        <a href="mailto:{{ $stand->contact_email }}" class="font-semibold text-indigo hover:underline">{{ $stand->contact_email }}</a>
                                    </dd>
                                </div>
                            @endif
                            @if($stand->website_url)
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-[0.12em] text-harmattan">Site</dt>
                                    <dd class="mt-1 break-all">
                                        <a href="{{ $stand->website_url }}" target="_blank" rel="noopener" class="font-semibold text-indigo hover:underline">{{ $stand->website_url }}</a>
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </aside>

                    <div>
                        <div :hidden="activeTab !== 'products'">
                            <div class="mb-4">
                                <input type="search" x-model="query" placeholder="Rechercher dans ce stand"
                                    class="h-11 w-full max-w-sm rounded-full border border-[#ece7df] bg-white px-4 text-sm text-bark outline-none placeholder:text-harmattan focus:border-kola">
                            </div>

                            <div class="relative" x-data="{ scroll(direction) { this.$refs.products.scrollBy({ left: direction * this.$refs.products.clientWidth * 0.8, behavior: 'smooth' }) } }">
                                <button type="button" @click="scroll(-1)" class="absolute top-16 left-0 z-10 hidden h-9 w-9 -translate-x-1/2 items-center justify-center rounded-full border border-[#ece7df] bg-white text-bark shadow-sm hover:border-kola md:inline-flex" aria-label="Produits précédents">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                                <button type="button" @click="scroll(1)" class="absolute top-16 right-0 z-10 hidden h-9 w-9 translate-x-1/2 items-center justify-center rounded-full border border-[#ece7df] bg-white text-bark shadow-sm hover:border-kola md:inline-flex" aria-label="Produits suivants">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                            <div x-ref="products" class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-2 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                                @forelse($stand->activeProducts as $product)
                                    @php
                                        $image = $product->main_image_url
                                            ? (str_starts_with($product->main_image_url, 'http') ? $product->main_image_url : Storage::url($product->main_image_url))
                                            : null;
                                        $whatsapp = preg_replace('/[^0-9]/', '', (string) ($stand->whatsapp_number ?: $stand->contact_phone));
                                        $priceLabel = number_format($product->price, 0, ',', ' ').' FCFA';
                                        $specLines = collect($product->specifications ?? [])
                                            ->map(fn ($spec) => trim(($spec['key'] ?? '').($spec['key'] ?? '' ? ' : ' : '').($spec['value'] ?? '')))
                                            ->filter()
                                            ->implode("\n");
                                        $whatsappText = "Bonjour, je souhaite ce produit sur Kelbom.\n"
                                            .'Stand : '.$stand->stand_name."\n"
                                            .'Produit : '.$product->name."\n"
                                            .'Prix : '.$priceLabel
                                            .($specLines ? "\n".$specLines : '');
                                        $whatsappUrl = $whatsapp ? 'https://wa.me/'.$whatsapp.'?text='.rawurlencode($whatsappText) : null;
                                    @endphp
                                    <article data-name="{{ \Illuminate\Support\Str::lower($product->name) }}"
                                        x-show="query === '' || $el.dataset.name.includes(query.toLowerCase())"
                                        class="flex w-[82%] max-w-[280px] shrink-0 snap-start flex-col overflow-hidden rounded-2xl border border-[#ece7df] bg-white shadow-sm sm:w-[46%] lg:w-[40%]">
                                        <div class="flex h-36 items-center justify-center bg-[#e8eaed] sm:h-44">
                                            @if($image)
                                                <img src="{{ $image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                            @else
                                                <span class="text-sm font-semibold text-harmattan">Photo à venir</span>
                                            @endif
                                        </div>
                                        <div class="flex flex-1 flex-col px-4 py-4">
                                            <h3 class="line-clamp-2 text-[15px] font-semibold text-bark">{{ $product->name }}</h3>
                                            @php
                                                $traits = collect($product->specifications ?? [])->pluck('value')->filter()->take(2)->implode(' · ');
                                            @endphp
                                            @if($traits)
                                                <p class="mt-1 line-clamp-1 text-xs text-harmattan">{{ $traits }}</p>
                                            @endif
                                            <p class="mt-auto pt-3 text-sm font-semibold tabular-nums text-kola-deep">{{ $priceLabel }}</p>
                                            @if($whatsappUrl)
                                                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener"
                                                    class="mt-3 inline-flex h-9 items-center justify-center rounded-full bg-[#25D366] px-3 text-xs font-semibold text-white hover:bg-[#1DA851]">
                                                    Commander sur WhatsApp
                                                </a>
                                            @endif
                                        </div>
                                    </article>
                                @empty
                                    <div class="col-span-full flex min-h-48 items-center justify-center rounded-2xl border border-dashed border-zinc-300 bg-white px-6 text-center">
                                        <p class="text-sm text-harmattan">Ce stand n’a pas encore de produits.</p>
                                    </div>
                                @endforelse
                            </div>
                            </div>
                        </div>

                        <template x-if="activeTab === 'reviews'">
                        <div class="space-y-4">
                            @if(session('success'))
                                <p class="rounded-2xl bg-palm/10 px-4 py-3 text-sm font-semibold text-palm">{{ session('success') }}</p>
                            @endif

                            <form action="{{ route('client.stand.review.store', $slug) }}" method="POST"
                                class="rounded-[28px] border border-[#ece7df] bg-white p-5 shadow-sm sm:p-6">
                                @csrf
                                <h2 class="text-sm font-semibold text-indigo-deep">Laisser un avis</h2>
                                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <label class="block text-sm">
                                        <span class="font-semibold text-bark">Votre nom</span>
                                        <input type="text" name="reviewer_name" required value="{{ old('reviewer_name') }}"
                                            class="mt-1.5 h-11 w-full rounded-xl border border-[#ece7df] bg-[#faf8f4] px-3 text-sm text-bark outline-none focus:border-kola">
                                    </label>
                                    <label class="block text-sm">
                                        <span class="font-semibold text-bark">Note</span>
                                        <select name="rating" required
                                            class="mt-1.5 h-11 w-full rounded-xl border border-[#ece7df] bg-[#faf8f4] px-3 text-sm text-bark outline-none focus:border-kola">
                                            <option value="5">5 — Excellent</option>
                                            <option value="4">4 — Très bien</option>
                                            <option value="3">3 — Correct</option>
                                            <option value="2">2 — Décevant</option>
                                            <option value="1">1 — Mauvais</option>
                                        </select>
                                    </label>
                                </div>
                                <label class="mt-4 block text-sm">
                                    <span class="font-semibold text-bark">Commentaire</span>
                                    <textarea name="comment" rows="3" class="mt-1.5 w-full rounded-xl border border-[#ece7df] bg-[#faf8f4] px-3 py-2.5 text-sm text-bark outline-none focus:border-kola">{{ old('comment') }}</textarea>
                                </label>
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" class="inline-flex h-11 items-center rounded-full bg-kola px-5 text-sm font-semibold text-white hover:bg-kola-deep">
                                        Publier mon avis
                                    </button>
                                </div>
                            </form>

                            <div class="rounded-[28px] border border-[#ece7df] bg-white p-5 shadow-sm sm:p-6">
                                <h2 class="text-sm font-semibold text-indigo-deep">Avis ({{ $stand->total_reviews }})</h2>
                                @if($stand->reviews->isEmpty())
                                    <p class="py-8 text-center text-sm text-harmattan">Aucun avis pour le moment.</p>
                                @else
                                    <ul class="mt-4 divide-y divide-[#f0ebe3]">
                                        @foreach($stand->reviews as $review)
                                            <li class="py-4 first:pt-2">
                                                <div class="flex items-center justify-between gap-3">
                                                    <div class="flex items-center gap-3">
                                                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo text-sm font-semibold text-shea">
                                                            {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                                                        </span>
                                                        <span>
                                                            <span class="block text-sm font-semibold text-bark">{{ $review->reviewer_name }}</span>
                                                            <span class="block text-xs text-harmattan">{{ $review->created_at->diffForHumans() }}</span>
                                                        </span>
                                                    </div>
                                                    <span class="text-sm font-semibold text-kola-deep">★ {{ $review->rating }}</span>
                                                </div>
                                                @if($review->comment)
                                                    <p class="mt-3 text-[15px] leading-relaxed text-bark">{{ $review->comment }}</p>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        </template>
                    </div>
                </div>
                </div>
            </section>
        @endif
    </main>

    <x-client.footer />
</body>

</html>
