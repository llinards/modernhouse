<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemporaryUploadRequest extends FormRequest
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
      'product-cover-photo.*'           => ['file', 'image', 'max:10240'],
      'product-cover-video.*'           => ['file', 'mimes:mp4,mov,avi', 'max:102400'],
      'product-variant-images.*'        => ['file', 'image', 'max:10240'],
      'gallery-images.*'                => ['file', 'image', 'max:10240'],
      'news-images.*'                   => ['file', 'image', 'max:10240'],
      'news-attachments.*'              => ['file', 'max:20480'],
      'product-variant-attachments.*'   => ['file', 'max:51200'],
      'product-variant-options-excel.*' => ['file', 'mimes:xlsx,xls,csv', 'max:10240'],
      'product-variant-plan.*'          => ['file', 'max:20480'],
      'introduction-video.*'            => ['file', 'mimes:mp4,mov,avi', 'max:102400'],
    ];
  }
}
