<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Liste des chapitres</h1>
        <nav class="flex items-center text-sm text-gray-400 space-x-2" aria-label="Breadcrumb">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.trainings') }}" class="hover:text-white">Formations</a>
            <span>/</span>
            <span class="text-white font-semibold">Création chapitre</span>
        </nav>
    </div>
    <div class="admin-content-section ">
        <x-widget.flash-message />
        <x-widget.dash-trainig-infos :training="$training" />
        <!-- Formations Table -->
        <div class="admin-card">
            <div class="overflow-x-auto">
                <table class="w-full admin-table">
                    <thead>
                        <tr>
                            <th>
                                Titre du chapitre
                            </th>
                            <th>Lien</th>
                            <th>Description</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training->chapters as $chapter)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center mr-3">
                                            <i class="fas fa-coins text-blue-400"></i>
                                        </div>
                                        <span>{{ $training->title }}</span>
                                    </div>
                                </td>
                                <td>{{ $chapter->video_url }}</td>
                                <td>{{ $chapter->content }}</td>

                                <td class="flex gap-2">
                                    <a href="{{ route('admin.training.edit.chapter', $chapter) }}"
                                        class="text-blue-500 hover:text-blue-700 p-2 rounded-lg border border-blue-200 transition"
                                        title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 p-2 rounded-lg border border-red-200 transition"
                                        title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
