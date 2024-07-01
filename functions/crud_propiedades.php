
<?php

include("setup.php");
if(isset($_GET['eliminar'])) {
    
    // Sanitize and validate the input
    $id = $_GET['id'];  // Ensure the ID is an integer to prevent SQL injection

    // Establish a connection to the database
    $conn = conectar();
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Prepare the SQL statements
    $sql_eliminar_fotos = "DELETE FROM `fotografias` WHERE `idpropiedad` = $id";
    $sql_eliminar = "DELETE FROM `propiedades` WHERE `idpropiedad` = $id";

    // Debugging: Echo the SQL statements (remove in production)
    echo $sql_eliminar_fotos . "<br>";
    echo $sql_eliminar . "<br>";
    
    // Execute the SQL statements
    if (mysqli_query($conn, $sql_eliminar_fotos) && mysqli_query($conn, $sql_eliminar)) {
        // Redirect to Propiedades.php
        header("Location: ../Propiedades.php");
        exit;
    } else {
        echo "ERROR: Could not execute $sql_eliminar_fotos or $sql_eliminar. " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}




switch($_POST['accion_btn']){
    
    case "Enviar": 
        Enviar();
        break;
    
    case "Modificar": 
        Modificar();
        break;
    
    case "Cancelar": 
        Cancelar();
        break;
}



function Enviar(){
    
    // Tu consulta de inserción
    $sql_enviar_propiedad = "INSERT INTO `propiedades` (`nombre`, `Descripcion`, `Direccion`, `Precio`, `cant_banos`, `cant_dorm`, `areaTotal_terreno`, `areaConstruida`, `fechaPublicacion`, `estado`, `idsector`, `id_usuario`, `tipo_propiedad`) 
    VALUES ('".$_POST['Nombre']."','".$_POST['Descripcion']."','".$_POST['Direccion']."','".$_POST['Precio']."', '".$_POST['Banos']."', '".$_POST['Dormitorios']."','".$_POST['areaTotal']."','".$_POST['areaconstruida']."', CURDATE(), 1, '".$_POST['Sector']."', '".$_POST['idUsuario']."', '".$_POST['tipo_prop']."');";

    // Ejecutar la consulta
    $conn = conectar();

    echo $sql_enviar_propiedad."<br><br><br>";
    echo $_FILES['File']['name']."<br>";
    echo $_FILES['File']['type']."<br>";
    echo $_FILES['File']['size']."<br>";
    echo $_FILES['File']['tmp_name']."<br>";

    //Ejecutar la consulta
    $resultado = mysqli_query($conn, $sql_enviar_propiedad);

    // Verificar si la inserción fue exitosa
    if ($resultado) {
        // Obtener el id generado para la propiedad insertada
        $id_propiedad = mysqli_insert_id($conn);

        // Procesar la imagen
        $original_file_name = $_FILES['File']['name'];
        $directory = '../img/fotosProp/';
        $filename = $directory . $original_file_name;

        // Extraer la extensión y el nombre del archivo sin extensión
        $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
        $file_name_without_extension = pathinfo($original_file_name, PATHINFO_FILENAME);

        // Comprobar si el archivo ya existe y encontrar un nombre único
        $counter = 1;
        $new_file_name = $original_file_name;
        $new_filename = $filename;

        while (file_exists($new_filename)) {
            // Crear un nuevo nombre de archivo con el contador
            $new_file_name = $file_name_without_extension . "($counter)." . $file_extension;
            $new_filename = $directory . $new_file_name;
            $counter++;
        }

        // Insertar la imagen en la base de datos
        $sql_fotografia = "INSERT INTO fotografias (Foto, principal, estado, idpropiedad) VALUES ('$new_file_name', 1, 1, $id_propiedad)";
        
        if (move_uploaded_file($_FILES['File']['tmp_name'], $new_filename)) {
            // File uploaded successfully
            echo "File uploaded successfully as $new_file_name<br>";

            // Ejecutar la consulta para insertar la imagen
            $result = mysqli_query($conn, $sql_fotografia);

            if ($result) {
                echo "La imagen se ha insertado correctamente.";
            } else {
                echo "Error al insertar la imagen: " . mysqli_error($conn);
            }
        } else {
            // File upload failed
            echo "File upload failed<br>";
        }
    } else {
        // Manejo de error si la inserción falla
        echo "Error al insertar la propiedad: " . mysqli_error($conn);
    }

    // Cerrar la conexión
    $conn->close();
    header("Location:../Propiedades.php");
    exit;
}

function Modificar(){
   
    $sql_modificar = "UPDATE `propiedades` SET 
                `nombre` = '".$_POST['Nombre']."',
                `Descripcion` = '".$_POST['Descripcion']."',
                `Direccion` = '".$_POST['Direccion']."',
                `Precio` = '".$_POST['Precio']."',
                `cant_banos` = '".$_POST['Banos']."',
                `cant_dorm` = '".$_POST['Dormitorios']."',
                `areaTotal_terreno` = '".$_POST['areaTotal']."',
                `areaConstruida` = '".$_POST['areaconstruida']."',
                `fechaPublicacion` = CURDATE(),
                `estado` = 1,
                `idsector` = '".$_POST['sectores']."',
                `id_usuario` = '".$_POST['idUsuario']."',
                `tipo_propiedad` = '".$_POST['tipo_prop']."'
                WHERE `idpropiedad` = ".$_POST['idpropiedad'];
    
    
    echo $sql_modificar."<br><br><br>";
    mysqli_query(conectar(),$sql_modificar);
    
    header("Location:../menu_adm.php");
    exit;
}

function Cancelar(){
    header("Location:../propiedades.php");
    exit;
}

// if ($_GET['estado']==1)
// {    
//     $sql="UPDATE `usuarios` SET `estado`=0 WHERE `id_usuario`=".$_GET['id'];
//     mysqli_query(conectar(),$sql);

//     header("Location:../menu_adm.php");
// }
// else
// {
//     $sql="UPDATE `usuarios` SET `estado`=1 WHERE `id_usuario`=".$_GET['id'];
//     mysqli_query(conectar(),$sql);

//     header("Location:../menu_adm.php");
// }
?>