<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-center">Pievienot jaunu aktualitāti</h2>
  </x-slot>
  <x-slot name="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-12">
          @include('includes.status-messages')
          <form action="/admin/news" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="alert alert-secondary mx-0 my-2" role="alert">
              <p>Jaunums, ko pievienosi būs pieejams tikai {{ strtoupper(Lang::locale()) }}
                valodā.</p>
            </div>
            <div class="mb-3">
              <label for="news-title" class="form-label">Nosaukums</label>
              <input type="text" class="form-control" id="news-title"
                     value="{{ old('news-title') }}"
                     name="news-title">
            </div>
            <div class="mb-3">
              <label for="news-content" class="form-label">Apraksts</label>
              <x-description-text-area
                :name="'news-content'">{{ old('news-content') }}</x-description-text-area>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="news-images" class="form-label">Bildes</label>
                <x-file-upload :name="'news-images'" :required="true"/>
              </div>
              <div class="col">
                <label for="news-attachments" class="form-label">Pielikumi</label>
                <x-file-upload :name="'news-attachments'"/>
              </div>
              <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
                izmērā.</p>
              <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                                target="_blank">compressor.io</a>
              <p class="small">Pielikumam ir jābūt .PDF un pēc iespējas mazākā izmērā.</p>
            </div>
            <a href="/admin/news" class="btn btn-dark">Atpakaļ</a>
            <button type="submit" class="btn btn-success">Pievienot</button>
          </form>
        </div>
      </div>
    </div>
  </x-slot>
</x-admin-layout>
