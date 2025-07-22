<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar la CP de la entidad
$codigoEliminar = $_POST["codigoEliminar"];
$nombreEliminar = $_POST["nombreEliminar"];

// Query SQL a la BD
$query = "DELETE FROM seccion WHERE codBiblioteca = '$codigoEliminar' AND nombre = '$nombreEliminar'";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if($result): 
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
    header ("Location: seccion.php");
else:
    echo "Ha ocurrido un error al eliminar este registro";
endif;
 
mysqli_close($conn);