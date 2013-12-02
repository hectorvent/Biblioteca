<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $descripcion = $_POST['descripcion'];

    if ($_POST['accion'] == "guardar") {

        $data = array(
            "clasificacion_descripcion" => $descripcion
        );

        $clasificacion = $library->clasificacion();
        $result = $clasificacion->insert($data);

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
        $idClasificacion = $_POST['id_clasificacion'];

        $clasificacion = $library->clasificacion[$idClasificacion];

        if ($clasificacion) {

            $data = array(
                "clasificacion_descripcion" => $descripcion
            );

            $result = $clasificacion->update($data);

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

if (isset($_POST['borrar']) && isset($_POST['id_clasificacion'])) {

    $idClasificacion = $_POST['id_clasificacion'];
    $clasificacion = $library->clasificacion[$idClasificacion];

    $json_arr = array(
        "estatus" => false
    );

    if ($clasificacion && $clasificacion->delete()) {
        $json_arr = array(
            "estatus" => true
        );
    }

    echo json_encode($json_arr);
}

if (isset($_POST['buscar'])) {

    $datos = $_POST['datos'];
    $clasificaciones = $library->clasificacion()->where("clasificacion_descripcion LIKE ?", "%$datos%")->limit(10);

    $array = array();
    foreach ($clasificaciones as $clasificacion) {
        $array[] = array(
            "id_clasificacion" => $clasificacion['id_clasificacion'],
            "descripcion" => $clasificacion['clasificacion_descripcion']
        );
    }

    echo json_encode($array);
}

if (isset($_POST['buscarId'])) {

    $idClasificacion = $_POST['id_clasificacion'];

    $cla = $library->clasificacion[$idClasificacion];

    $json_arr = array(
        "id_clasificacion" => $cla['id_clasificacion'],
        "descripcion" => $cla['clasificacion_descripcion']
    );

    echo json_encode($json_arr);
}
