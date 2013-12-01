function seleccionar(idEditora) {

    var parametros = {
        "id_editora": idEditora,
        "buscarId": true};

    $.ajax({
        type: "POST",
        url: "controler/controlador_editora.php",
        data: parametros,
        dataType: "json",
        error: function() {
            alert("error peticion ajax");
        },
        success: function(data) {

            $('input[name="accion"]').val("actualizar");
            $('input[name="descripcion"]').val(data.descripcion);
            $('input[name="direccion"]').val(data.direccion);
            $('input[name="id_editora"]').val(id_editora);

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

    $("#consultar_editora")
            .button()
            .click(function() {
                $("#dialog").dialog("open");
            });

    $("#guardar")
            .button()
            .click(function() {

                if ($("#descripcion").val().length < 1) {
                    alertify.error("La descripcion esta vacio");
                    return false;
                }

                if ($("#direccion").val().length < 1) {
                    alertify.error("La direccion esta vacio");
                    return false;
                }

                var parametros = {
                    "editora_descripcion": $('#descripcion').val(),
                    "editora_direccion": $('#direccion').val(),
                    "guardar": $('#guardar').val(),
                    "accion": $('#accion').val(),
                    "id_editora": $('#id_editora').val()
                };

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_editora.php",
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
                $('#form_editora')[0].reset();
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_editora')[0].reset();
                $('#id_editora').val("0");
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');
            });


    $("#borrar")
            .button()
            .click(function() {

                if ($('#id_editora').val() === "0") {
                    return false;
                }

                var parametros = {
                    "borrar": true,
                    "accion": $('#accion').val(),
                    "id_editora": $('#id_editora').val()
                };

                alertify.set({delay: 1500});
                $.ajax({
                    type: "POST",
                    url: "controler/controlador_editora.php",
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
                $('#id_editora').val("0");
                $('#form_editora')[0].reset();

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
            url: "controler/controlador_editora.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_editora > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_editora + " onClick='seleccionar(" + data[key].id_editora + ")'>";
                    html += " <td>" + data[key].descripcion + "</td>";
                    html += " <td>" + data[key].direccion + "</td>";
                    html += " </tr>";
                });

                $('#tabla_editora > tbody').append(html);
            }
        });
    });
});