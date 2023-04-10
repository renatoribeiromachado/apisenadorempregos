<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateConfig extends FormRequest
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
            'site' => "required",
            'email' => "required",
            'description' => "required", 
            'phone' => "required",
            'whatsapp' => "required", 
            'fantasy' => "required",
            'adress' => "required", 
            'facebook' => "required",
            'instagram' => "required", 
            'linkedin' => "required",
            'google' => "required", 
            'vision' => "required",
            'service' => "required"
        ];
    }
}
