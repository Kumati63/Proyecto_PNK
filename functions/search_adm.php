<?php
    include("setup.php");
?>
    <div class="card">
    <div class="bg-secondary bg-gradient">
        <div class="row" style="margin: auto; padding: 12px;">
            <div class="col col-sm-5 col-xs-12" style="display: flex; align-items: start; padding: 15px;">
                    <h4 style="font-size: 25px; padding-right: 10px; color:#fff;">Lista De <span>Usuarios</span></h4>
            </div>
        </div>
    </div>

    <div class="card-body">
    <div class="panel-body table-responsive">
            <table class="table">
                <thead>
                    <tr class="alineartexto">
                        <th>#</th>
                        <th>rut</th>
                        <th>Nombre</th>
                        <th>Correo</th>
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
                        <td  style="padding-top:20px"><?php echo $datos['tipo'];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col col-sm-8 col-xs-6">Cantidad de Usuarios: <b><?php echo $cont; ?></b></div>
                <div class="col col-sm-4 col-xs-6">
                    
                </div>
            </div>
        </div>
    </div>
    </div>

?>