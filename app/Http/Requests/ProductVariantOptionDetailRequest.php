<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariantOptionDetailRequest extends FormRequest
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
      'id'                            => ['required', 'numeric'],
      'product_variant_option_detail' => 'required',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages()
  {
    return [
      'id.required'                            => 'Kļūda! Mēģini vēlreiz.',
      'id.numeric'                             => 'Kļūda! Mēģini vēlreiz.',
      'product_variant_option_detail.required' => 'Nosaukums ir obligāts.',
    ];
  }
}
