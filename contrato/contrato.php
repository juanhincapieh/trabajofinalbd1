<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a CONTRATO (CONTRATOTEMPORAL)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="contrato_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" id="codigo" name="codigo" required>
        </div>

        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" required>
        </div>

        <div class="mb-3">
            <label for="fechacontratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fechacontratacion" name="fechacontratacion" required>
        </div>

        <div class="mb-3">
            <label for="fechaterminacion" class="form-label">Fecha de Terminación</label>
            <input type="date" class="form-control" id="fechaterminacion" name="fechaterminacion" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("../contrato/contrato_select.php");

// Verificar si llegan datos
if($resultadoContrato and $resultadoContrato->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Salario</th>
                <th scope="col" class="text-center">Fecha de Contratación</th>
                <th scope="col" class="text-center">Fecha de Terminación</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoContrato as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codigo"]; ?></td>
                <td class="text-center">$<?= $fila["salario"]; ?></td>
                <td class="text-center"><?= $fila["fechacontratacion"]; ?></td>
                <td class="text-center"><?= $fila["fechaterminacion"]; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="contrato_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codigo"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>