<?php require_once("./component/header.php"); ?>

<script src="resources/js_jadesoft/autor.js"></script>	

<div id="content" class="left_content">
    <table>
        <tr><th>CREAR AUTOR</th></tr>

    </table>


    <form id="form_autor" name="form_autor" >
        <input type="hidden" name="id_autor" value="0" id="id_autor" />
        <input type="hidden" name="accion" value="guardar" id="accion" />
        <table>

            <tr> 
                <td> NOMBRE </td> 
                <td><input class="form-input" type="text" name="nombre" id="nombre"> 
                    <img id="consultar_autor" src="resources/imagenes/zoom_30.png" alt="Consulta Autor"/></td>
                <td rowspan="4"> <!--input class="form-btn" type="reset" name="limpiar" value="limpiar" id="resetiar"--> 
                    <img id="nuevo" src="resources/imagenes/document_orientation_portrait_60.png" alt="Nuevo Autor" /><br/>
                    <img id="guardar" src="resources/imagenes/diskette_60.png" alt="Crear Autor" /><br/>
                    <img id="borrar" src="resources/imagenes/trash_can_60.png" alt="Eliminar Autor" /><br/>
                </td>

            </tr>

        </table>
    </form>          


    <div id="dialog" title="Lista de Autores">
        <div id="autor-contain" class="ui-widget">
            <input type="text" id="busqueda" />
            <div id="resultado">
                <table id='tabla_autor' class='ui-widget ui-widget-content'>
                    <thead>
                        <tr class='ui-widget-header '>                            
                            <th width="190">Nombre</th>                            
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
