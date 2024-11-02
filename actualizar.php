
<?php
include 'conexionProducto.php';

if (isset($_POST['actualizar'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $existencia = $_POST['existencia'];
    $fecha_ulti_venta = $_POST['fecha_ulti_venta'];
    echo $fecha_ulti_venta;
    $sql = "UPDATE tbl_producto SET nombre_producto = '$nombre_producto', existencia = '$existencia', fecha_ulti_venta = '$fecha_ulti_venta' WHERE id_producto = '$id_producto'";

    if ($conexion->query($sql) === TRUE) {
        echo '<script>
        window.onload = function() {
            console.log("Actualización exitosa, mostrando sweetalert");
            swal("¡Producto!", "Producto actualizado exitosamente", "success");
        };
        </script>';
    } else {
        echo '<script>
        window.onload = function() {
            console.error("Error al actualizar: ' . $conexion->error . '");
            swal("¡Producto!", "Producto no actualizado", "error");
        };
        </script>';
    }
}

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];

    $stmt = $conexion->prepare("SELECT * FROM tbl_producto WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="productos.css">
    <title>Actualizar Producto</title>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="navegacion">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/andrey2/productos.php">Lista de productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/andrey2/ingresaproducto.php">Insertar producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/andrey2/deleteproducto.php">Borrar producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/andrey2/actualizar.php?id_producto=2">Actualizar producto</a>
        </li>
    </ul>
</div> 

<div class="container mt-5">
    <h1>Actualizar Producto</h1>
    <form method="post" action="actualizar.php">
        <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($fila['id_producto']); ?>">
        <div class="mb-3">
            <label for="nombre_producto" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required value="<?php echo htmlspecialchars($fila['nombre_producto']); ?>">
        </div>
        <div class="mb-3">
            <label for="existencia" class="form-label">Existencia:</label>
            <input type="number" class="form-control" id="existencia" name="existencia" required value="<?php echo htmlspecialchars($fila['existencia']); ?>">
        </div>
        

<?php
$fecha_ulti_venta = DateTime::createFromFormat('d-m-Y', $fila['fecha_ulti_venta']);
if ($fecha_ulti_venta) {
    $fecha_ulti_venta_formateada = $fecha_ulti_venta->format('Y-m-d');
} else {

    $fecha_ulti_venta_formateada = '';
}
?>

        <div class="mb-3">
        <label for="fecha_ulti_venta" class="form-label">Fecha Última Venta:</label>
        <input type="date" class="form-control" id="fecha_ulti_venta" name="fecha_ulti_venta" required value="<?php echo htmlspecialchars($fecha_ulti_venta_formateada); ?>">
        </div>
>
        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar Producto</button>
    </form>
    </div>

</body>
</html>
<?php
    } else {
        echo "No se encontró ningún producto.";
    }
}

$conexion->close();
?>
