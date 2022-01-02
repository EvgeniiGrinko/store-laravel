<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'code' => 'required|min:3|max:255|unique:products,code',
            'name'=> 'required|min:3|max:255',
            'description'=> 'required|min:5',
            'price' => 'required|numeric|min:1|',
        ];
        dd($this->route());
        return $rules;
    }

    public function messages() {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно содержать минимум :min символа',
            'code.min' => 'Поле код должно быть не менее :min символов',
        ];
    }
}
