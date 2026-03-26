<?php

return [
    'title' => 'Vi använder cookies',
    'intro' => 'Denna webbplats använder cookies för att förbättra användarupplevelsen.',
    'link' => 'Läs vår <a href=":url">Integritetspolicy</a> för mer information.',

    'essentials' => 'Endast nödvändiga',
    'all' => 'Acceptera alla',
    'customize' => 'Anpassa',
    'manage' => 'Hantera cookies',
    'details' => [
        'more' => 'Mer detaljer',
        'less' => 'Mindre detaljer',
    ],
    'save' => 'Spara inställningar',
    'cookie' => 'Cookie',
    'purpose' => 'Syfte',
    'duration' => 'Varaktighet',
    'year' => 'År|År',
    'day' => 'Dag|Dagar',
    'hour' => 'Timme|Timmar',
    'minute' => 'Minut|Minuter',

    'categories' => [
        'essentials' => [
            'title' => 'Nödvändiga cookies',
            'description' => 'Vissa cookies krävs för att webbplatsen ska fungera korrekt. Därför behöver de inte ditt samtycke.',
        ],
        'analytics' => [
            'title' => 'Analys-cookies',
            'description' => 'Vi använder dessa för intern forskning om hur vi kan förbättra tjänsten för alla användare. Dessa cookies bedömer hur du interagerar med vår webbplats.',
        ],
        'marketing' => [
            'title' => 'Marknadsföringscookies',
            'description' => 'Dessa cookies används för riktad reklam och e-postmarknadsföring för att leverera innehåll som är relevant för dina intressen.',
        ],
    ],

    'defaults' => [
        'consent' => 'Används för att lagra användarens cookiepreferenser.',
        'session' => 'Används för att identifiera användarens webbsession.',
        'csrf' => 'Används för att skydda användaren och webbplatsen mot CSRF-attacker.',
        '_ga' => 'Huvudcookie för Google Analytics, skiljer en besökare från en annan.',
        '_ga_ID' => 'Används av Google Analytics för att bevara sessionstillstånd.',
        '_gid' => 'Används av Google Analytics för att identifiera användaren.',
        '_gat' => 'Används av Google Analytics för att begränsa förfrågningsfrekvensen.',
        'ga4_events' => 'Används för att spåra formulärhändelser via Google Analytics.',
        '_fbp' => 'Används av Facebook för konverteringsspårning och remarketing.',
        'klaviyo' => 'Används av Klaviyo för e-postmarknadsföring och webbplatsformulär.',
    ],
];
