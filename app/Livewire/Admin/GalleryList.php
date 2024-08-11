<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class GalleryList extends Component
{
  public object $galleries;

  public function updateOrder($galleries)
  {
    return $galleries;
  }

  public function mount()
  {
    $this->galleries = Gallery::select('id', 'slug', 'is_pinned', 'is_video', 'created_at', 'updated_at')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'gallery_id')->where('language', app()->getLocale());
        },
      ])
      ->orderByDesc('is_pinned')
      ->orderByDesc('created_at')
      ->get();
  }

  public function render()
  {
    return view('livewire.admin.gallery-list');
  }
}
