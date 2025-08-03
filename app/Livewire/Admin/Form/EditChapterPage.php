<?php

namespace App\Livewire\Admin\Form;

use App\Livewire\Forms\ChapterForm;
use App\Models\Chapter;
use App\Models\Training;
use Livewire\Component;

class EditChapterPage extends Component
{
    public  $chapter;
    public Training $training;
    public ChapterForm $form;

    public function mount(Chapter $chapter)
    {
        $this->chapter = $chapter;
        $this->training = $chapter->training;
        $this->form->fill($chapter->toArray());
    }

    public function update()
    {
        $fields = $this->validate();
        try {
            $this->chapter->update($fields);
            session()->flash('success', __('Chapitre créé avec succès.'));
            $this->redirect(route('admin.training.chapters', [$this->training]));
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.form.edit-chapter-page');
    }
}
