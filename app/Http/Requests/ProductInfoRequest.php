<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInfoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name-surname' => ['required','alpha','max:50'],
            'email' => ['required', 'email'],
            'phone-number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:25'],
            'company' => 'max:100'
        ];
    }
}