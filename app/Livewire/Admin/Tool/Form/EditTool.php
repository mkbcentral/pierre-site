<?php

namespace App\Livewire\Admin\Tool\Form;

use App\Enums\TrainingStatusType;
use App\Livewire\Forms\ToolForm;
use App\Models\CategoryTool;
use App\Models\Tool;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class EditTool extends Component
{
    public  $tool;
    public ToolForm $form;
    public ?Collection $categories;
    public  $statusList = [];

    public function mount(Tool $tool)
    {
        $this->tool = $tool;
        $this->form->fill($tool->toArray());
        $this->categories = CategoryTool::all();
        $this->statusList = TrainingStatusType::getValues();
    }


    public function update()
    {
        $fields = $this->validate();
        try {
            $this->tool->update($fields);
            session()->flash('success', __('tool updated successfully.'));
            $this->redirect(route('admin.tools'));
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.tool.form.edit-tool');
    }
}
