<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class GalleryIndex extends Component
{
  public object $galleries;

  public function mount()
  {
    $this->galleries = Gallery::select('id', 'slug', 'is_pinned', 'is_video', 'created_at', 'updated_at')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'gallery_id')->where('language', app()->getLocale());
        },
      ])
      ->orderByDesc('is_pinned')
      ->orderBy('created_at', 'desc')
      ->get();
  }

  public function updateOrder($galleries)
  {
    return $galleries;
  }

  public function render()
  {
    return view('livewire.admin.gallery-index')->layout('components.layouts.admin');
  }
}
