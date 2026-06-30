<x-layouts.admin>
    <x-slot name="header">
        Tehniskā informācija
    </x-slot>
    <x-slot name="content">

        <div class="row justify-content-center mt-5">
            <div class="mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#store-product-variant-option-modal">
                    Pievienot
                </button>
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                    data-bs-target="#copy-product-variant-options-modal">
                    <i class="bi bi-copy"></i> Kopēt no cita varianta
                </button>
            </div>
            @if (count($productVariant->productVariantOptions) === 0)
                <div class="col-lg-7 col-12">
                    <div class="alert alert-secondary" role="alert">
                        Izskatās, ka pagaidām tehniskā informācija nav pievienota.
                    </div>
                </div>
            @else
                <div class="col-12">
                    @include('admin.product-variant.product-variant-options.store-modal', [
                        'productVariant' => $productVariant,
                    ])
                    <livewire:admin.product-variant-option-list :productVariant="$productVariant" />
                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <a href="/admin/{{ app()->getLocale() }}/product-variant/{{ $productVariant->id }}/edit"
                            class="btn btn-dark">Atpakaļ</a>
                        {{-- <form
                            action="{{ route('product-variant-options.destroy', ['locale' => app()->getLocale(), 'productVariant' => $productVariant->id]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                onclick="return confirm('Vai tiešām vēlies dzēst ierakstu visu tehnisko informāciju? TIKS DZĒSTA INFORMĀCIJA VISĀS VALODĀS');"
                                class="btn btn-danger" type="submit">
                                Dzēst visu tehnisko informāciju
                            </button>
                        </form> --}}
                    </div>
                </div>
            @endif
        </div>
        <hr class="my-4" />
        <h5 class="mb-3">Importēt tehnisko specifikāciju no PDF</h5>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
                <form
                    action="{{ route('product-variant-options.import-pdf', ['locale' => app()->getLocale(), 'productVariant' => $productVariant->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="pdf_basic" class="form-label">Bāzes komplektācija (PDF)</label>
                        <input type="file" name="pdf_basic" id="pdf_basic" accept="application/pdf"
                            class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pdf_full" class="form-label">Pilnā komplektācija (PDF)</label>
                        <input type="file" name="pdf_full" id="pdf_full" accept="application/pdf"
                            class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Importēt no PDF</button>
                </form>
            </div>
        </div>
        @include('admin.product-variant.product-variant-options.copy-modal', [
            'productVariant' => $productVariant,
            'availableVariants' => $availableVariants,
        ])
    </x-slot>
</x-layouts.admin>
