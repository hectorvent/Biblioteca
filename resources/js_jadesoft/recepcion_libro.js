function reset() {
    alertify.set({
        labels: {
            ok: "Aceptar",
            cancel: "Cancelar"
        },
        delay: 5000,
        buttonReverse: false,
        buttonFocus: "ok"
    });
}

function seleccionarEstudiante(idEstudiante) {

    var parametros = {
        "id_estudiante": idEstudiante,
        "buscarId": true
    };

    $.ajax({
        type: "POST",
        url: "controler/controlador_estudiante.php",
        data: parametros,
        dataType: "json",
        error: function() {
            alert("error peticion ajax");
        },
        success: function(data) {
            $('input[name="nombre_estudiante"]').val(data.nombre);
            $('input[name="apellido"]').val(data.apellido);
            $('input[name="id_estudiante"]').val(idEstudiante);

            $("#dialog_estudiante").dialog("close");

            //////////////////////////////////////

            var parametros = {
                "id_estudiante": idEstudiante,
                "buscarPorEstudiante": true
            };

            $.ajax({
                type: "POST",
                url: "controler/controlador_prestamo.php",
                data: parametros,
                dataType: "json",
                error: function() {
                    alert("error peticion ajax");
                },
                success: function(data) {
                    $('input[name="nombre_estudiante"]').val(data.nombre);
                    $('input[name="apellido"]').val(data.apellido);
                    $('input[name="id_estudiante"]').val(idEstudiante);

                    $("#dialog_estudiante").dialog("close");

                }
            });
            /////////////////////////////////////




        }
    });
}

$(function() {

    $("#consultar_estudiante")
            .button()
            .click(function() {
                $("#dialog_estudiante").dialog("open");
            });

    $("#agregar_libro")
            .button()
            .click(function() {

                var idLibro = $('input[name="id_libro"]').val();
                var tituloLibro = $('input[name="titulo_libro"]').val();
                var autorLibro = $('input[name="autor_libro"]').val();

                var html = "";
                html += "<tr id='" + idLibro + "' onCLick='quitarLibro(this)' >";
                html += " <td> " + tituloLibro + "</td>";
                html += " <td> " + autorLibro + "</td>";
                html += " <td> <img id='consultar_libro' src='resources/imagenes/delete_20.png' alt='Quitar Liboro' /> </td>";
                html += " </tr>";

                $('#tabla_prestamo > tbody').append(html);

                // limpiamos los campos
                $('input[name="id_libro"]').val("0");
                $('input[name="titulo_libro"]').val("");
                $('input[name="autor_libro"]').val("");

                $('#agregar_libro').attr('disabled', 'disabled').addClass('ui-state-disabled');
            });

    $("#dialog_estudiante").dialog({
        autoOpen: false,
        resizable: false,
        height: 530,
        width: 600,
        modal: true,
        buttons: {
            Cancel: function() {
                $(this).dialog("close");
            }
        }
    });


    $("#guardar")
            .button()
            .click(function() {

                alertify.set({delay: 1500});
//                if ($("#descripcion").val().length < 1) {
//                    alertify.error("La descripcion esta vacia");
//                    return false;
//                }


                var libro = new Array();

                var indice = 0;
                $('#tabla_prestamo tbody tr').each(function() {
                    libro[indice] = $(this).attr('id');
                    indice++;
                });

                var jsonText = JSON.stringify(libro);
                var libros = ' { "libros" : ' + jsonText + ' }';

                var parametros = {
                    "guardar": $('#guardar').val(),
                    "id_estudiante": $('#id_estudiante').val(),
                    "fecha": $('#fecha').val(),
                    "fecha_entregar": $('#fecha_entrega').val(),
                    "salida": $('#salida').val(),
                    "libros": libros,
                };

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_prestamo.php",
                    data: parametros,
                    dataType: "json",
                    error: function() {
                        alertify.error("Error al enviar la peticion");
                    },
                    success: function(data) {
                        if (data.estatus) {
                            alertify.success("Registro Guardado Exitosamente");
                        } else {
                            alertify.error("Error al Intentar salvar el registro");
                        }
                    }
                });

                $("#nuevo").click();

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_prestamo')[0].reset();
                $('#id_estudianrte').val("0");
                $("#tabla_prestamo > tbody").empty();
            });

});

$(document).ready(function() {

    var consulta;

    $("#busqueda_estudiante").focus();
    $("#busqueda_estudiante").keyup(function(e) {

        consulta = $("#busqueda_estudiante").val();
        var parametros = {"datos": consulta, "buscar": true};

        $.ajax({
            type: "POST",
            url: "controler/controlador_estudiante.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_estudiante > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_estudiante + " onClick='seleccionarEstudiante(" + data[key].id_estudiante + ")'>";
                    html += " <td> " + data[key].matricula + "</td>";
                    html += " <td>" + data[key].nombre + "</td>";
                    html += "  <td>" + data[key].apellido + "</td>";
                    html += " </tr>";
                });

                $('#tabla_estudiante > tbody').append(html);
            }
        });
    });

});