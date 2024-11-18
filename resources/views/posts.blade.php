@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="container mx-auto flex flex-col items-center justify-center gap-6 px-4 md:px-6">
                        <div class="space-y-4 text-center">
                            <h2 class="text-2xl font-bold tracking-tighter sm:text-2xl md:text-2xl">Crea un nuevo post</h2>
                        </div>
                    </div>
                    <form id="PostForm" class= "col-12 mx-auto">
                    @csrf
                        <label for="title" class="col-md-4 col-form-label">Titulo</label>
                        <input id="title" type="text" class="form-control" name="title" required>
                        <label for="content" class="col-md-4 col-form-label">Contenido</label>
                        <textArea id="content" type="content" class="form-control" name="content" required ></textArea>
                        <label for="categoryid" class="col-md-4 col-form-label">Categoria</label>
                        <select id="options-select" class="form-select" aria-label=""name="categoryid" >
                            <option selected>Selecciona una opción</option>
                        </select>                      
                        <div class="m-4 mx-auto">
                            <button type="submit"  id="btn-create" class="btn btn-outline-success">
                                Crear
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 mt-4 container">
            <ul class="nav nav-underline" id="tabsCategories">
            </ul>
            <div class="tab-content mt-4" id="tabContent">
            </div>
           
        </div>
    </div>
</div>
<script>
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
            Swal.fire({
                    icon: 'success',
                    title: 'Categoria creada exitosamente',
                    confirmButtonText: 'Aceptar'
                });
            cargarCategorias();
            document.getElementById('PostForm').reset();
        })
        .catch(error => {
            var errors = error.response.data.errors;
            var mensaje = "<ul>";
            if (Object.keys(errors).length === 0) {
                mensaje = "<li>Error al crear el post, intente de nuevo.</li>";
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
                title: 'Error al crear el post',
                html : mensaje,
                confirmButtonText: 'Aceptar'
            });
        });
    });

    //Consultar categorias
    async function loadInformation() {
        cargarCategorias()
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
            Swal.fire({
                icon: 'error',
                title: 'Error al cargar las opciones',
                confirmButtonText: 'Aceptar'
            });
        }
    }
    async function cargarCategorias() {
            const response = await axios.get('/api/categories', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });
            const data = response.data.data; 
            const tabsContainer = document.getElementById('tabsCategories');
            const tabContentContainer = document.getElementById('tabContent');
            tabsContainer.value= ''
            tabContentContainer.value= ''
            data.forEach((categoria, index)=> {
                const tab = document.createElement('li');
                    tab.classList.add('nav-item');
                    const tabLink = document.createElement('a');
                    tabLink.classList.add('nav-link', 'link-light');
                    if(index === 0 )
                    tabLink.classList.add('active');
                    tabLink.setAttribute('id', `tab-${categoria.id}`);
                    tabLink.setAttribute('data-bs-toggle', 'tab');
                    tabLink.setAttribute('href', `#categoria${categoria.id}`);
                    tabLink.textContent = categoria.name;
                    tab.appendChild(tabLink);
                    tabsContainer.appendChild(tab);
                    const tabContent = document.createElement('div');
                    tabContent.classList.add('tab-pane', 'fade', 'active');
                    if(index === 0)
                    tabContent.classList.add('show');
                    tabContent.setAttribute('id', `categoria${categoria.id}`);       
                    const row = document.createElement('div');
                    row.classList.add('row');
                    categoria.posts.forEach(post => {
                        const col = document.createElement('div');
                        col.classList.add('col-md-4');
                        const card = document.createElement('div');
                        card.classList.add('card', 'mb-4');
                        const cardHeader = document.createElement('div');
                        cardHeader.classList.add('card-header');
                        cardHeader.textContent = post.title;
                        const cardBody = document.createElement('div');
                        cardBody.classList.add('card-body');
                        cardBody.innerHTML = `<p>${post.content.substring(0, 100)}...</p>`;
                        card.appendChild(cardHeader);
                        card.appendChild(cardBody);
                        col.appendChild(card);
                        row.appendChild(col);
                    });
                    tabContent.appendChild(row);
                    tabContentContainer.appendChild(tabContent);
            });
    }

    window.onload = loadInformation;

    </script>
@endsection