<div>
  <x-status-messages />

  <div class="d-flex justify-content-between mb-3">
    <button type="button" class="btn btn-success" wire:click="openModal">
      <i class="bi bi-plus text-white"></i> Pievienot detaļu
    </button>
    <button type="button" class="btn btn-outline-dark" wire:click="openCopyModal">
      <i class="bi bi-copy"></i> Kopēt no varianta
    </button>
  </div>

  {{-- Sortable detail list --}}
  <div wire:sortable="updateDetailOrder">
    @foreach($details as $detail)
      <div wire:key="detail-{{ $detail->id }}" wire:sortable.item="{{ $detail->id }}"
           class="d-flex align-items-center mb-2 p-2 border rounded">
        <div wire:sortable.handle class="me-2" style="cursor: grab;">
          <i class="bi bi-arrows-move"></i>
        </div>
        <img width="25" src="{{ asset('storage/icons/product-variant-detail-icons/'.$detail->icon.'.svg') }}" alt="" class="me-2">
        <div class="flex-grow-1">
          <strong>{{ $detail->name }}</strong>
          <span class="ms-2">
            <img width="20" src="{{ $detail->hasThis ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}" alt="">
          </span>
          <span class="ms-2 text-muted">Skaits: {{ $detail->count }}</span>
        </div>
        <button type="button" class="btn btn-dark btn-sm mx-1" wire:click="edit({{ $detail->id }})">
          <i class="bi bi-pencil text-white"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm"
                onclick="confirm('Vai tiešām vēlies dzēst ierakstu?') || event.stopImmediatePropagation()"
                wire:click="destroy({{ $detail->id }})">
          <i class="bi bi-trash text-white"></i>
        </button>
      </div>
    @endforeach
  </div>

  @if($details->isEmpty())
    <p class="text-muted text-center">Nav pievienotu detaļu.</p>
  @endif

  {{-- Add/Edit Modal --}}
  @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $editingDetailId ? 'Rediģēt detaļu' : 'Pievienot detaļu' }}</h5>
            <button type="button" class="btn-close" wire:click="closeModal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="detail-name" class="form-label">Nosaukums</label>
              <input type="text" class="form-control @error('form.name') is-invalid @enderror"
                     id="detail-name" wire:model="form.name">
              @error('form.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="detail-hasThis" wire:model="form.hasThis">
                <label class="form-check-label" for="detail-hasThis">Pieejamība</label>
              </div>
            </div>
            <div class="mb-3">
              <label for="detail-count" class="form-label">Skaits</label>
              <input type="number" class="form-control @error('form.count') is-invalid @enderror"
                     id="detail-count" wire:model="form.count">
              @error('form.count') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <p>Esošās ikonas</p>
              @error('form.icon') <div class="text-danger small mb-2">{{ $message }}</div> @enderror
              @foreach($icons as $iconItem)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"
                         value="{{ basename($iconItem->name, '.svg') }}"
                         id="icon-{{ $iconItem->id }}"
                         wire:model="form.icon">
                  <label class="form-check-label" for="icon-{{ $iconItem->id }}">
                    <img width="50" src="{{ asset('storage/icons/product-variant-detail-icons/'.$iconItem->name) }}" alt="">
                  </label>
                </div>
              @endforeach
            </div>
            <div class="mb-3">
              <label for="detail-new-icon" class="form-label">Pievieno jaunu ikonu</label>
              <input class="form-control" type="file" id="detail-new-icon" wire:model="form.newIcon" accept=".svg">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:click="closeModal">Aizvērt</button>
            @if($editingDetailId)
              <button type="button" class="btn btn-success" wire:click="update">Saglabāt</button>
            @else
              <button type="button" class="btn btn-success" wire:click="store">Pievienot</button>
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif

  {{-- Copy from Variant Modal --}}
  @if($showCopyModal)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Kopēt detaļas no varianta</h5>
            <button type="button" class="btn-close" wire:click="closeCopyModal"></button>
          </div>
          <div class="modal-body">
            @if($details->isNotEmpty())
              <div class="alert alert-warning">
                Šim variantam jau ir detaļas. Kopētās detaļas tiks pievienotas esošajām.
              </div>
            @endif
            <div class="mb-3">
              <label for="copy-variant-select" class="form-label">Izvēlieties variantu</label>
              <select class="form-select" id="copy-variant-select" wire:model="copyFromVariantId">
                <option value="">-- Izvēlieties --</option>
                @foreach($availableVariants as $variant)
                  <option value="{{ $variant->id }}">
                    {{ $variant->slug }} ({{ $variant->product->translations->first()?->name ?? $variant->product->slug }})
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:click="closeCopyModal">Aizvērt</button>
            <button type="button" class="btn btn-success" wire:click="copyFromVariant" @if(!$copyFromVariantId) disabled @endif>
              Kopēt
            </button>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
