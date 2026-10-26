@props(['stands' => null])

@php
    $sideStands = collect($stands ?? ($premiumStands ?? []))->take(4);
@endphp

<section class="max-w-[1400px] mx-auto px-4 md:px-8 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.7fr)_minmax(280px,0.85fr)] gap-5 items-stretch">

        <div class="flex flex-col rounded-[28px] border border-[#f0ebe3] bg-[#faf8f4] shadow-sm">
            <div class="px-6 pt-10 pb-4 text-center sm:px-10 sm:pt-12">
                <h1 class="mx-auto max-w-xl text-3xl font-semibold leading-tight tracking-tight text-indigo-deep sm:text-4xl">
                    L’univers des stands, près de chez vous.
                </h1>
                <p class="mx-auto mt-3 max-w-md text-[15px] leading-relaxed text-harmattan">
                    Découvrez des vendeurs et leurs produits, réunis sur une seule place de marché.
                </p>
                <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="{{ route('client.marketplace') }}"
                        class="inline-flex h-11 items-center justify-center text-white rounded-full bg-kola px-5 text-sm font-semibold text-bark hover:bg-kola-deep">
                        Voir les stands
                    </a>
                    <a href="{{ route('client.request.create') }}"
                        class="inline-flex h-11 items-center justify-center rounded-full bg-white px-5 text-sm font-semibold text-bark shadow-sm hover:bg-shea">
                        Publier une demande
                    </a>
                </div>
            </div>

            <div class="mt-6 flex max-sm:hidden items-end justify-center px-4 sm:px-8">
                <img src="{{ asset('assets/img/hero1.png') }}" alt="Cliente avec plusieurs sacs Kelbom"
                    width="320" height="320"
                    class="relative z-0 h-[240px] w-auto max-w-[50%] object-contain object-bottom sm:h-[280px]">
                <img src="{{ asset('assets/img/hero.png') }}" alt="Cliente avec ses achats Kelbom"
                    width="320" height="320"
                    class="relative z-10 -ml-10 h-[220px] w-auto max-w-[48%] object-contain object-bottom sm:-ml-44 sm:h-[280px]">
            </div>
        </div>

        <aside class="flex h-full flex-col rounded-[28px] border border-[#ece7df] bg-white p-4 shadow-sm sm:p-5">
            <div class="mb-3 flex items-center justify-between gap-3">
                <h2 class="text-sm font-semibold text-bark">Stands ouverts</h2>
                <a href="{{ route('client.marketplace') }}" class="text-xs font-semibold text-kola-deep hover:underline">Tout voir</a>
            </div>

            @if ($sideStands->isEmpty())
                <p class="py-10 text-center text-sm text-harmattan">Aucun stand pour le moment.</p>
            @else
                <ul class="flex flex-1 flex-col gap-3">
                    @foreach ($sideStands as $stand)
                        <li class="flex flex-1 items-center gap-3.5 rounded-2xl border border-[#f0ebe3] bg-[#faf8f4] p-3.5 sm:p-4">
                            @if ($stand->logo_url)
                                <img src="{{ str_starts_with($stand->logo_url, 'http') ? $stand->logo_url : Storage::url($stand->logo_url) }}"
                                    alt="" class="h-16 w-16 shrink-0 rounded-xl object-cover bg-white">
                            @else
                                <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-indigo text-sm font-semibold text-shea">
                                    {{ mb_strtoupper(mb_substr($stand->stand_name, 0, 1)) }}
                                </span>
                            @endif
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-bark">{{ $stand->stand_name }}</p>
                                <p class="mt-0.5 flex items-center gap-1 text-xs text-harmattan">
                                    <span class="text-kola">★</span>
                                    {{ number_format((float) $stand->rating_avg, 1, ',', ' ') }}
                                    · {{ $stand->city }}
                                </p>
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    <a href="{{ route('client.stand.show', $stand->slug) }}"
                                        class="text-xs font-semibold text-kola-deep hover:underline">Voir le stand</a>
                                    @if ($stand->is_verified)
                                        <span class="rounded-full bg-palm/10 px-2 py-0.5 text-[10px] font-semibold text-palm">Vérifié</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </aside>
    </div>
</section>
