<?php
    include("setup.php");
    session_start();
if(isset($_SESSION['usu']))
    {
        switch($_SESSION['tipo']){
            case 1: $tipo=1;
                $tipo="ADMINISTRADOR";
                break;
            case 2: $tipo=2;
                $tipo="PROPIETARIO";
                break;
            case 3: $tipo=3;
                $tipo="VENDEDOR";
                break;
        }
    if ($tipo == "ADMINISTRADOR"){
        if(isset($_POST['buscador']))
            {
                $sql = "SELECT 
                    `fotografias`.`Foto`, 
                    `tipo_propiedad`.`tipo`, 
                    `usuarios`.`email`, 
                    `sector`.`sector`, 
                    `propiedades`.* 
                FROM 
                    `fotografias` 
                INNER JOIN 
                    `propiedades` ON `propiedades`.`idpropiedad` = `fotografias`.`idpropiedad` 
                INNER JOIN 
                    `tipo_propiedad` ON `propiedades`.`tipo_propiedad` = `tipo_propiedad`.`idtipo_propiedad` 
                INNER JOIN 
                    `usuarios` ON `propiedades`.`id_usuario` = `usuarios`.`id_usuario` 
                INNER JOIN 
                    `sector` ON `propiedades`.`idsector` = `sector`.`idsector` 
                WHERE 
                    `fotografias`.`principal` = 1 
                    AND (`propiedades`.`nombre` LIKE '%".$_POST['buscador']."%'
                    OR `propiedades`.`Direccion` LIKE '%".$_POST['buscador']."%'
                    OR `usuarios`.`email` LIKE '%".$_POST['buscador']."%')";

            } else {
                $sql="SELECT `fotografias`.`Foto`, `tipo_propiedad`.`tipo`, `usuarios`.`email`, `sector`.`sector`, `propiedades`.* 
                FROM `fotografias` INNER JOIN `propiedades` ON `propiedades`.`idpropiedad` = `fotografias`.`idpropiedad` INNER JOIN `tipo_propiedad` ON `propiedades`.`tipo_propiedad` = `tipo_propiedad`.`idtipo_propiedad` INNER JOIN `usuarios` ON `propiedades`.`id_usuario` = `usuarios`.`id_usuario` INNER JOIN `sector` ON `propiedades`.`idsector` = `sector`.`idsector`;";
            }
    }else{
        if(isset($_POST['buscador']))
            {
                $sql = "SELECT 
            `fotografias`.`Foto`, 
            `tipo_propiedad`.`tipo`, 
            `usuarios`.`email`, 
            `sector`.`sector`, 
            `propiedades`.* 
        FROM 
            `fotografias` 
        INNER JOIN 
            `propiedades` ON `propiedades`.`idpropiedad` = `fotografias`.`idpropiedad` 
        INNER JOIN 
            `tipo_propiedad` ON `propiedades`.`tipo_propiedad` = `tipo_propiedad`.`idtipo_propiedad` 
        INNER JOIN 
            `usuarios` ON `propiedades`.`id_usuario` = `usuarios`.`id_usuario` 
        INNER JOIN 
            `sector` ON `propiedades`.`idsector` = `sector`.`idsector` 
        WHERE 
            `fotografias`.`principal` = 1 
            AND (
                `propiedades`.`nombre` LIKE '%".$_POST['buscador']."%'
                OR `propiedades`.`Direccion` LIKE '%".$_POST['buscador']."%'
                Or `usuarios`.`email`  LIKE '%".$_POST['buscador']."%')
            AND `propiedades`.`id_usuario` = '".$_SESSION['id_usuario']."'";

            } else {
                $sql="SELECT `fotografias`.`Foto`, `tipo_propiedad`.`tipo`, `usuarios`.`email`, `sector`.`sector`, `propiedades`.* 
                FROM `fotografias` 
                INNER JOIN 
                    `propiedades` ON `propiedades`.`idpropiedad` = `fotografias`.`idpropiedad` 
                INNER JOIN 
                    `tipo_propiedad` ON `propiedades`.`tipo_propiedad` = `tipo_propiedad`.`idtipo_propiedad` 
                INNER JOIN 
                    `usuarios` ON `propiedades`.`id_usuario` = `usuarios`.`id_usuario` 
                INNER JOIN 
                    `sector` ON `propiedades`.`idsector` = `sector`.`idsector`
                where 
                    `propiedades`.`id_usuario` = '".$_SESSION['id_usuario']."'";
            }
    }}
$filename = "lista_de_Propiedades.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$filename);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table">
                    <thead>
                        <tr class="alineartexto">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Tipo</th>
                            <th>precio</th>
                            <th>Sector</th>
                            <th>Usuario</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query(conectar(), $sql);

                        $cont=mysqli_num_rows($result);
                            
                        $con = 0;
                        while($datos=mysqli_fetch_array($result)) {
                            ?>
                            <tr class="alineartexto">
                                <td style="padding-top:20px"><?php echo $con+1; $con++;?></td>
                                <td style="padding-top:20px"><?php echo $datos['nombre'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['Direccion'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['tipo'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['Precio'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['sector'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['email'];?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
</body>
</html>