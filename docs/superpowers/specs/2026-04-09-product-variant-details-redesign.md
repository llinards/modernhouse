# Product Variant Details Redesign

## Problem

The current product variant details system is significantly underdeveloped:

- **No edit capability** — details can only be created or deleted, forcing a delete-and-recreate workflow
- **No reuse** — each detail is hand-entered per variant per language, with no way to copy from another variant
- **No service layer** — logic lives directly in the controller
- **No Livewire** — uses plain forms and separate pages, while the sibling ProductVariantOption system has inline Livewire management with drag-to-reorder
- **No ordering** — details have no `order` column

## Solution

Replace the entire detail management flow with an inline Livewire component embedded in the product variant edit page, backed by a dedicated service layer. Add copy-from-variant functionality for reuse. No template tables — keep it simple.

## Data Model Changes

### Existing `product_variant_details` table

Add one column:

- `order` (integer, default 0) — for drag-to-reorder

All existing columns remain unchanged: `name`, `hasThis`, `icon`, `count`, `product_variant_id`, `language`.

Existing records are backfilled with sequential order values per variant+language group.

### No new tables

The copy-from-variant feature reads details from a source variant and inserts cloned records for the target variant.

## Livewire Component: ProductVariantDetailList

Embedded in the product variant edit page, following the `ProductVariantOptionList` pattern.

### Capabilities

- **List** all details for the current variant, filtered by active language
- **Add** a new detail via modal
- **Edit** an existing detail via the same modal
- **Delete** with a confirm dialog
- **Reorder** via drag-and-drop using `wire:sortable`
- **Copy from variant** — pick a source variant, clone its details for the current language

### Add/Edit Modal Fields

- **Name** — text input, required
- **Has this** — checkbox/toggle
- **Count** — number input, required
- **Icon picker** — radio grid of existing icons from `ProductVariantDetailIcon` registry
- **Upload new icon** — SVG file input; when uploaded, creates a `ProductVariantDetailIcon` record and stores the file in `storage/icons/product-variant-detail-icons/`, then auto-selects it

### Copy-from-Variant Flow

1. "Copy from variant" button above the detail list
2. Opens a modal with a searchable dropdown of all other product variants (showing variant slug + parent product name)
3. On confirm: clones all details from the source variant for the current language
4. If the current variant already has details, the user is warned — copied details are **appended** (not replaced)
5. List refreshes; user can edit/delete/reorder as needed

### Language Behavior

The component respects the current admin language. When copying from a variant, it copies only the details matching the current language. Each language's details remain fully independent.

## Service Layer: ProductVariantDetailService

Extracts all logic from the controller:

- `store(ProductVariant, array $data): ProductVariantDetail` — create a detail, handle icon upload if present
- `update(ProductVariantDetail, array $data): ProductVariantDetail` — edit an existing detail, handle icon swap/upload
- `destroy(ProductVariantDetail): void` — delete a detail
- `reorder(array $orderedIds): void` — bulk update `order` column
- `copyFromVariant(ProductVariant $source, ProductVariant $target, string $language): void` — clone all details from source to target for the given language

### Validation

Handled by Livewire component's `rules()`:

- `name` — required
- `count` — required, numeric
- `icon` — required (either selected from picker or uploaded)
- Uploaded file — must be SVG

## Migration & Cleanup

### Migration

- Add `order` column to `product_variant_details` (integer, default 0)
- Backfill existing records with sequential order values per variant+language group

### Files Removed

- `ProductVariantDetailController`
- `StoreProductVariantDetail` form request
- `resources/views/admin/product-variant/product-variant-details/index.blade.php`
- `resources/views/admin/product-variant/product-variant-details/create.blade.php`
- Old controller routes from `routes/web.php`

### Files Added

- `ProductVariantDetailService`
- `ProductVariantDetailList` Livewire component (class + blade view)
- Migration for `order` column

### Files Modified

- `ProductVariantDetail` model — add `order` to fillable, add global ordering scope
- Variant edit blade view — embed the new Livewire component
- `routes/web.php` — remove old detail routes
