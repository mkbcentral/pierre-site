<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Edition d'une formation</h1>
        <nav class="flex items-center text-sm text-gray-400 space-x-2" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.trainings') }}" class="hover:text-white">Formations</a>
            <span>/</span>
            <span class="text-white font-semibold">Edition</span>
        </nav>
    </div>
    <div class="admin-content-section ">
        <form wire:submit='update'>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-gray-300">Image de couverture</label>
                        <div class="admin-upload-area">
                            <i class="fas fa-cloud-upload-alt text-2xl mb-2"></i>
                            <p>Glissez votre image ici ou</p>
                            <input type="file" class="hidden" id="coverImageInput" wire:model.blur="form.cover_image"
                                accept="image/*">
                            <button type="button" class="btn-sm mt-2"
                                onclick="document.getElementById('coverImageInput').click()">Parcourir</button>

                        </div>
                        @error('form.cover_image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center justify-center h-full">
                        @if ($form->cover_image)
                            <div class="w-full h-32 mt-2 flex items-center justify-center">
                                <img src="{{ $form->cover_image->temporaryUrl() }}" alt="Preview"
                                    class="object-cover w-full h-full rounded shadow">
                            </div>
                        @elseif (isset($training) && $training->cover_image)
                            <div class="w-full h-32 mt-2 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $training->cover_image) }}" alt="Training Cover"
                                    class="object-cover w-full h-full rounded shadow">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-gray-300">Titre de la formation</label>
                        <input type="text" class="admin-form-input"
                            placeholder="Exemple: Fondamentaux des Cryptomonnaies" wire:model.blur="form.title">
                        @error('form.title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300">Nom du formateur </label>
                        <input type="text" class="admin-form-input" placeholder="Nom du formateur"
                            wire:model.blur="form.author">
                        @error('form.author')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-gray-300">Prix </label>
                        <input type="text" class="admin-form-input" placeholder="Exemple: 99.99"
                            wire:model.blur="form.price">
                        @error('form.price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300">Categorie</label>
                        <select
                            class="bg-gray-900 text-white border border-gray-700 rounded-lg w-full px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            wire:model.blur="form.category_training_id">
                            <option value="">Selectionner une category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('form.category_training_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-gray-300">Niveau</label>
                        <select
                            class="bg-gray-900 text-white w-full border border-gray-700 rounded-lg px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            wire:model.blur="form.level">
                            <option value="">Sélectionner un niveau</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level }}">{{ $level }}</option>
                            @endforeach
                        </select>
                        @error('form.level')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300">Status</label>
                        <select
                            class="bg-gray-900 text-white w-full border border-gray-700 rounded-lg px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            wire:model.blur="form.status">
                            <option value="">Sélectionner un statut</option>
                            @foreach ($statusList as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('form.status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-gray-300">Description de la formation</label>
                    <textarea class="admin-form-input h-32 resize-y" placeholder="Décrivez la formation ici..."
                        wire:model.blur="form.description"></textarea>
                    @error('form.description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.trainings') }}" id="cancelFormationBtn" class="btn-secondary">Annuler</a>
                    <button type="submit" class="btn-primary">Créer la formation</button>
                </div>
            </div>
        </form>
    </div>
</div>
