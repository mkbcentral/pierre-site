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
    public $successMessage = '';
    public $errorMessage = '';

    protected $rules = [
        'category' => 'required|string',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:5000',
    ];

    protected $messages = [
        'category.required' => 'La sélection d\'une catégorie est obligatoire.',
        'name.required' => 'Le nom est obligatoire.',
        'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        'email.required' => 'L\'adresse email est obligatoire.',
        'email.email' => 'L\'adresse email doit être valide.',
        'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',
        'message.required' => 'Le message est obligatoire.',
        'message.max' => 'Le message ne peut pas dépasser 5000 caractères.',
    ];

    public function mount()
    {
        // Clear any messages on mount
        $this->clearMessages();
    }

    private function clearMessages()
    {
        $this->successMessage = '';
        $this->errorMessage = '';
        session()->forget(['success', 'error']);
    }

    public function sendEmail()
    {
        // Clear any existing messages first
        $this->clearMessages();

        // Validate the form data - Livewire will automatically stop execution if validation fails
        $this->validate();

        try {
            // Send the email
            Mail::to('contact@pierremusili.com')->send(new ContactMail([
                'category' => $this->category,
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]));

            // Reset the form fields
            $this->reset(['category', 'name', 'email', 'message']);

            // Set success message
            $this->successMessage = 'Message envoyé avec succès! Nous vous contacterons dans les plus brefs délais.';
        } catch (Exception $ex) {
            // Set error message if email sending fails
            $this->errorMessage = 'Une erreur est survenue. Veuillez réessayer plus tard.';
        }
    }

    public function render()
    {
        return view('livewire.pages.contact-page', [
            'categories' => CategoryTraining::all()
        ]);
    }
}
