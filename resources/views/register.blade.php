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
                    <form id="registerForm">
                    @csrf
                        <div class="row mb-1">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"  required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" minlength="8" required >
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirmación Contraseña</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" minlength="8" required onkeyup="confirmValues('password', 'password_confirmation', 'confirm_password', 'btn-registro')">
                                
                                <span id="confirm_password"  hidden= true style="color: red;">Las contraseñas no coinciden.</span>
                            </div>
                        </div>
                        <div class="m-4">
                            <button type="submit"  id="btn-registro" class="btn btn-outline-success">
                            Registrate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        function confirmValues(val1, val2, txt, boton) {
            
            var val1 = document.getElementById(val1).value;
            var val2 = document.getElementById(val2).value;
            var txt = document.getElementById(txt);
            var boton = document.getElementById(boton);
            if (val1 == val2) {
                txt.setAttribute("hidden", true);
                boton.removeAttribute("disabled");
            } else {
                txt.removeAttribute("hidden");
                boton.setAttribute("disabled", true);
            }
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this); 
            axios.post('/api/register', formData)
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario creado exitosamente',
                    confirmButtonText: 'Aceptar'
                });
                document.getElementById('registerForm').reset(); 
            })
            .catch(error => {
                var errors = error.response.data.errors;
                var mensaje = "<ul>";
                if (Object.keys(errors).length === 0) {
                    mensaje = "<li>Error al registrar el usuario, intente de nuevo.</li>";
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
                    title: 'Error al crear el usuario',
                    html : mensaje,
                    confirmButtonText: 'Aceptar'
                });
            });
        });

    </script>
@endsection