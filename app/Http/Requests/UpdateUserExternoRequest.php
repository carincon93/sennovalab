<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserExternoRequest extends FormRequest
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
            'primer_nombre'                     => ['required', 'string', 'max:255'],
            'segundo_nombre'                    => ['nullable', 'string', 'max:255'],
            'primer_apellido'                   => ['required', 'string', 'max:255'],
            'segundo_apellido'                  => ['nullable', 'string', 'max:255'],
            'email'                             => ['required', 'max:255',  'email', 'unique:users,email,' . $this->route('user_externo')->user_id . ',id'],
            'tipo_documento'                    => ['required', 'string', 'max:50'],
            'numero_documento'                  => ['required', 'integer', 'min:0', 'max:9223372036854775807', 'unique:users,numero_documento,' . $this->route('user_externo')->user_id . ',id'],
            'celular'                           => ['required', 'integer', 'min:0', 'max:9223372036854775807'],
            'telefono'                          => ['required', 'string', 'max:50'],
            'extension'                         => ['nullable', 'string', 'max:50'],
            'estado'                            => ['required', 'boolean'],
            'autorizacion_tratamiento_datos'    => ['required', 'boolean'],

            'tipo_usuario'                      => ['required', 'string', 'max:50'],
            'empresa_centro_formacion'          => ['required', 'string', 'max:100'],
            'nit_rut'                           => ['required', 'string', 'max:50'],
            'digito_verificacion'               => ['required', 'integer', 'max:9'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (is_array($this->tipo_documento)) {
            $this->merge([
                'tipo_documento' => $this->tipo_documento['value'],
            ]);
        }

        if (is_array($this->tipo_usuario)) {
            $this->merge([
                'tipo_usuario' => $this->tipo_usuario['value'],
            ]);
        }

        if (is_array($this->estado)) {
            $this->merge([
                'estado' => $this->estado['value'] == '1' ? 1 : 0,
            ]);
        }
    }
}
