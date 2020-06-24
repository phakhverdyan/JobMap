<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandingSignupAcademyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email',
        ];
    }
}
