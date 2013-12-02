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


function quitarLibro(idLibro) {

//    reset();
//    alertify.confirm("Desea remover este libro", function(e) {
//        if (e) {
    $(idLibro).remove();
    alertify.success("Libro removido");
//        }
//    });
}

function seleccionarLibro(idLibro) {

    var parametros = {
        "id_libro": idLibro,
        "buscarId": true};

    $.ajax({
        type: "POST",
        url: "controler/controlador_libro.php",
        data: parametros,
        dataType: "json",
        error: function() {
            alert("error peticion ajax");
        },
        success: function(data) {
            $('input[name="id_libro"]').val(idLibro);
            $('input[name="titulo_libro"]').val(data.titulo);
            $('input[name="autor_libro"]').val(data.autor);

            $("#dialog_libro").dialog("close");
            $('#agregar_libro').removeAttr("disabled").removeClass('ui-state-disabled');
        }
    });
}



function seleccionarEstudiante(idEstudiante) {

    var parametros = {
        "id_estudiante": idEstudiante,
        "buscarId": true};

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
        }
    });
}

$(function() {


    $("#fecha").datepicker();
    $("#fecha_entrega").datepicker();

    $("#consultar_estudiante")
            .button()
            .click(function() {
                $("#dialog_estudiante").dialog("open");
            });

    $("#consultar_libro")
            .button()
            .click(function() {
                $("#dialog_libro").dialog("open");
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


    $("#dialog_libro").dialog({
        autoOpen: false,
        resizable: false,
        height: 500,
        width: 500,
        modal: true,
        buttons: {
            Cancel: function() {
                $(this).dialog("close");
            }
        }
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


                var objDatosColumna = Array();
//                var num= 0;
//                $("#tabla tbody tr").each(function(index) {
//                    objDatosColumna.push(num);
//                    num++;
//                });

                var myArr = $.param({ a : [1,2,3] });
                var parametros = {
                    "guardar" : true,
                    "descripcion": "prueba",
                    "libros":  myArr 
                };

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_prestamo.php",
                    data: parametros,
                    dataType: "html",
                    error: function() {
                        alertify.error("Error al enviar la peticion");
                    },
                    success: function(data) {

                        alert(data);
//                        if (data.estatus) {
//                            alertify.success("Registro Guardado Exitosamente");
//                        } else {
//                            alertify.error("Error al Intentar salvar el registro");
//                        }
                    }
                });

//                $('#accion').val("guardar");
//                $('#form_genero')[0].reset();
//                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_genero')[0].reset();
                $('#id_genero').val("0");
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');
            });


    $("#borrar")
            .button()
            .click(function() {

                if ($('#id_genero').val() === "0") {
                    return false;
                }

                var parametros = {
                    "borrar": true,
                    "accion": $('#accion').val(),
                    "id_genero": $('#id_genero').val()
                };

                alertify.set({delay: 1500});
                $.ajax({
                    type: "POST",
                    url: "controler/controlador_genero.php",
                    data: parametros,
                    dataType: "json",
                    error: function() {
                        alertify.error("Error al enviar la peticion");
                    },
                    success: function(data) {
                        if (data.estatus) {
                            alertify.success("Registro eliminado");
                        } else {
                            alertify.error("Error al eliminar registro o el registro se esta utilizando");
                        }
                    }
                });

                $('#accion').val("guardar");
                $('#id_genero').val("0");
                $('#form_genero')[0].reset();

                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;

            });
});

$(document).ready(function() {

    var consulta;

    $("#busqueda_libro").focus();
    $("#busqueda_libro").keyup(function(e) {

        consulta = $("#busqueda_libro").val();

        var parametros = {
            "datos": consulta,
            "buscar": true
        };

        $.ajax({
            type: "POST",
            url: "controler/controlador_libro.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_libro > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_libro + " onClick='seleccionarLibro(" + data[key].id_libro + ")'>";
                    html += " <td> " + data[key].isbn + "</td>";
                    html += " <td> " + data[key].titulo + "</td>";
                    html += " </tr>";

                });

                $('#tabla_libro > tbody').append(html);
            }
        });
    });



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