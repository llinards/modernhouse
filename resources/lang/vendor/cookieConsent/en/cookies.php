<?php

return [
    'title' => 'We use cookies',
    'intro' => 'This website uses cookies in order to enhance the overall user experience.',
    'link' => 'Take a look at our <a href=":url">Privacy Policy</a> for more information.',

    'essentials' => 'Only essentials',
    'all' => 'Accept all',
    'customize' => 'Customize',
    'manage' => 'Manage cookies',
    'details' => [
        'more' => 'More details',
        'less' => 'Less details',
    ],
    'save' => 'Save settings',
    'cookie' => 'Cookie',
    'purpose' => 'Purpose',
    'duration' => 'Duration',
    'year' => 'Year|Years',
    'day' => 'Day|Days',
    'hour' => 'Hour|Hours',
    'minute' => 'Minute|Minutes',

    'categories' => [
        'essentials' => [
            'title' => 'Essential cookies',
            'description' => 'There are some cookies that we have to include in order for certain web pages to function. For this reason, they do not require your consent.',
        ],
        'analytics' => [
            'title' => 'Analytics cookies',
            'description' => 'We use these for internal research on how we can improve the service we provide for all our users. These cookies assess how you interact with our website.',
        ],
        'marketing' => [
            'title' => 'Marketing cookies',
            'description' => 'These cookies are used for targeted advertising and email marketing to deliver content relevant to your interests.',
        ],
    ],

    'defaults' => [
        'consent' => 'Used to store the user\'s cookie consent preferences.',
        'session' => 'Used to identify the user\'s browsing session.',
        'csrf' => 'Used to secure both the user and our website against cross-site request forgery attacks.',
        '_ga' => 'Main cookie used by Google Analytics, enables a service to distinguish one visitor from another.',
        '_ga_ID' => 'Used by Google Analytics to persist session state.',
        '_gid' => 'Used by Google Analytics to identify the user.',
        '_gat' => 'Used by Google Analytics to throttle the request rate.',
        'ga4_events' => 'Used to track form submission events via Google Analytics.',
        '_fbp' => 'Used by Facebook for conversion tracking and remarketing.',
        'klaviyo' => 'Used by Klaviyo for email marketing and on-site forms.',
    ],
];
