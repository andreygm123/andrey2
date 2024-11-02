<?php
include 'conexionProducto.php';


if(isset($_GET['id_producto'])){
    $id_producto = intval($_GET['id_producto']);
    $sql = "DELETE FROM tbl_producto WHERE id_producto = $id_producto";
    
    if ($conexion->query($sql) === TRUE) {
        echo '<script>
        window.onload = function() {
            swal("¡Producto!", "Producto eliminado", "success");
        };
        </script>';
        header('Location: productos.php');
        exit();
    } else {
        echo '<script>
        window.onload = function() {
            swal("¡Producto!", "Producto no eliminado", "error");
        };
        </script>';
    }
    }

 $conexion->close();

?>

<!-- SweetAlert2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>
