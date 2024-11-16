
<?php
include 'conexionProducto.php';

$sql = "SELECT 
    tbl_producto.id_producto,
    tbl_producto.nombre_producto,
    tbl_producto.existencia,
    tbl_medida.nombre AS nombre_medida,
    tbl_vendedor.nombre AS nombre_vendedor,
    tbl_producto.valor_venta,
    tbl_producto.fecha_ulti_venta
FROM tbl_producto
JOIN tbl_medida ON tbl_producto.id_medida = tbl_medida.id_medida
JOIN tbl_vendedor ON tbl_producto.id_vendedor = tbl_vendedor.id_vendedor";
$resultado = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="productos.css">
    <title>Lista de los productos</title>
</head>
<body>
<div class="navegacion">
<ul class="nav nav-pills">
        <li class="nav nav-pills">
            <a class="nav-link active" href="http://localhost/andrey2/productos.php">Lista de productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/andrey2/ingresaproducto.php">Insertar producto</a>
        </li>

    </ul>
</div>
    <h1>Lista de los productos</h1>

    <?php
    if ($resultado->num_rows > 0) {
        echo '<table class="table table-striped table-bordered">
                <thead class="table-info">
                    <tr>
                        <th>ID producto</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Medida</th>
                        <th>Vendedor</th>
                        <th>Valor venta</th>
                        <th>Fecha Ultima venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
        while ($fila = $resultado->fetch_assoc()) {
            echo '<tr>
                    <td>' . $fila['id_producto'] . '</td>
                    <td>' . $fila['nombre_producto'] . '</td>
                    <td>' . $fila['existencia'] . '</td>
                    <td>' . $fila['nombre_medida'] . '</td>
                    <td>' . $fila['nombre_vendedor'] . '</td>
                    <td>' . $fila['valor_venta'] . '</td>
                    <td>' . $fila['fecha_ulti_venta'] . '</td>
                    <td> 
                        <a href="deleteproducto.php?id_producto=' . $fila['id_producto'] . '" class="btn btn-danger btn-sm btn-custom" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este producto?\');" > 
                        <img src="img/delete.png" alt="Eliminar">
                        </a>

                    <a href="actualizar.php?id_producto=' . $fila['id_producto'] . '" class="btn btn-primary btn-sm btn-custom">
                        <img src="img/edit.png" alt="Editar">
                    </a>
                </td>
              </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No se encontraron productos.</p>';
    }

    $conexion->close();
    ?>
</body>
</html>

</body>
</html>

