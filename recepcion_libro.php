<?php require_once("./component/header.php"); ?>

<script src="resources/js_jadesoft/recepcion_libro.js"></script>	

<div id="content" class="left_content">
    <table>
        <tr><th>RECIBIR LIBROS, PRESTADOS A ESTUDIANTES</th></tr>

    </table>


    <form id="form_prestamo" name="form_prestamo" >
        <input type="hidden" name="id_estudiante" value="0" id="id_estudiante" />
        <input type="hidden" name="accion" value="guardar" id="accion" />
        <table>

            <tr> 
                <td> Estudiante </td> 
                <td><input class="form-input" type="text" name="nombre_estudiante" id="descripcion">
                    <img id="consultar_estudiante" src="resources/imagenes/zoom_20.png" alt="Buscar estudiante" /></td>
                <td></td>
                 <td></td>
                <td rowspan="2"> <!--input class="form-btn" type="reset" name="limpiar" value="limpiar" id="resetiar"--> 
                    <img id="nuevo" src="resources/imagenes/document_orientation_portrait_60.png" alt="Nueva Recepcion" /><br/>
                    <img id="guardar" src="resources/imagenes/diskette_60.png" alt="Guardar Recepcion" /><br/>
                </td>

            </tr>
           
<!--             <tr> 

                 <td> Fecha Entrega :</td>
                 <td> <input type="text" id="fecha_entrega" name="fecha_entrega">  </td>
                 <td></td>
                <td></td>
                
            </tr>-->
            <tr> 
                <td colspan="4">
                    <div id="resultado">
                                                
                        <table id='tabla_prestamo' class='ui-widget ui-widget-content tabla_consulta'>
                            <thead>
                                <tr class='ui-widget-header '>
                                    <th width="400"> Libro </th>
                                    <th width="400"> Autor </th>
                                    <th width="100"> Recibir </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </td> 
            </tr>

        </table>
    </form>          
    
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
