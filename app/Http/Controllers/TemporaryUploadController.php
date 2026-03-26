<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemporaryUploadRequest;
use App\Http\Services\TemporaryUploadService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TemporaryUploadController extends Controller
{
  public function store(StoreTemporaryUploadRequest $request, TemporaryUploadService $uploadService): string
  {
    return $uploadService->store($request);
  }

  public function destroy(Request $request, TemporaryUploadService $uploadService): string
  {
    $uploadService->destroy($request->getContent());

    return '';
  }

  public function load(Request $request, TemporaryUploadService $uploadService): BinaryFileResponse
  {
    return $uploadService->load($request->query('source', ''));
  }
}
