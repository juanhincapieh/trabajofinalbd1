<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACIÓN (SECCIÓN)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="seccion_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="codBiblioteca" class="form-label">Código de biblioteca</label>
            <input type="number" class="form-control" id="codBiblioteca" name="codBiblioteca" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="piso" class="form-label">Piso</label>
            <input type="number" class="form-control" id="piso" name="piso" required>
        </div>

        <div class="mb-3">
            <label for="pasillo" class="form-label">Pasillo</label>
            <input type="text" class="form-control" id="pasillo" name="pasillo" required>
        </div>

        <div class="mb-3">
            <label for="fechacreacion" class="form-label">Fecha de creación</label>
            <input type="date" class="form-control" id="fechacreacion" name="fechacreacion" required>
        </div>
        
        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="adminid" class="form-label">ID Administrador</label>
            <select name="adminid" id="adminid" class="form-select" required>

                <!-- Option por defecto -->
                <option selected></option>

                <?php
                // Importar el código del otro archivo
                require("../bibliotecario/bibliotecario_select.php");

                // Verificar si llegan datos
                if($resultadoBibliotecario and $resultadoBibliotecario->num_rows > 0):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoBibliotecario as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["cedula"]; ?>"><?= $fila["cedula"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <!-- Consultar la lista de empresas y desplegarlos -->
        <div class="mb-3">
            <label for="auxiliarid" class="form-label">ID Auxiliar</label>
            <select name="auxiliarid" id="auxiliarid" class="form-select">

                <!-- Option por defecto -->
                <option selected></option>

                <?php
                // Importar el código del otro archivo
                require("../bibliotecario/bibliotecario_select.php");

                // Verificar si llegan datos
                if($resultadoBibliotecario):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoBibliotecario as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["cedula"]; ?>"><?= $fila["cedula"]; ?></option>

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
require("seccion_select.php");
            
// Verificar si llegan datos
if($resultadoSeccion and $resultadoSeccion->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código de biblioteca</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Piso</th>
                <th scope="col" class="text-center">Pasillo</th>
                <th scope="col" class="text-center">Fecha de creación</th>
                <th scope="col" class="text-center">ID Administrador</th>
                <th scope="col" class="text-center">ID Auxiliar</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoSeccion as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["codBiblioteca"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["piso"]; ?></td>
                <td class="text-center"><?= $fila["pasillo"]; ?></td>
                <td class="text-center"><?= $fila["fechacreacion"]; ?></td>
                <td class="text-center"><?= $fila["adminid"]; ?></td>
                <td class="text-center"><?= $fila["auxiliarid"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="seccion_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["codBiblioteca"]; ?>">
                        <input hidden type="text" name="nombreEliminar" value="<?= $fila["nombre"]; ?>">
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