<?php

namespace App\Http\Requests;

use App\Rules\usuario\registrar\duplicidadCorreo;
use App\Rules\usuario\registrar\duplicidadUsuario;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioActualizarRequest extends FormRequest
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
            'usuario' => ['required', new duplicidadUsuario(request()->id,request()->usuario)],
            'correo' => ['required', new duplicidadCorreo(request()->id,request()->correo)]
        ];
    }
}
