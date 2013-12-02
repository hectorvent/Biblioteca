<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $apellido = $_POST['apellido'];
    $estado = $_POST['habilitado'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "estudiante_nombre" => $nombre,
            "estudiante_apellido" => $apellido,
            "matricula" => $matricula,
            "estudiante_activo" => $estado,
            "puntuacion" => 0
        );

//        echo json_encode($data);
        $estudiante = $library->estudiante();
        $result = $estudiante->insert($data);


        $json_arr = array(
            "estatus" => false
        );

        if (isset($result)) {
            $json_arr = array(
                "estatus" => true
            );
        }

        echo json_encode($json_arr);
    } else {
        $idEstudiante = $_POST['id_estudiante'];

        $estudiante = $library->estudiante[$idEstudiante];

        if ($estudiante) {

            $data = array(
                "estudiante_nombre" => $nombre,
                "estudiante_apellido" => $apellido,
                "matricula" => $matricula,
                "estudiante_activo" => $estado
            );

            $result = $estudiante->update($data);

            $json_arr = array(
                "estatus" => false
            );

            if ($result == 1) {
                $json_arr = array(
                    "estatus" => true
                );
            }

            echo json_encode($json_arr);
        }
    }
}

if (isset($_POST['borrar']) && isset($_POST['id_estudiante'])) {

    $idEstudiante = $_POST['id_estudiante'];
    $estudiante = $library->estudiante[$idEstudiante];

    $json_arr = array(
        "estatus" => false
    );

    if ($estudiante && $estudiante->delete()) {
        $json_arr = array(
            "estatus" => true
        );
    }

    echo json_encode($json_arr);
}

if (isset($_POST['buscar'])) {

    $datos = $_POST['datos'];
    $books = $library->libro()->where("CONCAT(ISBN, titulo) LIKE ?", "%$datos%")->limit(10);

    $array = array();
    foreach ($books as $est) {
        $array[] = array(
            "id_libro" => $est['id_libro'],
            "titulo" => $est['titulo'],
            "isbn" => $est['ISBN'],
            "subtitulo" => $est['subtitulo'],
            "resumen" => $est['resumen']
        );
    }

    echo json_encode($array);
}

if (isset($_POST['buscarId'])) {

    $idLibro = $_POST['id_libro'];

    $est = $library->libro[$idLibro];
    
    $autor = $library->autor[$est['id_autor']];

    $json_arr = array(
        "id_libro" => $est['id_libro'],
        "titulo" => $est['titulo'],
        "isbn" => $est['ISBN'],
        "subtitulo" => $est['subtitulo'],
        "resumen" => $est['resumen'],
        "autor" => $autor['autor_nombre']
    );
    
    // $est['id_autor']//

    echo json_encode($json_arr);
}
