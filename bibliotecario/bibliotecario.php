<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECÁNICO (BIBLIOTECARIO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="bibliotecario_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="number" class="form-control" id="cedula" name="cedula" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>

        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="contratoid" class="form-label">ID Contrato</label>
            <select name="contratoid" id="contratoid" class="form-select">

                <!-- Option por defecto -->
                <option selected></option>

                <?php
                // Importar el código del otro archivo
                require("../contrato/contrato_select.php");
                
                // Verificar si llegan datos
                if($resultadoContrato and $resultadoContrato->num_rows > 0):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoContrato as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["codigo"]; ?>"><?= $fila["codigo"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("bibliotecario_select.php");

// Verificar si llegan datos
if($resultadoBibliotecario and $resultadoBibliotecario->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Apellido</th>
                <th scope="col" class="text-center">ID Contrato</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoBibliotecario as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["cedula"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["apellido"]; ?></td>
                <td class="text-center"><?= $fila["contratoid"]; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="bibliotecario_delete.php" method="post">
                        <input hidden type="text" name="cedulaEliminar" value="<?= $fila["cedula"]; ?>">
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