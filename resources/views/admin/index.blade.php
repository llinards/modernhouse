<x-layouts.admin>
    <x-slot name="header">
        Visas mājas/moduļi
    </x-slot>
    <x-slot name="content">
        <div class="d-flex gap-2">
            @if (app()->getLocale() == 'lv')
                <div class="my-2">
                    <a href="{{ route('admin.products.create', ['locale' => app()->getLocale()]) }}"
                        class="btn btn-success">Jauna
                        kategorija</a>
                </div>
                <div class="my-2">
                    <a href="/admin/{{ app()->getLocale() }}/product-variant/create" class="btn btn-success">Jauns
                        modulis/māja</a>
                </div>
            @endif
            <div class="my-2">
                <a href="/admin/{{ app()->getLocale() }}/project-catalogs" class="btn btn-success">Projektu katalogi</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <livewire:admin.product-list />
        </div>
        <hr class="my-4">
        <h5>Pirmā skata video</h5>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
                <form action="{{ route('admin.introduction-video.update', ['locale' => app()->getLocale()]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <x-file-upload :name="'introduction-video'" :required="'true'" :files="$videoExists ? json_encode(['introduction-video/introduction-video.mp4']) : null" />
                        <p class="small">Video ir jābūt .MP4 formātā un pēc iespējas mazākā izmērā.</p>
                        <p class="small">Pirmais kadrs tiks automātiski izmantots kā priekšskatījuma bilde.</p>
                    </div>
                    <button type="submit" class="btn btn-success">Saglabāt</button>
                </form>
            </div>
        </div>
        <hr class="my-4">
        <h5>Sākumlapas reklāmas logs</h5>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
                <form action="{{ route('admin.promo-modal.update', ['locale' => app()->getLocale()]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="promo-modal-is-enabled" name="is_enabled"
                            value="1" @checked(old('is_enabled', $promoModal->is_enabled))>
                        <label class="form-check-label" for="promo-modal-is-enabled">Rādīt reklāmas logu
                            sākumlapā</label>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="promo-modal-starts-at" class="form-label">Rādīt no (neobligāts)</label>
                            <input type="date" class="form-control" id="promo-modal-starts-at" name="starts_at"
                                value="{{ old('starts_at', $promoModal->starts_at?->format('Y-m-d')) }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="promo-modal-ends-at" class="form-label">Rādīt līdz (neobligāts)</label>
                            <input type="date" class="form-control" id="promo-modal-ends-at" name="ends_at"
                                value="{{ old('ends_at', $promoModal->ends_at?->format('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="promo-modal-title" class="form-label">Virsraksts</label>
                        <input type="text" class="form-control" id="promo-modal-title" name="title"
                            value="{{ old('title', $promoModal->title) }}">
                    </div>
                    <div class="mb-3">
                        <label for="promo-modal-description" class="form-label">Apraksts (neobligāts)</label>
                        <x-description-text-area
                            :name="'description'">{{ old('description', $promoModal->description) }}</x-description-text-area>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="promo-modal-cta-label" class="form-label">Pogas teksts</label>
                            <input type="text" class="form-control" id="promo-modal-cta-label" name="cta_label"
                                value="{{ old('cta_label', $promoModal->cta_label) }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="promo-modal-cta-url" class="form-label">Pogas saite</label>
                            <input type="text" class="form-control" id="promo-modal-cta-url" name="cta_url"
                                value="{{ old('cta_url', $promoModal->cta_url) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bilde</label>
                        <x-file-upload :name="'promo-modal-image'" :required="$promoModal->image_filename ? 'false' : 'true'" :files="$promoModal->image_filename
                            ? json_encode([App\Models\PromoModal::IMAGE_DIRECTORY . '/' . $promoModal->image_filename])
                            : null" />
                    </div>
                    <button type="submit" class="btn btn-success">Saglabāt</button>
                </form>
            </div>
        </div>
    </x-slot>
</x-layouts.admin>
