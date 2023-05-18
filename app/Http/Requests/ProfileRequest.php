<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'ci'=> 'required|min:7',
            'telefono' => 'required|min:8',
            'direccion' => 'required|min:7',
            'email' => 'required|min:10',
            'photo' => 'nullable|mimes:jpeg,jpg,png',
            'personaResponsable' => 'nullable',
            'telefonoResponsable' => 'nullable',
            
        ];
    }
}
