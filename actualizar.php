<?php
include 'conexionProducto.php';

// Inicializar variables para mensajes
$mensaje = '';
$tipo_mensaje = '';

// Inicializar variables del producto
$fila = null;
$fecha_ulti_venta_formateada = '';

if (isset($_POST['actualizar'])) {
    // Procesar la actualización
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $existencia = $_POST['existencia'];
    $fecha_ulti_venta = $_POST['fecha_ulti_venta'];

    // Usar sentencia preparada para mayor seguridad
    $sql = $conexion->prepare("UPDATE tbl_producto SET nombre_producto = ?, existencia = ?, fecha_ulti_venta = ? WHERE id_producto = ?");
    $sql->bind_param("sisi", $nombre_producto, $existencia, $fecha_ulti_venta, $id_producto);

    if ($sql->execute()) {
        $mensaje = '¡Producto actualizado exitosamente!';
        $tipo_mensaje = 'success';
    } else {
        $mensaje = 'No se pudo actualizar el producto.';
        $tipo_mensaje = 'error';
    }

    // Obtener los datos actualizados del producto
    $sql = $conexion->prepare("SELECT * FROM tbl_producto WHERE id_producto = ?");
    $sql->bind_param("i", $id_producto);
    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        $fecha_ulti_venta = DateTime::createFromFormat('Y-m-d', $fila['fecha_ulti_venta']);
        if ($fecha_ulti_venta) {
            $fecha_ulti_venta_formateada = $fecha_ulti_venta->format('Y-m-d');
        } else {
            $fecha_ulti_venta_formateada = '';
        }
    } else {
        echo "No se encontró ningún producto.";
        exit;
    }

} else if (isset($_GET['id_producto'])) {
    // Obtener los datos del producto para mostrar en el formulario
    $id_producto = $_GET['id_producto'];

    $sql = $conexion->prepare("SELECT * FROM tbl_producto WHERE id_producto = ?");
    $sql->bind_param("i", $id_producto);
    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();

        $fecha_ulti_venta = DateTime::createFromFormat('Y-m-d', $fila['fecha_ulti_venta']);
        if ($fecha_ulti_venta) {
            $fecha_ulti_venta_formateada = $fecha_ulti_venta->format('Y-m-d');
        } else {
            $fecha_ulti_venta_formateada = '';
        }
    } else {
        echo "No se encontró ningún producto.";
        exit;
    }
} else {
    echo "ID de producto no especificado.";
    exit;
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaces a CSS de Bootstrap y SweetAlert2 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="productos.css">
</head>
<body>
    <div class="navegacion">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="productos.php">Lista de productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="ingresaproducto.php">Insertar producto</a>
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
            <div class="mb-3">
                <label for="fecha_ulti_venta" class="form-label">Fecha Última Venta:</label>
                <input type="date" class="form-control" id="fecha_ulti_venta" name="fecha_ulti_venta" required value="<?php echo htmlspecialchars($fecha_ulti_venta_formateada); ?>">
            </div>
            <button type="submit" name="actualizar" value="1" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>

    <!-- Incluir SweetAlert2 JS después de cargar la librería -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Script para mostrar la alerta si hay un mensaje -->
    <script>
        <?php if (!empty($mensaje) && !empty($tipo_mensaje)) { ?>
            Swal.fire({
                title: "<?php echo ($tipo_mensaje == 'success') ? '¡Buen trabajo!' : '¡Error!'; ?>",
                text: "<?php echo $mensaje; ?>",
                icon: "<?php echo $tipo_mensaje; ?>"
            }).then(function() {
                window.location = "productos.php";
            });
        <?php } ?>
    </script>

    <!-- Enlaces a JS de Bootstrap (opcional si lo necesitas) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Si usas funciones de Bootstrap que requieren JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>