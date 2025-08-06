<div>
    <!-- Formations Section -->
    <div class="admin-content-section ">
        <x-widget.flash-message />
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestionnaire des vos étudiants</h1>
        </div>

        <!-- Filters -->
        <div class="bg-gray-800 rounded-lg p-4 mb-6">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px]">
                    <input wire:model.live="search" type="text" placeholder="Rechercher un outil..."
                        class="admin-form-input">
                </div>

            </div>
        </div>

        <!-- Formations Table -->
        <div class="admin-card">
            <div class="overflow-x-auto">
                <table class="w-full admin-table">
                    <thead>
                        <tr>
                            <th>
                                Nom compte
                            </th>
                            <th class="">N° Téléphone</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Formations</th>
                            <th>Source</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center mr-3">
                                            <i class="fas fa-coins text-blue-400"></i>
                                        </div>
                                        <span>{{ $student->name }}</span>
                                    </div>
                                </td>
                                <td class="">{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td class="text-center">0</td>
                                <td>R.D Congo</td>
                                <td class="flex gap-2">
                                    -
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
