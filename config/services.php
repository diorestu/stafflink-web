<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'model' => env('OPENAI_MODEL', 'gpt-4.1-mini'),
    ],

    'ai_agent' => [
        'api_key' => env('AI_AGENT_API_KEY'),
        'base_url' => env('AI_AGENT_BASE_URL', 'https://ai.sumopod.com/v1'),
        'model' => env('AI_AGENT_MODEL', 'gpt-4o-mini'),
    ],

    'country_state_city' => [
        'api_key' => env('COUNTRYSTATECITY_API_KEY', '8ec2dc2550cdd4be4ed0688e5107a9024f9407e81f8c381536340d4abb35b19e'),
        'base_url' => env('COUNTRYSTATECITY_BASE_URL', 'https://api.countrystatecity.in/v1'),
    ],

];
