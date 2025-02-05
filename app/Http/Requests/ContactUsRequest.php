<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\URL;

class ContactUsRequest extends FormRequest
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
      'first-name'                          => ['required', 'string', 'max:50'],
      'last-name'                           => ['required', 'string', 'max:50'],
      'email'                               => ['required', 'email'],
      'phone-number'                        => ['required', 'string', 'max:25'],
      'company'                             => 'max:100',
      'customer-agrees-for-data-processing' => 'accepted',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(
      redirect($this->redirectTo())->withErrors($validator)
    );
  }

  public function redirectTo()
  {
    return URL::previous().'#contact-us';
  }
}
