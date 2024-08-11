<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class GalleryList extends Component
{
  public object $galleries;

  public function updateOrder($galleries): void
  {
    foreach ($galleries as $gallery) {
      Gallery::findOrFail($gallery['value'])->update(['order' => $gallery['order']]);
    }
    $this->mount();
    session()->flash('success', 'Galerijas secība atjaunota');
  }

  public function mount()
  {
    $this->galleries = Gallery::select('id', 'slug', 'is_pinned', 'is_video', 'created_at', 'updated_at', 'order')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'gallery_id')->where('language', app()->getLocale());
        },
      ])
      ->orderByDesc('is_pinned')
      ->orderBy('order')
      ->orderByDesc('created_at')
      ->get();
  }

  public function render()
  {
    return view('livewire.admin.gallery-list');
  }
}
