@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="container mx-auto flex flex-col items-center justify-center gap-6 px-4 md:px-6">
                        <div class="space-y-4 text-center">
                            <h2 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl">Crear un nuevo post</h2>
                        </div>
                    </div>
                    <form id="PostForm">
                    @csrf
                        <div class="row mb-1">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Titulo</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="content" class="col-md-4 col-form-label text-md-end">Contenido</label>

                            <div class="col-md-6">
                                <textArea id="content" type="content" class="form-control" name="content" required ></textArea>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="categoryid" class="col-md-4 col-form-label text-md-end">Categoria</label>

                            <div class="col-md-6">
                            <select   id="options-select" class="form-select" aria-label=""name="categoryid" >
                                <option selected>Selecciona una opción</option>
                            </select>
                
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit"  id="btn-registro" class="btn btn-primary ">
                                    Ingresar
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 mt-4" style="color:#F36E21">
                <h2 class="text-4xl font-semibold text-gray-800 mb-4" style="font-size: 2rem;
            font-weight: 700;
            line-height: 2.7rem;
            margin-bottom: calc(var(--base-unit)* 2);
            word-break: break-word;">Listado de Post</h2> 
        </div>
        <div class="col-md-12 mt-4">
                <div id="posts-container" class="row">
                </div>  
        </div>
    </div>
</div>
<script>
    const token = localStorage.getItem('auth_token'); 
    if (!token) {
        alert("Usuario no autenticado");
        window.location.href = '/posts'; 

    }

    //Crear Post
        document.getElementById('PostForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this); 
            axios.post('/api/post', formData, {
                headers: {
                    'Authorization': `Bearer ${token}`, 
                    'Accept': 'application/json',     
                }
            })
            .then(response => {
                console.log(':', response.data);
                document.getElementById('PostForm').reset();
                window.location.href = '/posts'; 
            })
            .catch(error => {
                console.error('Hubo un error al autenticar el usuario:', error);
                alert('Error al autenticar al usuario. Por favor, intenta de nuevo.');
            });
        });
    //Consultar categorias
   
    async function loadInformation() {
        const token = localStorage.getItem('auth_token'); 
        if (!token) {
            alert("Usuario no autenticado");
            window.location.href = '/posts'; 
        }

            try {
                const response = await axios.get('/api/categories', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });
                const data = response.data.data; 
                const selectElement = document.getElementById('options-select');
                selectElement.innerHTML = '<option value="">Selecciona una opción</option>';
                data.forEach(option => {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.id;
                    optionElement.textContent = option.name;
                    selectElement.appendChild(optionElement);
                });
            } catch (error) {
                console.error('Error al cargar las opciones:', error);
            }
            try {
                const postsContainer = document.getElementById('posts-container');
        
        // Limpiar el contenedor antes de agregar los nuevos posts
        postsContainer.innerHTML = '';
                const response = await axios.get('/api/posts', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });
                const posts = response.data.data; 
                console.log(posts)
                posts.forEach(post => {
            const card = document.createElement('div'); 
            card.classList.add('card');
            card.classList.add('col-md-4');
            card.classList.add('m-2');

            const cardHeader = document.createElement('div');
            cardHeader.classList.add('card-header');
            cardHeader.textContent = post.title;

            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');
            cardBody.innerHTML = `<p>${post.content.substring(0, 100)}...</p>`;
            card.appendChild(cardHeader);
            card.appendChild(cardBody);
            postsContainer.appendChild(card);
        });

            } catch (error) {
                console.error('Error al cargar las opciones:', error);
            }
        }
    window.onload = loadInformation;

    </script>
@endsection