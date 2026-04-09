# Product Variant Details Redesign — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Replace the product variant detail management system with an inline Livewire component supporting full CRUD, drag-to-reorder, icon upload, and copy-from-variant.

**Architecture:** A `ProductVariantDetailList` Livewire component embedded in the variant edit page handles all detail management inline. A `ProductVariantDetailService` encapsulates business logic. The old controller, form request, and separate views are removed. A migration adds an `order` column to `product_variant_details`.

**Tech Stack:** Laravel 13, Livewire 4, Pest 4, PHP 8.3, Bootstrap 5 (modals, accordion)

**Spec:** `docs/superpowers/specs/2026-04-09-product-variant-details-redesign.md`

---

### Task 1: Migration — Add `order` Column

**Files:**
- Create: `database/migrations/YYYY_MM_DD_HHMMSS_add_order_to_product_variant_details_table.php` (via artisan)

- [ ] **Step 1: Create the migration**

Run:
```bash
php artisan make:migration add_order_to_product_variant_details_table --table=product_variant_details --no-interaction
```

- [ ] **Step 2: Write migration logic**

Edit the generated migration file:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_variant_details', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('count');
        });

        // Backfill sequential order per variant+language group
        $groups = DB::table('product_variant_details')
            ->select('product_variant_id', 'language')
            ->distinct()
            ->get();

        foreach ($groups as $group) {
            $details = DB::table('product_variant_details')
                ->where('product_variant_id', $group->product_variant_id)
                ->where('language', $group->language)
                ->orderBy('id')
                ->get();

            foreach ($details as $index => $detail) {
                DB::table('product_variant_details')
                    ->where('id', $detail->id)
                    ->update(['order' => $index]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('product_variant_details', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
```

- [ ] **Step 3: Run migration**

Run:
```bash
php artisan migrate
```
Expected: Migration succeeds, `order` column added to `product_variant_details`.

- [ ] **Step 4: Commit**

```bash
git add database/migrations/*add_order_to_product_variant_details*
git commit -m "feat: add order column to product_variant_details table"
```

---

### Task 2: Update ProductVariantDetail Model

**Files:**
- Modify: `app/Models/ProductVariantDetail.php`
- Modify: `database/factories/ProductVariantDetailFactory.php`

- [ ] **Step 1: Write the test for ordering scope**

Create test file:

Run:
```bash
php artisan make:test --pest Admin/ProductVariantDetailTest --no-interaction
```

Write in `tests/Feature/Admin/ProductVariantDetailTest.php`:

```php
<?php

use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('ProductVariantDetail model', function () {
    it('orders details by order column via global scope', function () {
        $variant = ProductVariant::factory()->create();

        ProductVariantDetail::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => 'Second',
            'order' => 1,
        ]);
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $variant->id,
            'name' => 'First',
            'order' => 0,
        ]);

        $details = ProductVariantDetail::where('product_variant_id', $variant->id)->get();

        expect($details->first()->name)->toBe('First')
            ->and($details->last()->name)->toBe('Second');
    });
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:
```bash
php artisan test --compact --filter="orders details by order column"
```
Expected: FAIL — no global ordering scope exists yet.

- [ ] **Step 3: Update the model**

Edit `app/Models/ProductVariantDetail.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hasThis', 'icon', 'count', 'order', 'product_variant_id', 'language'];

    protected static function booted(): void
    {
        static::addGlobalScope('order', static function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
```

- [ ] **Step 4: Update factory to include order**

Edit `database/factories/ProductVariantDetailFactory.php` — add `'order' => 0` to the definition return array:

```php
public function definition(): array
{
    $detail = fake()->randomElement(self::$detailTypes);

    return [
        'name' => $detail['name'],
        'hasThis' => fake()->boolean(70),
        'icon' => $detail['icon'],
        'count' => fake()->numberBetween(0, 3),
        'order' => 0,
        'product_variant_id' => ProductVariant::factory(),
        'language' => 'lv',
    ];
}
```

- [ ] **Step 5: Run test to verify it passes**

Run:
```bash
php artisan test --compact --filter="orders details by order column"
```
Expected: PASS

- [ ] **Step 6: Commit**

```bash
git add app/Models/ProductVariantDetail.php database/factories/ProductVariantDetailFactory.php tests/Feature/Admin/ProductVariantDetailTest.php
git commit -m "feat: add order column support and global ordering scope to ProductVariantDetail"
```

---

### Task 3: ProductVariantDetailService

**Files:**
- Create: `app/Http/Services/ProductVariantDetailService.php`
- Modify: `tests/Feature/Admin/ProductVariantDetailTest.php`

- [ ] **Step 1: Write tests for the service**

Add to `tests/Feature/Admin/ProductVariantDetailTest.php`:

```php
use App\Http\Services\ProductVariantDetailService;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
```

Add these describe blocks after the existing model describe block:

```php
describe('ProductVariantDetailService', function () {
    beforeEach(function () {
        $this->service = new ProductVariantDetailService();
        $this->variant = ProductVariant::factory()->create();
        Storage::fake('public');
    });

    it('stores a detail with an existing icon', function () {
        $detail = $this->service->store($this->variant, [
            'name' => 'Guļamistabas',
            'hasThis' => true,
            'count' => 3,
            'icon' => 'bed',
        ]);

        expect($detail)->toBeInstanceOf(ProductVariantDetail::class)
            ->and($detail->name)->toBe('Guļamistabas')
            ->and($detail->hasThis)->toBeTruthy()
            ->and($detail->count)->toBe(3)
            ->and($detail->icon)->toBe('bed')
            ->and($detail->language)->toBe('lv')
            ->and($detail->product_variant_id)->toBe($this->variant->id);
    });

    it('stores a detail with a new icon upload', function () {
        $file = UploadedFile::fake()->create('custom.svg', 1, 'image/svg+xml');

        $detail = $this->service->store($this->variant, [
            'name' => 'Custom',
            'hasThis' => false,
            'count' => 1,
            'newIcon' => $file,
        ]);

        expect($detail->icon)->toBe('custom')
            ->and(ProductVariantDetailIcon::where('name', 'custom.svg')->exists())->toBeTrue();
        Storage::disk('public')->assertExists('icons/product-variant-detail-icons/custom.svg');
    });

    it('assigns sequential order when storing', function () {
        $this->service->store($this->variant, [
            'name' => 'First',
            'hasThis' => true,
            'count' => 1,
            'icon' => 'bed',
        ]);
        $second = $this->service->store($this->variant, [
            'name' => 'Second',
            'hasThis' => true,
            'count' => 2,
            'icon' => 'leaf',
        ]);

        expect($second->order)->toBe(1);
    });

    it('updates a detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Old Name',
            'count' => 1,
        ]);

        $updated = $this->service->update($detail, [
            'name' => 'New Name',
            'hasThis' => false,
            'count' => 5,
            'icon' => 'leaf',
        ]);

        expect($updated->name)->toBe('New Name')
            ->and($updated->count)->toBe(5)
            ->and($updated->icon)->toBe('leaf');
    });

    it('updates a detail with a new icon upload', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
        ]);
        $file = UploadedFile::fake()->create('new-icon.svg', 1, 'image/svg+xml');

        $updated = $this->service->update($detail, [
            'name' => $detail->name,
            'hasThis' => $detail->hasThis,
            'count' => $detail->count,
            'newIcon' => $file,
        ]);

        expect($updated->icon)->toBe('new-icon')
            ->and(ProductVariantDetailIcon::where('name', 'new-icon.svg')->exists())->toBeTrue();
        Storage::disk('public')->assertExists('icons/product-variant-detail-icons/new-icon.svg');
    });

    it('destroys a detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
        ]);

        $this->service->destroy($detail);

        expect(ProductVariantDetail::find($detail->id))->toBeNull();
    });

    it('reorders details', function () {
        $first = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 0,
        ]);
        $second = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 1,
        ]);

        $this->service->reorder([$second->id, $first->id]);

        expect($second->fresh()->order)->toBe(0)
            ->and($first->fresh()->order)->toBe(1);
    });

    it('copies details from one variant to another', function () {
        $source = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Bedrooms',
            'icon' => 'bed',
            'count' => 3,
            'language' => 'lv',
            'order' => 0,
        ]);
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Bathrooms',
            'icon' => 'bathtub',
            'count' => 1,
            'language' => 'lv',
            'order' => 1,
        ]);
        // Different language — should NOT be copied
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Bedrooms EN',
            'language' => 'en',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $copied = ProductVariantDetail::where('product_variant_id', $this->variant->id)
            ->where('language', 'lv')
            ->get();

        expect($copied)->toHaveCount(2)
            ->and($copied->first()->name)->toBe('Bedrooms')
            ->and($copied->last()->name)->toBe('Bathrooms');
    });

    it('appends copied details after existing ones', function () {
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Existing',
            'order' => 0,
            'language' => 'lv',
        ]);

        $source = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Copied',
            'order' => 0,
            'language' => 'lv',
        ]);

        $this->service->copyFromVariant($source, $this->variant, 'lv');

        $details = ProductVariantDetail::where('product_variant_id', $this->variant->id)
            ->where('language', 'lv')
            ->get();

        expect($details)->toHaveCount(2)
            ->and($details->first()->name)->toBe('Existing')
            ->and($details->first()->order)->toBe(0)
            ->and($details->last()->name)->toBe('Copied')
            ->and($details->last()->order)->toBe(1);
    });
});
```

- [ ] **Step 2: Run tests to verify they fail**

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailService"
```
Expected: FAIL — service class does not exist.

- [ ] **Step 3: Create the service**

Create `app/Http/Services/ProductVariantDetailService.php`:

```php
<?php

namespace App\Http\Services;

use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Http\UploadedFile;

class ProductVariantDetailService
{
    public function store(ProductVariant $productVariant, array $data): ProductVariantDetail
    {
        $icon = $this->resolveIcon($data);

        $maxOrder = ProductVariantDetail::withoutGlobalScope('order')
            ->where('product_variant_id', $productVariant->id)
            ->where('language', app()->getLocale())
            ->max('order');

        return ProductVariantDetail::create([
            'name' => $data['name'],
            'hasThis' => $data['hasThis'] ?? false,
            'icon' => $icon,
            'count' => $data['count'],
            'order' => $maxOrder !== null ? $maxOrder + 1 : 0,
            'product_variant_id' => $productVariant->id,
            'language' => app()->getLocale(),
        ]);
    }

    public function update(ProductVariantDetail $detail, array $data): ProductVariantDetail
    {
        $icon = $this->resolveIcon($data) ?? $detail->icon;

        $detail->update([
            'name' => $data['name'],
            'hasThis' => $data['hasThis'] ?? false,
            'icon' => $icon,
            'count' => $data['count'],
        ]);

        return $detail;
    }

    public function destroy(ProductVariantDetail $detail): void
    {
        $detail->delete();
    }

    public function reorder(array $orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            ProductVariantDetail::withoutGlobalScope('order')
                ->where('id', $id)
                ->update(['order' => $index]);
        }
    }

    public function copyFromVariant(ProductVariant $source, ProductVariant $target, string $language): void
    {
        $maxOrder = ProductVariantDetail::withoutGlobalScope('order')
            ->where('product_variant_id', $target->id)
            ->where('language', $language)
            ->max('order');

        $nextOrder = $maxOrder !== null ? $maxOrder + 1 : 0;

        $sourceDetails = ProductVariantDetail::where('product_variant_id', $source->id)
            ->where('language', $language)
            ->get();

        foreach ($sourceDetails as $detail) {
            ProductVariantDetail::create([
                'name' => $detail->name,
                'hasThis' => $detail->hasThis,
                'icon' => $detail->icon,
                'count' => $detail->count,
                'order' => $nextOrder++,
                'product_variant_id' => $target->id,
                'language' => $language,
            ]);
        }
    }

    private function resolveIcon(array $data): ?string
    {
        if (isset($data['newIcon']) && $data['newIcon'] instanceof UploadedFile) {
            $file = $data['newIcon'];
            $fileName = $file->getClientOriginalName();
            $file->storeAs('icons/product-variant-detail-icons', $fileName, 'public');

            ProductVariantDetailIcon::create(['name' => $fileName]);

            return basename($fileName, '.svg');
        }

        return $data['icon'] ?? null;
    }
}
```

- [ ] **Step 4: Run tests to verify they pass**

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailService"
```
Expected: All PASS

- [ ] **Step 5: Commit**

```bash
git add app/Http/Services/ProductVariantDetailService.php tests/Feature/Admin/ProductVariantDetailTest.php
git commit -m "feat: add ProductVariantDetailService with full CRUD, reorder, and copy-from-variant"
```

---

### Task 4: ProductVariantDetailList Livewire Component (Class)

**Files:**
- Create: `app/Livewire/Admin/ProductVariantDetailList.php`
- Modify: `tests/Feature/Admin/ProductVariantDetailTest.php`

- [ ] **Step 1: Write Livewire component tests**

Add to `tests/Feature/Admin/ProductVariantDetailTest.php`:

```php
use Livewire\Livewire;
```

Add this describe block:

```php
describe('ProductVariantDetailList Livewire component', function () {
    beforeEach(function () {
        $this->variant = ProductVariant::factory()->create();
        Storage::fake('public');
    });

    it('renders with existing details', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Guļamistabas',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->assertSee('Guļamistabas');
    });

    it('stores a new detail', function () {
        ProductVariantDetailIcon::factory()->create(['name' => 'bed.svg']);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->set('form.name', 'Guļamistabas')
            ->set('form.hasThis', true)
            ->set('form.count', 3)
            ->set('form.icon', 'bed')
            ->call('store')
            ->assertHasNoErrors();

        expect(ProductVariantDetail::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });

    it('validates required fields on store', function () {
        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('store')
            ->assertHasErrors(['form.name', 'form.count']);
    });

    it('updates an existing detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Old Name',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('edit', $detail->id)
            ->set('form.name', 'New Name')
            ->call('update')
            ->assertHasNoErrors();

        expect($detail->fresh()->name)->toBe('New Name');
    });

    it('deletes a detail', function () {
        $detail = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('destroy', $detail->id)
            ->assertHasNoErrors();

        expect(ProductVariantDetail::find($detail->id))->toBeNull();
    });

    it('reorders details', function () {
        $first = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 0,
            'language' => 'lv',
        ]);
        $second = ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant->id,
            'order' => 1,
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->call('updateDetailOrder', [
                ['value' => $second->id, 'order' => 0],
                ['value' => $first->id, 'order' => 1],
            ]);

        expect($second->fresh()->order)->toBe(0)
            ->and($first->fresh()->order)->toBe(1);
    });

    it('copies details from another variant', function () {
        $source = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $source->id,
            'name' => 'Copied Detail',
            'language' => 'lv',
        ]);

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->set('copyFromVariantId', $source->id)
            ->call('copyFromVariant')
            ->assertHasNoErrors();

        expect(ProductVariantDetail::where('product_variant_id', $this->variant->id)->count())->toBe(1);
    });
});
```

- [ ] **Step 2: Run tests to verify they fail**

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailList Livewire"
```
Expected: FAIL — component does not exist.

- [ ] **Step 3: Create the Livewire component class**

Create `app/Livewire/Admin/ProductVariantDetailList.php`:

```php
<?php

namespace App\Livewire\Admin;

use App\Http\Services\ProductVariantDetailService;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductVariantDetailList extends Component
{
    use WithFileUploads;

    public ProductVariant $productVariant;
    public Collection $details;
    public Collection $icons;

    /** @var array{name: string, hasThis: bool, count: int|null, icon: string, newIcon: mixed} */
    public array $form = [
        'name' => '',
        'hasThis' => false,
        'count' => null,
        'icon' => '',
        'newIcon' => null,
    ];

    public ?int $editingDetailId = null;
    public ?int $copyFromVariantId = null;
    public bool $showModal = false;
    public bool $showCopyModal = false;

    public function mount(ProductVariant $productVariant): void
    {
        $this->productVariant = $productVariant;
        $this->loadDetails();
        $this->icons = ProductVariantDetailIcon::all();
    }

    public function store(): void
    {
        $this->validate();

        $service = app(ProductVariantDetailService::class);
        $service->store($this->productVariant, $this->form);

        $this->resetForm();
        $this->loadDetails();
        session()->flash('success', 'Pievienots!');
    }

    public function edit(int $detailId): void
    {
        $detail = ProductVariantDetail::findOrFail($detailId);
        $this->editingDetailId = $detail->id;
        $this->form = [
            'name' => $detail->name,
            'hasThis' => (bool) $detail->hasThis,
            'count' => $detail->count,
            'icon' => $detail->icon,
            'newIcon' => null,
        ];
        $this->showModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $detail = ProductVariantDetail::findOrFail($this->editingDetailId);
        $service = app(ProductVariantDetailService::class);
        $service->update($detail, $this->form);

        $this->resetForm();
        $this->loadDetails();
        session()->flash('success', 'Atjaunots!');
    }

    public function destroy(int $detailId): void
    {
        $detail = ProductVariantDetail::findOrFail($detailId);
        $service = app(ProductVariantDetailService::class);
        $service->destroy($detail);

        $this->loadDetails();
        session()->flash('success', 'Dzēsts!');
    }

    public function updateDetailOrder(array $orderedDetails): void
    {
        $service = app(ProductVariantDetailService::class);
        $ids = array_map(fn ($item) => $item['value'], $orderedDetails);

        // Sort by the order value from the sortable event
        usort($orderedDetails, fn ($a, $b) => $a['order'] <=> $b['order']);
        $sortedIds = array_map(fn ($item) => $item['value'], $orderedDetails);

        $service->reorder($sortedIds);
        $this->loadDetails();
        session()->flash('success', 'Secība atjaunota.');
    }

    public function copyFromVariant(): void
    {
        if (! $this->copyFromVariantId) {
            return;
        }

        $source = ProductVariant::findOrFail($this->copyFromVariantId);
        $service = app(ProductVariantDetailService::class);
        $service->copyFromVariant($source, $this->productVariant, app()->getLocale());

        $this->copyFromVariantId = null;
        $this->showCopyModal = false;
        $this->loadDetails();
        session()->flash('success', 'Detaļas nokopētas!');
    }

    public function openModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function openCopyModal(): void
    {
        $this->showCopyModal = true;
    }

    public function closeCopyModal(): void
    {
        $this->copyFromVariantId = null;
        $this->showCopyModal = false;
    }

    public function render()
    {
        $availableVariants = ProductVariant::where('id', '!=', $this->productVariant->id)
            ->with(['product.translations' => fn ($q) => $q->where('language', app()->getLocale())])
            ->get();

        return view('livewire.admin.product-variant-detail-list', [
            'availableVariants' => $availableVariants,
        ]);
    }

    protected function rules(): array
    {
        return [
            'form.name' => 'required|string',
            'form.count' => 'required|numeric',
            'form.icon' => 'required_without:form.newIcon|string',
            'form.newIcon' => 'nullable|file|mimes:svg',
        ];
    }

    protected function messages(): array
    {
        return [
            'form.name.required' => 'Nosaukums ir obligāts.',
            'form.count.required' => 'Skaits ir obligāts.',
            'form.count.numeric' => 'Skaitam jābūt skaitlim.',
            'form.icon.required_without' => 'Izvēlieties ikonu vai augšupielādējiet jaunu.',
        ];
    }

    private function loadDetails(): void
    {
        $this->details = ProductVariantDetail::where('product_variant_id', $this->productVariant->id)
            ->where('language', app()->getLocale())
            ->get();
    }

    private function resetForm(): void
    {
        $this->editingDetailId = null;
        $this->form = [
            'name' => '',
            'hasThis' => false,
            'count' => null,
            'icon' => '',
            'newIcon' => null,
        ];
        $this->resetValidation();
    }
}
```

- [ ] **Step 4: Create a minimal blade view (so tests can render)**

Create `resources/views/livewire/admin/product-variant-detail-list.blade.php`:

```blade
<div>
  <x-status-messages />
  @foreach($details as $detail)
    <div wire:key="detail-{{ $detail->id }}">
      {{ $detail->name }}
    </div>
  @endforeach
</div>
```

- [ ] **Step 5: Run tests to verify they pass**

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailList Livewire"
```
Expected: All PASS

- [ ] **Step 6: Commit**

```bash
git add app/Livewire/Admin/ProductVariantDetailList.php resources/views/livewire/admin/product-variant-detail-list.blade.php tests/Feature/Admin/ProductVariantDetailTest.php
git commit -m "feat: add ProductVariantDetailList Livewire component with full CRUD"
```

---

### Task 5: Livewire Blade View — Full UI

**Files:**
- Modify: `resources/views/livewire/admin/product-variant-detail-list.blade.php`

- [ ] **Step 1: Build the full Blade view**

Replace `resources/views/livewire/admin/product-variant-detail-list.blade.php` with the full UI:

```blade
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
```

- [ ] **Step 2: Manually verify in the browser**

The component is not yet embedded in the variant edit page (that's Task 6). For now, verify the view has no syntax errors by running existing tests:

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailList Livewire"
```
Expected: All PASS

- [ ] **Step 3: Commit**

```bash
git add resources/views/livewire/admin/product-variant-detail-list.blade.php
git commit -m "feat: build full Blade UI for ProductVariantDetailList with modals and sortable"
```

---

### Task 6: Embed Component in Variant Edit Page & Remove Old System

**Files:**
- Modify: `resources/views/admin/product-variant/edit.blade.php`
- Modify: `routes/web.php`
- Delete: `app/Http/Controllers/ProductVariantDetailController.php`
- Delete: `app/Http/Requests/StoreProductVariantDetail.php`
- Delete: `resources/views/admin/product-variant/product-variant-details/index.blade.php`
- Delete: `resources/views/admin/product-variant/product-variant-details/create.blade.php`

- [ ] **Step 1: Write a test to verify the component renders on the edit page**

Add to `tests/Feature/Admin/ProductVariantDetailTest.php`:

```php
describe('Variant edit page embeds detail component', function () {
    it('shows the detail list component on the variant edit page', function () {
        $product = \App\Models\Product::factory()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->id]);
        \App\Models\TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'lv',
        ]);

        $this->actingAs($this->user)
            ->get("/admin/lv/product-variant/{$variant->id}/edit")
            ->assertSuccessful()
            ->assertSeeLivewire(\App\Livewire\Admin\ProductVariantDetailList::class);
    });
});
```

- [ ] **Step 2: Run test to verify it fails**

Run:
```bash
php artisan test --compact --filter="shows the detail list component"
```
Expected: FAIL — component not yet embedded.

- [ ] **Step 3: Embed the Livewire component in the edit view**

Edit `resources/views/admin/product-variant/edit.blade.php`. Replace lines 59-64 (the section with the two `<a>` buttons for "Tehniskā informācija" and "Platība, istabas"):

Replace:
```blade
          <div class="mb-3">
            <a href="/admin/{{ app()->getLocale() }}/product-variant/{{ $productVariant->id }}/product-variant-options"
               class="btn btn-dark" target="_blank">Tehniskā informācija</a>
            <a href="/admin/{{ app()->getLocale() }}/product-variant/{{ $productVariant->id }}/product-variant-details"
               class="btn btn-dark" target="_blank">Platība, istabas</a>
          </div>
