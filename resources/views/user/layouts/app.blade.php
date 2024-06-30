<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('build/assets/blogger.png') }}" type="image/png">
</head>
<body>
        @include('user.layouts.navigation')
   <main>
       {{ $slot }}
   </main>
    <footer>

    </footer>

</body>
</html>
