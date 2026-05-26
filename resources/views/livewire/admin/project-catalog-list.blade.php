<div>
    <x-status-messages />

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button type="button" class="btn btn-success" wire:click="openModal">
            Pievienot katalogu
        </button>
    </div>

    @if ($catalogs->isEmpty())
        <p class="text-muted text-center">Vēl nav neviena kataloga.</p>
    @else
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 40px"></th>
                    <th scope="col">Statuss</th>
                    @foreach ($languages as $code => $name)
                        <th scope="col">{{ strtoupper($code) }}</th>
                    @endforeach
                    <th scope="col" style="width: 110px"></th>
                </tr>
            </thead>
            <tbody wire:sortable="updateOrder">
                @foreach ($catalogs as $catalog)
                    <tr wire:key="catalog-{{ $catalog->id }}" wire:sortable.item="{{ $catalog->id }}">
                        <td wire:sortable.handle>
                            <i class="bi bi-arrows-move"></i>
                        </td>
                        <td>
                            @if ($catalog->is_active)
                                <span class="badge bg-success">Aktīvs</span>
                            @else
                                <span class="badge bg-secondary">Neaktīvs</span>
                            @endif
                        </td>
                        @foreach ($languages as $code => $name)
                            @php($translation = $catalog->translations->firstWhere('language', $code))
                            <td>
                                @if ($translation)
                                    <a href="{{ asset('storage/project-catalogs/' . $catalog->id . '/' . $code . '/' . $translation->pdf_filename) }}"
                                        target="_blank" rel="noopener" title="{{ $translation->pdf_filename }}">
                                        {{ $translation->menu_name }}
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <button type="button" class="btn" title="Rediģēt"
                                wire:click="edit({{ $catalog->id }})">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn" title="Dzēst"
                                onclick="confirm('Vai tiešām vēlies dzēst katalogu?') || event.stopImmediatePropagation()"
                                wire:click="destroy({{ $catalog->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Add/Edit Modal --}}
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $editingCatalogId ? 'Rediģēt katalogu' : 'Pievienot katalogu' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        @error('form.translations')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="catalog-is-active"
                                    wire:model="form.is_active">
                                <label class="form-check-label" for="catalog-is-active">
                                    Aktīvs
                                </label>
                            </div>
                        </div>
                        @foreach ($languages as $code => $name)
                            <fieldset class="border rounded p-3 mb-3">
                                <legend class="float-none w-auto px-2 fs-6 fw-bold">
                                    {{ strtoupper($code) }}
                                </legend>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="menu-name-{{ $code }}" class="form-label">Izvēlnes
                                            nosaukums</label>
                                        <input type="text"
                                            class="form-control @error('form.translations.' . $code . '.menu_name') is-invalid @enderror"
                                            id="menu-name-{{ $code }}"
                                            wire:model="form.translations.{{ $code }}.menu_name">
                                        @error('form.translations.' . $code . '.menu_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="pdf-{{ $code }}" class="form-label">
                                            {{ !empty($form['translations'][$code]['existing_pdf_filename']) ? 'Aizstāt PDF' : 'PDF fails' }}
                                        </label>
                                        <input type="file"
                                            class="form-control @error('form.translations.' . $code . '.new_pdf') is-invalid @enderror"
                                            id="pdf-{{ $code }}" accept="application/pdf"
                                            wire:model="form.translations.{{ $code }}.new_pdf">
                                        @error('form.translations.' . $code . '.new_pdf')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @if (!empty($form['translations'][$code]['existing_pdf_filename']))
                                    <div class="mt-3 small d-flex align-items-center flex-wrap gap-3">
                                        <span>
                                            Esošais PDF:
                                            <a href="{{ asset('storage/project-catalogs/' . $editingCatalogId . '/' . $code . '/' . $form['translations'][$code]['existing_pdf_filename']) }}"
                                                target="_blank" rel="noopener">
                                                {{ $form['translations'][$code]['existing_pdf_filename'] }}
                                            </a>
                                        </span>
                                        <div class="form-check m-0">
                                            <input class="form-check-input" type="checkbox"
                                                id="remove-{{ $code }}"
                                                wire:model="form.translations.{{ $code }}.remove">
                                            <label class="form-check-label" for="remove-{{ $code }}">
                                                Noņemt šo valodu
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </fieldset>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" wire:click="closeModal">Aizvērt</button>
                        @if ($editingCatalogId)
                            <button type="button" class="btn btn-success" wire:click="update">Saglabāt</button>
                        @else
                            <button type="button" class="btn btn-success" wire:click="store">Pievienot</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
