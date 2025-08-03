<?php

namespace App\Livewire\Admin\Form;

use App\Livewire\Forms\ChapterForm;
use App\Models\Training;
use Livewire\Component;

class NewChapterPage extends Component
{
    public  $training;
    public ChapterForm $form;

    public function mount(Training $training)
    {
        $this->training = $training;
    }
    public function store()
    {
        $fields = $this->form->validate();
        try {
            $this->form->create(array_merge($fields, ['training_id' => $this->training->id ?? 0]));
            session()->flash('success', __('Chapitre créé avec succès.'));
            $this->redirect(route('admin.trainings', [$this->training]));
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.form.new-chapter-page');
    }
}
