<?php require_once("./component/header.php"); ?>

<div id="content" class="left_content">
    CREAR CLASIFICACION DE ARTICULO
    <form action="controlador_clasificacion.php" method="post">
        <table>
            <tr> 
                <td> DESCRIPCION </td> 
                <td><input class="form-input" type="text" name="descripcion"> </td>
            </tr>
            <tr> 

                <td> <input class="form-btn" type="reset" name="limpiar" value="limpiar"> </td> 
                <td><input class="form-btn" type="submit" name="guardar" value="guardar"> 
            </tr>

        </table>
    </form>          



</div>


<?php require_once("./component/footer.php"); ?>