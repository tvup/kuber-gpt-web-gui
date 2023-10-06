<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.eu.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => \App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'incident_server' => [
        'url' => env('INCIDENT_SERVER_URL'),
    ],
    'ai' => [
        'openai' => [
            'model' => env('OPENAI_MODEL'),
            'roles' => [
                'system' => [
                    'locale' => [
                        'en' => [
                            'spam_checker' => env('SERVICES_AI_OPENAI_ROLES_SYSTEM_EN_SPAM_CHECKER', 'You are spamCheckerGPT - A ChatGPT clone with speciality in checking contact form content for spam. You reply with either "true" if the content is spam or "false" if it\'s not'),
                        ],
                        'da' => [
                            'spam_checker' => env('SERVICES_AI_OPENAI_ROLES_SYSTEM_DA_SPAM_CHECKER', 'Du er spamCheckerGPT - En ChatGPT klon med speciale i at tjekke indhold fra kontaktformularer for spam. Du svarer med enten "true" hvis indholdet er spam eller "false" hvis det ikke er.'),
                        ],
                    ],
                ],
            ],
        ],
    ],

];
