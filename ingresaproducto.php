<?php
include 'conexionProducto.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre_producto = $_POST['nombre_producto'];
    $existencia = $_POST['existencia'];
    $id_medida = $_POST['id_medida'];
    $id_vendedor = $_POST['id_vendedor'];
    $valor_venta = $_POST['valor_venta'];
    $fecha_ulti_venta = $_POST['fecha_ulti_venta'];

    $sql = "INSERT INTO tbl_producto (nombre_producto, existencia, id_medida, id_vendedor, valor_venta, fecha_ulti_venta) 
    VALUES ('$nombre_producto','$existencia','$id_medida','$id_vendedor','$valor_venta','$fecha_ulti_venta')";

if ($conexion->query($sql) === TRUE) {
    echo '<script>
        window.onload = function() {
            Swal.fire({
                title: "¡Buen trabajo!",
                text: "!Producto insertado exitosamente!",
                icon: "success"

            });
        };
        </script>';
          } else {
          echo '<script>
        window.onload = function() {
            Swal.fire({
                title: "¡Error!",
                text: "No se pudo eliminar el producto.",
                icon: "error"
            });
        };
        </script>';
    
    }
}

$conexion->close();

?> 
<!--Frontend-->
<?php
include 'conexionProducto.php';
$sql = "SELECT id_medida, nombre FROM tbl_medida";
$resultado = $conexion->query($sql);

$sql = "SELECT id_vendedor, nombre FROM tbl_vendedor";
$carrera = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css"rel="stylesheet">
    <link rel="stylesheet" href="productos.css">
    <title>Insertar Producto</title>
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
</div> 
    <div class="container mt-5">
        <h1 class="text-center">Insertar Producto</h1>
        <form method="post" action="ingresaproducto.php">
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre Producto:</label>
                <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" required>
            </div>
            <div class="mb-3">
                <label for="existencia" class="form-label">Existencia:</label>
                <input type="number" class="form-control" name="existencia" id="existencia" required>
            </div>
            <div class="mb-3">
                <label for="valor_venta" class="form-label">Valor de Venta:</label>
                <input type="number" class="form-control" name="valor_venta" id="valor_venta" required>
            </div>
            <div class="mb-3">
                <label for="fecha_ulti_venta" class="form-label">Fecha de su Última Venta:</label>
                <input type="date" class="form-control" name="fecha_ulti_venta" id="fecha_ulti_venta" required>
            </div>

            <div class="mb-3">
                <label for="id_medida" class="form-label">Medida:</label>
                <select name="id_medida" id="id_medida" class="form-select" required>
                    <option value="">Seleccione su medida</option>
                    <?php
                    if($resultado->num_rows > 0){
                        while($fila = $resultado->fetch_assoc()){
                            echo '<option value="'.$fila['id_medida'].'">'.$fila['nombre'].'</option>';
                        }
                    }else{
                        echo '<option value="">No hay medidas disponibles</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_vendedor" class="form-label">Vendedor:</label>
                <select name="id_vendedor" id="id_vendedor" class="form-select" required>
                    <option value="">Seleccione el vendedor</option>
                    <?php
                    if ($carrera->num_rows > 0) {
                        while($fila = $carrera->fetch_assoc()){
                            echo '<option value="'.$fila['id_vendedor'].'">'.$fila['nombre'].'</option>';
                        }
                    }else{
                        echo '<option value="">No hay vendedores disponibles</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>
</body>
</html>
