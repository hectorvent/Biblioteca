    function seleccionar(idAutor) {

        var parametros = {
            "id_autor": idAutor, 
            "buscarId": true};

        $.ajax({
            type: "POST",
            url: "controler/controlador_autor.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {
                
                $('input[name="accion"]').val("actualizar");                
                $('input[name="nombre"]').val(data.nombre);
                $('input[name="id_autor"]').val(id_autor);               

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

    $("#consultar_autor")
            .button()
            .click(function() {
                $("#dialog").dialog("open");
            });

    $("#guardar")
            .button()
            .click(function() {
                
                if ($("#nombre").val().length < 1) {
                    alertify.error("El nombre esta vacio");
                    return false;
                }

                var parametros = {
                    "nombre": $('#nombre').val(),
                    "guardar": $('#guardar').val(),
                    "accion": $('#accion').val(),
                    "id_autor": $('#id_autor').val()
                };

                $.ajax({
                    type: "POST",
                    url: "controler/controlador_autor.php",
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
                $('#form_autor')[0].reset();
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_autor')[0].reset();
                $('#id_autor').val("0");
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');
            });


    $("#borrar")
            .button()
            .click(function() {

                if ($('#id_autor').val() === "0") {
                    return false;
                }

                var parametros = {
                    "borrar": true,
                    "accion": $('#accion').val(),
                    "id_autor": $('#id_autor').val()
                };
                
                alertify.set({delay: 1500});
                $.ajax({
                    type: "POST",
                    url: "controler/controlador_autor.php",
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
                $('#id_autor').val("0");
                $('#form_autor')[0].reset();

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
            url: "controler/controlador_autor.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_autor > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_autor + " onClick='seleccionar(" + data[key].id_autor + ")'>";                    
                    html += " <td>" + data[key].nombre + "</td>";     
                    html += " </tr>";
                });

                $('#tabla_autor > tbody').append(html);
            }
        });
    });
});