<?php

namespace App\Livewire\Pages;

use App\Mail\ContactMail;
use App\Models\CategoryTraining;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactPage extends Component
{
    public $category;
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'category' => 'required|string',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:5000',
    ];
    public function submit()
    {
        $this->validate();
        try {
            Mail::to('contact@pierremusili.com')->send(new ContactMail([
                'category' => $this->category,
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]));
            session()->flash('success', 'Votre message a été envoyé avec succès !');
            $this->reset(['category', 'name', 'email', 'message']);
        } catch (Exception $ex) {
            session()->flash('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
        }
    }

    public function render()
    {
        return view('livewire.pages.contact-page', [
            'categories' => CategoryTraining::all()
        ]);
    }
}
