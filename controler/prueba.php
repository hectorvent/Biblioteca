<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once dirname(__FILE__) . "/Connection.php";

$conexion = Connection::getInstance();
$library = $conexion->getLibrary();

$query = "select id_prestamo_detalle, l.titulo, a.autor_nombre "
        . "from prestamo p, prestamo_detalle pd, autor a, libro l "
        . "where p.id_prestamo = pd.id_prestamo AND pd.id_libro = l.id_libro AND "
        . "l.id_autor = a.id_autor";

//$books = $conexion->query($query);
//
//foreach ($books as $book) {
//    echo "<tr>";
//    echo "<td>" . $book["titulo"] . "</td>";
//    echo "<td>=" . $book["autor_nombre"] . " -</td>";
//    echo "</tr>";
//    
////   print_r($book->autor[1]);
//}


$books = $library->libro();

foreach ($books as $book) {
    echo "<tr>";
    echo "<td>" . $book["titulo"] . "</td>";
    echo "<td>=" . $book->autor["autor_nombre"] . " -</td>";
    echo "</tr>";
    
//   print_r($book->autor[1]);
}