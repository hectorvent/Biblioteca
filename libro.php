<?php require_once("./component/header.php"); ?>
<script src="resources/js_jadesoft/libro.js"></script>	

<style>
    .left_content {
        height: 380px;
    }
</style>

<div id="content" class="left_content">
    <table>
        <tr><th>CREAR LIBROS</th></tr>

    </table>


    <form id="form_libro" name="form_libro" >
        <input type="hidden" name="id_libro" value="0" id="id_libro" />
        <input type="hidden" name="accion" value="guardar" id="accion" />
        <table>

            <tr> 
                <td> ISBN
                </td> 
                <td><input class="form-input" type="text" name="isbn" id="isbn">  
                    <img id="consultar_libro" src="resources/imagenes/zoom_20.png" alt="Buscar Libro" />
                </td>

                <td rowspan="13"> <!--input class="form-btn" type="reset" name="limpiar" value="limpiar" id="resetiar"--> 
                    <img id="nuevo" src="resources/imagenes/document_orientation_portrait_60.png" alt="Nuevo Libro" /><br/>
                    <img id="guardar" src="resources/imagenes/diskette_60.png" alt="Crear Libro" /><br/>
                    <img id="borrar" src="resources/imagenes/trash_can_60.png" alt="Eliminar Libro" /><br/>
                </td>

            </tr>

            <tr>
                <td> Titulo
                </td> 
                <td><input type="text" name="titulo" id="titulo">                  
                </td>
            </tr>
            <tr>
                <td> Sub Titulo
                </td> 
                <td><input type="text" name="sub_titulo" id="sub_titulo">                  
                </td>
            </tr>    
            <tr>
                <td> Imagen
                </td> 
                <td><input id="imagen" name="imagen" type="file" multiple>
                </td>
            </tr> 
            <tr>
                <td> Resumen
                </td> 
                <td><input type="text" name="resumen" id="resumen">                  
                </td>
            </tr>
            <tr>
                <td> Clasificacion
                </td> 
                <td>   
                    <select name="clasificacion" id="clasificacion">
                        <!--  <?php echo $combobit; ?> 
                        -->
                    </select>
                </td>
            </tr>
            <tr>   
            <input type="hidden" name="id_autor" value="0" id="id_autor" />
            <td> Autor
            </td> 
            <td><input  class="form-input" type="text" name="autor" id="autor" readonly="readonly">
                <img id="consultar_autor" src="resources/imagenes/zoom_20.png" alt="Buscar Autor" />
            </td>
            </tr>
            <tr>     
            <input type="hidden" name="id_genero" value="0" id="id_genero" />
            <td> Genero
            </td> 
            <td><input  class="form-input" type="text" name="genero" id="genero" readonly="readonly">
                <img id="consultar_genero" src="resources/imagenes/zoom_20.png" alt="Buscar Genero" />
            </td>
            </tr>
            <tr>     
            <input type="hidden" name="id_editora" value="0" id="id_editora" />
            <td> Editora
            </td> 
            <td><input  class="form-input" type="text" name="editora" id="editora" readonly="readonly">
                <img id="consultar_editora" src="resources/imagenes/zoom_20.png" alt="Buscar Editora" />
            </td>
            </tr>
            <tr>     
                <td> Cantidad
                </td> 
                <td><input  type="text" name="cantidad" id="cantidad">                   
                </td>
            </tr>
            <tr>     
                <td> Cantidad Disponible
                </td> 
                <td><input type="text" name="cantidad_disponible" id="cantidad_disponible">                 
                </td>
            </tr>
            <tr> 
                <td>Permitir Salir</td>
                <td><input type="checkbox" id="permitir_salir"> </td>
            </tr>


        </table>
    </form>          


    <div id="dialog_libro" title="Lista de Libros">
        <div id="libro-contain" class="ui-widget">
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
    <div id="dialog_autor" title="Lista de Autores">
        <div id="autor-contain" class="ui-widget">
            <input type="text" id="busqueda_autor" />
            <div id="resultado_autor">
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
    <div id="dialog_genero" title="Lista de Genero de Libros">
        <div id="genero-contain" class="ui-widget">
            <input type="text" id="busqueda_genero" />
            <div id="resultado_genero">
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
    <div id="dialog_editora" title="Lista de Editora">
        <div id="editora-contain" class="ui-widget">
            <input type="text" id="busqueda_editora" />
            <div id="resultado_editora">
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
