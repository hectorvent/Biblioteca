<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $descripcion = $_POST['descripcion'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "descripcion" => $descripcion
        );

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
        $idClasificacion = $_POST['id_genero'];

        $genero = $library->genero[$idClasificacion];

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

    $idClasificacion = $_POST['id_genero'];
    $genero = $library->genero[$idClasificacion];

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
    $generoes = $library->genero()->where("descripcion LIKE ?", "%$datos%")->limit(10);

    $array = array();
    foreach ($generoes as $genero) {
        $array[] = array(
            "id_genero" => $genero['id_genero'],
            "descripcion" => $genero['descripcion']
        );
    }

    echo json_encode($array);
}

if (isset($_POST['buscarId'])) {

    $idClasificacion = $_POST['id_genero'];

    $cla = $library->genero[$idClasificacion];

    $json_arr = array(
        "id_genero" => $cla['id_genero'],
        "descripcion" => $cla['descripcion']
    );

    echo json_encode($json_arr);
}
