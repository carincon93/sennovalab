<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicioRequest extends FormRequest
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
            'descripcion_necesidad'                        => ['required', 'string'],
            'user_externo_id'                              => ['required', 'min:0', 'max:9223372036854775807', 'integer', 'exists:user_externo,id'],
            'tipo_servicio_id'                             => ['required', 'min:0', 'max:9223372036854775807', 'integer', 'exists:tipos_servicio,id'],
            'categoria_linea_desarrollo_id'                => ['required', 'min:0', 'max:9223372036854775807', 'integer', 'exists:categorias_linea_desarrollo,id'],


        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (is_array($this->user_externo_id)) {
            $this->merge([
                'user_externo_id' => $this->user_externo_id['value'],
            ]);
        }
        if (is_array($this->tipo_servicio_id)) {
            $this->merge([
                'tipo_servicio_id' => $this->tipo_servicio_id['value'],
            ]);
        }
        if (is_array($this->categoria_linea_desarrollo_id)) {
            $this->merge([
                'categoria_linea_desarrollo_id' => $this->categoria_linea_desarrollo_id['value'],
            ]);
        }
    }
}
