<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|numeric'
        ];
    }
}
