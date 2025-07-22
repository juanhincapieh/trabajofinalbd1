<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Consulta 1</h1>

<p class="mt-3">
    <strong> El primer botón debe mostrar los datos de las tres reparaciones de mayor valor
    que no tienen mecánico ejecutor (en caso de empates, usted decide como
    proceder). Se debe mostrar para cada una de estas tres reparaciones los datos
    correspondientes del mecánico receptor. </strong>
</p>

<p class="mt-3y">
    El primer botón debe mostrar los datos de las tres secciones de mayor piso
    que no tienen bibliotecario auxiliar (en caso de empates, usted decide como
    proceder). Se debe mostrar para cada una de estas tres secciones los datos
    correspondientes del bibliotecario administrador.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT 
        s.codBiblioteca, 
        s.nombre AS nombreseccion, 
        s.piso, 
        s.pasillo, 
        s.fechacreacion, 
        b.cedula, 
        b.nombre AS nombrebibliotecario, 
        b.apellido, 
        b.contratoid 
        FROM seccion AS s INNER JOIN bibliotecario AS b 
        ON s.adminid = b.cedula
        WHERE s.auxiliarid IS NULL 
        AND (
            SELECT COUNT(*) 
            FROM seccion AS s2 
            WHERE s2.auxiliarid IS NULL
                AND s2.piso > s.piso
        ) <= 3
        ORDER BY s.piso DESC";
        
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código de Biblioteca</th>
                <th scope="col" class="text-center">Nombre de Sección</th>
                <th scope="col" class="text-center">Piso</th>
                <th scope="col" class="text-center">Pasillo</th>
                <th scope="col" class="text-center">Fecha de Creación</th>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Apellido</th>
                <th scope="col" class="text-center">ID Contrato</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codBiblioteca"]; ?></td>
                <td class="text-center"><?= $fila["nombreseccion"]; ?></td>
                <td class="text-center"><?= $fila["piso"]; ?></td>
                <td class="text-center"><?= $fila["pasillo"]; ?></td>
                <td class="text-center"><?= $fila["fechacreacion"]; ?></td>
                <td class="text-center"><?= $fila["cedula"]; ?></td>
                <td class="text-center"><?= $fila["nombrebibliotecario"]; ?></td>
                <td class="text-center"><?= $fila["apellido"]; ?></td>
                <td class="text-center"><?= $fila["contratoid"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
endif;

include "../includes/footer.php";
?>