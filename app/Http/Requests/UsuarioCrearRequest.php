<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioCrearRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => 'required',
            'nombre' => 'required',
            'usuario' => ['required', 'unique:App\Models\Usuario,usuario'],
            'password' => 'required',
            'correo' => ['required', 'unique:App\Models\Usuario,correo']
        ];
    }
}
