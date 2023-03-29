<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductVariantDetail extends FormRequest
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
      'product-variant-id' => ['required', 'numeric'],
      'product-variant-detail-name' => 'required',
      'product-variant-detail-count' => ['required', 'numeric'],
      'product-variant-detail-new-icon' => 'mimes:svg,png',
    ];
  }
}
