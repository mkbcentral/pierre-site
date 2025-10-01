<?php

namespace App\Livewire\Admin;

use App\Enums\RoleType;
use App\Models\User;
use Livewire\Component;

class StudentAdminList extends Component
{
    public string $search = '';
    public function render()
    {
        return view('livewire.admin.student-admin-list', [
            'students' => User::query()
                ->where('role', RoleType::STUDENT)
                ->when(
                    $this->search,
                    function ($query) {
                        $query->where(function ($subQuery) {
                            $subQuery->where('name', 'like', '%' . $this->search . '%')
                                ->orWhereDate('phone', $this->search)
                                ->orWhereDate('email', $this->search);
                        });
                    }
                )
                ->get()
        ]);
    }
}
