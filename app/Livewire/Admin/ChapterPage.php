<?php

namespace App\Livewire\Admin;

use App\Models\Training;
use Livewire\Component;

class ChapterPage extends Component
{
    public $training;

    public function mount(Training $training)
    {
        $this->training = $training;
    }
    public function render()
    {
        return view('livewire.admin.chapter-page');
    }
}
