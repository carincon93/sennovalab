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
            'primer_nombre' => ['required', 'string', 'max:255'],
            'segundo_nombre' => ['nullable', 'string', 'max:255'],
            'primer_apellido' => ['required', 'string', 'max:255'],
            'segundo_apellido' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'tipo_documento' => ['required', 'string', 'max:50'],
            'numero_documento' => ['required', 'integer', 'min:0', 'max:9223372036854775807'],
            'celular' => ['required', 'integer', 'min:0', 'max:9223372036854775807'],
            'telefono' => ['required', 'string', 'max:50'],
            'extension' => ['nullable', 'string', 'max:50'],
            'autorizacion_datos' => ['required', 'boolean'],
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
    }
}
