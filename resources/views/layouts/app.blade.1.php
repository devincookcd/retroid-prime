<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    {{-- <div id="app"> --}}
        {{-- <main> --}}
        {{-- @yield('content') --}}
        {{-- </main> --}}
    {{-- </div> --}}
    <div id="app">
        <v-app id="test">
            <v-content>
                <v-container>
                    Hello world
                    <v-btn>Test</v-btn>

                    <div
                        v-ripple
                        class="text-xs-center elevation-2 pa-5 headline"
                    >
                        HTML element with v-ripple
                    </div>
                </v-container>
            </v-content>
        </v-app>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
