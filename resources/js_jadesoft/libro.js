$(function() {
    // Clasificacion
    var parametros = {"findAllClas": true};

    $.ajax({
        type: "POST",
        url: "controler/controlador_clasificacion.php",
        data: parametros,
        dataType: "json",
        error: function() {
            alert("error peticion ajax");
        },
        success: function(data) {
            $("#clasificacion ").html("");

            $.each(data, function(key) {
                $("#clasificacion").append('<option value="' + data[key].descripcion + '">' + data[key].descripcion + '</option>')
            });
        }
    });
//Consulta Libro
    $("#consultar_libro")
            .button()
            .click(function() {
                $("#dialog_libro").dialog("open");
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

    //Consulta Autor
    $("#consultar_autor")
            .button()
            .click(function() {
                $("#dialog_autor").dialog("open");
            });

    $("#dialog_autor").dialog({
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

    //Consulta Genero
    $("#consultar_genero")
            .button()
            .click(function() {
                $("#dialog_genero").dialog("open");
            });

    $("#dialog_genero").dialog({
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
    //Consulta Editora
    $("#consultar_editora")
            .button()
            .click(function() {
                $("#dialog_editora").dialog("open");
            });

    $("#dialog_editora").dialog({
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


    $("#guardar")
            .button()
            .click(function() {

                alertify.set({delay: 1500});
                if ($("#isbn").val().length < 1) {
                    alertify.error("El ISBN esta vacia");
                    return false;
                }
                if ($("#titulo").val().length < 1) {
                    alertify.error("El Titulo esta vacia");
                    return false;
                }
                if ($("#sub_titulo").val().length < 1) {
                    alertify.error("El Sub-Titulo esta vacia");
                    return false;
                }
                if ($("#resumen").val().length < 1) {
                    alertify.error("El resumen esta vacia");
                    return false;
                }
                if ($("#autor").val().length < 1) {
                    alertify.error("El autor esta vacia");
                    return false;
                }
                if ($("#genero").val().length < 1) {
                    alertify.error("El genero esta vacia");
                    return false;
                }
                if ($("#editora").val().length < 1) {
                    alertify.error("La editora esta vacia");
                    return false;
                }

                var parametros = {
                    "isbn": $('#isbn').val(),
                    "titulo": $('#titulo').val(),
                    "sub_titulo": $('#sub_titulo').val(),
                    "resumen": $('#resumen').val(),
                    "clasificacion": $('#id_editora').val(),
//                    "imagen": $('#imagen').val(),
                    "autor": $('#id_autor').val(),
                    "genero": $('#id_genero').val(),
                    "editora": $('#id_editora').val(),
                    "cantidad": $('#cantidad').val(),
                    "cantidad_disponible": $('#cantidad_disponible').val(),
                    "permitir_salir": $('#permitir_salir').val(),
                    "id_libro": $('#id_libro').val(),
                    "guardar": $('#guardar').val(),
                    "accion": $('#accion').val()
                };


                $.ajax({
                    type: "POST",
                    url: "controler/controlador_libro.php",
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

                $('#accion').val("guardar");
                $('#form_libro')[0].reset();
                $('#borrar').attr('disabled', 'disabled').addClass('ui-state-disabled');

                return false;
            });

    $("#nuevo")
            .button()
            .click(function() {
                $('#form_libro')[0].reset();
                $('#form_libro').val("0");
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
    ///

    $("#busqueda_editora").focus();
    $("#busqueda_editora").keyup(function(e) {

        consulta = $("#busqueda_editora").val();
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
                    html += "<tr id=" + data[key].id_editora + " onClick='seleccionarEditora(" + data[key].id_editora + ")'>";
                    html += " <td>" + data[key].descripcion + "</td>";
                    html += " <td>" + data[key].direccion + "</td>";
                    html += " </tr>";
                });

                $('#tabla_editora > tbody').append(html);
            }
        });
    });

    ///
    $("#busqueda_autor").focus();
    $("#busqueda_autor").keyup(function(e) {

        consulta = $("#busqueda_autor").val();
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
                    html += "<tr id=" + data[key].id_autor + " onClick='seleccionarAutor(" + data[key].id_autor + ")'>";
                    html += " <td>" + data[key].nombre + "</td>";
                    html += " </tr>";
                });

                $('#tabla_autor > tbody').append(html);
            }
        });
    });

    ///
    $("#busqueda_genero").focus();
    $("#busqueda_genero").keyup(function(e) {

        consulta = $("#busqueda_genero").val();
        var parametros = {"datos": consulta, "buscar": true};

        $.ajax({
            type: "POST",
            url: "controler/controlador_genero.php",
            data: parametros,
            dataType: "json",
            error: function() {
                alert("error peticion ajax");
            },
            success: function(data) {

                $("#tabla_genero > tbody").empty();

                var html = "";

                $.each(data, function(key) {
                    html += "<tr id=" + data[key].id_genero + " onClick='seleccionarGenero(" + data[key].id_genero + ")'>";
                    html += " <td> " + data[key].descripcion + "</td>";
//                    html += " <td>" + data[key].nombre + "</td>";
//                    html += "  <td>" + data[key].apellido + "</td>";
                    html += " </tr>";
                });

                $('#tabla_genero > tbody').append(html);
            }
        });
    });

});

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
            $('input[name="isbn"]').val(data.isbn);
            $('input[name="titulo"]').val(data.titulo);
            $('input[name="sub_titulo"]').val(data.sub_titulo);
            $('input[name="resumen"]').val(data.resumen);
            $('input[name="autor"]').val(data.autor);
            //  $('input[name="imagen"]').val(idLibro);
            $('select[name="clasificacion"]').val(data.clasificacion);
            $('input[name="genero"]').val(data.genero);
            $('input[name="editora"]').val(data.editora);
            $('input[name="cantidad"]').val(data.cantidad);
            $('input[name="cantidad_disponible"]').val(data.cantidad_disponible);
            $("#permitir_salir").attr('checked', data.permite_salida == 1 ? true : false);

            $("#dialog_libro").dialog("close");
        }
    });
}

function seleccionarEditora(idEditora) {

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

            $('input[name="editora"]').val(data.descripcion);
            $('input[name="id_editora"]').val(idEditora);

            $('#borrar').removeAttr("disabled").removeClass('ui-state-disabled');
            $("#dialog_editora").dialog("close");
        }
    });
}

function seleccionarAutor(idAutor) {

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

            $('input[name="autor"]').val(data.nombre);
            $('input[name="id_autor"]').val(idAutor);

            $("#dialog_autor").dialog("close");
        }
    });
}

function seleccionarGenero(idGenero) {

    var parametros = {
        "id_genero": idGenero,
        "buscarId": true};

    $.ajax({
        type: "POST",
        url: "controler/controlador_genero.php",
        data: parametros,
        dataType: "json",
        error: function() {
            alert("error peticion ajax");
        },
        success: function(data) {

            $('input[name="genero"]').val(data.descripcion);
            $('input[name="id_genero"]').val(idGenero);

            $("#dialog_genero").dialog("close");
        }
    });
}