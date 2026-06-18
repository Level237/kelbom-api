@props(['data' => []])
<section class="min-h-[100dvh] bg-gradient-to-br from-[#FDFBF4] via-white to-emerald-50/30 py-8 md:py-12 px-4">
    <!-- Background Texture -->
    <div class="fixed inset-0 opacity-[0.02] pointer-events-none"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'1\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'1\'/%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <!-- Background Blur Elements -->
    <div class="fixed top-1/4 -left-40 w-96 h-96 bg-emerald-200/20 blur-[120px] rounded-full pointer-events-none -z-10"></div>
    <div class="fixed bottom-1/3 -right-40 w-96 h-96 bg-blue-100/20 blur-[120px] rounded-full pointer-events-none -z-10"></div>

    <div class="max-w-3xl mx-auto relative z-10">
        <!-- Step Indicator -->
        <div class="mb-8 md:mb-12">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#0A2E65] text-white flex items-center justify-center text-sm font-bold shadow-lg shadow-blue-900/20">
                        4
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-zinc-500 uppercase tracking-wide">Étape 4 sur 4</h2>
                        <p class="text-base md:text-lg font-bold text-zinc-900">Visuels + Confirmation</p>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-2">
                    <div class="flex items-center">
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                        <div class="w-8 h-1 bg-[#0A2E65] rounded-full"></div>
                    </div>
                </div>
            </div>
            <!-- Mobile Progress Bar -->
            <div class="sm:hidden w-full h-1 bg-zinc-100 rounded-full overflow-hidden">
                <div class="h-full w-full bg-gradient-to-r from-[#0A2E65] to-emerald-500 rounded-full transition-all duration-300"></div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-[2rem] border border-zinc-100 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] overflow-hidden">
            <!-- Card Header -->
            <div class="p-8 md:p-10 border-b border-zinc-100/50 bg-gradient-to-br from-white to-zinc-50/50">
                <h3 class="text-2xl md:text-3xl font-bold text-zinc-900 mb-2">Visuels et confirmation</h3>
                <p class="text-base text-zinc-500 max-w-xl">Finalisez votre stand avec des logos et une image de couverture attrayante.</p>
            </div>

            <!-- Form Content -->
            <form action="{{ route('seller.stand.storeStep') }}" method="POST" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
                @csrf
                <input type="hidden" name="current_step" value="4">

                <!-- Section 1: Logo du stand -->
                <div class="space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500">
                    <label class="block text-sm font-bold text-zinc-900">
                        Logo du stand
                    </label>
                    
                    <!-- Logo Upload Area -->
                    <div class="relative">
                        <input 
                            type="file" 
                            id="logo_upload" 
                            name="logo" 
                            accept="image/*" 
                            class="hidden" 
                        />
                        
                        <!-- Preview Container (Hidden by default) -->
                        <div id="logo_preview_container" class="hidden mb-4">
                            <div class="relative w-full max-w-xs">
                                <img id="logo_preview" class="w-full aspect-square object-cover rounded-xl border-2 border-emerald-200" />
                                <button 
                                    type="button" 
                                    onclick="removeLogo()"
                                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 transition-colors duration-300"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Upload Area (shown when no image) -->
                        <label 
                            id="logo_upload_area"
                            for="logo_upload" 
                            class="flex flex-col items-center justify-center w-full max-w-xs aspect-square px-6 py-8 border-2 border-dashed border-amber-300 rounded-xl hover:border-amber-500 hover:bg-amber-50/30 transition-all duration-300 cursor-pointer group bg-white"
                        >
                            <div class="flex flex-col items-center justify-center text-center">
                                <svg class="w-10 h-10 text-amber-500 group-hover:text-amber-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <p class="text-sm font-bold text-zinc-900">Ajouter un logo</p>
                                <p class="text-xs text-zinc-500 mt-1">1:1 Ratio</p>
                            </div>
                        </label>
                    </div>

                    <p class="text-xs text-zinc-500">Cliqué ou glissé, JPG ou PNG, max 2MB</p>
                </div>

                <!-- Separator -->
                <div class="pt-4 border-t border-zinc-100"></div>

                <!-- Section 2: Image de couverture -->
                <div class="space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100">
                    <label class="block text-sm font-bold text-zinc-900">
                        Image de couverture
                    </label>

                    <div class="relative">
                        <input 
                            type="file" 
                            id="cover_image" 
                            name="cover_image" 
                            accept="image/*" 
                            class="hidden" 
                        />
                        
                        <!-- Cover Preview Container (Hidden by default) -->
                        <div id="cover_preview_container" class="hidden mb-4">
                            <div class="relative w-full">
                                <img id="cover_preview" class="w-full aspect-video object-cover rounded-xl border-2 border-emerald-200" />
                                <button 
                                    type="button" 
                                    onclick="removeCover()"
                                    class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-2 transition-colors duration-300"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Upload Area (shown when no image) -->
                        <label 
                            id="cover_upload_area"
                            for="cover_image" 
                            class="flex flex-col items-center justify-center w-full aspect-video px-6 py-12 border-2 border-dashed border-emerald-300 rounded-xl hover:border-emerald-500 hover:bg-emerald-50/30 transition-all duration-300 cursor-pointer group bg-white"
                        >
                            <div class="flex flex-col items-center justify-center text-center">
                                <svg class="w-10 h-10 text-emerald-500 group-hover:text-emerald-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <p class="text-sm font-bold text-zinc-900">Photo de couverture</p>
                                <p class="text-xs text-zinc-500 mt-1">1200 x 400 recommandé</p>
                            </div>
                        </label>
                    </div>

                    <p class="text-xs text-zinc-500">Cette image sera affichée en haut de votre profil de stand</p>
                </div>

                <!-- Separator -->
                <div class="pt-4 border-t border-zinc-100"></div>

                <!-- Section 3: Résumé -->
                <div class="space-y-4 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-200">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex-1 h-px bg-zinc-200"></div>
                        <span class="text-xs font-bold text-zinc-500 uppercase px-3">Résumé</span>
                        <div class="flex-1 h-px bg-zinc-200"></div>
                    </div>

                    <div class="space-y-3 bg-zinc-50 p-6 rounded-xl">
                        <!-- Nom -->
                        <div class="flex items-start justify-between py-2 border-b border-zinc-200/50">
                            <span class="text-sm font-semibold text-zinc-700">Nom</span>
                            <span class="text-sm font-semibold text-zinc-900 text-right">{{ $data['stand_name'] ?? 'N/A' }}</span>
                        </div>

                        <!-- Catégorie -->
                        <div class="flex items-start justify-between py-2 border-b border-zinc-200/50">
                            <span class="text-sm font-semibold text-zinc-700">Catégorie</span>
                            <span class="text-sm font-semibold text-zinc-900 text-right">{{ $data['category'] ?? 'N/A' }}</span>
                        </div>

                        <!-- Ville -->
                        <div class="flex items-start justify-between py-2 border-b border-zinc-200/50">
                            <span class="text-sm font-semibold text-zinc-700">Ville</span>
                            <span class="text-sm font-semibold text-zinc-900 text-right">{{ $data['city'] ?? 'N/A' }}, {{ $data['zone'] ?? 'N/A' }}</span>
                        </div>

                        <!-- Téléphone -->
                        <div class="flex items-start justify-between py-2 border-b border-zinc-200/50">
                            <span class="text-sm font-semibold text-zinc-700">Téléphone</span>
                            <span class="text-sm font-semibold text-zinc-900 text-right">{{ $data['phone'] ?? 'N/A' }}</span>
                        </div>

                        <!-- Logo Status -->
                        <div class="flex items-start justify-between py-2 border-b border-zinc-200/50">
                            <span class="text-sm font-semibold text-zinc-700">Logo</span>
                            <div id="logo_status" class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-bold text-red-600">Non uploadé</span>
                            </div>
                        </div>

                        <!-- Couverture Status -->
                        <div class="flex items-start justify-between py-2">
                            <span class="text-sm font-semibold text-zinc-700">Couverture</span>
                            <div id="cover_status" class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-bold text-red-600">Non uploadée</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Note -->
                <div class="px-5 py-4 bg-gradient-to-r from-blue-50 to-emerald-50 rounded-xl border border-blue-100/50 flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Les visuels de qualité attirent plus de clients</p>
                        <p class="text-xs text-zinc-600 mt-1">Un bon logo et une couverture professionnelle augmentent la confiance des clients envers votre stand.</p>
                    </div>
                </div>

            

            <!-- Form Footer / Actions -->
            <div class="px-8 md:px-10 py-8 border-t border-zinc-100/50 bg-gradient-to-r from-zinc-50 to-white flex flex-col sm:flex-row items-center justify-between gap-4">
                <a
                    href="?step=3"
                    class="hidden sm:flex items-center justify-center gap-2 px-8 py-3.5 text-sm font-bold text-zinc-700 bg-white border-2 border-zinc-200 rounded-full hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300 active:scale-95"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Précédent</span>
                </a>

                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    <button
                        type="button"
                        data-action="cancel"
                        class="w-full sm:w-auto px-8 py-3.5 text-sm font-bold text-zinc-700 bg-white border-2 border-zinc-200 rounded-full hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300 active:scale-95 sm:hidden"
                    >
                        Annuler
                    </button>
                    <button
                        type="submit"
                        class="w-full sm:flex-1 px-8 py-3.5 text-sm font-bold text-white bg-[#0A2E65]  rounded-full  transition-all duration-300 active:scale-95 flex items-center justify-center gap-2"
                    >
                        <span>Créer mon stand</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            </form>
        </div>

        <!-- Support Section -->
        <div class="mt-8 md:mt-12 text-center">
            <p class="text-sm text-zinc-600">
                Prêt à lancer votre stand ?
                <a href="#" class="font-bold text-[#0A2E65] hover:text-[#0A2E65]/80 transition-colors duration-300">
                    Contacter notre support
                </a>
            </p>
        </div>
    </div>

    <script>
        // Remove Logo Function
        function removeLogo() {
            document.getElementById('logo_upload').value = '';
            document.getElementById('logo_preview_container').classList.add('hidden');
            document.getElementById('logo_upload_area').classList.remove('hidden');
            
            // Reset logo status to "Non uploadé"
            document.getElementById('logo_status').innerHTML = `
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-bold text-red-600">Non uploadé</span>
            `;
        }

        // Remove Cover Image Function
        function removeCover() {
            document.getElementById('cover_image').value = '';
            document.getElementById('cover_preview_container').classList.add('hidden');
            document.getElementById('cover_upload_area').classList.remove('hidden');
            
            // Reset cover status to "Non uploadée"
            document.getElementById('cover_status').innerHTML = `
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-bold text-red-600">Non uploadée</span>
            `;
        }

        // Logo Upload Preview Handler
        const logoInput = document.getElementById('logo_upload');
        const logoPreviewContainer = document.getElementById('logo_preview_container');
        const logoPreview = document.getElementById('logo_preview');
        const logoUploadArea = document.getElementById('logo_upload_area');
        const logoStatus = document.getElementById('logo_status');

        // Handle logo file selection
        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    logoPreview.src = event.target.result;
                    logoPreviewContainer.classList.remove('hidden');
                    logoUploadArea.classList.add('hidden');
                    
                    // Update logo status to "Uploadé"
                    logoStatus.innerHTML = `
                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-bold text-emerald-600">Uploadé</span>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle logo drag and drop
        logoUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            logoUploadArea.classList.add('border-amber-500', 'bg-amber-50/50');
        });

        logoUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            logoUploadArea.classList.remove('border-amber-500', 'bg-amber-50/50');
        });

        logoUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            logoUploadArea.classList.remove('border-amber-500', 'bg-amber-50/50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                logoInput.files = files;
                const event = new Event('change', { bubbles: true });
                logoInput.dispatchEvent(event);
            }
        });

        // Cover Image Upload Handler
        const coverInput = document.getElementById('cover_image');
        const coverPreviewContainer = document.getElementById('cover_preview_container');
        const coverPreview = document.getElementById('cover_preview');
        const coverUploadArea = document.getElementById('cover_upload_area');
        const coverStatus = document.getElementById('cover_status');

        // Handle cover file selection
        coverInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    coverPreview.src = event.target.result;
                    coverPreviewContainer.classList.remove('hidden');
                    coverUploadArea.classList.add('hidden');
                    
                    // Update cover status to "Uploadée"
                    coverStatus.innerHTML = `
                        <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-bold text-emerald-600">Uploadée</span>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle cover drag and drop
        coverUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            coverUploadArea.classList.add('border-emerald-500', 'bg-emerald-50/50');
        });

        coverUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            coverUploadArea.classList.remove('border-emerald-500', 'bg-emerald-50/50');
        });

        coverUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            coverUploadArea.classList.remove('border-emerald-500', 'bg-emerald-50/50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                coverInput.files = files;
                const event = new Event('change', { bubbles: true });
                coverInput.dispatchEvent(event);
            }
        });
    </script>
</section>
