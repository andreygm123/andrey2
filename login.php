<?php
session_start();
include 'conexionProducto.php';

if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    $username = $_POST['username'];
    $contraseña = $_POST['contraseña'];
    /*prepare consulta*/
    $stmt = $conexion->prepare("SELECT id_usuario, contraseña FROM tbl_usuarios WHERE username = ?");

    /*asocio valores*/
    $stmt->bind_param("s" , $username);

    /*ejecuto consulta*/
    $stmt->execute();

    /*obtengo el resulado*/
    $stmt->store_result();


    if($stmt ->num_rows > 0){
        /*obtengo el id del usuaro*/
        $stmt->bind_result($id_usuario, $hashed_password);
        $stmt->fetch();

        /*verifico la contraseña*/
        if(password_verify($password, $hashed_password)){
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['username'] = $username;
            header("Location: productos.php");
            exit();
        }else {
            echo "Contaseña incorrecta.";
        }
    }else {
       echo "Usuario no encontrado"
       
           ;
    }

    $stmt->close();
    $conexion->close();
}



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input {
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form  action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="contraseña" placeholder="contraseña" required>
        <button type="submit">Ingresar</button>
    </form>

</body>
</html>
