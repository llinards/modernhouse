<?php

namespace App\Http\Services\Pdf;

use Smalot\PdfParser\Parser;

/**
 * Parses a technical-specification PDF (fixed template: numbered element →
 * bold sub-heading → bulleted items) into an ordered structure the importer
 * can turn into product variant options and option details.
 */
class TechSpecPdfParser
{
  /**
   * Combining-mark sequences the source PDFs emit instead of the precomposed
   * Latvian letters, mapped to their canonical form. NFC cannot recompose
   * these because the marks used (comma below / turned comma above) are not
   * the canonical cedilla.
   */
  private const DIACRITIC_MAP = [
    "l\u{0326}" => 'ļ', "l\u{0327}" => 'ļ', "L\u{0326}" => 'Ļ', "L\u{0327}" => 'Ļ',
    "n\u{0326}" => 'ņ', "n\u{0327}" => 'ņ', "N\u{0326}" => 'Ņ', "N\u{0327}" => 'Ņ',
    "k\u{0326}" => 'ķ', "k\u{0327}" => 'ķ', "K\u{0326}" => 'Ķ', "K\u{0327}" => 'Ķ',
    "g\u{0312}" => 'ģ', "g\u{0326}" => 'ģ', "g\u{0327}" => 'ģ',
    "G\u{0326}" => 'Ģ', "G\u{0312}" => 'Ģ', "G\u{0327}" => 'Ģ',
    "\u{0131}\u{0304}" => 'ī', "i\u{0304}" => 'ī', "I\u{0304}" => 'Ī',
  ];

  public function __construct(private Parser $parser = new Parser()) {}

  /**
   * @return array<int, array{element: string, rows: array<int, array{type: string, text: string}>}>
   */
  public function parse(string $path): array
  {
    return $this->parseText($this->parser->parseFile($path)->getText());
  }

  /**
   * @return array<int, array{element: string, rows: array<int, array{type: string, text: string}>}>
   */
  public function parseText(string $text): array
  {
    $options = [];
    $currentIndex = -1;

    foreach (preg_split('/\R/u', $text) as $rawLine) {
      $line = $this->normalizeLine($rawLine);

      if ($line === '') {
        continue;
      }

      if (preg_match('/^\d+\.\s*/u', $line)) {
        [$element, $label] = $this->splitElementLine($line);
        $options[]    = ['element' => $element, 'rows' => []];
        $currentIndex = count($options) - 1;

        if ($label !== '') {
          $options[$currentIndex]['rows'][] = ['type' => 'label', 'text' => $label];
        }

        continue;
      }

      if ($currentIndex < 0) {
        continue;
      }

      if (preg_match('/^[-•–]/u', $line)) {
        $options[$currentIndex]['rows'][] = [
          'type' => 'item',
          'text' => trim(preg_replace('/^([-•–]\s*)+/u', '', $line)),
        ];

        continue;
      }

      $options[$currentIndex]['rows'][] = ['type' => 'label', 'text' => $this->cleanLabel($line)];
    }

    return $options;
  }

  /**
   * Splits an element heading from an optional sub-heading that the PDF
   * sometimes renders on the same line (e.g. "Starpsienas elements IW-1:
   * Starpsienas pamatkonstrukcija:").
   *
   * @return array{0: string, 1: string} [element title, trailing label]
   */
  private function splitElementLine(string $line): array
  {
    $line = preg_replace('/^\d+\.\s*/u', '', $line);

    if (preg_match('/^(.+?elements\s+[A-Z]{2}-\d+)\s*:?\s*(.*)$/u', $line, $matches)) {
      return [trim($matches[1]), $this->cleanLabel($matches[2])];
    }

    return [$this->cleanLabel($line), ''];
  }

  private function cleanLabel(string $line): string
  {
    return trim(rtrim(trim($line), ': '));
  }

  private function normalizeLine(string $line): string
  {
    $line = strtr($line, self::DIACRITIC_MAP);

    // The capital long vowels (Ā Ē Ī Ū) are emitted as "letter + underscore"
    // when they open a word; restore them before composing the rest.
    $line = preg_replace_callback('/([AEIU])_(?=\p{Ll})/u', static function (array $m): string {
      return ['A' => 'Ā', 'E' => 'Ē', 'I' => 'Ī', 'U' => 'Ū'][$m[1]];
    }, $line);

    // NFC composes the remaining base-vowel + combining-macron sequences
    // (e.g. "a" + U+0304 → "ā") into their precomposed Latvian letters.
    if (class_exists(\Normalizer::class)) {
      $line = \Normalizer::normalize($line, \Normalizer::FORM_C);
    }

    return trim(preg_replace('/\h+/u', ' ', $line));
  }
}
