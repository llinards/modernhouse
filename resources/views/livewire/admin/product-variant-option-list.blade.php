<div>
    <x-status-messages />

    <div class="mb-3">
        <button type="button" class="btn btn-success" wire:click="openOptionModal">
            Pievienot
        </button>
        <button type="button" class="btn btn-outline-dark" wire:click="openCopyModal">
            <i class="bi bi-copy"></i> Kopēt no cita varianta
        </button>
    </div>

    @if ($options->isEmpty())
        <p class="text-muted text-center">Izskatās, ka pagaidām tehniskā informācija nav pievienota.</p>
    @else
        <table class="table table-hover align-middle" style="table-layout: fixed">
            <thead>
                <tr>
                    <th style="width: 40px"></th>
                    <th scope="col">Nosaukums</th>
                    <th scope="col" style="width: 100px">Ieraksti</th>
                    <th style="width: 110px"></th>
                </tr>
            </thead>
            <tbody wire:sortable="updateProductVariantOptionOrder"
                wire:sortable-group="updateProductVariantOptionDetailOrder">
                @foreach ($options as $option)
                    <tr wire:key="option-row-{{ $option->id }}" wire:sortable.item="{{ $option->id }}">
                        <td wire:sortable.handle>
                            <i class="bi bi-arrows-move"></i>
                        </td>
                        <td>{{ $option->option_title }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#option-details-{{ $option->id }}"
                                aria-expanded="false" aria-controls="option-details-{{ $option->id }}">
                                <i class="bi bi-chevron-up"></i>
                                <i class="bi bi-chevron-down"></i>
                                <span class="badge bg-secondary">{{ count($option->productVariantOptionDetails) }}</span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn" title="Rediģēt" wire:click="editOption({{ $option->id }})">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn" title="Dzēst"
                                onclick="confirm('Vai tiešām vēlies dzēst ierakstu?') || event.stopImmediatePropagation()"
                                wire:click="destroyOption({{ $option->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr wire:key="option-details-row-{{ $option->id }}" id="option-details-{{ $option->id }}"
                        class="collapse">
                        <td colspan="4" class="p-0">
                            <div class="p-2">
                                <button type="button" class="btn btn-success btn-sm"
                                    wire:click="openDetailModal({{ $option->id }})">
                                    Pievienot
                                </button>
                            </div>
                            <table class="table table-hover table-light align-middle m-0" style="table-layout: fixed">
                                <tbody wire:sortable-group.item-group="{{ $option->id }}">
                                    @foreach ($option->productVariantOptionDetails as $detail)
                                        <tr wire:key="option-detail-{{ $detail->id }}"
                                            wire:sortable-group.item="{{ $detail->id }}">
                                            <td style="width: 40px" wire:sortable-group.handle>
                                                <i class="bi bi-arrows-move"></i>
                                            </td>
                                            <td>
                                                @if ($detail->is_label)
                                                    <strong>{{ $detail->detail }}</strong>
                                                @else
                                                    <i class="bi bi-arrow-return-right text-muted me-1"></i>{{ $detail->detail }}
                                                @endif
                                            </td>
                                            <td style="width: 240px">
                                                @unless ($detail->is_label || str_contains($detail->detail, '*'))
                                                    <span class="d-flex gap-1">
                                                        <span
                                                            class="badge {{ $detail->has_in_basic ? 'bg-success' : 'bg-light text-muted' }}"
                                                            title="Bāzes komplektācija">Bāzes</span>
                                                        <span
                                                            class="badge {{ $detail->has_in_middle ? 'bg-success' : 'bg-light text-muted' }}"
                                                            title="Pelēkā apdare">Pelēkā</span>
                                                        <span
                                                            class="badge {{ $detail->has_in_full ? 'bg-success' : 'bg-light text-muted' }}"
                                                            title="Pilnā komplektācija">Pilnā</span>
                                                    </span>
                                                @endunless
                                            </td>
                                            <td style="width: 110px">
                                                <button type="button" class="btn btn-sm" title="Rediģēt"
                                                    wire:click="editDetail({{ $detail->id }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm" title="Dzēst"
                                                    onclick="confirm('Vai tiešām vēlies dzēst ierakstu?') || event.stopImmediatePropagation()"
                                                    wire:click="destroyDetail({{ $detail->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Option add/edit modal --}}
    @if ($showOptionModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingOptionId ? 'Rediģēt sadaļu' : 'Pievienot sadaļu' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeOptionModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="option-title" class="form-label">Nosaukums</label>
                            <input type="text" class="form-control @error('optionForm.title') is-invalid @enderror"
                                id="option-title" wire:model="optionForm.title"
                                wire:keydown.enter="{{ $editingOptionId ? 'updateOption' : 'storeOption' }}">
                            @error('optionForm.title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" wire:click="closeOptionModal">Aizvērt</button>
                        @if ($editingOptionId)
                            <button type="button" class="btn btn-success" wire:click="updateOption">Saglabāt</button>
                        @else
                            <button type="button" class="btn btn-success" wire:click="storeOption">Pievienot</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Detail add/edit modal --}}
    @if ($showDetailModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingDetailId ? 'Rediģēt ierakstu' : 'Pievienot ierakstu' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeDetailModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" class="form-control @error('detailForm.detail') is-invalid @enderror"
                                wire:model="detailForm.detail">
                            @error('detailForm.detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="detail-is-label"
                                wire:model.live="detailForm.is_label">
                            <label class="form-check-label" for="detail-is-label">
                                Apakšvirsraksts (bez komplektācijām)
                            </label>
                        </div>
                        @unless ($detailForm['is_label'])
                            <div class="d-flex justify-content-between mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="detail-has-basic"
                                        wire:model="detailForm.has_in_basic">
                                    <label class="form-check-label" for="detail-has-basic">Bāzes komplektācija</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="detail-has-middle"
                                        wire:model="detailForm.has_in_middle">
                                    <label class="form-check-label" for="detail-has-middle">Pelēkā apdare</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="detail-has-full"
                                        wire:model="detailForm.has_in_full">
                                    <label class="form-check-label" for="detail-has-full">Pilnā komplektācija</label>
                                </div>
                            </div>
                        @endunless
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" wire:click="closeDetailModal">Aizvērt</button>
                        @if ($editingDetailId)
                            <button type="button" class="btn btn-success" wire:click="updateDetail">Saglabāt</button>
                        @else
                            <button type="button" class="btn btn-success" wire:click="storeDetail">Pievienot</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Copy from variant modal --}}
    @if ($showCopyModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kopēt opcijas no cita varianta</h5>
                        <button type="button" class="btn-close" wire:click="closeCopyModal"></button>
                    </div>
                    <div class="modal-body">
                        @if ($options->isNotEmpty())
                            <div class="alert alert-warning">
                                Šim variantam jau ir tehniskā informācija. Kopētās opcijas tiks pievienotas esošajām.
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="copy-variant-select" class="form-label">Izvēlieties variantu</label>
                            <select class="form-select" id="copy-variant-select" wire:model.live="copyFromVariantId">
                                <option value="">-- Izvēlieties --</option>
                                @foreach ($availableVariants as $variant)
                                    <option value="{{ $variant->id }}">
                                        {{ $variant->translations->first()?->name ?? $variant->slug }}
                                        —
                                        {{ $variant->product->translations->first()?->name ?? $variant->product->slug }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" wire:click="closeCopyModal">Aizvērt</button>
                        <button type="button" class="btn btn-success" wire:click="copyFromVariant"
                            @if (!$copyFromVariantId) disabled @endif>
                            Kopēt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
