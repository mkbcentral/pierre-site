<?php

namespace App\Livewire\Admin\Post\Form;

use App\Enums\StatusType;
use App\Livewire\Forms\PostForm;
use App\Models\CategoryPost;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

use function Illuminate\Log\log;

class CreatePost extends Component
{
    use WithFileUploads;
    public PostForm $form;
    public ?Collection $categories;
    public  $levels = [];
    public  $statusList = [];
    public $content = '';

    public function mount()
    {
        $this->categories = CategoryPost::all();
        $this->statusList = StatusType::getValues();
    }

    public function store()
    {
        $fields = $this->validate();
        //dd($fields);
        try {
            // Generate slug from title
            if (isset($fields['title'])) {
                $fields['slug'] = Str::slug($fields['title']);
            }
            // Handle image upload if image is present
            if ($this->form->cover_image) {
                $imagePath = $this->form->cover_image->store('posts', 'public');
                $fields['cover_image'] = $imagePath;
            } else {
                $fields['user_id'] = Auth::id();
                $this->form->create($fields);
                session()->flash('success', __('Post created successfully.'));
                $this->redirect(route('admin.posts'));
            }
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            Log::error($exception);
        }
    }

    public function render()
    {
        return view('livewire.admin.post.form.create-post');
    }
}
