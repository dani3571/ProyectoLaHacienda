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
            'name' => 'required',
            'ci'=> 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'photo' => 'nullable|mimes:jpeg,jpg,png',
            'personaResponsable' => 'nullable',
            'telefonoResponsable' => 'nullable',
            
        ];

     
    }
}
