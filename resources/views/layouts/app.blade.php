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
    <a class="navbar-brand" href="/posts">Posts</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/categories">Categorias</a>
        </li>
    </ul>
        <span class="navbar-text">
          <a class="nav-link" href="#" id="cerrarSesionBtn">Cerrar Sesion</a>
      </span>
    </div>
  </div>
</nav>

<body class="bg-cover bg-center" style="background-image: url('{{ asset('images/fondo.jpg') }}');">


    <div id="app">

    </div>

    <main class="py-4">
        @yield('content')
    </main>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
  const token = localStorage.getItem('auth_token'); 
  if (!token) {
      window.location.href = '/login'; 
  }
  document.getElementById('cerrarSesionBtn').addEventListener('click', function() {
    const token = localStorage.getItem('auth_token');
    if (token) {
      axios.post('/api/logout', {}, {
        headers: {
          'Authorization': `Bearer ${token}`, 
        }
      })
      .then(response => {
        localStorage.clear();
        Swal.fire({
          icon: 'success',
          title: 'Sesión cerrada',
          confirmButtonText: 'Aceptar',
          timer: 15000,
          timerProgressBar: true,
          willClose: () => {
              window.location.href = '/login';
          }
        });
      })
      .catch(error => {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un problema al cerrar sesión. Intenta nuevamente.',
        });
      });
    } else {
      Swal.fire({
          icon: 'warning',
          title: 'No hay sesión activa',
          text: 'No se pudo cerrar sesión porque no estás autenticado.',
          confirmButtonText: 'Aceptar',
          timer: 15000,
          timerProgressBar: true,
          willClose: () => {
              window.location.href = '/login';
          }
        });
    }
});
</script>

</html>