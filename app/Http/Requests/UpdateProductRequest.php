<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'slug' => Str::slug($this->input('product-name')),
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function rules(): array
  {
    $rules = [
      'product-name' => ['required', 'string', 'max:255'],
    ];

    $isPrimaryLocale = app()->getLocale() === config('app.fallback_locale');

    if ($isPrimaryLocale) {
      $rules['slug'] = [Rule::unique('products', 'slug')->ignore($this->route('product'))];
    }

    return $rules;
  }

  /**
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'slug.unique' => 'Kategorija ar šādu nosaukumu jau eksistē.',
    ];
  }
}
