<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="resources/css/estilo.css" type="text/css" />
        <link rel="stylesheet" href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" >
        <!--<link rel="stylesheet" href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" >-->
        <link rel="stylesheet" href="resources/css/alert/alertify.core.css" />
        <link rel="stylesheet" href="resources/css/alert/alertify.default.css" />
        <script src="resources/js/jquery-1.9.1.js" ></script>
        <script src="resources/js/jquery-ui-1.10.3.custom.js"></script>
        <script src="resources/js/alertify.min.js"></script>


        <title>JadeSoft ** Biblioteca</title>

        <script>
            $(function() {
                $("#menu").menu();
            });
        </script>
    </head>

    <body>

        <div class="wrapper">
            <div id="header">
                <img src="resources/imagenes/biblioteca.jpg" width="960" height="150" alt="Imagen"/>
            </div>
            <div id="top"> 
                SISTEMA DE BIBLIOTECA
            </div>
            <div>
                <div id="left">
                    <ul id="menu">
                        <li class="ui-state-disabled"><a href="#">INICIO</a></li>
                        <li><a href="registrar_prestamo.php">Prestamo de Libros</a></li>
                        <li><a href="registrar_reseccion.php">Recepcion Prestamo</a></li>
                        <li><a href="ajuste_libros.php">Ajuste de Libros Existentes</a></li>
                        <li>
                            <a href="#">Administracion</a>
                            <ul>
                                <!--li class="ui-state-disabled"><a href="#">Ada</a></li-->
                                <li><a href="crear_estudiante.php">Estudiante</a></li>
                                <li><a href="crear_autor.php">Autor</a></li>
                                <li><a href="crear_genero.php">Genero</a></li>
                                <li><a href="crear_clasificacion.php">Categoria</a></li>
                                <li><a href="crear_editora.php">Editora</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Reportes</a>
                            <ul>
                                <li><a href="#">Estudiante</a></li>
                                <li><a href="#">Autor</a></li>
                                <li><a href="#">Genero</a></li>
                                <li><a href="#">Categoria</a></li>
                                <li><a href="#">Editora</a></li>
                                <li><a href="#">Libros Prestados</a></li>
                                <li><a href="#">Pretamos Vencidos</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
