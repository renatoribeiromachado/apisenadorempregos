<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLegislation extends FormRequest
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
        $id = $this->segment(3);
        return [
            'title' => "required|min:3|max:255|unique:api_legislations_senador,title,{$id},id",
            //'link'  => 'required|mimes:pdf|max:10240',
            'link' => 'nullable'
        ];
    }
}
