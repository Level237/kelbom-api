<section class="mx-auto max-w-[1400px] px-4 py-4 md:px-8">
    <div class="flex flex-col items-start justify-between gap-6 rounded-[28px] bg-indigo-deep px-6 py-8 sm:flex-row sm:items-center sm:px-10">
        <div class="max-w-xl">
            <h2 class="text-2xl font-semibold tracking-tight text-shea sm:text-[28px]">
                Vous ne trouvez pas ce qu’il vous faut ?
            </h2>
            <p class="mt-2 text-[15px] leading-relaxed text-shea/80">
                Publiez une demande. Les stands de la catégorie vous envoient leurs offres.
            </p>
        </div>
        <a href="{{ route('client.request.create') }}"
            class="inline-flex h-11 shrink-0 items-center justify-center rounded-full bg-kola px-5 text-sm font-semibold text-white hover:bg-kola-deep">
            Publier une demande
        </a>
    </div>
</section>
