<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $descripcion = $_POST['editora_descripcion'];
    $direccion = $_POST['editora_direccion'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "editora_descripcion" => $descripcion,
            "editora_direccion" => $direccion
                //     "puntuacion" => 0
        );

//        echo json_encode($data);
        $editora = $library->editora();
        $result = $editora->insert($data);


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
        $idGenero = $_POST['id_editora'];

        $editora = $library->editora[$idGenero];

        if ($editora) {

            $data = array(
                "editora_descripcion" => $descripcion,
                "editora_direccion" => $direccion
            );

            $result = $editora->update($data);

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

if (isset($_POST['borrar']) && isset($_POST['id_editora'])) {

    $idGenero = $_POST['id_editora'];
    $editora = $library->editora[$idGenero];

    $json_arr = array(
        "estatus" => false
    );

    if ($editora && $editora->delete()) {
        $json_arr = array(
            "estatus" => true
        );
    }

    echo json_encode($json_arr);
}

if (isset($_POST['buscar'])) {

    $datos = $_POST['datos'];
    $books = $library->editora()->where("CONCAT(editora_descripcion, editora_direccion) LIKE ?", "%$datos%")->limit(10);

    $array = array();
    foreach ($books as $est) {
        $array[] = array(
            "id_editora" => $est['id_editora'],
            "descripcion" => $est['editora_descripcion'],
            "direccion" => $est['editora_direccion']
        );
    }

    echo json_encode($array);
}

if (isset($_POST['buscarId'])) {

    $idGenero = $_POST['id_editora'];

    $est = $library->editora[$idGenero];

    $json_arr = array(
        "descripcion" => $est['editora_descripcion'],
        "direccion" => $est['editora_direccion']
    );

    echo json_encode($json_arr);
}
