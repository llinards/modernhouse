# ProductVariant Controller & Service Refactor

## Context

The `ProductController` and `ProductService` were recently refactored (Mar 2026) to follow clean architectural patterns: stateless service, DB transactions, dependency injection, proper type hints, config-driven locale checks, and slug validation in form requests. The `ProductVariantController` and `ProductVariantService` still use the old patterns (stateful service, no transactions, inline `new FileService()`, hardcoded locale). This refactor brings them into alignment.

## Scope

Align architectural patterns only. No changes to sync logic behavior (images, plans, attachments). No new features.

## Files to Modify

- `app/Http/Services/ProductVariantService.php`
- `app/Http/Controllers/ProductVariantController.php`
- `app/Http/Requests/StoreProductVariantRequest.php`
- `app/Http/Requests/UpdateProductVariantRequest.php`
- `routes/web.php` (product variant routes only)
- `resources/views/admin/product-variant/edit.blade.php`
- `resources/views/admin/product-variant/create.blade.php`
- `tests/Feature/Admin/ProductVariantTest.php`

## Reference Files (patterns to follow)

- `app/Http/Services/ProductService.php` — stateless service with constructor DI
- `app/Http/Controllers/ProductController.php` — transactions, types, structured logging
- `app/Http/Requests/StoreProductRequest.php` — `prepareForValidation()` + `Rule::unique`
- `app/Http/Requests/UpdateProductRequest.php` — locale-aware slug uniqueness with `ignore()`

---

## 1. ProductVariantService — Stateless with DI

### Remove mutable state
- Delete `private string $slug` and `private object $productVariant` properties
- Delete `setSlug()` and `getProductVariant()` helper methods

### Constructor injection
```php
public function __construct(private FileService $fileService) {}
```
Use `$this->fileService` everywhere instead of `new FileService()`.

### Method signatures (return + pass pattern)

| Method | Current signature | New signature |
|--------|------------------|---------------|
| `addProductVariant` | `(object $data): void` | `(StoreProductVariantRequest $request): ProductVariant` |
| `addTranslation` | `(object $data): void` | `(ProductVariant $productVariant, string $name, string $description): void` |
| `addImage` | `(array $images): void` | `(ProductVariant $productVariant, array $images): void` |
| `addPlan` | `(array $files): void` | `(ProductVariant $productVariant, array $files): void` |
| `addAttachment` | `(array $attachments): void` | `(ProductVariant $productVariant, array $attachments): void` |
| `getTranslation` | `()` | `(ProductVariant $productVariant): ?TranslationsProductVariants` |
| `updateProductVariant` | `(object $data): void` | `(ProductVariant $productVariant, UpdateProductVariantRequest $request): void` |
| `updateTranslation` | `($translation, $data): void` | `(TranslationsProductVariants $translation, string $name, string $description): void` |
| `syncImages` | `(array $submittedFiles): void` | `(ProductVariant $productVariant, array $submittedFiles): void` |
| `syncPlans` | `(array $submittedFiles): void` | `(ProductVariant $productVariant, array $submittedFiles): void` |
| `syncAttachment` | `(array $submittedFiles): void` | `(ProductVariant $productVariant, array $submittedFiles): void` |
| `destroyProductVariant` | `(object $data): void` | `(ProductVariant $productVariant): void` |

### Internal changes
- Compute slug locally in each method that needs it (from `$productVariant->slug` or from the request name)
- Build file paths using passed `$productVariant` instead of `$this->productVariant`
- Replace hardcoded `'lv'` in `updateProductVariant()` with `config('app.fallback_locale')`

---

## 2. ProductVariantController — Transactions, Types, Route Model Binding

### Return types
Add to all methods: `create(): View`, `store(...): RedirectResponse`, `show(...): View`, `update(...): RedirectResponse`, `destroy(...): RedirectResponse`.

### `store()` method
- Wrap in `DB::transaction()`
- `$productVariant = $productVariantService->addProductVariant($request)` — capture return
- Pass `$productVariant` to all subsequent service calls
- Redirect using `route('admin.products.index', ...)`

### `update()` method
- Accept `ProductVariant $productVariant` via route model binding (replaces `$data['id']`)
- Wrap in `DB::transaction()`
- Pass `$productVariant` to all service calls

### `show()` method
- Simplify: use `$productVariant->load(...)` instead of re-querying by ID
- Keep `$product = $productVariant->product` for the view

### `destroy()` method
- Wrap in `DB::transaction()`

### Error handling
- Remove `23000` duplicate key catch (handled by form request validation now)
- Structured logging: `Log::error('Product variant store failed', ['exception' => $e])`
- Use `redirect()->route()` for all redirects

---

## 3. Form Requests — Slug Validation

### StoreProductVariantRequest
- Add `prepareForValidation()`:
  ```php
  protected function prepareForValidation(): void
  {
      $this->merge([
          'slug' => Str::slug($this->input('product-variant-name')),
      ]);
  }
  ```
- Add slug validation rule: `'slug' => [Rule::unique('product_variants', 'slug')]`
- Add custom error message: `'slug.unique' => 'Produkta variants ar šādu nosaukumu jau eksistē.'`
- Add return types: `authorize(): bool`, `rules(): array`

### UpdateProductVariantRequest
- Add `prepareForValidation()` (same as Store)
- Add slug validation only for primary locale:
  ```php
  $isPrimaryLocale = app()->getLocale() === config('app.fallback_locale');
  if ($isPrimaryLocale) {
      $rules['slug'] = [Rule::unique('product_variants', 'slug')->ignore($this->route('productVariant'))];
  }
  ```
- Remove `'id'` validation rule (no longer in request body)
- Add custom error message and return types

---

## 4. Routes — Named Routes + Route Model Binding

```php
Route::get('/product-variant/create', [ProductVariantController::class, 'create'])
    ->name('admin.product-variants.create');
Route::post('/product-variant', [ProductVariantController::class, 'store'])
    ->name('admin.product-variants.store');
Route::get('/product-variant/{productVariant}/edit', [ProductVariantController::class, 'show'])
    ->name('admin.product-variants.edit');
Route::patch('/product-variant/{productVariant}', [ProductVariantController::class, 'update'])
    ->name('admin.product-variants.update');
Route::delete('/product-variant/{productVariant}/delete', [ProductVariantController::class, 'destroy'])
    ->name('admin.product-variants.destroy');
```

Key change: PATCH route gets `{productVariant}` parameter.

---

## 5. Views

### edit.blade.php
- Form action: use `route('admin.product-variants.update', $productVariant)` instead of hardcoded URL
- Remove hidden `<input name="id" ...>` field
- Delete form action: use `route('admin.product-variants.destroy', $productVariant)`
- "Back" link: use `route('admin.products.index', ['locale' => app()->getLocale()])`

### create.blade.php
- Form action: use `route('admin.product-variants.store')` instead of hardcoded URL
- "Back" link: use `route('admin.products.index', ['locale' => app()->getLocale()])`

---

## 6. Tests

- Update all PATCH requests: URL changes from `/admin/lv/product-variant` to `/admin/lv/product-variant/{id}`
- Remove `'id' => $this->variant->id` from PATCH request payloads
- Verify redirects match new named route paths
- Add a test for slug uniqueness validation (create two variants with same name, expect validation error)

---

## Verification

1. Run `php artisan test --compact --filter=ProductVariantTest` — all tests pass
2. Run `php artisan route:list --name=product-variant` — verify named routes exist
3. Manually test in browser: create variant, edit variant, delete variant
