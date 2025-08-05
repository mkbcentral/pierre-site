<div>
    <!-- Formations Section -->
    <div class="admin-content-section ">
        <x-widget.flash-message />
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des outils</h1>
            <div>
                <a href="{{ route('admin.tool.create') }}" class="btn-primary" id="newFormationBtn">
                    <i class="fas fa-plus mr-2"></i>
                    Nouvel outil
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-gray-800 rounded-lg p-4 mb-6">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px]">
                    <input wire:model.live="search" type="text" placeholder="Rechercher un outil..."
                        class="admin-form-input">
                </div>
                <div class="w-40">
                    <select wire:model.live="selectedCategory"
                        class="bg-gray-900 text-white border border-gray-700 rounded-lg px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">Toutes</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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
                                Nom de outil
                            </th>
                            <th class="text-center">
                                Prix
                            </th>
                            <th class="">Date de publication</th>
                            <th class="text-center">Catégorie</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tools as $tool)
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center mr-3">
                                            <i class="fas fa-coins text-blue-400"></i>
                                        </div>
                                        <span>{{ $tool->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $tool->price }}
                                </td>

                                <td class="">{{ $tool->created_at->format('d/m/Y') }}</td>
                                <td>{{ $tool->categorytool->name }}</td>
                                <td>
                                    <select wire:change="updateStatus({{ $tool->id }}, $event.target.value)"
                                        class="
                                            text-xs py-1 px-2 rounded-full whitespace-nowrap border focus:outline-none transition
                                            @if ($tool->status === 'draft') bg-slate-600-500/20 text-slate-600-700 border-slate-600-400 focus:ring-slate-600-400
                                            @elseif ($tool->status === 'archived')
                                                bg-gray-500/20 text-gray-300 border-gray-400 focus:ring-gray-400
                                            @elseif ($tool->status === 'canceled')
                                                bg-red-500/20 text-red-700 border-red-400 focus:ring-red-400
                                            @else
                                                bg-green-500/20 text-green-700 border-green-400 focus:ring-green-400 @endif
">
                                        @foreach ($statusList as $status)
                                            <option value="{{ $status }}"
                                                class="bg-white text-green-700 font-semibold px-2 py-1"
                                                {{ $tool->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="flex gap-2">
                                    <a href="{{ route('admin.tool.edit', $tool) }}"
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
