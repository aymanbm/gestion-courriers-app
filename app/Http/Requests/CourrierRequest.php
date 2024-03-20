<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourrierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reference' => [
                'required',"max:9",
                Rule::unique('courriers')->ignore($this->courrier),
            ],

            "destinateur" => "required|max:150",
            "lieu_destinateur" => "required|max:250",
            "commentaire" => "max:250",
            "objet" => "",
            "date_reçu" => "",
            "date_envoyer" => "",
            "courrier_statue" => "required",
            'files' => 'array|max:10', // Accept an array of maximum two files
            // 'files.*' => 'max:6144', // Max size for each file within the array
            'files.*' => 'max:20044', // Max size for each file within the array

        ];
    }
}
