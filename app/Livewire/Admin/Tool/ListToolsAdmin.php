<?php

namespace App\Livewire\Admin\Tool;

use App\Enums\StatusType;
use App\Models\CategoryTool;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListToolsAdmin extends Component
{
    public  $statusList = [];
    public Collection $categories;
    public $selectedCategory;

    public string $search = '';
    public function mount()
    {
        $this->categories = CategoryTool::all();
        $this->statusList = StatusType::getValues();
    }
    public function updateStatus($postId, $status)
    {
        $post = Tool::find($postId);
        if ($post) {
            $post->status = $status;
            $post->save();
            session()->flash('success', __('Tool status updated successfully.'));
        } else {
            session()->flash('error', __('Tool not found.'));
        }
    }
    public function render()
    {
        return view('livewire.admin.tool.list-tools-admin', [
            'tools' => Tool::query()->with(['categoryTool'])
                ->orderBy('created_at', 'desc')
                ->when(
                    $this->selectedCategory,
                    function ($query) {
                        $query->where('category_tool_id', $this->selectedCategory);
                    }
                )
                ->when(
                    $this->search,
                    function ($query) {
                        $query->where(function ($subQuery) {
                            $subQuery->where('name', 'like', '%' . $this->search . '%')
                                ->orWhereDate('created_at', $this->search)
                                ->orWhereHas('categoryTool', function ($catQuery) {
                                    $catQuery->where('name', 'like', '%' . $this->search . '%');
                                });
                        });
                    }
                )
                ->get(),
        ]);
    }
}
