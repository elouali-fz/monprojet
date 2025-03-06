<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarqueRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autoriser cette requête
    }

    public function rules()
    {
        return [
            'nom' => 'required|unique:marques|max:255',  // Validation pour le nom de la marque
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la marque est obligatoire.',
            'nom.unique' => 'Le nom de la marque existe déjà.',
            'nom.max' => 'Le nom de la marque ne doit pas dépasser 255 caractères.',
        ];
    }
}
