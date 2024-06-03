<?php

include("setup.php");

$filename = "lista_de_usuarios.xls";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$filename);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exportar a exel</title>
</head>
<body>
    <!-- pegar la tabla de usuarios de menu_adm -->
    <table class="table">
                        <thead>
                            <tr class="alineartexto">
                                <th>#</th>
                                <th>rut</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Tipo Usuario</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $con=1;
                            $sql=   "SELECT `tipo_usuario`.`tipo`,`usuarios`.* FROM `usuarios` INNER JOIN `tipo_usuario` ON `tipo_usuario`.`id_tipo` = `usuarios`.`id_tipo`";
                            $result=mysqli_query(conectar(),$sql);
                            $cont=mysqli_num_rows($result);
                            
                            while($datos=mysqli_fetch_array($result))
                            {
                        ?>
                            <tr class="alineartexto">
                                <td style="padding-top:20px"><?php echo $con; $con++;?></td>
                                <td style="padding-top:20px"><?php echo $datos['rut'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['nombre'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['email'];?></td>
                                
                                <td  style="padding-top:17px"><?php 
                                    if($datos['estado']==1)
                                    {
                                        ?>
                                        <p>ACTIVO</p>
                                        <?php 
                                    }else{
                                    ?>
                                        <p>INACTIVO</p>
                                    <?php } 
                                    
                                    ?>
                                </td>
                                
                                <td  style="padding-top:20px"><?php echo $datos['tipo'];?></td>
                                
                            </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
</body>
</html>