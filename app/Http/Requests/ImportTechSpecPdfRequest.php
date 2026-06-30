<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportTechSpecPdfRequest extends FormRequest
{
  /**
   * Form field name for each package slot. Middle is reserved for a future
   * "pelēkā apdare" PDF and is optional.
   *
   * @var array<string, string>
   */
  public const PACKAGE_FIELDS = [
    'basic'  => 'pdf_basic',
    'middle' => 'pdf_middle',
    'full'   => 'pdf_full',
  ];

  public function authorize(): bool
  {
    return true;
  }

  /**
   * @return array<string, array<int, string>>
   */
  public function rules(): array
  {
    return [
      'pdf_basic'  => ['required', 'file', 'mimes:pdf', 'max:20480'],
      'pdf_full'   => ['required', 'file', 'mimes:pdf', 'max:20480'],
      'pdf_middle' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
    ];
  }
}
