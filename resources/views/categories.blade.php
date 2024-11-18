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

    async function loadInformation() {
        const token = localStorage.getItem('auth_token'); 
        if (!token) {
            Swal.fire({
                    icon: 'error',
                    title: 'Usuario no autenticado',
                    confirmButtonText: 'Aceptar'
                });
            window.location.href = '/categories'; 
        }
        try {
            const categoriesContainer = document.getElementById('categories-container');
            categoriesContainer.innerHTML = '';
            const response = await axios.get('/api/categories', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });
            const categories = response.data.data; 
            categories.forEach(category => {
                const card = document.createElement('div');
                card.classList.add('col-md-3', 'm-2', 'text-bg-light', 'card');
                const cardInner = document.createElement('div');
                cardInner.classList.add('card', 'mb-4');
                const cardBody = document.createElement('div');
                cardBody.classList.add('card-body');
                cardBody.textContent = category.name;
                card.appendChild(cardBody);
                categoriesContainer.appendChild(card);
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error al cargar las categorias',
                confirmButtonText: 'Aceptar'
            });
        }
    }
    window.onload = loadInformation;


    </script>
@endsection