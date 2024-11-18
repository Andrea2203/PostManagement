# Prueba final para Desarrollador fullstack
En el repositorio se encuentra el desarrollo de la prueba, la cual tiene funcionalidades como crear usuarios, inicio de sesión de usuarios, creación de post y listado de post a usuarios logeados
## **Requisitos previos**:<br>
Se requiere contar con PHP 8.3, composer y postgres.<br>
## **Pasos para la instalación**:
1. Clonar repositorio
```
git clone https://github.com/Andrea2203/backend-postManagement.git
cd backend-postManagement
```
2. Instalar dependencias
```
composer install
```
3.  Configura tu archivo .env:
```
cp .env.example .env
```
4. Ejecutar migraciones
```
php artisan migrate
```
5. Iniciar el servidor
```
php artisan serve
npm run dev
```
## **Link para visualizar la aplicacion**:
1. Inicio de sesión
```
http://127.0.0.1:8000/login
http://3.140.159.213/login
```
1. Registrarse
```
http://127.0.0.1:8000/register
http://3.140.159.213/register
```
1. Creacion y lista de Post
```
http://127.0.0.1:8000/posts
http://3.140.159.213/posts
```


## **Consumos que puede realizar**:
### 1. Crear un Usuario
**POST** `/api/register`

#### Parámetros (Body - JSON):
```json
{
    "name": "Andrea",
    "email": "andrea@gmail.com",
    "password": "aaaa123",
    "password_confirmation": "aaa123"
}
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": {
        "name": "Andrea",
        "email": "andrea@gmail.com",
        "id": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2",
        "updated_at": "2024-11-09T04:38:00.000000Z",
        "created_at": "2024-11-09T04:38:00.000000Z"
    }
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "errors": {
        "email": [
            "validation.unique"
        ]
    }
}
```
<br>

### 2. Inicio de sesión Usuario
**POST** `/api/login`

#### Parámetros (Body - JSON):
```json
{
    "email": "andrea@gmail.com",
    "password": "aaaa123",
 }
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": {
        "token": "2|tGwloXivAb0Iw429Ks1GARhK3E0fxofbRjXfwVQD8d058fc6"
    }
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "message": "Usuario o contraseña incorrecto"
}
```
### 3. Crear un Post
**POST** `/api/post`

#### Autorizacion:
```
Authorization: Bearer token
```
#### Parámetros (Body - JSON):
```json
{
    "title": "Post Nuevo",
    "content": "Este es un post",
    "categoryid": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2"
}
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": {
        "title": "Post Nuevo",
        "content": "Este es un post",
        "userid": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2",
        "id": 0,
        "updated_at": "2024-11-09T05:20:41.000000Z",
        "created_at": "2024-11-09T05:20:41.000000Z"
    }
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "errors": {
        "content": [
            "validation.required"
        ]
    }
}
```

### 3. Lista de Post
**GET** `/api/posts`

#### Autorizacion:
```
Authorization: Bearer token
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": [
         {
            "id": 0,
            "title": "Post Nuevo",
            "content": "Este es un post",
            "userid": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2",
            "created_at": "2024-11-09T05:28:55.000000Z",
            "updated_at": "2024-11-09T05:28:55.000000Z",
            "user": {
                "id": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2",
                "name": "Juan Perez",
                "email": "juan1@example.com",
                "email_verified_at": null,
                "created_at": "2024-11-09T04:38:00.000000Z",
                "updated_at": "2024-11-09T04:38:00.000000Z"
            },
            "category": {
                "id": "7cecb0b9-4de6-46fd-863f-4710d2ff6d69",
                "name": "Comedia",
                "created_at": "2024-11-09T06:20:50.000000Z",
                "updated_at": "2024-11-09T06:20:50.000000Z"
            }
        }
    ]
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "message": "Error al traer los posts",
    "error": "Error"
}
```
### 4. Lista de Post por id de categoria
**GET** `/api/posts/{categoryid}`

#### Autorizacion:
```
Authorization: Bearer token
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": [
         {
            "id": 0,
            "title": "Post Nuevo",
            "content": "Este es un post",
            "userid": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2",
            "created_at": "2024-11-09T05:28:55.000000Z",
            "updated_at": "2024-11-09T05:28:55.000000Z",
            "user": {
                "id": "b15ddcd7-cd2d-4aa2-b9c0-86e7e54737b2",
                "name": "Juan Perez",
                "email": "juan1@example.com",
                "email_verified_at": null,
                "created_at": "2024-11-09T04:38:00.000000Z",
                "updated_at": "2024-11-09T04:38:00.000000Z"
            },
            "category": {
                "id": "7cecb0b9-4de6-46fd-863f-4710d2ff6d69",
                "name": "Comedia",
                "created_at": "2024-11-09T06:20:50.000000Z",
                "updated_at": "2024-11-09T06:20:50.000000Z"
            }
        }
    ]
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "message": "Error al traer los posts",
    "error": "Error"
}
```

### 5. Crear una categoria
**POST** `/api/category`

#### Autorizacion:
```
Authorization: Bearer token
```
#### Parámetros (Body - JSON):
```json
{
    "name": "Comedia",
}
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": {
        "name": "Comedia",
        "id": "1f9d6fc6-6b12-4fd2-85ca-ea4c3b94d227",
        "updated_at": "2024-11-09T06:39:30.000000Z",
        "created_at": "2024-11-09T06:39:30.000000Z"
    }
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "errors": {
        "name": [
            "validation.required"
        ]
    }
}
```

### 3. Lista de Categorias
**GET** `/api/categories`

#### Autorizacion:
```
Authorization: Bearer token
```
#### Respuesta correcta:
```json
{
    "success": true,
    "data": [
        {
            "id": "3211afb9-6bc3-47fb-86bb-47d54e36ff81",
            "name": "Comedia",
            "created_at": "2024-11-10T05:10:40.000000Z",
            "updated_at": "2024-11-10T05:10:40.000000Z",
            "posts": [
                {
                    "id": "76a3ce0e-3e6e-4d7b-8ff3-ac8e80aed799",
                    "title": "Prueba",
                    "content": "Post de comedia",
                    "userid": "5b1690e1-ed50-4fcf-8cdd-3a57a96900fc",
                    "categoryid": "3211afb9-6bc3-47fb-86bb-47d54e36ff81",
                    "created_at": "2024-11-10T05:11:01.000000Z",
                    "updated_at": "2024-11-10T05:11:01.000000Z"
                },
                {
                    "id": "ae11438e-12fc-4c81-b52a-ff8fa6dacd7b",
                    "title": "Prueba",
                    "content": "Prueba",
                    "userid": "0c2946ff-638c-41de-96a6-defa00bf7b3e",
                    "categoryid": "3211afb9-6bc3-47fb-86bb-47d54e36ff81",
                    "created_at": "2024-11-18T22:46:28.000000Z",
                    "updated_at": "2024-11-18T22:46:28.000000Z"
                }
            ]
        },
    ]
}
```
#### Respuesta erronea:
```json
{
    "success": false,
    "message": "Error al traer las categorias",
    "error": "Error"
}
```
