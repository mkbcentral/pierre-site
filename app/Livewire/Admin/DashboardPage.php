<?php

namespace App\Livewire\Admin;

use App\Enums\RoleType;
use App\Enums\StatusType;
use App\Models\Post;
use App\Models\Training;
use App\Models\User;
use Livewire\Component;

class DashboardPage extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-page', [
            'trainingCount' => Training::query()
                ->where('status', StatusType::PUBLISHED)
                ->count(),
            'userCount' => User::query()->where('role', RoleType::student)->count(),
            'revenueAmount' => 0,
            'postCount' => Post::query()
                ->where('status', StatusType::PUBLISHED)
                ->count(),
        ]);
    }
}
