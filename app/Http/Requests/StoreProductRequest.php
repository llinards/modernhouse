<?php

namespace App\Http\Requests;

use App\Models\Product;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
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
    return [
      'product-name'        => [
        'required',
        'string',
        'max:255',
        function (string $attribute, mixed $value, Closure $fail): void {
          if (Product::where('slug', Str::slug($value))->exists()) {
            $fail('Kategorija ar šādu nosaukumu jau eksistē.');
          }
        },
      ],
      'product-cover-photo' => 'required|array',
    ];
  }
}
