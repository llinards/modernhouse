<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductVariantRequest extends FormRequest
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
      'product-id' => ['required', 'numeric'],
      'product-variant-name' => 'required',
      'product-variant-basic-price' => ['required', 'numeric'],
      'product-variant-full-price' => ['required', 'numeric'],
      'product-variant-living-area' => ['required', 'numeric'],
      'product-variant-building-area' => ['required', 'numeric'],
      'product-variant-description' => 'required',
      'product-variant-images' => 'required'
    ];
  }
}
