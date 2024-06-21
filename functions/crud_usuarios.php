<?php
include("setup.php");

if(isset($_GET['eliminar']))
{   if ($_GET['id']!=$_GET['id_usu']){
        $sql_eliminar = "DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` =".$_GET['id'];
        mysqli_query(conectar(),$sql_eliminar);
        header("Location:../menu_adm.php");
        exit;
    }else{
        $message = "No puedes eliminar el usuario que está en uso.";
        echo "<script type='text/javascript'>
            if (confirm('$message')) {
                window.location.href = '../menu_adm.php';
            } else {
                window.location.href = '../menu_adm.php';
            }
        </script>";
        exit;
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



    
}

function Enviar(){
    echo $_FILES['File']['name']."<br>";
    echo $_FILES['File']['type']."<br>";
    echo $_FILES['File']['size']."<br>";
    echo $_FILES['File']['tmp_name']."<br>";

    if ($_FILES['File']['name'] == ""){
         
        $sql_enviar = "INSERT INTO `usuarios` (`rut`, `email`, `telefono`, `nombre`, `contrasena`, `nacimiento`, `sexo`, `estado`, `id_tipo`) 
            VALUES ('".$_POST['rut']."', '".$_POST['rut']."', '".$_POST['email']."', ".$_POST['Telefono'].", '".$_POST['Nombre']."', '".md5($_POST['contrasena'])."',
            '".$_POST['nacimiento']."', '".$_POST['sexo']."', ".$_POST['estado'].", ".$_POST['tipo_usuario'].")";
    }else{
        $sql_enviar = "INSERT INTO `usuarios` ('imgPerfil', `rut`, `email`, `telefono`, `nombre`, `contrasena`, `nacimiento`, `sexo`, `estado`, `id_tipo`) 
    VALUES ('".$_FILES['File']['name']."','".$_POST['rut']."', '".$_POST['rut']."', '".$_POST['email']."', ".$_POST['Telefono'].", '".$_POST['Nombre']."', '".md5($_POST['contrasena'])."',
            '".$_POST['nacimiento']."', '".$_POST['sexo']."', ".$_POST['estado'].", ".$_POST['tipo_usuario'].")";
            move_uploaded_file($_FILES['File']['tmp_name'], "../img/fotos/".$_FILES['File']['name']);
    }

    
    
    mysqli_query(conectar(),$sql_enviar);
    
    header("Location:../menu_adm.php");
    exit;
}

function Modificar(){
    echo $_FILES['File']['name']."<br>";
    echo $_FILES['File']['type']."<br>";
    echo $_FILES['File']['size']."<br>";
    echo $_FILES['File']['tmp_name']."<br><br>"; 
    $original_file_name = $_FILES['File']['name'];
    $directory = '../img/fotos/';
    $filename = $directory . $original_file_name;
    
    // Extract file extension
    $file_extension = pathinfo($original_file_name, PATHINFO_EXTENSION);
    // Extract file name without extension
    $file_name_without_extension = pathinfo($original_file_name, PATHINFO_FILENAME);
    
    // Check if file exists and find a unique name
    $counter = 1;
    $new_file_name = $original_file_name;
    $new_filename = $filename;
    
    if ($_FILES['File']['name'] == ""){
        $sql_modificar = "UPDATE `usuarios` SET `rut` = '".$_POST['rut']."', `email` = '".$_POST['email']."', `telefono` = ".$_POST['Telefono'].",
         `nombre` = '".$_POST['Nombre']."', `nacimiento` = '".$_POST['nacimiento']."', `sexo` = '".$_POST['sexo']."', `estado` = ".$_POST['estado'].", `id_tipo` = ".$_POST['tipo_usuario']." 
         WHERE `usuarios`.`id_usuario` = ".$_POST['get_id'];  
        
    }else{
        if (file_exists($filename)) {
            while (file_exists($new_filename)) {
                // Create a new file name with the counter
                $new_file_name = $file_name_without_extension . "($counter)." . $file_extension;
                $new_filename = $directory . $new_file_name;
                $counter++;
            }
            $new_filename = $filename;
            $sql_modificar = "UPDATE `usuarios` SET `imgPerfil` = '".$new_file_name."', `rut` = '".$_POST['rut']."', `email` = '".$_POST['email']."', `telefono` = ".$_POST['Telefono'].",
                `nombre` = '".$_POST['Nombre']."', `nacimiento` = '".$_POST['nacimiento']."', `sexo` = '".$_POST['sexo']."', `estado` = ".$_POST['estado'].", `id_tipo` = ".$_POST['tipo_usuario']." 
                WHERE `usuarios`.`id_usuario` = ".$_POST['get_id'];
                
                if (move_uploaded_file($_FILES['File']['tmp_name'], $directory . $new_file_name)) {
                    // File uploaded successfully
                    echo "File uploaded successfully as $new_file_name"."<br>";
                } else {
                    // File upload failed
                    echo "File upload failed"."<br>";
                }
        
        } else {
            $sql_modificar = "UPDATE `usuarios` SET `imgPerfil` = '".$original_file_name."', `rut` = '".$_POST['rut']."', `email` = '".$_POST['email']."', `telefono` = ".$_POST['Telefono'].",
                `nombre` = '".$_POST['Nombre']."', `nacimiento` = '".$_POST['nacimiento']."', `sexo` = '".$_POST['sexo']."', `estado` = ".$_POST['estado'].", `id_tipo` = ".$_POST['tipo_usuario']." 
                WHERE `usuarios`.`id_usuario` = ".$_POST['get_id']; 
                if (move_uploaded_file($_FILES['File']['tmp_name'], $directory .$original_file_name)) {
                    // File uploaded successfully
                    echo "File uploaded successfully as $original_file_name"."<br>";
                } else {
                    // File upload failed
                    echo "File upload failed"."<br>";
                }
        }
    }
    

    echo "The file $original_file_name exists. Renamed to $new_file_name"."<br>";
    echo $sql_modificar;
    mysqli_query(conectar(),$sql_modificar);
    
    header("Location:../menu_adm.php");
    exit;
}

function Cancelar(){
    header("Location:../menu_adm.php");
    exit;
}

if ($_GET['estado']==1)
{    
    $sql="UPDATE `usuarios` SET `estado`=0 WHERE `id_usuario`=".$_GET['id'];
    mysqli_query(conectar(),$sql);

    header("Location:../menu_adm.php");
}
else
{
    $sql="UPDATE `usuarios` SET `estado`=1 WHERE `id_usuario`=".$_GET['id'];
    mysqli_query(conectar(),$sql);

    header("Location:../menu_adm.php");
}
?>