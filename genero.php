<?php require_once("./component/header.php"); ?>

<script src="resources/js_jadesoft/genero.js"></script>	

<div id="content" class="left_content">
    <table>
        <tr><th>CREAR GENERO DE LIBROS</th></tr>

    </table>


    <form id="form_genero" name="form_genero" >
        <input type="hidden" name="id_genero" value="0" id="id_genero" />
        <input type="hidden" name="accion" value="guardar" id="accion" />
        <table>

            <tr> 
                <td> Descripcion </td> 
                <td><input class="form-input" type="text" name="descripcion" id="descripcion"> 
                    <img id="consultar_genero" src="resources/imagenes/zoom_30.png" alt="Consulta Estudiante"/></td>
                <td rowspan="4"> <!--input class="form-btn" type="reset" name="limpiar" value="limpiar" id="resetiar"--> 
                    <img id="nuevo" src="resources/imagenes/document_orientation_portrait_60.png" alt="Nuevo Estudiante" /><br/>
                    <img id="guardar" src="resources/imagenes/diskette_60.png" alt="Crear Estudiante" /><br/>
                    <img id="borrar" src="resources/imagenes/trash_can_60.png" alt="Eliminar Estudiante" /><br/>
                </td>

            </tr>
            <tr> 
                <td></td> 
                <td> </td>

            </tr>
            <tr> 
                <td>  </td> <td>
                </td>

            </tr>
            <tr> 
                <td>  </td> 
                <td>
                </td>

            </tr>

        </table>
    </form>          


    <div id="dialog" title="Lista de Genero de Libros">
        <div id="genero-contain" class="ui-widget">
            <input type="text" id="busqueda" />
            <div id="resultado">
                <table id='tabla_genero' class='ui-widget ui-widget-content tabla_consulta'>
                    <thead>
                        <tr class='ui-widget-header '>
                            <th width="100">Descripcion</th>
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
