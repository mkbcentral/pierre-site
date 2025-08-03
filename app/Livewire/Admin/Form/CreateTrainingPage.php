<?php

namespace App\Livewire\Admin\Form;

use App\Enums\LevelType;
use App\Enums\TrainingStatusType;
use App\Livewire\Forms\TrainingForm;
use App\Models\CategoryTraining;
use Exception;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTrainingPage extends Component
{
    use WithFileUploads;
    public ?Collection $categories;
    public  $levels = [];
    public  $statusList = [];
    public TrainingForm $form;
    public function store()
    {
        $fields = $this->validate();
        try {
            // Handle image upload if image is present
            if ($this->form->cover_image) {
                $imagePath = $this->form->cover_image->store('trainings', 'public');
                $fields['cover_image'] = $imagePath;
            }
            $this->form->create($fields);
            session()->flash('success', __('Training created successfully.'));
            $this->redirect(route('admin.trainings'));
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }
    public function mount()
    {
        $this->categories = CategoryTraining::all();
        $this->levels = LevelType::getValues();
        $this->statusList = TrainingStatusType::getValues();
    }
    public function render()
    {
        return view('livewire.admin.form.create-training-page');
    }
}
