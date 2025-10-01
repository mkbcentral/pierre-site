<?php

namespace App\Http\Requests;

use App\Enums\LevelType;
use App\Enums\RoleType;
use App\Enums\TrainingStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTrainingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role === RoleType::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:trainings,title',
            'description' => 'nullable|string|max:1000',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'level' => ['required', Rule::in(LevelType::getValues())],
            'status' => ['required', Rule::in(TrainingStatusType::getValues())],
            'category_training_id' => 'required|exists:category_trainings,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            'title.unique' => 'Une formation avec ce titre existe déjà.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'author.required' => 'L\'auteur est obligatoire.',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix doit être positif.',
            'level.required' => 'Le niveau est obligatoire.',
            'level.in' => 'Le niveau sélectionné n\'est pas valide.',
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut sélectionné n\'est pas valide.',
            'category_training_id.required' => 'La catégorie est obligatoire.',
            'category_training_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'cover_image.image' => 'Le fichier doit être une image.',
            'cover_image.mimes' => 'L\'image doit être au format JPEG, PNG, JPG ou GIF.',
            'cover_image.max' => 'L\'image ne peut pas dépasser 2 MB.',
        ];
    }
}
