<?php

return [
  'custom' => [
    'first-name' => [
      'required' => 'Pieteikumā ir jānorāda vārds.',
      'alpha' => 'Vārds drīkst saturēt tikai alfabēta simbolus.',
      'max' => 'Vārds ir aizdomīgi garš.'
    ],
    'last-name' => [
      'required' => 'Pieteikumā ir jānorāda uzvārds.',
      'alpha' => 'Uzvārds drīkst saturēt tikai alfabēta simbolus.',
      'max' => 'Uzvārds ir aizdomīgi garš.'
    ],
    'phone-number' => [
      'required' => 'Pieteikumā ir jānorāda telefona numurs.',
      'regex' => 'Telefona numurs drīkst saturēt tikai ciparus.',
      'max' => 'Telefona numurs ir aizdomīgi garš.'
    ],
    'company' => [
      'max' => 'Kompānijas nosaukums ir aizdomīgi garš.'
    ],
    'email' => [
      'required' => 'Pieteikumā ir jānorāda e-pasts.',
      'email' => 'E-pasta adrese nav korekta.'
    ],
    'customer-agrees-for-data-processing' => [
      'accepted' => 'Jums ir jāpiekrīt datu apstrādei un uzglabāšanai, lai sazinātos ar mums.'
    ],
    // Admin panel
    'product-name' => [
      'required' => 'Nav norādīts nosaukums.'
    ],
    'product-slug' => [
      'required' => 'Nav norādīts ID.'
    ],
    'product-cover-photo' => [
      'required' => 'Nav pievienota titulbilde.'
    ],
    'product-id' => [
      'numeric' => 'Nav izvēlēta kategorija, kam pievienot!'
    ],
    'product-variant-name' => [
      'required' => 'Nav norādīts nosaukums.'
    ],
    'product-variant-basic-price' => [
      'required' => 'Nav norādīta rūpnīcas komplektācijas summa.',
      'numeric' => 'Rūpnīcas komplektācijas summa drīkst saturēt tikai ciparus.'
    ],
    'product-variant-full-price' => [
      'required' => 'Nav norādīta pilnās komplektācijas summa.',
      'numeric' => 'Pilnās komplektācijas summa drīkst saturēt tikai ciparus.'
    ],
    'product-variant-area-details-name.*' => [
      'required' => 'Nav norādīta nosaukums platībai.'
    ],
    'product-variant-area-details-square-meters.*' => [
      'required' => 'Nav norādīta platība.'
    ],
    'product-variant-description' => [
      'required' => 'Nav pievienots apraksts.'
    ],
    'product-variant-images' => [
      'required' => 'Nav pievienotas bildes.'
    ],
    'gallery-title' => [
      'required' => 'Nav norādīts galerijas nosaukums.'
    ],
    'gallery-images' => [
      'required' => 'Nav pievienotas bildes galerijai.'
    ],
    'id.*' => [
      'required' => 'Mēģini vēlreiz.',
      'numeric' => 'Mēģini vēlreiz.'
    ],
    'product-variant-option-title.*' => [
      'required' => 'Nav norādīts nosaukums.'
    ],
    'product-variant-option-category.*' => [
      'required' => 'Nav izvēlēta komplektācija.',
      'in' => 'Nav izvēlēta komplektācija.'
    ],
    'product-variant-option-description.*' => [
      'required' => 'Nav pievienots apraksts.'
    ],
    'product-variant-id.*' => [
      'required' => 'Mēģini vēlreiz.',
      'numeric' => 'Mēģini vēlreiz.'
    ],
    'product-variant-detail-name' => [
      'required' => 'Nav pievienots nosaukums.'
    ],
    'product-variant-detail-count' => [
      'required' => 'Nav norādīts skaits. Ja nav paredzēts, ieraksti 0.',
      'numeric' => 'Skaita lauciņš var saturēt tikai ciparus.'
    ],
    'product-variant-detail-new-icon' => [
      'mimes' => 'Ikonai jābūt vai nu SVG vai PNG formāta.'
    ],
  ],

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap our attribute placeholder
  | with something more reader friendly such as "E-Mail Address" instead
  | of "email". This simply helps us make our message more expressive.
  |
  */

  'attributes' => [],

];
