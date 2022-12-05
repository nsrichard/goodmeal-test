<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'about' => 'required',
            'logo' => 'required',
            'banner' => 'required',
            'service' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nombre requerido',
            'about.required' => 'descripción requerida',
            // .. all message complete
        ];
    }
}
