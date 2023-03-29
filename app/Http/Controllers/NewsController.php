<?php

namespace App\Http\Controllers;

use App\Models\NewsContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $allNewsContent = NewsContent::all();
    return view('admin.news.index', compact('allNewsContent'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.news.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $data
   * @return RedirectResponse
   */
  public function store(Request $data)
  {
    try {
      $newNewsContent = NewsContent::create([
        'title' => $data['news-title'],
        'content' => $data['news-content']
      ]);
      foreach ($data['news-images-attachments'] as $newsImageAttachment) {
        $fileName = basename($newsImageAttachment);
        Storage::disk('public')->move($newsImageAttachment, 'news/' . Str::slug($data['news-title']) . '/' . $fileName);
        if (pathinfo($newsImageAttachment)['extension'] === 'pdf') {
          $newNewsContent->newsAttachments()->create([
            'attachment_location' => Str::slug($data['news-title']) . '/' . $fileName
          ]);
        } else {
          $newNewsContent->newsImages()->create([
            'image_location' => Str::slug($data['news-title']) . '/' . $fileName
          ]);
        }
      }
      return redirect('/admin/news')->with('success', Lang::get('added'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public
  function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public
  function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public
  function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public
  function destroy($id)
  {
    //
  }
}
