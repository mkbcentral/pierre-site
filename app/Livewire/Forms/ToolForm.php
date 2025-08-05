<?php

namespace App\Livewire\Forms;

use App\Models\Tool;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ToolForm extends Form
{
    #[Validate('required', message: "Le tritre est obligatoire")]
    #[Validate('string', message: "Le tritre doit pas dépasser 255 caractères")]
    public $name = '';
    #[Validate('required', message: "Le lien est obligatoire")]
    #[Validate('url', message: "L'URL de l'outil doit être une URL valide")]
    public $tool_link = '';

    #[Validate('required', message: "Le prix est obligatoire")]
    #[Validate('numeric', message: "Le prix doit être numérique")]
    public $price = 0.0;
    #[Validate('required', message: "Le statut est obligatoire")]
    public $status = '';
    #[Validate('required', message: "La catégorie est obligatoire")]
    #[Validate('exists:category_tools,id', message: "La catégorie doit exister")]
    #[Validate('integer', message: "L'ID de la catégorie doit être un entier")]
    #[Validate('min:1', message: "L'ID de la catégorie doit être supérieur à 0")]
    public $category_tool_id = '';
    #[Validate('nullable')]
    #[Validate('string', message: "L'icone doit pas dépasser 255 caractères")]
    public $icon = '';

    public function create(array $fields)
    {
        Tool::create($fields);
    }
}
