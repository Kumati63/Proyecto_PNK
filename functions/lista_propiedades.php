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
?>


<div id="contenedor-usuarios">
    <div class="card">
        <div class="card-body">
            <div class="panel-body table-responsive">
                <table class="table">
                    <thead>
                        <tr class="alineartexto">
                            <th>#</th>
                            <th>Foto Principal</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Tipo</th>
                            <th>precio</th>
                            <th>Sector</th>
                            <th>Usuario</th>
                            <th>accion</th>
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
                                <td><img src="img/fotosProp/<?php echo $datos['Foto'];?>" width="50px"></td>
                                <td style="padding-top:20px"><?php echo $datos['nombre'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['Direccion'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['tipo'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['Precio'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['sector'];?></td>
                                <td style="padding-top:20px"><?php echo $datos['email'];?></td>
                                <td>
                                <a href="Propiedades.php?id=<?php echo $datos['idpropiedad'];?>" style="text-decoration: none;">
                                <button type="button" onclick="" class="btn btn-default" id="btn-close" title="Editar">
                                    <img src="img\menu-icons/edit_icon.jpg" alt="" width="30px">
                                </button>
                            </a>
                            <br><br>
                            <a onclick="javacript:return confirm('Desea eliminar la propiedad con Dirección: <?php echo $datos['Direccion'];?>, y Tipo: <?php echo $datos['tipo'];?>?')" href="functions/crud_propiedades.php?id=<?php echo $datos['idpropiedad'];?>&eliminar" style="text-decoration: none;">
                                <button type="button" name="btn_eliminar" onclick="" class="btn btn-default" id="btn-close" title="Eliminar">
                                    <img src="img\menu-icons/trash.png" alt="" width="30px">
                                </button>
                            </a>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col col-sm-8 col-xs-6">Cantidad de Propiedades: <b><?php echo $con;?></b></div>
                    <div class="col col-sm-4 col-xs-6">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
