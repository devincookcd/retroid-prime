<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet"> --}}
    <!-- What... -->
    <link rel="manifest" href="/manifest.json">
    <!-- Why... -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}


</head>
<body>
    <div id="app">
        <vue-app></vue-app>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

{{-- <script src="http://localhost:8080/js/bundle.js"></script> --}}

{{-- @if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
@endif --}}

<script>
window.Laravel = @json([
    'csrfToken'=> csrf_token(),
    'apiToken' => isset($currentUser) ? $currentUser->api_token : null
]);
</script>

@if(config('app.env') == 'prod')
<script>
    if ('serviceWorker' in navigator ) {
      window.addEventListener('load', function() {
          navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
              // Registration was successful
              console.log('ServiceWorker registration successful with scope: ', registration.scope);
          }, function(err) {
              // registration failed :(
              console.log('ServiceWorker registration failed: ', err);
          });
      });
  }
</script>
@endif

</html>

