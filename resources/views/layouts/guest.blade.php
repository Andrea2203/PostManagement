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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/login">Posts</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/login">Inicio de sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register">Registrarse</a>
        </li>
      </ul>
      <span class="navbar-text">
      </span>
    </div>
  </div>
</nav>

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