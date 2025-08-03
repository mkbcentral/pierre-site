@props(['training' => null])

<div class="mb-8 p-6 bg-gradient-to-r from-gray-800 to-gray-700 rounded-lg shadow-lg border border-gray-700">
    <h2 class="text-xl font-bold mb-4 text-blue-400 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"></path>
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none">
            </circle>
        </svg>
        Formation
    </h2>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Colonne gauche -->
        <dl class="flex-1 space-y-4 text-gray-200">
            <div>
                <dt class="font-semibold text-gray-400">Titre</dt>
                <dd class="truncate">{{ $training->title }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-400">Auteur</dt>
                <dd>{{ $training->author ?? 'N/A' }}</dd>
            </div>
        </dl>
        <!-- Colonne droite -->
        <dl class="flex-1 space-y-4 text-gray-200">
            <div>
                <dt class="font-semibold text-gray-400">Description</dt>
                <dd class="italic">{{ $training->description }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-gray-400">Date de création</dt>
                <dd>{{ $training->created_at->format('d/m/Y') }}</dd>
            </div>
        </dl>
    </div>
</div>
