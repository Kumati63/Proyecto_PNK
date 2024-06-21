<?php
    include("setup.php");
    session_start();

    if($_POST['buscador']=="")
    {
        $sql="select * from usuarios";
    }else{
        $sql="select * from usuarios where nombre LIKE '%".$_POST['buscador']."%' or rut LIKE '%".$_POST['buscador']."%'";
    }

?>


    <div id="contenedor-usuarios">
            <div class="card">
                <div class="card-body">
                <div class="panel-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="alineartexto">
                                    <th>#</th>
                                    <th>Imagen Perfil</th>
                                    <th>rut</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Estado</th>
                                    <th>Tipo Usuario</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $con=1;
                                //$sql= "SELECT `tipo_usuario`.`tipo`,`usuarios`.* FROM `usuarios` INNER JOIN `tipo_usuario` ON `tipo_usuario`.`id_tipo` = `usuarios`.`id_tipo`";
                                $result=mysqli_query(conectar(),$sql);
                                $cont=mysqli_num_rows($result);
                                
                                while($datos=mysqli_fetch_array($result))
                                {
                            ?>
                                <tr class="alineartexto">
                                    <td style="padding-top:20px"><?php echo $con; $con++;?></td>
                                    <td><img src="img/fotos/<?php if($datos['imgPerfil']==''){ echo 'no_prof_pic.jpg'; }else{ echo $datos['imgPerfil'];}?>" width="50px"></td>

                                    <td style="padding-top:20px"><?php echo $datos['rut'];?></td>
                                    <td style="padding-top:20px"><?php echo $datos['nombre'];?></td>
                                    <td style="padding-top:20px"><?php echo $datos['email'];?></td>
                                    
                                    <td  style="padding-top:17px"><?php 
                                        if($datos['estado']==1)
                                        {
                                            ?>
                                            <a href="functions/crud_usuarios.php?id=<?php echo $datos['id_usuario'];?>&estado=1">
                                                <img src="img/menu-icons/ACTIVO.png" alt="" width="80px">
                                            </a>
                                            <?php 
                                        }else{
                                        ?>
                                            <a href="functions/crud_usuarios.php?id=<?php echo $datos['id_usuario'];?>&estado=0">
                                                <img src="img/menu-icons/INACTIVO.png" alt="" width="80px">
                                            </a>
                                        <?php } 
                                        
                                        ?>
                                    </td>
                                    
                                    <td  style="padding-top:20px"><?php
                                        if($datos['id_tipo']==1)
                                        {
                                            ?><p>ADMINISTRADOR</p><?php
                                        }
                                        if($datos['id_tipo']==2)
                                        {
                                            ?><p>PROPIETARIO</p><?php
                                        }
                                        if($datos['id_tipo']==3)
                                        {
                                            ?><p>VENDEDOR</p><?php
                                        }
                                        ?></td>
                                    <td>
                                        <a href="menu_adm.php?id=<?php echo $datos['id_usuario'];?>" style="text-decoration: none;">
                                            <button type="button" onclick="" class="btn btn-default" id="btn-close" title="Editar">
                                                <img src="img\menu-icons/edit_icon.jpg" alt="" width="30px">
                                            </button>
                                        </a>
                                        <a onclick="javacript:return confirm('Desea eliminar al usuario <?php echo $datos['nombre'];?>?')" href="functions/crud_usuarios.php?id=<?php echo $datos['id_usuario'];?>&eliminar&id_usu=<?php echo $_SESSION['id_usuario']; ?>" style="text-decoration: none;">
                                            <button type="button" name="btn_eliminar" onclick="" class="btn btn-default" id="btn-close" title="Eliminar">
                                                <img src="img\menu-icons/trash.png" alt="" width="30px">
                                            </button>
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
                            <div class="col col-sm-8 col-xs-6">Cantidad de Usuarios: <b><?php echo $cont; ?></b></div>
                            <div class="col col-sm-4 col-xs-6">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>