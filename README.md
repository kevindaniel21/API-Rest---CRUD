# API CRUD básica en PHP

Este proyecto es una API REST básica desarrollada en PHP puro, que permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre usuarios utilizando un archivo JSON como almacenamiento.

## 🚀 Funcionalidades

* Obtener usuarios (GET)
* Crear usuario (POST)
* Actualizar usuario (PUT)
* Eliminar usuario (DELETE)

## 🛠 Tecnologías usadas

* PHP
* JSON
* Postman (para pruebas)

## 📡 Endpoints

### GET

Obtiene todos los usuarios

```
GET /api.php
```

### POST

Crea un usuario

```
POST /api.php
Body:
{
  "nombre": "Kevin"
}
```

### PUT

Actualiza un usuario

```
PUT /api.php
Body:
{
  "id": 1,
  "nombre": "Nuevo nombre"
}
```

### DELETE

Elimina un usuario

```
DELETE /api.php
Body:
{
  "id": 1
}
```

## ⚠️ Notas

* Este proyecto usa un archivo JSON como base de datos
* Es un proyecto de aprendizaje (no recomendado para producción)

## 👨‍💻 Autor

* Kevin Daniel
