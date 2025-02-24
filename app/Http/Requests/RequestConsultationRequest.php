<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\URL;

class RequestConsultationRequest extends FormRequest
{

  public function authorize(): true
  {
    return true;
  }


  public function rules(): array
  {
    return [
      'question_one'                        => ['required', 'string'],
      'question_two'                        => ['required', 'string'],
      'question_three'                      => ['required', 'string'],
      'first-name'                          => ['required', 'string', 'max:50'],
      'last-name'                           => ['required', 'string', 'max:50'],
      'email'                               => ['required', 'email'],
      'phone-number'                        => ['required', 'string', 'max:25'],
      'company'                             => 'max:100',
      'customer-agrees-for-data-processing' => 'accepted',
    ];
  }

  public function messages(): array
  {
    return [
      'question_one.required'   => 'The first question is required',
      'question_two.required'   => 'The second question is required',
      'question_three.required' => 'The third question is required',
      'question_four.required'  => 'The fourth question is required',
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
