<?php

use App\Http\Services\Pdf\TechSpecPdfParser;

function techSpecFixture(string $name): string
{
    return dirname(__DIR__)."/Fixtures/pdf/$name";
}

it('parses elements, labels and items from a basic spec PDF', function () {
    $result = (new TechSpecPdfParser())->parse(techSpecFixture('ange_baze.pdf'));

    expect(array_column($result, 'element'))
        ->toContain('Ārsienas elements EW-1')
        ->toContain('Starpsienas elements IW-1')
        ->toContain('Grīdas elements GE-1')
        ->toContain('Jumta elements RE-1');

    $first  = $result[0];
    $labels = array_column(array_filter($first['rows'], fn ($r) => $r['type'] === 'label'), 'text');
    $items  = array_column(array_filter($first['rows'], fn ($r) => $r['type'] === 'item'), 'text');

    expect($first['element'])->toBe('Ārsienas elements EW-1')
        ->and($labels)->toContain('Ārējā apdare')->toContain('Ārsienas pamatkonstrukcija')
        ->and($items)->toContain('Latojums (28x70mm)');
});

it('repairs combining-diacritic artifacts into precomposed Latvian letters', function () {
    $result = (new TechSpecPdfParser())->parse(techSpecFixture('ange_baze.pdf'));
    $text   = collect($result)->flatMap(fn ($o) => collect($o['rows'])->pluck('text'))->implode("\n");

    expect($text)
        ->toContain('Peļu barjera')        // l + combining comma-below → ļ
        ->toContain('ģipškartons')          // g + combining turned-comma → ģ
        ->toContain('līdzvērtīga')          // dotless ı + macron → ī
        ->not->toContain("\u{0326}")        // no stray combining comma-below
        ->not->toContain("\u{0304}");       // no stray combining macron
});

it('strips repeated leading bullet markers from items', function () {
    $result = (new TechSpecPdfParser())->parse(techSpecFixture('ange_pilna.pdf'));

    $items = collect($result)->flatMap(fn ($o) => collect($o['rows'])->where('type', 'item')->pluck('text'));

    expect($items)->each(function ($text) {
        expect(preg_match('/^[-•–]/u', $text->value))->toBe(0);
    });
});
