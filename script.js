const apiURL = 'api.php';

//FUNCIONES

//CARGAR USUARIOS Y MOSTRAR EN TABLA
function cargarUsuarios(){
    fetch(apiURL)
    .then(res => res.json())
    .then(data => {
        const tbody = document.getElementById('tablaUsuarios');
        tbody.innerHTML = '';
        data.forEach(usuario => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${usuario.id}</td>
                <td>${usuario.nombre}</td>
                <td>
                    <button onclick="editarUsuario(${usuario.id}, '${usuario.nombre}')">Editar</button>
                    <button onclick="eliminarUsuario(${usuario.id})">Eliminar</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    });
}


//guardar usuario (crear o actualizar)
function guardarUsuario() {
    const nombre = document.getElementById('nombre').value;
    const id = document.getElementById('idEditar').value;

    if (!nombre.trim()) {
        alert("El nombre es obligatorio");
        return;
    }

    let metodo = id ? 'PUT' : 'POST';
    let cuerpo = id ? {id: parseInt(id), nombre} : {nombre};

    fetch(apiURL, {
        method: metodo,
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(cuerpo)
    })
    .then(res => res.json())
    .then(respuesta => {
        alert(respuesta.mensaje || respuesta.error);
        document.getElementById('nombre').value = '';
        document.getElementById('idEditar').value = '';
        cargarUsuarios();
    });
}

// Preparar formulario para editar
function editarUsuario(id, nombre) {
    document.getElementById('nombre').value = nombre;
    document.getElementById('idEditar').value = id;
}

// Eliminar usuario
function eliminarUsuario(id) {
    if (!confirm("¿Seguro que quieres eliminar este usuario?")) return;

    fetch(apiURL, {
        method: 'DELETE',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id})
    })
    .then(res => res.json())
    .then(respuesta => {
        alert(respuesta.mensaje || respuesta.error);
        cargarUsuarios();
    });
}

// Cargar usuarios al inicio
cargarUsuarios();
