<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Création d'un outil</h1>
        <nav class="flex items-center text-sm text-gray-400 space-x-2" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.tools') }}" class="hover:text-white">Outils</a>
            <span>/</span>
            <span class="text-white font-semibold">Modification</span>
        </nav>
    </div>

    <div class="admin-content-section ">
        <form wire:submit='update'>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-gray-300">Nom de l'outil</label>
                        <input type="text" class="admin-form-input" placeholder="Saisir le nom ici"
                            wire:model.blur="form.name">
                        @error('form.name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300">Le prix de l'outil</label>
                        <input type="text" class="admin-form-input" placeholder="Saisir le prix ici"
                            wire:model.blur="form.price">
                        @error('form.price')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-gray-300">Categorie</label>
                        <select
                            class="bg-gray-900 text-white border border-gray-700 rounded-lg w-full px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            wire:model.blur="form.category_tool_id">
                            <option value="">Selectionner une category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('form.category_tool_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-gray-300">Le lien de l'outil</label>
                        <input type="text" class="admin-form-input" placeholder="Saisir le lien ici"
                            wire:model.blur="form.tool_link">
                        @error('form.tool_link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    <div>
                        <label class="block mb-2 text-gray-300">L'ione de l'outil</label>
                        <input type="text" class="admin-form-input" placeholder="Saisir l'icone ici"
                            wire:model.blur="form.icon">
                        @error('form.icon')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.tools') }}" id="cancelFormationBtn" class="btn-secondary">Annuler</a>
                    <button type="submit" class="btn-primary">Modifier l'outil</button>
                </div>
            </div>
        </form>
    </div>
</div>
