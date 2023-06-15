<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosticoRequest extends FormRequest
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
            'nombre_diagnostico' => 'required',
            'descripcion' => 'required',
            'fecha_diagnostico' => 'required',
            'resultados' => 'required',
            'tratamiento' => 'required',
            'mascota_id' => 'required',
        ];
    }
}
