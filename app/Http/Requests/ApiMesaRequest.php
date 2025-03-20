<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiMesaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255', 
            'capacidad' => 'required|integer', 
            'ubicacion' => 'required|string|max:255',
        ];
    }
}
