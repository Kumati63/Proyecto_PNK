<?php

include("setup.php");

$rut = $_POST["rut"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$nombre = $_POST["nombre"];
$contrasena = md5($_POST["contrasena"]);
$antecedentes = $_POST["antecedentes"];
$nacimiento = $_POST["nacimiento"];
$sexo = $_POST["sexo"];
$estado = 0;
$tipo_usuario = 3;

//CREAMOS LA CONSULTA PARA INGRESAR DATOS A LA DB
$sql = "INSERT INTO usuarios (rut, email, telefono, nombre, contrasena, antecedentes, nacimiento, sexo, estado, id_tipo)
VALUES ('$rut', '$email', '$telefono', '$nombre', '$contrasena', '$antecedentes', '$nacimiento', '$sexo', '$estado','$tipo_usuario')";

//VERIFICAR QUE NO SE REPITAN LOS RUT
$verificar_rut = "SELECT * FROM usuarios WHERE rut='$rut'";
$result=mysqli_query(conectar(),$verificar_rut);
$cont_rut = mysqli_num_rows($result);

if ($cont_rut != 0) {
    echo '<script type="text/javascript">';
    echo 'if (confirm("El RUT ingresado ya está en uso.")) {';
    echo '    window.location.href = "../signup_ges.html";';
    echo '} else {';
    echo '    window.location.href = "../signup_ges.html";';  // Recargar la página actual
    echo '}';
    echo '</script>';
    die;
}
//TERMINO DE VERIFICACION DE RUT

//VERIFICAR QUE NO SE REPITAN LOS CORREOS ELECTRONICOS
$verificar_correo = "SELECT * FROM usuarios WHERE email='$email'";
$result=mysqli_query(conectar(),$verificar_correo);
$cont = mysqli_num_rows($result);

if ($cont != 0) {
    echo '<script type="text/javascript">';
    echo 'if (confirm("El correo ingresado ya está en uso.")) {';
    echo '    window.location.href = "../signup_ges.html";';
    echo '} else {';
    echo '    window.location.href = "../signup_ges.html";';  // Recargar la página actual
    echo '}';
    echo '</script>';
    die;
}
//TERMINO DE VERIFICACION DE CORREOS

mysqli_query(conectar(),$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup_process.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <h2>Su Cuenta se ha creado correctamente, de 3 a 5 días se vera activada</h2>
        <button><a href="..\index.html">Volver al inicio</a></button>
    </div>
</body>
</html>