<?php

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

if (isset($_POST['guardar'])) {

    $idEstudiante = $_POST['id_estudiante'];
    $fecha = new DateTime($_POST['fecha']);
    $fechaEntregar = new DateTime($_POST['fecha_entregar']);
    $salida = $_POST['salida'];
    $libros = $_POST['libros'];


    $data = array(
        "id_estudiante" => $idEstudiante,
        "fecha" => date_format($fecha, 'Y-m-d'),
        "fecha_entregar" => date_format($fechaEntregar, 'Y-m-d')
    );

    $prestamo = $library->prestamo();
    $result = $prestamo->insert($data);


    $json_arr = array(
        "estatus" => true
    );

    if (!isset($result)) {
        $json_arr = array(
            "estatus" => false
        );
    }

    $libr = json_decode($libros, true);

    $libross = $libr['libros'];

    $prestamod = $library->prestamo_detalle();

    foreach ($libross as $value) {

        $data1 = array(
            "id_prestamo" => $result,
            "id_libro" => $value
        );

        $result = $prestamod->insert($data1);

        if (!isset($result)) {
            $json_arr = array(
                "estatus" => false
            );
        }
    }

    echo json_encode($json_arr);
}

if (isset($_POST['buscarPorEstudiante'])) {

    $datos = $_POST['id_estudiante'];

    $query = "select id_prestamo_detalle, l.titulo, a.autor_nombre, l.ISBN "
            . "from prestamo p, prestamo_detalle pd, autor a, libro l "
            . "where p.id_prestamo = pd.id_prestamo AND pd.id_libro = l.id_libro AND "
            . "l.id_autor = a.id_autor";

    $books = $conexion->query($query);

    $array = array();
    foreach ($books as $est) {
        $array[] = array(
            "id_libro" => $est['id_libro'],
            "titulo" => $est['titulo'],
            "isbn" => $est['ISBN'],
            "autor" => $est['autor_nombre'],
            "id_prestamo_detalle"
        );
    }

    echo json_encode($array);
}


