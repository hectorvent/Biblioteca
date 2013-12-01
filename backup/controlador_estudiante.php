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
    ?>

    <script>
    
//////////////////// del Controlador_estudiante.php

$('#tablaEstudiante tr').click(function(event) {

    var idEstudiante;

    //obtenemos el texto introducido en el campo de busqueda
    idEstudiante = $(this).attr('id');

    //hace la b�squeda
    var parametros = {"id_estudiante": idEstudiante, "buscarId": true};

    $.ajax({
        type: "POST",
        url: "controler/controlador_estudiante.php",
        data: parametros,
        dataType: "json",
        beforeSend: function() {
            //$("#resultado").html( "ho hay data");

        },
        error: function() {
            alert("error peticion ajax");
        },
        success: function(data) {
            //	alert(data);
//            var obj = $.parseJSON(data);

            //	alert(obj.matricula);
            $('input[name="accion"]').val("actualizar");

            $('input[name="matricula"]').val(data.matricula);
            $('input[name="nombre"]').val(data.nombre);
            $('input[name="apellido"]').val(data.apellido);
            $('input[name="id_estudiante"]').val(idEstudiante);

            $('input:radio[name="habilitado"][value="' + data.estado + '"]').prop('checked', true);
            //                        if (obj.estado === 1) {
            //                            $('input:radio[name="habilitado"][value="1"]').prop('checked', true);
            //                        } else {
            //                            $('input:radio[name="habilitado"][value="0"]').prop('checked', true);
            //                        }

            $('#borrar').removeAttr("disabled").removeClass('ui-state-disabled');
            $("#dialog").dialog("close");

        }
    });

});

    
    </script>

    <table id='tablaEstudiante' class='ui-widget ui-widget-content'>
        <thead>
            <tr class='ui-widget-header '>
                <th width="30">Matricula</th>
                <th width="50">Nombre</th>
                <th width="50">Apellido</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $datos = $_POST['datos'];

            $books = $library->estudiante()->where("CONCAT(matricula, estudiante_nombre, estudiante_apellido) LIKE ?", "%$datos%")->limit(10, 0);

            foreach ($books as $book) {
                echo "<tr id=" . $book["id_estudiante"] . ">";
                echo " <td> " . $book["matricula"] . "</td> <td>" . $book["estudiante_nombre"] . "</td> <td>" . $book["estudiante_apellido"];
                echo "	</tr>";
            }

            echo "</tbody></table>";
        }

        if (isset($_POST['buscarId'])) {

            $idEstudiante = $_POST['id_estudiante'];

            $est = $library->estudiante[$idEstudiante];


            $json_arr = array(
                "nombre" => $est['estudiante_nombre'],
                "apellido" => $est['estudiante_apellido'],
                "matricula" => $est['matricula'],
                "estado" => $est['estudiante_activo'],
                "email" => $est['estudiante_activo']
            );

            echo json_encode($json_arr);
        }