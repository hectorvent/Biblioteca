    function seleccionar(idClasificacion) {

        var parametros = {
            "id_clasificacion": idClasificacion, 
            "buscarId": true};

        $.ajax({
            type: "POST",
            url: "controler/controlador_clasificacion.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {
                
                $('input[name="accion"]').val("actualizar");
                $('input[name="descripcion"]').val(data.descripcion);
                $('input[name="id_clasificacion"]').val(idClasificacion);

                $('#borrar').removeAttr("disabled").removeClass('ui-state-disabled');
                $("#dialog").dialog("close");
            }
        });
    }

$(function() {

    $("#dialog").dialog({
        autoOpen: false,
        resizable: false,
        height: 500,
        width: 400,
        modal: true,
        buttons: {
            Cancel: function() {
                $(this).dialog("close");
            }
        }
    });

    $("#consultar_clasificacion")
            .button()
            .click(function() {
                $("#dialog").dialog("open");
            });

    $("#guardar")
            .button()
            .click(function() {

                alertify.set({delay: 1500});
                if ($("#descripcion").val().length < 1) {
                    alertify.error("La descripcion esta vacia");
                    return false;
                }

                var parametros = {
                    "descripcion": $('#descripcion').val(),
                    "guardar": $('#guardar').val(),
                    "accion": $('#accion').val(),
                    "id_clasificacion": $('#id_clasificacion').val()
                };

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_clasificacion.php",
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

                $('#accion').val("guardar");
                $('#form_clasificacion')[0].reset();
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_clasificacion')[0].reset();
                $('#id_clasificacion').val("0");
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');
            });


    $("#borrar")
            .button()
            .click(function() {

                if ($('#id_clasificacion').val() === "0") {
                    return false;
                }

                var parametros = {
                    "borrar": true,
                    "accion": $('#accion').val(),
                    "id_clasificacion": $('#id_clasificacion').val()
                };
                
                alertify.set({delay: 1500});
                $.ajax({
                    type: "POST",
                    url: "controler/controlador_clasificacion.php",
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
                $('#id_clasificacion').val("0");
                $('#form_clasificacion')[0].reset();

                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;

            });
});

$(document).ready(function() {

    var consulta;
    $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');


    $("#busqueda").focus();
    $("#busqueda").keyup(function(e) {

        consulta = $("#busqueda").val();
        var parametros = {"datos": consulta, "buscar": true};

        $.ajax({
            type: "POST",
            url: "controler/controlador_clasificacion.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_clasificacion > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_clasificacion + " onClick='seleccionar(" + data[key].id_clasificacion + ")'>";
                    html += " <td> " + data[key].descripcion + "</td>";
//                    html += " <td>" + data[key].nombre + "</td>";
//                    html += "  <td>" + data[key].apellido + "</td>";
                    html += " </tr>";
                });

                $('#tabla_clasificacion > tbody').append(html);
            }
        });
    });
});