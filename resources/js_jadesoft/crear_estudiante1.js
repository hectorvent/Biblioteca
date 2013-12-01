    function seleccionar(idEstudiante) {

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
                
                $('input[name="accion"]').val("actualizar");
                $('input[name="matricula"]').val(data.matricula);
                $('input[name="nombre"]').val(data.nombre);
                $('input[name="apellido"]').val(data.apellido);
                $('input[name="id_estudiante"]').val(idEstudiante);
                $('input:radio[name="habilitado"][value="' + data.estado + '"]').prop('checked', true);

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

    $("#consultar_estudiante")
            .button()
            .click(function() {
                $("#dialog").dialog("open");
            });

    $("#guardar")
            .button()
            .click(function() {

                alertify.set({delay: 1500});
                if ($("#matricula").val().length < 1) {
                    alertify.error("La matricula esta vacia");
                    return false;
                }

                if ($("#nombre").val().length < 1) {
                    alertify.error("El nombre esta vacio");
                    return false;
                }

                var parametros = {
                    "nombre": $('#nombre').val(),
                    "apellido": $('#apellido').val(),
                    "matricula": $('#matricula').val(),
                    "habilitado": $('input:radio[name=habilitado]:checked').val(),
                    "guardar": $('#guardar').val(),
                    "accion": $('#accion').val(),
                    "id_estudiante": $('#id_estudiante').val()
                };

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_estudiante1.php",
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
                $('#form_estudiante')[0].reset();
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_estudiante')[0].reset();
                $('#id_estudiante').val("0");
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');
            });


    $("#borrar")
            .button()
            .click(function() {

                if ($('#id_estudiante').val() === "0") {
                    return false;
                }

                var parametros = {
                    "borrar": true,
                    "accion": $('#accion').val(),
                    "id_estudiante": $('#id_estudiante').val()
                };
                
                alertify.set({delay: 1500});
                $.ajax({
                    type: "POST",
                    url: "controler/controlador_estudiante1.php",
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
                $('#id_estudiante').val("0");
                $('#form_estudiante')[0].reset();

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
            url: "controler/controlador_estudiante1.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_estudiante > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_estudiante + " onClick='seleccionar(" + data[key].id_estudiante + ")'>";
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