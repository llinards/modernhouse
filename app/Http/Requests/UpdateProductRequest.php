<?php

namespace App\Http\Requests;

use App\Models\Product;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateProductRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
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
      $rules['product-name'][] = function (string $attribute, mixed $value, Closure $fail): void {
        $slug    = Str::slug($value);
        $product = $this->route('product');

        if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
          $fail('Kategorija ar šādu nosaukumu jau eksistē.');
        }
      };
    }

    return $rules;
  }
}
