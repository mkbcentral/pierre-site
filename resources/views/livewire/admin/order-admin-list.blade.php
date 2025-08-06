<div>
    <!-- Formations Section -->
    <div class="admin-content-section ">
        <x-widget.flash-message />
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestionnaire des vos transtions</h1>
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
                                #
                            </th>
                            <th>
                                Client
                            </th>
                            <th class="">Formation</th>
                            <th>Montant</th>
                            <th>Reference</th>
                            <th>Mode de payment</th>
                            <th>Status</th>
                            <th>Date opération</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $order->user->name }}
                                </td>
                                <td class="">{{ $order->training->title }}</td>
                                <td>{{ $order->amount }} CDF</td>
                                <td>{{ $order->payment_reference }}</td>
                                <td>{{ $order->payment_reference }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
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
