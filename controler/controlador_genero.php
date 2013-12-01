<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $descripcion = $_POST['descripcion'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "descripcion" => $descripcion
       //     "puntuacion" => 0
        );

//        echo json_encode($data);
        $genero = $library->genero();
        $result = $genero->insert($data);


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
        $idGenero = $_POST['id_genero'];

        $genero = $library->genero[$idGenero];

        if ($genero) {

            $data = array(
                "descripcion" => $descripcion
            );

            $result = $genero->update($data);

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

if (isset($_POST['borrar']) && isset($_POST['id_genero'])) {

    $idGenero = $_POST['id_genero'];
    $genero = $library->genero[$idGenero];

    $json_arr = array(
        "estatus" => false
    );

    if ($genero && $genero->delete()) {
        $json_arr = array(
            "estatus" => true
        );
    }

    echo json_encode($json_arr);
}

if (isset($_POST['buscar'])) {

    $datos = $_POST['datos'];
    $books = $library->genero()->where("CONCAT(descripcion) LIKE ?", "%$datos%")->limit(10);

    $array = array();
    foreach ($books as $est) {
        $array[] = array(
            "id_genero" => $est['id_genero'],
            "descripcion" => $est['descripcion']
        );
    }

    echo json_encode($array);
}

if (isset($_POST['buscarId'])) {

    $idGenero = $_POST['id_genero'];

    $est = $library->genero[$idGenero];

    $json_arr = array(
        "descripcion" => $est['descripcion']
    );

    echo json_encode($json_arr);
}
