<?php

namespace App\Livewire\Admin;

use App\Enums\TrainingStatusType;
use App\Models\CategoryTraining;
use App\Models\Training;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TrainingPage extends Component
{
    public ?Collection $categories;
    public $selectedCategory;

    public string $search = '';
    public  $statusList = [];

    public function updateStatus($trainingId, $status)
    {
        $training = Training::find($trainingId);
        if ($training) {
            $training->status = $status;
            $training->save();
            session()->flash('success', __('Training status updated successfully.'));
        } else {
            session()->flash('error', __('Training not found.'));
        }
    }

    public function mount()
    {
        $this->categories = CategoryTraining::all();
        $this->statusList = TrainingStatusType::getValues();
    }

    public function render()
    {
        return view('livewire.admin.training-page', [
            'trainings' => Training::query()
                ->with(['categoryTraining'])
                ->orderBy('created_at', 'desc')
                ->when(
                    $this->selectedCategory,
                    function ($query) {
                        $query->where('category_training_id', $this->selectedCategory);
                    }
                )
                ->when(
                    $this->search,
                    function ($query) {
                        $query->where(function ($subQuery) {
                            $subQuery->where('title', 'like', '%' . $this->search . '%')
                                ->orWhere('price', 'like', '%' . $this->search . '%')
                                ->orWhereDate('created_at', $this->search)
                                ->orWhereHas('categoryTraining', function ($catQuery) {
                                    $catQuery->where('name', 'like', '%' . $this->search . '%');
                                });
                        });
                    }
                )
                ->get(),
        ]);
    }
}
