<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$contratoid = $_POST["contratoid"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
if ($contratoid === "") {
	$query = "INSERT INTO `bibliotecario`(`cedula`,`nombre`, `apellido`) VALUES ('$cedula', '$nombre', '$apellido')";
}

else {
	$query = "INSERT INTO `bibliotecario`(`cedula`,`nombre`, `apellido`, `contratoid`) VALUES ('$cedula', '$nombre', '$apellido', '$contratoid')";

}

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: bibliotecario.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);