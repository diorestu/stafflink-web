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
        'api_key' => env('COUNTRYSTATECITY_API_KEY'),
        'base_url' => env('COUNTRYSTATECITY_BASE_URL', 'https://api.countrystatecity.in/v1'),
        'snapshot_path' => env('COUNTRYSTATECITY_SNAPSHOT_PATH', database_path('data/countries_states.json')),
        'metadata_snapshot_path' => env('COUNTRYSTATECITY_METADATA_SNAPSHOT_PATH', database_path('data/countries_meta.json')),
    ],

    'whatsapp' => [
        'inquiry_number' => env('WHATSAPP_INQUIRY_NUMBER', '6285739660906'),
        'inquiry_template' => env('WHATSAPP_INQUIRY_TEMPLATE', 'Hi Staff Link, I am interested in the {position} role ({work_mode}) in {location}.'),
        'candidate_template' => env('WHATSAPP_CANDIDATE_TEMPLATE', 'Hi {name}, thank you for applying to {position}. We would like to continue your process.'),
    ],

    'microsoft_graph' => [
        'enabled' => env('MS_GRAPH_ENABLED', false),
        'tenant_id' => env('MS_GRAPH_TENANT_ID'),
        'client_id' => env('MS_GRAPH_CLIENT_ID'),
        'client_secret' => env('MS_GRAPH_CLIENT_SECRET'),
        'user_id' => env('MS_GRAPH_USER_ID'),
        'timezone' => env('MS_GRAPH_TIMEZONE', 'Asia/Makassar'),
    ],

    'cloudflare_turnstile' => [
        'enabled' => env('CLOUDFLARE_TURNSTILE_ENABLED', false),
        'site_key' => env('CLOUDFLARE_TURNSTILE_SITE_KEY'),
        'secret_key' => env('CLOUDFLARE_TURNSTILE_SECRET_KEY'),
        'verify_url' => env('CLOUDFLARE_TURNSTILE_VERIFY_URL', 'https://challenges.cloudflare.com/turnstile/v0/siteverify'),
    ],

];
