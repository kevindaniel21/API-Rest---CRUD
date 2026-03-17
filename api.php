<?php
/*mi intento*/
// header("Content-Type: application/json");

// $metodo = $_SERVER["REQUEST_METHOD"];

// // echo $metodo;

// // $datos = [
// //     "nombre" => "kevin",
// //     "edad" => 20,
// // ];

// // echo json_encode($datos);


// if($metodo === "GET"){

//     $archivo = file_get_contents("usuarios.json");

//     $usuarios = json_decode($archivo, true);

//     echo json_encode($usuarios); 
// }


//estudiar

// | Método | Qué hace      |
// | ------ | ------------- |
// | GET    | ver usuarios  |
// | POST   | crear usuario |
// | PUT    | Actualizar    |
// | DELETE | Eliminar      |

//la respuesta sera json

header("Content-Type: application/json");

//funcion guardar datos
function guardarDatos($usuarios){
    // Usamos array_values para reindexar y JSON_PRETTY_PRINT para que el archivo sea legible
    return file_put_contents("usuarios.json", json_encode(array_values($usuarios), JSON_PRETTY_PRINT));
}

//Que metodo es
$metodo = $_SERVER["REQUEST_METHOD"];

//LEER ARCHIVO DONDE ESTAN LOS USUARIOS JSON
$archivo = file_get_contents("usuarios.json");

//Pasamos de json a array
$usuarios = json_decode($archivo, true);


//========================
// GET (obtener usuarios)
//========================

if($metodo === "GET"){
    echo json_encode($usuarios);
}

//=============================
// POST (CREAR USUARIOS)
//=============================

if($metodo === "POST"){
    //LEER DATOS ENVIADOS DESDE POSTMAN
    $datos= json_decode(file_get_contents("php://input"), true);

    //validacion basica
    if(!isset($datos["nombre"]) || empty(trim($datos["nombre"]))){
        http_response_code(400);
        echo json_encode([
            "error" => "el campo 'nombre' es obligatorio."
        ]); 
        exit;
    }

    $maxId = 0;

    foreach($usuarios as $usuario){
        if(isset($usuario["id"]) && $usuario["id"] > $maxId){
            $maxId = $usuario["id"];
        }
    }

    $id = $maxId + 1;

    $nuevoUsuario = [
        "id" => $id,
        "nombre" => trim($datos["nombre"]),
    ];

    //agregar el usuario al array
    $usuarios[] = $nuevoUsuario;

    //Guardar nuevamente el archivo
    guardarDatos($usuarios);

    //respuesta de la api
    echo json_encode([
        "mensaje" => "usuario creado."
    ]);
}

//=======================
// PUT (ACTUALIZAR DATOS)
//=======================

if($metodo === "PUT"){
    //Leer los datos de postman
    $datos = json_decode(file_get_contents("php://input"), true);

    //validacion que se enviarion id y nombre
    if (!isset($datos["id"]) || !isset($datos["nombre"])){
        echo json_encode([
            "error" => "faltan datos (id o nombre)"
        ]);
        exit;
    }

    $encontrado = false;
    //Recorre el array
    foreach($usuarios as &$usuario){
        //Valida si en el archivo json el id es igual al id de los datos que se ingresan en postman
        
        if($usuario["id"] == $datos["id"]){
            //si cumple la condicion, entonces , el nombre que se ponga en posman va a actualizar el nombre que esta en el archivo .json
            $usuario["nombre"] = $datos["nombre"];
            $encontrado = true;
            break;
        }
    }

    //validar si el usuario existia
    if(!$encontrado){
        http_response_code(404);
        echo json_encode([
            "error" => "usuario no encontrado"
        ]);
        exit;
    }

    //Guarda los datos
    guardarDatos($usuarios);

    //Muestra mensaje
    echo json_encode([
        "mensaje" => "usuario actualizado."
    ]);

}

//===============================
// DELETE (ELIMINAR)
//===============================


if($metodo === "DELETE"){
    //Leer los datos de postman
    $datos = json_decode(file_get_contents("php://input"), true);

    if (!isset($datos["id"]) || !is_numeric($datos["id"])) {
        http_response_code(400);
        echo json_encode(["error" => "El ID debe ser un número válido."]);
        exit;
    }

    $encontrado = false;
    foreach($usuarios as $index => $usuario){
        if($usuario["id"] == $datos["id"]){
            unset($usuarios[$index]);
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        http_response_code(404);
        echo json_encode(["error" => "Usuario no encontrado."]);
        exit;
    }

    file_put_contents("usuarios.json", json_encode(array_values($usuarios)));

    echo json_encode([
        "mensaje" => "Usuario eliminado"
    ]);
}

?>