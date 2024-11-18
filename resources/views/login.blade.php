@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="container mx-auto flex flex-col items-center justify-center gap-6 px-4 md:px-6">
                        <div class="space-y-4 text-center">
                            <h2 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl">Bienvenido</h2>
                            <h5 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl">Por favor ingresar los datos para su registro</h5>
                        </div>
                    </div>
                    <form id="loginForm" class= "col-8 mx-auto">
                    @csrf
                        <div class="row mb-1">
                            <div class="col-md-6 input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control" placeholder="Correo electrónico " name="email" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6 input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div class="m-4">
                            <button type="submit"  id="btn-login" class="btn btn-outline-success">
                                Ingresar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this); 
        axios.post('/api/login', formData)
        .then(response => {
            document.getElementById('loginForm').reset();
            localStorage.setItem('auth_token', response.data.data.token);

            window.location.href = '/posts'; 
        })
        .catch(error => {
            var errors = error.response.data.errors;
            var mensaje = "<ul>";
            if (Object.keys(errors).length === 0) {
                mensaje = "<li>Error al ingresar, intente de nuevo.</li>";
            } else {
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        mensaje += errors[key].map(error => "<li>" + error + "</li>").join("");
                    }
                }
            }
            mensaje += "</ul>";
            Swal.fire({
                icon: 'error',
                title: 'Ha ocurrido un error.',
                html : mensaje,
                confirmButtonText: 'Aceptar'
            });
        });
    });

    </script>
@endsection