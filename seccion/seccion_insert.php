<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$codBiblioteca = $_POST["codBiblioteca"];
$adminid = $_POST["adminid"];
$auxiliarid = $_POST["auxiliarid"];
$nombre = $_POST["nombre"];
$piso = $_POST["piso"];
$pasillo = $_POST["pasillo"];
$fechacreacion = $_POST["fechacreacion"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
if ($auxiliarid === "") {
	$query = "INSERT INTO `seccion`(`codBiblioteca`,`adminid`, `nombre`, `piso`, `pasillo`, `fechacreacion`) VALUES ('$codBiblioteca', '$adminid', '$nombre', '$piso', '$pasillo', '$fechacreacion')";
} else {
	$query = "INSERT INTO `seccion`(`codBiblioteca`,`adminid`, `auxiliarid`, `nombre`, `piso`, `pasillo`, `fechacreacion`) VALUES ('$codBiblioteca', '$adminid', '$auxiliarid', '$nombre', '$piso', '$pasillo', '$fechacreacion')";
}

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: seccion.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);