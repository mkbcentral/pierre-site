<?php

namespace App\Livewire\Forms;

use App\Models\Training;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TrainingForm extends Form
{
    #[Validate('required', message: "Le tritre est obligatoire")]
    #[Validate('string', message: "Le tritre doit pas dépasser 255 caractères")]
    public $title = '';
    #[Validate('required', message: "Le nom du formateur est obligatoire")]
    #[Validate('string', message: "Le nom du formateur doit pas dépasser 255 caractères")]
    public $author = '';
    #[Validate('required', message: "La description est obligatoire")]
    #[Validate('string', message: "La description doit pas dépasser 255 caractères")]
    public $description = '';
    #[Validate('nullable', onUpdate: false)]
    #[Validate('mimes:jpeg,png', message: "L'image doit être une image de type jpeg ou png", onUpdate: false)]
    public $cover_image;
    #[Validate('required', message: "Le prix est obligatoire")]
    #[Validate('numeric', message: "Le prix doit être numérique")]
    public $price = 0.0;
    #[Validate('required', message: "Le niveau est obligatoire")]
    public $level = '';
    #[Validate('required', message: "Le statut est obligatoire")]
    public $status = '';
    #[Validate('required', message: "La catégorie est obligatoire")]
    #[Validate('exists:category_trainings,id', message: "La catégorie doit exister")]
    #[Validate('integer', message: "L'ID de la catégorie doit être un entier")]
    #[Validate('min:1', message: "L'ID de la catégorie doit être supérieur à 0")]
    public $category_training_id = '';



    //create method
    public function create(array $fields)
    {
        Training::create($fields);
    }
}
