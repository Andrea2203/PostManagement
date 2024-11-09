<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>


<body class="bg-cover bg-center" style="background-image: url('{{ asset('images/fondo.jpg') }}');">

    <div class="absolute  p-6 rounded-lg  max-w-lg w-full justify-content-center py-3">

        <div class="container mx-auto flex flex-col items-center justify-center gap-6 px-4 md:px-6 relative z-10">
            <div class="space-y-4 text-center" style="color:#F36E21">
                <h1 class="text-2xl font-bold text-blue-600 mb-2"></h1>
               <h2 class="text-4xl font-semibold text-gray-800 mb-4" style="font-size: 3rem;
    font-weight: 800;
    line-height: 2.7rem;
    margin-bottom: calc(var(--base-unit)* 2);
    word-break: break-word;">Creación de Post</h2>
            </div>

        </div>
    </div>
    <div id="app">

    </div>

    <main class="py-4">
        @yield('content')
    </main>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</html>