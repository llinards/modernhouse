<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\URL;

class ContactUsRequest extends FormRequest
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
      'first-name'                          => ['required', 'string', 'max:50'],
      'last-name'                           => ['required', 'string', 'max:50'],
      'email'                               => ['required', 'email'],
      'phone-number'                        => ['required', 'max:25'],
      'company'                             => ['nullable', 'max:100'],
      'customer-agrees-for-data-processing' => 'accepted',
      'subject'                             => ['nullable', 'string', 'max:255'],
      'customers-question'                  => ['nullable', 'string', 'max:5000'],
      'product-name'                        => ['nullable', 'string', 'max:255'],
      'product-variant'                     => ['nullable', 'string', 'max:255'],
      'product-variant-option'              => ['nullable', 'string', 'max:255'],
    ];
  }

  protected function failedValidation(Validator $validator): void
  {
    throw new HttpResponseException(
      redirect($this->redirectTo())->withErrors($validator)
    );
  }

  public function redirectTo(): string
  {
    return URL::previous().'#contact-us';
  }
}
