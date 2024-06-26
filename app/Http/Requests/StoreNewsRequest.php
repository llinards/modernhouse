<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'news-title' => 'required',
      'news-images' => 'required'
    ];
  }

  public function messages(): array
  {
    return [
      'news-title.required' => 'Nav pievienots virsraksts!',
      'news-images.required' => 'Nav pievienotas bildes!',
    ];
  }
}
