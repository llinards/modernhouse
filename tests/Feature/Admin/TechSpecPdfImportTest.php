<?php

use App\Http\Services\Pdf\TechSpecPdfParser;
use App\Http\Services\ProductVariantOptionPdfImportService;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\User;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    app()->setLocale('lv');
    $this->variant = ProductVariant::factory()->create();
});

function pdfFixture(string $name): string
{
    return base_path("tests/Fixtures/pdf/$name");
}

function uploadedPdf(string $name): UploadedFile
{
    return new UploadedFile(pdfFixture($name), $name, 'application/pdf', null, true);
}

describe('ProductVariantOptionPdfImportService', function () {
    it('imports options, label rows and package flags from basic + full PDFs', function () {
        (new ProductVariantOptionPdfImportService(new TechSpecPdfParser()))->import($this->variant, [
            'basic' => pdfFixture('ange_baze.pdf'),
            'full'  => pdfFixture('ange_pilna.pdf'),
        ]);

        $options = ProductVariantOption::where('product_variant_id', $this->variant->id)->get();

        expect($options->first()->option_title)->toBe('Ārsienas elements EW-1');

        $details = $options->firstWhere('option_title', 'Ārsienas elements EW-1')->productVariantOptionDetails;

        // Sub-headings become label rows.
        expect($details->where('is_label', true)->pluck('detail'))->toContain('Ārējā apdare');

        // An item present in both PDFs is flagged basic + full.
        $shared = $details->firstWhere('detail', 'Latojums (28x70mm)');
        expect($shared->is_label)->toBeFalse()
            ->and($shared->has_in_basic)->toBeTrue()
            ->and($shared->has_in_full)->toBeTrue()
            ->and($shared->has_in_middle)->toBeFalse();

        // An item only in the full PDF is flagged full only.
        $fullOnly = $details->firstWhere('detail', 'OSB 3 (10mm)');
        expect($fullOnly->has_in_basic)->toBeFalse()
            ->and($fullOnly->has_in_full)->toBeTrue();

        // No middle PDF was supplied, so middle stays empty everywhere.
        expect(ProductVariantOptionDetail::where('has_in_middle', true)->count())->toBe(0);
    });

    it('replaces the variant existing options on import', function () {
        ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant->id,
            'option_title'       => 'Old option',
            'language'           => 'lv',
        ]);

        (new ProductVariantOptionPdfImportService(new TechSpecPdfParser()))->import($this->variant, [
            'basic' => pdfFixture('ange_baze.pdf'),
        ]);

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)
            ->where('option_title', 'Old option')->exists())->toBeFalse()
            ->and(ProductVariantOption::where('product_variant_id', $this->variant->id)->count())->toBeGreaterThan(0);
    });
});

describe('PDF import route', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    it('imports tech specs from uploaded PDFs', function () {
        $this->actingAs($this->user)
            ->post(route('product-variant-options.import-pdf', ['locale' => 'lv', 'productVariant' => $this->variant->id]), [
                'pdf_basic' => uploadedPdf('ange_baze.pdf'),
                'pdf_full'  => uploadedPdf('ange_pilna.pdf'),
            ])
            ->assertRedirect()
            ->assertSessionHas('success');

        expect(ProductVariantOption::where('product_variant_id', $this->variant->id)->count())->toBeGreaterThan(0);
    });

    it('requires both the basic and full PDFs', function () {
        $this->actingAs($this->user)
            ->post(route('product-variant-options.import-pdf', ['locale' => 'lv', 'productVariant' => $this->variant->id]), [
                'pdf_basic' => uploadedPdf('ange_baze.pdf'),
            ])
            ->assertSessionHasErrors('pdf_full');
    });

    it('redirects guests away from the import route', function () {
        $this->post(route('product-variant-options.import-pdf', ['locale' => 'lv', 'productVariant' => $this->variant->id]), [
            'pdf_basic' => uploadedPdf('ange_baze.pdf'),
        ])->assertRedirect();
    });
});
