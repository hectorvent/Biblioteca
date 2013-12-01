<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "autor_nombre" => $nombre
       //     "puntuacion" => 0
        );

//        echo json_encode($data);
        $autor = $library->autor();
        $result = $autor->insert($data);


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
        $idAutor = $_POST['id_autor'];

        $autor = $library->autor[$idAutor];

        if ($autor) {

            $data = array(
                "autor_nombre" => $nombre
            );

            $result = $autor->update($data);

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

if (isset($_POST['borrar']) && isset($_POST['id_autor'])) {

    $idAutor = $_POST['id_autor'];
    $autor = $library->autor[$idAutor];

    $json_arr = array(
        "estatus" => false
    );

    if ($autor && $autor->delete()) {
        $json_arr = array(
            "estatus" => true
        );
    }

    echo json_encode($json_arr);
}

if (isset($_POST['buscar'])) {

    $datos = $_POST['datos'];
    $books = $library->autor()->where("CONCAT(autor_nombre) LIKE ?", "%$datos%")->limit(10);

    $array = array();
    foreach ($books as $est) {
        $array[] = array(
            "id_autor" => $est['id_autor'],
            "nombre" => $est['autor_nombre']
        );
    }

    echo json_encode($array);
}

if (isset($_POST['buscarId'])) {

    $idAutor = $_POST['id_autor'];

    $est = $library->autor[$idAutor];

    $json_arr = array(
        "nombre" => $est['autor_nombre']
    );

    echo json_encode($json_arr);
}
