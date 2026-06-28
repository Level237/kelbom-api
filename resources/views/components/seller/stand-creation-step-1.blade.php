@props(['data' => [], 'categories' => []])
<section class="min-h-[100dvh] bg-gradient-to-br from-[#FDFBF4] via-white to-emerald-50/30 py-8 md:py-12 px-4">
    <!-- Background Texture -->
    <div class="fixed inset-0 opacity-[0.02] pointer-events-none"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'1\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'1\'/%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <!-- Background Blur Elements -->
    <div class="fixed top-1/4 -left-40 w-96 h-96 bg-emerald-200/20 blur-[120px] rounded-full pointer-events-none z-10">
    </div>
    <div class="fixed bottom-1/3 -right-40 w-96 h-96 bg-blue-100/20 blur-[120px] rounded-full pointer-events-none z-10">
    </div>

    <div class="max-w-3xl mx-auto relative z-10">
        <!-- Step Indicator -->
        <div class="mb-8 md:mb-12">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-[#0A2E65] text-white flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-900/20">
                        1
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-500 uppercase tracking-wide">Étape 1 sur 4</h2>
                        <p class="text-base md:text-lg font-bold text-zinc-900">Identité du stand</p>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-2">
                    <div class="flex items-center">
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-zinc-200 rounded-full"></div>
                        <div class="w-8 h-1 bg-zinc-200 rounded-full"></div>
                        <div class="w-8 h-1 bg-zinc-200 rounded-full"></div>
                    </div>
                </div>
            </div>
            <!-- Mobile Progress Bar -->
            <div class="sm:hidden w-full h-1 bg-zinc-100 rounded-full overflow-hidden">
                <div
                    class="h-full w-1/4 bg-gradient-to-r from-[#0A2E65] to-emerald-500 rounded-full transition-all duration-300">
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div
            class="bg-white rounded-[2rem] border border-zinc-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
            <!-- Card Header -->
            <div class="p-8 md:p-10 border-b border-zinc-100/50 bg-gradient-to-br from-white to-zinc-50/50">
                <h3 class="text-2xl md:text-3xl font-bold text-zinc-900 mb-2">Identifiez votre stand</h3>
                <p class="text-base text-zinc-500 max-w-xl">Commençons par les informations essentielles. Ces détails
                    seront visibles à vos clients.</p>
            </div>

            <!-- Form Content -->
            <form action="{{ route('seller.stand.storeStep') }}" method="POST" class="p-8 md:p-10 space-y-8">
                @csrf
                <input type="hidden" name="current_step" value="1">

                <!-- Field 1: Nom du stand -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <label for="stand_name" class="block text-sm font-bold text-zinc-900">
                        Nom du stand <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <input type="text" id="stand_name" name="stand_name"
                            value="{{ old('stand_name', $data['stand_name'] ?? '') }}"
                            placeholder="Entrez le nom de votre stand"
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 @error('stand_name') border-red-500 @enderror" />
                        @error('stand_name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-400 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m7-4a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Choisissez un nom unique et mémorable pour votre stand</p>
                </div>

                <!-- Field 2: Catégories -->
                <div class="space-y-3 animate-in  fade-in slide-in-from-bottom-4 duration-500 delay-100 relative z-20">
                    <label for="categories" class="block text-sm font-bold text-zinc-900">
                        Catégories<span class="text-red-500">*</span>
                    </label>
                    @php
                        $selectedCategories = old('categories', $data['categories'] ?? []);
                        if (!is_array($selectedCategories)) {
                            $selectedCategories = [];
                        }
                    @endphp
                    <div class="relative group " x-data="{
                        open: false,
                        selected: {{ json_encode(array_map('strval', $selectedCategories)) }},
                        options: [
                            @foreach($categories as $parent)
                                @foreach($parent->children as $child)
                                    { value: '{{ $child->id }}', label: '{{ addslashes($child->name) }}' },
                                @endforeach
                            @endforeach
                        ],
                        toggle(value) {
                            const valStr = String(value);
                            if (this.selected.includes(valStr)) {
                                this.selected = this.selected.filter(i => i !== valStr);
                            } else {
                                this.selected.push(valStr);
                            }
                        },
                        get selectedLabels() {
                            return this.selected.map(val => {
                                const opt = this.options.find(o => String(o.value) === String(val));
                                return opt ? opt.label : '';
                            }).filter(label => label !== '');
                        }
                    }" @click.away="open = false">

                        <!-- Hidden inputs for form submission -->
                        <template x-for="val in selected" :key="val">
                            <input type="hidden" name="categories[]" :value="val">
                        </template>

                        <!-- Empty hidden input to send empty array when nothing is selected -->
                        <template x-if="selected.length === 0">
                            <input type="hidden" name="categories[]" value="">
                        </template>

                        <!-- Trigger -->
                        <div @click="open = !open"
                            class="w-full px-4 py-3 min-h-[56px] text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 transition-all duration-300 hover:border-zinc-300 cursor-pointer flex flex-wrap gap-2 items-center"
                            :class="{
                                'border-[#0A2E65] ring-4 ring-blue-50': open, 
                                'border-red-500': {{ $errors->has('categories') ? 'true' : 'false' }} 
                            }">
                            <template x-if="selected.length === 0">
                                <span class="text-zinc-400">Sélectionnez vos catégories</span>
                            </template>

                            <template x-for="(label, index) in selectedLabels" :key="index">
                                <span
                                    class="bg-indigo-50 text-indigo-700 text-sm font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 border border-indigo-100 shadow-sm animate-in zoom-in-95 duration-200">
                                    <span x-text="label"></span>
                                    <button type="button" @click.stop="toggle(selected[index])"
                                        class="hover:bg-indigo-200 hover:text-indigo-900 p-0.5 rounded-md transition-colors focus:outline-none">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <div class="ml-auto text-zinc-400">
                                <svg class="w-5 h-5 transition-transform duration-300"
                                    :class="{'rotate-180 text-[#0A2E65]': open}" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute z-[10000] w-full mt-2 bg-white border border-zinc-200 rounded-xl shadow-xl shadow-blue-900/5 max-h-72 overflow-y-auto overflow-x-hidden"
                            style="display: none;">
                            @foreach($categories as $parent)
                                <div
                                    class="px-4 py-2.5 bg-zinc-50/95 backdrop-blur-sm text-xs font-black text-zinc-500 uppercase tracking-widest sticky top-0 z-[9999999] border-y border-zinc-100 first:border-t-0 shadow-sm">
                                    {{ $parent->name }}
                                </div>
                                <div class="py-1">
                                    @foreach($parent->children as $child)
                                        <label
                                            class="flex items-center px-4 py-2.5 hover:bg-blue-50/50 cursor-pointer transition-all group">
                                            <div class="relative flex items-center justify-center w-5 h-5 mr-3 border-2 rounded-md border-zinc-300 group-hover:border-blue-500 transition-colors"
                                                :class="{'bg-[#0A2E65] border-[#0A2E65] group-hover:border-[#0A2E65]': selected.includes('{{ $child->id }}')}">
                                                <input type="checkbox" class="absolute opacity-0 w-full h-full cursor-pointer"
                                                    :checked="selected.includes('{{ $child->id }}')"
                                                    @change="toggle('{{ $child->id }}')">
                                                <svg class="w-3.5 h-3.5 text-white pointer-events-none transition-opacity duration-200"
                                                    :class="{'opacity-100': selected.includes('{{ $child->id }}'), 'opacity-0': !selected.includes('{{ $child->id }}')}"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                            <span
                                                class="text-sm font-semibold text-zinc-700 group-hover:text-zinc-900 transition-colors"
                                                :class="{'text-[#0A2E65]': selected.includes('{{ $child->id }}')}">{{ $child->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        @error('categories')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="text-xs text-zinc-500">Sélectionnez les catégories qui correspondent le mieux à vos
                        produits/services.</p>
                </div>

                <!-- Field 3: Description courte -->
                <div class="space-y-3 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-200 relative z-10">
                    <label for="short_desc" class="block text-sm font-bold text-zinc-900">
                        Description courte <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <textarea id="short_desc" name="short_desc" rows="3"
                            placeholder="Décrivez brièvement votre stand. Ex: Vente de produits alimentaires de qualité au meilleur prix..."
                            class="w-full px-5 py-3.5 text-base bg-white border-2 border-zinc-200 rounded-xl text-zinc-900 placeholder:text-zinc-400 transition-all duration-300 focus:outline-none focus:border-[#0A2E65] focus:ring-4 focus:ring-blue-50 hover:border-zinc-300 resize-none @error('short_desc') border-red-500 @enderror">{{ old('short_desc', $data['short_desc'] ?? '') }}</textarea>
                        @error('short_desc')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <div class="absolute bottom-3 right-4 text-xs text-zinc-400">
                            <span class="char-count">45</span>/150
                        </div>
                    </div>
                    <p class="text-xs text-zinc-500">Maximum 150 caractères. Soyez concis et attractif.</p>
                </div>



                <!-- Required Fields Note -->
                <div
                    class="pt-4 px-5 py-4 bg-gradient-to-r from-blue-50 to-emerald-50 rounded-xl border border-blue-100/50 flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Les champs marqués d'un <span
                                class="text-red-500">*</span> sont obligatoires</p>
                        <p class="text-xs text-zinc-600 mt-1">Vous pourrez modifier ces informations à tout moment
                            depuis votre espace vendeur.</p>
                    </div>
                </div>



                <!-- Form Footer / Actions -->
                <div
                    class="px-8 md:px-10 py-8 border-t border-zinc-100/50 bg-gradient-to-r from-zinc-50 to-white flex flex-col sm:flex-row items-center justify-between gap-4">
                    <button type="button" data-action="prev-step"
                        class="hidden sm:flex items-center justify-center gap-2 px-8 py-3.5 text-sm font-bold text-zinc-700 bg-white border-2 border-zinc-200 rounded-full hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <span>Précédent</span>
                    </button>

                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                        <button type="button" data-action="cancel"
                            class="w-full sm:w-auto px-8 py-3.5 text-sm font-bold text-zinc-700 bg-white border-2 border-zinc-200 rounded-full hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300 active:scale-95 sm:hidden">
                            Annuler
                        </button>
                        <button type="button" data-action="next-step"
                            class="w-full sm:flex-1 px-8 py-3.5 text-sm font-bold text-white bg-gradient-to-r from-[#0A2E65] to-[#0A2E65]/80 rounded-full hover:from-[#0A2E65]/90 hover:to-[#0A2E65]/70 shadow-lg shadow-blue-900/20 transition-all duration-300 active:scale-95 flex items-center justify-center gap-2">
                            <span>Suivant</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Support Section -->
        <div class="mt-8 md:mt-12 text-center">
            <p class="text-sm text-zinc-600">
                Besoin d'aide ?
                <a href="#" class="font-bold text-[#0A2E65] hover:text-[#0A2E65]/80 transition-colors duration-300">
                    Consultez notre guide de création
                </a>
            </p>
        </div>
    </div>

    <script>
        // Character counter for textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            const updateCount = () => {
                const count = textarea.value.length;
                const container = textarea.closest('div');
                const counter = container.querySelector('.char-count');
                if (counter) counter.textContent = count;
            };
            textarea.addEventListener('input', updateCount);
        });

        // Form validation feedback
        document.querySelectorAll('input[type="text"], select, textarea').forEach(field => {
            field.addEventListener('blur', function () {
                if (this.value.trim()) {
                    this.classList.remove('border-zinc-200');
                    this.classList.add('border-emerald-300');
                    this.closest('div').querySelector('svg[viewBox="0 0 24 24"]')?.classList.remove('hidden');
                }
            });

            field.addEventListener('focus', function () {
                this.classList.remove('border-emerald-300');
                this.classList.add('border-zinc-200');
            });
        });
    </script>
</section>