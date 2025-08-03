<?php

namespace App\Livewire\Admin\Post\Form;

use App\Enums\TrainingStatusType;
use App\Livewire\Forms\PostForm;
use App\Models\CategoryPost;
use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public  $post;
    public PostForm $form;
    public ?Collection $categories;
    public  $statusList = [];

    public function mount(Post $post)
    {
        $this->post = $post;
        $formData = $post->toArray();
        unset($formData['cover_image']);
        $this->form->fill($formData);
        $this->categories = CategoryPost::all();
        $this->statusList = TrainingStatusType::getValues();
    }


    public function update()
    {
        $fields = $this->validate();
        try {
            // Handle image upload if image is present
            if ($this->form->cover_image) {
                $imagePath = $this->form->cover_image->store('posts', 'public');
                $fields['cover_image'] = $imagePath;
                $this->post->update($fields);
            } else {
                unset($fields['cover_image']);
                $this->post->update($fields);
            }
            session()->flash('success', __('Post updated successfully.'));
            $this->redirect(route('admin.posts'));
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.admin.post.form.edit-post');
    }
}
