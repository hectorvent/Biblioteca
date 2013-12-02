<?php require_once("./component/header.php"); ?>

<script src="resources/js_jadesoft/prestamo.js"></script>	

<div id="content" class="left_content">
    <table>
        <tr><th>CREAR GENERO DE LIBROS</th></tr>

    </table>


    <form id="form_prestamo" name="form_prestamo" >
        <input type="hidden" name="id_estudiante" value="0" id="id_prestamo" />
        <input type="hidden" name="accion" value="guardar" id="accion" />
        <table>

            <tr> 
                <td> Estudiante </td> 
                <td><input class="form-input" type="text" name="nombre_estudiante" id="descripcion">
                    <img id="consultar_estudiante" src="resources/imagenes/zoom_20.png" alt="Buscar estudiante" /></td>
                <td></td>
                 <td></td>
                <td rowspan="5"> <!--input class="form-btn" type="reset" name="limpiar" value="limpiar" id="resetiar"--> 
                    <img id="nuevo" src="resources/imagenes/document_orientation_portrait_60.png" alt="Nuevo Estudiante" /><br/>
                    <img id="guardar" src="resources/imagenes/diskette_60.png" alt="Crear Estudiante" /><br/>
                    <img id="borrar" src="resources/imagenes/trash_can_60.png" alt="Eliminar Estudiante" /><br/>
                </td>

            </tr>
            <tr> 
                <td> Fecha : </td>
                <td><input type="text" id="fecha" name="fecha"></td> 
                <td></td>
                <td></td>
                
                
            </tr>
             <tr> 

                 <td> Fecha Entrega :</td>
                 <td> <input type="text" id="fecha_entrega" name="fecha_entrega">  </td>
                 <td></td>
                <td></td>
                
            </tr>
            <tr> 
                <td>Salida del Biblioteca</td>
                <td><input type="checkbox" > </td>
                <td></td>
                <td></td>
            </tr>
            <tr> 
                <td colspan="4">
                    <div id="resultado">
                        <input type="hidden" id="id_libro" name="id_libro">
                        <input type="hidden" id="autor_libro" name="autor_libro">
                        
                        Buscar Libro <input type="text" id="titulo_libro" name="titulo_libro">
                         <img id="consultar_libro" src="resources/imagenes/zoom_20.png" alt="Buscar Liboro" />
                        <img id="agregar_libro" src="resources/imagenes/add_20.png" alt="Agregar Libro" />
                        
                        <table id='tabla_prestamo' class='ui-widget ui-widget-content tabla_consulta'>
                            <thead>
                                <tr class='ui-widget-header '>
                                    <th width="400"> Libro </th>
                                    <th width="400"> Autor </th>
                                    <th width="100"> Quitar </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </td> 
<!--                <td></td>
                <td></td>
                <td></td>-->
            </tr>

        </table>
    </form>          


    <div id="dialog_libro" title="Lista de Libros">
        <div id="prestamo-contain" class="ui-widget">
            <input type="text" id="busqueda_libro" />
            <div id="resultado_libro">
                <table id='tabla_libro' class='ui-widget ui-widget-content tabla_consulta'>
                    <thead>
                        <tr class='ui-widget-header '>
                            <th width="120">ISBN</th>
                            <th width="450">Titulo</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
    
    <div id="dialog_estudiante" title="Lista de Estudiantes">
        <div id="estudiante-contain" class="ui-widget">
            <input type="text" id="busqueda_estudiante" />
            <div id="resultado_estudiante">
                <table id='tabla_estudiante' class='ui-widget ui-widget-content'>
                    <thead>
                        <tr class='ui-widget-header '>
                            <th width="150">Matricula</th>
                            <th width="300">Nombre</th>
                            <th width="300">Apellido</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>

<?php

require_once("./component/footer.php");
