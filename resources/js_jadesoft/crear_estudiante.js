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

                if ($("#matricula").val().length < 1) {
                    alertify.set({delay: 1500});
                    alertify.error("La matricula esta vacia");
                    return false;
                }

                if ($("#nombre").val().length < 1) {
                    alertify.set({delay: 1500});
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
                    url: "controler/controlador_estudiante.php",
                    data: parametros,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    error: function() {
                        alertify.set({delay: 1500});
                        alertify.error("Error al enviar la peticion");
                    },
                    success: function(data) {
                        //  alert(data);
                        alertify.set({delay: 1500});
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

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_estudiante.php",
                    data: parametros,
                    dataType: "json",
                    beforeSend: function() {
                    },
                    error: function() {
                        alertify.set({delay: 1500});
                        alertify.error("Error al enviar la peticion");
                    },
                    success: function(data) {
                        alertify.set({delay: 1500});
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
            url: "controler/controlador_estudiante.php",
            data: parametros,
            dataType: "html",
            beforeSend: function() {
                $("#resultado").html("ho hay data");
            },
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {
                $("#resultado").empty();
                $("#resultado").append(data);
            }
        });
    });
});