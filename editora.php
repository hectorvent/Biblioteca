<?php require_once("./component/header.php"); ?>

<script src="resources/js_jadesoft/editora.js"></script>	

<div id="content" class="left_content">
    <table>
        <tr><th>CREAR EDITORA</th></tr>

    </table>


    <form id="form_editora" name="form_editora" >
        <input type="hidden" name="id_editora" value="0" id="id_editora" />
        <input type="hidden" name="accion" value="guardar" id="accion" />
        <table>

            <tr> 
                <td> Descripcion </td> 
                <td><input class="form-input" type="text" name="descripcion" id="descripcion"> 
                    <img id="consultar_editora" src="resources/imagenes/zoom_30.png" alt="Consulta Editora"/></td>
                <td rowspan="2"> <!--input class="form-btn" type="reset" name="limpiar" value="limpiar" id="resetiar"--> 
                    <img id="nuevo" src="resources/imagenes/document_orientation_portrait_60.png" alt="Nuevo Genero" /><br/>
                    <img id="guardar" src="resources/imagenes/diskette_60.png" alt="Crear Editora" /><br/>
                    <img id="borrar" src="resources/imagenes/trash_can_60.png" alt="Eliminar Editora" /><br/>
                </td>
            </tr>
            <tr>               
                <td> Direccion </td> 
                <td><input class="form-input" type="text" name="direccion" id="direccion"> </tr>

        </table>
    </form>          


    <div id="dialog" title="Lista de Editora">
        <div id="editora-contain" class="ui-widget">
            <input type="text" id="busqueda" />
            <div id="resultado">
                <table id='tabla_editora' class='ui-widget ui-widget-content tabla_consulta'>
                    <thead>
                        <tr class='ui-widget-header '>                            
                            <th width="190">Descripcion</th>   
                            <th width="190">Direccion</th>   
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
