# API REST CRUD en PHP con JSON

Este proyecto es una API REST básica desarrollada en PHP puro que permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre usuarios utilizando un archivo JSON como almacenamiento.

Además, incluye un frontend básico en HTML y JavaScript que consume la API mediante fetch.

---

## 🚀 Funcionalidades

* Obtener usuarios (GET)
* Crear usuario (POST)
* Actualizar usuario (PUT)
* Eliminar usuario (DELETE)

---

## 🛠 Tecnologías usadas

* PHP
* JavaScript (fetch)
* JSON
* Postman (para pruebas)

---

## 📡 Endpoints

### GET

Obtiene todos los usuarios

```
GET /api.php
```

---

### POST

Crea un usuario

```
POST /api.php
Body:
{
  "nombre": "Kevin"
}
```

---

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

---

### DELETE

Elimina un usuario

```
DELETE /api.php
Body:
{
  "id": 1
}
```

---

## 💻 Frontend

El proyecto incluye una interfaz web básica que permite interactuar con la API:

* Listar usuarios en una tabla
* Crear nuevos usuarios
* Editar usuarios existentes
* Eliminar usuarios

---

## ▶️ Cómo ejecutar el proyecto

1. Clona este repositorio
2. Coloca la carpeta en:

   * `htdocs` (XAMPP) o
   * `www` (Laragon)
3. Inicia Apache
4. Abre en el navegador:

```
http://localhost/API-Rest---CRUD/
```

---

## ⚠️ Notas

* Este proyecto utiliza un archivo JSON como base de datos
* Es un proyecto educativo (no recomendado para producción)

---

## 👨‍💻 Autor

Kevin Daniel
