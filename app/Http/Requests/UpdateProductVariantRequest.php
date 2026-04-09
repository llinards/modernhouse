<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProductVariantRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'slug' => Str::slug($this->input('product-variant-name')),
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function rules(): array
  {
    $rules = [
      'product-variant-name'          => ['required', 'string'],
      'product-variant-basic-price'   => ['nullable', 'numeric'],
      'product-variant-middle-price'  => ['nullable', 'numeric'],
      'product-variant-full-price'    => ['nullable', 'numeric'],
      'product-variant-living-area'   => ['required', 'numeric'],
      'product-variant-building-area' => ['required', 'numeric'],
      'product-variant-description'   => ['required', 'string'],
      'product-variant-images'        => ['required', 'array', 'min:1'],
      'product-variant-images.*'      => ['required', 'string'],
    ];

    $isPrimaryLocale = app()->getLocale() === config('app.fallback_locale');

    if ($isPrimaryLocale) {
      $rules['slug'] = [Rule::unique('product_variants', 'slug')->ignore($this->route('productVariant'))];
    }

    return $rules;
  }

  /**
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'slug.unique' => 'Produkta variants ar šādu nosaukumu jau eksistē.',
    ];
  }
}
