<?php

include("setup.php");

$rut = $_POST["rut"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$nombre = $_POST["nombre"];
$contrasena = md5($_POST["contrasena"]);
$propiedad = $_POST["propiedad"];
$nacimiento = $_POST["nacimiento"];
$sexo = $_POST["sexo"];
$estado = 0;
$tipo_usuario = 2;

// CREAMOS LA CONSULTA PARA INGRESAR DATOS A LA DB
$sql = "INSERT INTO usuarios (rut, email, telefono, nombre, contrasena, propiedades, nacimiento, sexo, estado, id_tipo)
VALUES ('$rut', '$email', '$telefono', '$nombre', '$contrasena', '$propiedad', '$nacimiento', '$sexo', '$estado','$tipo_usuario')";

//EJECUCION DE LA QUERY PARA INGRESAR EL USUARIO NUEVO
mysqli_query(conectar(),$sql);

header("Location:..\login.html");