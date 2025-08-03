<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Création d'un nouveau chapitre</h1>
        <nav class="flex items-center text-sm text-gray-400 space-x-2" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.training.chapters', $training) }}" class="hover:text-white">Chapitres</a>
            <span>/</span>
            <span class="text-white font-semibold">Edition chapitre</span>
        </nav>
    </div>
    <div class="admin-content-section ">
        <x-widget.dash-trainig-infos :training="$training" />
        <form wire:submit='update' class="space-y-4">
            <div>
                <label class="block mb-2 text-gray-300">Titre du chapitre</label>
                <input type="text" class="admin-form-input" placeholder="Exemple: Introduction à Laravel"
                    wire:model.blur="form.title">
                @error('form.title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-gray-300">URL de la vidéo</label>
                <input type="text" class="admin-form-input" placeholder="https://..."
                    wire:model.blur="form.video_url">
                @error('form.video_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-gray-300">Contenu</label>
                <textarea rows="4" class="admin-form-input" placeholder="Décrivez le contenu du chapitre"
                    wire:model.blur="form.content"></textarea>
                @error('form.content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded
                     text-white font-semibold">Créer
                    le
                    chapitre</button>
            </div>
        </form>
    </div>
</div>
