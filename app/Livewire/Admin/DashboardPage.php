<?php

namespace App\Livewire\Admin;

use App\Enums\StatusType;
use App\Models\Post;
use App\Models\Training;
use Livewire\Component;

class DashboardPage extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-page', [
            'trainingCount' => Training::query()
                ->where('status', StatusType::PUBLISHED)
                ->count(),
            'userCount' => 0,
            'revenueAmount' => 0,
            'postCount' => Post::query()
                ->where('status', StatusType::PUBLISHED)
                ->count(),
        ]);
    }
}
