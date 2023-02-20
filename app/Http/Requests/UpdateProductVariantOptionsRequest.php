<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductVariantOptionsRequest extends FormRequest
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
      'id.*' => ['required', 'numeric'],
      'product-variant-option-title.*' => 'required',
      'product-variant-option-category.*' => 'required|in:Basic,Full',
      'product-variant-option-description.*' => 'required'
    ];
  }
}
