<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nombre'            => 'required|max:191',
            'email'             => 'required|email|max:191|unique:users,email,'.$this->route('user').',id',
            'numeroDocumento'   => 'required|max:20',
            'celular'           => 'max:20',
            'rol'               => 'required|max:191',
            'estado'            => 'required|max:191',
        ];
    }
}
