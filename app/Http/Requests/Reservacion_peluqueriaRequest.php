<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Reservacion_peluqueriaRequest extends FormRequest
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
            'fecha' => ['required', 'date'],
            'horaRecepcion'=> 'required',
            'horaEntrega' => 'required',
            'BanoSimple' => 'required',
            'corte' => 'required',
            'tranquilizante' => 'required',
            'Observaciones',
            'usuario_id' => 'required',
            'mascota_id' => 'required',
            
        ];


        
    }
}
