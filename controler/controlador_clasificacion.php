<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

$clasificacion = $library->clasificacion();

if (isset($_POST['guardar'])) {

    $descripcion = $_POST['descripcion'];

    $data = array(
        "clasificacion_descripcion" => $descripcion
    );

    $result = $clasificacion->insert($data);
    echo $result;
}
?>
