<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LineaDesarrolloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'nombre_linea'                     => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (is_array($this->nombre_linea)) {
            $this->merge([
                'nombre_linea' => $this->nombre_linea['value'],
            ]);
        }


    }
}
