<?php

namespace App\Livewire\Admin\Post;

use App\Enums\StatusType;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListPostAdmin extends Component
{
    public  $statusList = [];
    public Collection $categories;
    public $selectedCategory;

    public string $search = '';
    public function mount()
    {
        $this->categories = CategoryPost::all();
        $this->statusList = StatusType::getValues();
    }
    public function updateStatus($postId, $status)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->status = $status;
            $post->save();
            session()->flash('success', __('Post status updated successfully.'));
        } else {
            session()->flash('error', __('Post not found.'));
        }
    }
    public function render()
    {
        return view('livewire.admin.post.list-post-admin', [
            'posts' => Post::query()->with(['categoryPost'])
                ->orderBy('created_at', 'desc')
                ->when(
                    $this->selectedCategory,
                    function ($query) {
                        $query->where('category_post_id', $this->selectedCategory);
                    }
                )
                ->when(
                    $this->search,
                    function ($query) {
                        $query->where(function ($subQuery) {
                            $subQuery->where('title', 'like', '%' . $this->search . '%')
                                ->orWhereDate('created_at', $this->search)
                                ->orWhereHas('categoryPost', function ($catQuery) {
                                    $catQuery->where('name', 'like', '%' . $this->search . '%');
                                });
                        });
                    }
                )
                ->get(),
        ]);
    }
}
