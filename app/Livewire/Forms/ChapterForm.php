<?php

namespace App\Livewire\Forms;

use App\Models\Chapter;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ChapterForm extends Form
{
    #[Validate('required', message: "Le tritre est obligatoire")]
    #[Validate('string', message: "Le tritre doit pas dépasser 255 caractères")]
    public $title = '';
    #[Validate('required', message: "Le contenu est obligatoire")]
    #[Validate('string', message: "Le contenu doit pas dépasser 65535 caractères")]
    public $content = '';
    //video url
    #[Validate('required', message: "L'URL de la vidéo doit être valide")]
    #[Validate('url', message: "L'URL de la vidéo doit être une URL valide")]
    public $video_url = '';

    //create method
    public function create(array $fields)
    {
        // Create a new chapter using the validated fields
        Chapter::create($fields);
    }
}
