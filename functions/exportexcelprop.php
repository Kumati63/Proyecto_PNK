<?php

include("setup.php");

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
                        $sql="SELECT `fotografias`.`Foto`, `tipo_propiedad`.`tipo`, `usuarios`.`email`, `sector`.`sector`, `propiedades`.* 
        FROM `fotografias` INNER JOIN `propiedades` ON `propiedades`.`idpropiedad` = `fotografias`.`idpropiedad` INNER JOIN `tipo_propiedad` ON `propiedades`.`tipo_propiedad` = `tipo_propiedad`.`idtipo_propiedad` INNER JOIN `usuarios` ON `propiedades`.`id_usuario` = `usuarios`.`id_usuario` INNER JOIN `sector` ON `propiedades`.`idsector` = `sector`.`idsector`;";
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