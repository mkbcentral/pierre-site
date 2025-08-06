<?php

namespace App\Livewire\Admin;

use App\Models\OrderTraining;
use Livewire\Component;

class OrderAdminList extends Component
{
    public function render()
    {
        return view('livewire.admin.order-admin-list', [
            'orders' => OrderTraining::query()
                ->with(['user', 'training'])
                ->orderBy('created_at', 'DESC')
                ->get()
        ]);
    }
}
