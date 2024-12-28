<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f4f4f4;
            }
            .container {
                display: flex;
                width: 80%;
                max-width: 1200px;
                /* background: #fff; */
                /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
                border-radius: 8px;
                overflow: hidden;
            }
            .logo-section {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #fff;
            }
            .logo-section img {
                max-width: 80%;
                height: auto;
                border-radius: 50%;
            }
            .form-section {
                flex: 1;
                padding: 40px;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <!-- Logo Section -->
            <div class="logo-section">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
            </div>

            <!-- Form Section -->
            <div class="form-section">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
