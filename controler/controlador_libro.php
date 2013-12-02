<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $sub_titulo = $_POST['sub_titulo'];
    $resumen = $_POST['resumen'];
    $imagen = $_POST['imagen'];
    $clasificacion = $_POST['clasificacion'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $editora = $_POST['editora'];
    $cantidad = $_POST['cantidad'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $permitir_salir = $_POST['permitir_salir'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "ISBN" => $isbn,
            "titulo" => $titulo,
            "sub_titulo" => $sub_titulo,
            "resumen" => $resumen,
            "imagen" => $imagen,
            "id_clasificacion" => $clasificacion,
            "id_autor" => $autor,
            "id_genero" => $genero,
            "id_editora" => $editora,
            "cantidad" => $cantidad,
            "cantidad_disponible" => $cantidad_disponible,
            "permitir_salir" => $permitir_salir
        );

//        echo json_encode($data);
        $libro = $library->libro();
        $result = $libro->insert($data);


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
        $idLibro = $_POST['id_libro'];

        $libro = $library->libro[$idLibro];

        if ($libro) {

            $data = array(
                "ISBN" => $isbn,
                "titulo" => $titulo,
                "sub_titulo" => $sub_titulo,
                "resumen" => $resumen,
                "imagen" => $imagen,
                "id_clasificacion" => $clasificacion,
                "id_autor" => $autor,
                "id_genero" => $genero,
                "id_editora" => $editora,
                "cantidad" => $cantidad,
                "cantidad_disponible" => $cantidad_disponible,
                "permitir_salir" => $permitir_salir
            );

            $result = $libro->update($data);

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
    $clasificacion = $library->clasificacion[$est['id_clasificacion']];
    $genero = $library->genero[$est['id_genero']];
    $editora = $library->editora[$est['id_editora']];

    $json_arr = array(
        "id_libro" => $est['id_libro'],
        "titulo" => $est['titulo'],
        "isbn" => $est['ISBN'],
        "sub_titulo" => $est['subtitulo'],
        "resumen" => $est['resumen'],
        "autor" => $autor['autor_nombre'],
        "imagen" => $ast['imagen'],
        "clasificacion" => $clasificacion['clasificacion_descripcion'],
        "genero" => $genero['descripcion'],
        "editora" => $editora['editora_descripcion'],
        "cantidad" => $est['cantidad'],
        "cantidad_disponible" => $est['cantidad_disponible'],
        "permite_salida" => $est['permite_salida']
    );

    // $est['id_autor']//

    echo json_encode($json_arr);
}
