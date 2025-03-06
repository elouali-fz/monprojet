<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUniteRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser cette requête
    }

    public function rules()
    {
        return [
            'nom' => 'required|max:255|unique:unites,nom,' . $this->route('unite'),  // Validation pour le nom de l'unité
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de l\'unité est obligatoire.',
            'nom.unique' => 'Le nom de l\'unité existe déjà.',
            'nom.max' => 'Le nom de l\'unité ne doit pas dépasser 255 caractères.',
        ];
    }
}
