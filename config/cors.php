<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://kelbom.com',        // React SPA (production)
        'http://localhost:5173',     // React SPA (dev Vite)
        'http://localhost:3000',     // React SPA (dev alternative)
    ],

    'allowed_origins_patterns' => [], // On vide temporairement pour débloquer, ou voir l'alternative ci-dessous

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];