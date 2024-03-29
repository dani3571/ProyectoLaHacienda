<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MascotaRequest extends FormRequest
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
            'nombre' => 'required|min:3',
            'tipo'=> 'required',
            'raza' => 'required|min:2|max:10',
            'color' => 'required|min:3|max:10',
            'fechaNacimiento' => 'required',
            'caracter' => 'required|min:5|max:40',
            'sexo' => 'required',
            'peso' => 'required|max:5',
            'tamaño' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg', // Validación de la imagen
            
        ];


        /*
           $table->id();
            $table->string('nombre', 60);
            $table->string('tipo', 30);
            $table->string('raza', 30);
            $table->string('color', 30);
            $table->date('fechaNacimiento');
            $table->string('caracter', 90)->nullable();
            $table->string('sexo', 30);        
            $table->char('estado')->default(1);
    
            $table->unsignedBigInteger('usuario_id'); 
            $table->foreign('usuario_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); */
    }
}
