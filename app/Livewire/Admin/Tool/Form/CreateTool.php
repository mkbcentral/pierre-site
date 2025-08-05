<?php

namespace App\Livewire\Admin\Tool\Form;

use App\Enums\StatusType;
use App\Livewire\Forms\ToolForm;
use App\Models\CategoryTool;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateTool extends Component
{
    public ToolForm $form;
    public ?Collection $categories;
    public  $statusList = [];

    public function mount()
    {
        $this->categories = CategoryTool::all();
        $this->statusList = StatusType::getValues();
    }

    public function store()
    {
        $fields = $this->validate();
        try {
            $this->form->create($fields);
            session()->flash('success', __('Tool created successfully.'));
            $this->redirect(route('admin.tools'));
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.tool.form.create-tool');
    }
}
