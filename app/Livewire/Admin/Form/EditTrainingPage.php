<?php

namespace App\Livewire\Admin\Form;

use App\Enums\LevelType;
use App\Enums\TrainingStatusType;
use App\Livewire\Forms\TrainingForm;
use App\Models\CategoryTraining;
use App\Models\Training;
use Exception;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditTrainingPage extends Component
{
    use WithFileUploads;
    public  $training;
    public TrainingForm $form;
    public ?Collection $categories;
    public  $levels = [];
    public  $statusList = [];
    public function mount(Training $training)
    {
        $this->training = $training;
        $formData = $training->toArray();
        unset($formData['cover_image']);
        $this->form->fill($formData);
        $this->categories = CategoryTraining::all();
        $this->levels = LevelType::getValues();
        $this->statusList = TrainingStatusType::getValues();
    }
    public function update()
    {
        $fields = $this->validate();
        try {
            // Handle image upload if image is present
            if ($this->form->cover_image) {
                $imagePath = $this->form->cover_image->store('trainings', 'public');
                $fields['cover_image'] = $imagePath;
            }
            $this->training->update($fields);
            session()->flash('success', __('Training updated successfully.'));
            $this->redirect(route('admin.trainings'));
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.form.edit-training-page');
    }
}
