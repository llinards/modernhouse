<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class IndexGallery extends Component
{
  public $galleries;
  public int $amount = 3;
  private $allGalleries;

  public function mount()
  {
    $this->allGalleries = $this->fetchAllGalleries();
    $this->galleries = $this->allGalleries->slice(0, $this->amount);
  }

  public function loadMore()
  {
    if ($this->allGalleries === null) {
      $this->allGalleries = $this->fetchAllGalleries();
    }

    ++$this->amount;
    $this->galleries = $this->allGalleries->slice(0, $this->amount);
    $this->dispatch('galleryChange');
  }

  private function fetchAllGalleries()
  {
    return Gallery::select('id', 'slug', 'is_video')
      ->with([
        'images' => function ($query) {
          $query->select('filename', 'gallery_id');
        },
        'translations' => function ($query) {
          $query->select('title', 'content', 'gallery_id')->where('language', app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->orderByDesc('is_pinned')
      ->orderBy('created_at', 'desc')
      ->get();
  }

  public function render()
  {
    return view('livewire.index-gallery');
  }
}
