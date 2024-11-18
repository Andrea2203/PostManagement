@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <h1 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl text-light text-center">Categorias</h1>

        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="container mx-auto flex flex-col items-center justify-center gap-6 px-4 md:px-6">
                        <div class="space-y-4 text-center">
                            <h2 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl">Crea una nueva categoria</h2>
                        </div>
                    </div>
                    <form id="CategoryForm" class= "col-12 mx-auto">
                    @csrf
                        <label for="name" class="col-md-4 col-form-label">Nombre</label>
                        <input id="name" type="text" class="form-control" name="name" required>
                        <div class="m-4 mx-auto">
                            <button type="submit"  id="btn-create" class="btn btn-outline-success">
                                Crear
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div id="categories-container" class="row">
            </div>  
    </div>
</div>
<script>
    document.getElementById('CategoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this); 
        axios.post('/api/category', formData, {
            headers: {
                'Authorization': `Bearer ${token}`, 
                'Accept': 'application/json',     
            }
        })
        .then(response => {
            Swal.fire({
                    icon: 'success',
                    title: 'Categoria creada exitosamente',
                    confirmButtonText: 'Aceptar'
                });
            document.getElementById('CategoryForm').reset();
            loadInformation();
        })
        .catch(error => {
            var errors = error.response.data.errors;
            var mensaje = "<ul>";
            if (Object.keys(errors).length === 0) {
                mensaje = "<li>Error al crear la categoria, intente de nuevo.</li>";
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
                title: 'Error al crear la categoria',
                html : mensaje,
                confirmButtonText: 'Aceptar'
            });
        });
    });
    </script>
@endsection