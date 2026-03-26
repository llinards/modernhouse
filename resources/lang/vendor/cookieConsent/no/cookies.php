<?php

return [
    'title' => 'Vi bruker informasjonskapsler',
    'intro' => 'Denne nettsiden bruker informasjonskapsler for å forbedre brukeropplevelsen.',
    'link' => 'Les vår <a href=":url">Personvernpolicy</a> for mer informasjon.',

    'essentials' => 'Kun nødvendige',
    'all' => 'Godta alle',
    'customize' => 'Tilpass',
    'manage' => 'Administrer informasjonskapsler',
    'details' => [
        'more' => 'Flere detaljer',
        'less' => 'Færre detaljer',
    ],
    'save' => 'Lagre innstillinger',
    'cookie' => 'Informasjonskapsel',
    'purpose' => 'Formål',
    'duration' => 'Varighet',
    'year' => 'År|År',
    'day' => 'Dag|Dager',
    'hour' => 'Time|Timer',
    'minute' => 'Minutt|Minutter',

    'categories' => [
        'essentials' => [
            'title' => 'Nødvendige informasjonskapsler',
            'description' => 'Noen informasjonskapsler er nødvendige for at nettsiden skal fungere korrekt. Derfor krever de ikke ditt samtykke.',
        ],
        'analytics' => [
            'title' => 'Analyseinformasjonskapsler',
            'description' => 'Vi bruker disse til intern forskning for å forbedre tjenesten for alle brukere. Disse informasjonskapslene vurderer hvordan du samhandler med nettsiden vår.',
        ],
        'marketing' => [
            'title' => 'Markedsføringsinformasjonskapsler',
            'description' => 'Disse informasjonskapslene brukes til målrettet annonsering og e-postmarkedsføring for å levere innhold som er relevant for dine interesser.',
        ],
    ],

    'defaults' => [
        'consent' => 'Brukes til å lagre brukerens samtykkepreferanser for informasjonskapsler.',
        'session' => 'Brukes til å identifisere brukerens nettleserøkt.',
        'csrf' => 'Brukes til å beskytte brukeren og nettsiden mot CSRF-angrep.',
        '_ga' => 'Hoved-informasjonskapsel for Google Analytics, skiller én besøkende fra en annen.',
        '_ga_ID' => 'Brukes av Google Analytics for å opprettholde økttilstand.',
        '_gid' => 'Brukes av Google Analytics for å identifisere brukeren.',
        '_gat' => 'Brukes av Google Analytics for å begrense forespørselsfrekvensen.',
        'ga4_events' => 'Brukes til å spore skjemainnsendingshendelser via Google Analytics.',
        '_fbp' => 'Brukes av Facebook for konverteringssporing og remarketing.',
        'klaviyo' => 'Brukes av Klaviyo for e-postmarkedsføring og nettstedskjemaer.',
    ],
];
