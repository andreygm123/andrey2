<?php
//<!--CONEXION BASE DE DATOS -->
$servername = "localhost";
$username = "root";
$bdname = "bd_productos";
$password = "";

// create connection
$conexion = new mysqli($servername, $username, $password, $bdname);

//verificar la conexion
if($conexion -> connect_error){
    die("Error en la conexion" . $conexion->connect_error);
}