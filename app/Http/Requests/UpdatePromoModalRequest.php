<?php

namespace App\Http\Requests;

use App\Models\PromoModal;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePromoModalRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'is_enabled' => $this->boolean('is_enabled'),
      'cta_url' => $this->normalizeCtaUrl($this->input('cta_url')),
    ]);
  }

  /**
   * The CTA link must always be an absolute https URL.
   */
  private function normalizeCtaUrl(mixed $url): ?string
  {
    $url = is_string($url) ? trim($url) : '';

    if ($url === '') {
      return null;
    }

    if (str_starts_with($url, 'https://')) {
      return $url;
    }

    if (str_starts_with($url, 'http://')) {
      return 'https://'.substr($url, 7);
    }

    return 'https://'.ltrim($url, '/');
  }

  /**
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'is_enabled' => 'boolean',
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'cta_label' => 'required|string|max:255',
      'cta_url' => 'required|string|max:2048',
      'starts_at' => 'nullable|date',
      'ends_at' => 'nullable|date|after_or_equal:starts_at',
      'promo-modal-image' => [PromoModal::current()->image_filename ? 'nullable' : 'required', 'array'],
    ];
  }
}
