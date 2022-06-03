<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInternoRequest extends FormRequest
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
            'email'                             => ['required', 'max:255',  'email', 'unique:users,email,' . $this->route('user_interno')->user_id . ',id'],
            'tipo_documento'                    => ['required', 'string', 'max:50'],
            'numero_documento'                  => ['required', 'integer', 'min:0', 'max:9223372036854775807', 'unique:users,numero_documento,' . $this->route('user_interno')->user_id . ',id'],
            'celular'                           => ['required', 'integer', 'min:0', 'max:9223372036854775807'],
            'telefono'                          => ['required', 'string', 'max:50'],
            'extension'                         => ['nullable', 'string', 'max:50'],
            'estado'                            => ['required', 'boolean'],
            'autorizacion_tratamiento_datos'    => ['required', 'boolean'],
            'rol_id'                            => ['required', 'min:0', 'max:9223372036854775807', 'integer', 'exists:roles,id'],

            'tipo_afiliacion'                   => ['required', 'string', 'max:50'],
            'numero_contrato'                   => ['required_if:tipo_afiliacion,Contratista', 'nullable', 'string', 'max:100'],
            'fecha_inicio_contrato'             => ['required_if:tipo_afiliacion,Contratista', 'nullable', 'date', 'date_format:Y-m-d', 'before:fecha_finalizacion_contrato'],
            'fecha_finalizacion_contrato'       => ['required_if:tipo_afiliacion,Contratista', 'nullable', 'date', 'date_format:Y-m-d', 'after:fecha_inicio_contrato'],
            'firma_digital'                     => ['nullable', 'mimes:jpeg,bmp,png', 'max:5000'],
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

        if (is_array($this->tipo_afiliacion)) {
            $this->merge([
                'tipo_afiliacion' => $this->tipo_afiliacion['value'],
            ]);
        }

        if (is_array($this->rol_id)) {
            $this->merge([
                'rol_id' => $this->rol_id['value'],
            ]);
        }

        if (is_array($this->estado)) {
            $this->merge([
                'estado' => $this->estado['value'] == '1' ? 1 : 0,
            ]);
        }
    }
}