```

With:
```blade
          <div class="mb-3">
            <a href="/admin/{{ app()->getLocale() }}/product-variant/{{ $productVariant->id }}/product-variant-options"
               class="btn btn-dark" target="_blank">Tehniskā informācija</a>
          </div>
          <div class="mb-3">
            <h5>Platība, istabas</h5>
            <livewire:admin.product-variant-detail-list :productVariant="$productVariant" />
          </div>
```

- [ ] **Step 4: Remove old routes**

Edit `routes/web.php`. Remove the Product Variant Details route block (lines 100-108) and the `use` import for `ProductVariantDetailController` (line 10).

Remove from imports:
```php
use App\Http\Controllers\ProductVariantDetailController;
```

Remove route block:
```php
  /* Product Variant Details */
  Route::get('/product-variant/{productVariant}/product-variant-details',
    [ProductVariantDetailController::class, 'index']);
  Route::get('/product-variant/{productVariant}/product-variant-details/create',
    [ProductVariantDetailController::class, 'create']);
  Route::post('/product-variant/{productVariant}/product-variant-details',
    [ProductVariantDetailController::class, 'store']);
  Route::get('/product-variant/{productVariant}/product-variant-details/{productVariantDetail}',
    [ProductVariantDetailController::class, 'destroy']);
```

- [ ] **Step 5: Delete old files**

Run:
```bash
rm app/Http/Controllers/ProductVariantDetailController.php
rm app/Http/Requests/StoreProductVariantDetail.php
rm resources/views/admin/product-variant/product-variant-details/index.blade.php
rm resources/views/admin/product-variant/product-variant-details/create.blade.php
rmdir resources/views/admin/product-variant/product-variant-details/
```

- [ ] **Step 6: Run tests to verify they pass**

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailTest"
```
Expected: All PASS

Also run the existing ProductVariant tests to make sure nothing broke:
```bash
php artisan test --compact --filter="ProductVariantTest"
```
Expected: All PASS

- [ ] **Step 7: Commit**

```bash
git add -A
git commit -m "feat: embed ProductVariantDetailList in variant edit page, remove old detail system"
```

---

### Task 7: Final Integration Test & Cleanup

**Files:**
- Modify: `tests/Feature/Admin/ProductVariantDetailTest.php`

- [ ] **Step 1: Add integration test for store with icon upload via Livewire**

Add to the `ProductVariantDetailList Livewire component` describe block:

```php
    it('stores a detail with a new icon upload', function () {
        $file = UploadedFile::fake()->create('pool.svg', 1, 'image/svg+xml');

        Livewire::actingAs($this->user)
            ->test(\App\Livewire\Admin\ProductVariantDetailList::class, ['productVariant' => $this->variant])
            ->set('form.name', 'Baseins')
            ->set('form.hasThis', true)
            ->set('form.count', 1)
            ->set('form.newIcon', $file)
            ->call('store')
            ->assertHasNoErrors();

        $detail = ProductVariantDetail::where('product_variant_id', $this->variant->id)->first();

        expect($detail->icon)->toBe('pool')
            ->and(ProductVariantDetailIcon::where('name', 'pool.svg')->exists())->toBeTrue();
    });
```

- [ ] **Step 2: Run all detail tests**

Run:
```bash
php artisan test --compact --filter="ProductVariantDetailTest"
```
Expected: All PASS

- [ ] **Step 3: Run full test suite to verify no regressions**

Run:
```bash
php artisan test --compact
```
Expected: All PASS

- [ ] **Step 4: Commit**

```bash
git add tests/Feature/Admin/ProductVariantDetailTest.php
git commit -m "test: add icon upload integration test for ProductVariantDetailList"
```
