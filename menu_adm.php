<?php

include("functions/setup.php");

session_start();

if(isset($_SESSION['usu']))
{
    switch($_SESSION['tipo']){
        case 1: $tipo=1;
            $_SESSION['id_usuario'];
            break;
        case 2: $tipo=2;
            $_SESSION['id_usuario'];
            break;
        case 3: $tipo=3;
            $_SESSION['id_usuario'];
            break;
    }

    // recoger datos del usuario
    if (isset($_GET['id'])){
        $sql_usuario="SELECT `usuarios`.* FROM `usuarios` WHERE id_usuario=".$_GET['id'];
        $result_usuario=mysqli_query(conectar(),$sql_usuario);
        $datos_usuario=mysqli_fetch_array($result_usuario);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ges_usuarios.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery-3.7.1.min.js""></script>
    <script src="js/validar_adm.js""></script>
    <title>Adm.Usuarios</title>
    <style>
        #buscador{
            width: 300px;
            height: 40px;
            border-radius: 10px;
            border: none;
        }

        #buscador:focus{
            box-shadow: none;
            outline: none;
        }
        #buscador::placeholder{
            font-size: 15px;
            font-weight: 500;
            padding-top: 10px;
        }
    </style>
    <script>
        $(function() {
            
        });

        // $(function() {
        //     $("#adm-users").hide();
        //     $('#new-user').on( "click", function() {
        //         $("#adm-users").show();
        //     } );
        //     $('#btn-edit-user').on( "click", function() {
        //         $("#adm-users").show();
        //     } );
        // });

        

    </script>
</head>
<body>

    <?php
        if($_SESSION['tipo']==1){// Si es ADMINISTRADOR mostrara la lista de usuarios
    ?>
    <!-- header -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a href="menu.php">
                <button type="button" class="btn-volver">Volver</button>
            </a>
            <div id="title">
            <p>Menu Administración de usuarios</p>
            </div>
        </div>
        
        <!-- Default dropstart button -->
        <div class="btn-group dropstart espacio">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Dropstart
            </button>
            <ul class="dropdown-menu">
                <!-- Dropdown menu links -->
                <li><a class="dropdown-item" href="perfil.php">Editar Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="functions/cerrar.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
    
    <br>

    <!-- body -->
    <!-- CREACION Y MODIFICACION DE USUARIOS -->
    <div id="adm-users">
        <div id="contenedor-usuarios">
            <div class="card">
                <div class="card-header alineartexto">Administración de Usuarios</div>
                <div class="card-body">
                    <form action="functions/crud_usuarios.php" method="post" name="form" class="form-container">
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-rut">Rut</label><br>
                                    <input class="form-control" id="rut "name="rut" type="text" placeholder="Rut"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['rut'];} ?>">
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-tipo_Usuario">Tipo Usuario</label><br>
                                    <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                                        <option class="form-control" value="9">Seleccionar</option>
                                        <?php
                                            $sql="SELECT * FROM tipo_usuario WHERE estado=1";
                                            $result=mysqli_query(conectar(),$sql);
                                            while($datos=mysqli_fetch_array($result)){
                                            ?>
                                                <option 
                                                class="form-control" value="
                                                <?php echo $datos['id_tipo'];?>"<?php if (isset($_GET['id'])){if($datos_usuario['id_tipo']==$datos['id_tipo']){?>selected<?php }}?>>
                                                <?php echo $datos['tipo'];?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-nombre">Nombre</label><br>
                                    <input class="form-control" name="Nombre" type="text" placeholder="Nombre Completo"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['nombre'];} ?>">
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-email">Email</label><br>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['email'];} ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-estado">Estado</label><br>
                                    <select name="estado" id="estado" class="form-control">
                                        <option class="form-control" value="9">Seleccionar</option>
                                        <option class="form-control" value="1" <?php if (isset($_GET['id'])){if($datos_usuario['estado']==1){?>selected<?php }}?>>Activo</option>
                                        <option class="form-control" value="0" <?php if (isset($_GET['id'])){if($datos_usuario['estado']==0){?>selected<?php }}?>>Inactivo</option>
                                    </select>
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-telefono">Telefono</label><br>
                                    <input class="form-control" type="text" id="telefono" name="Telefono" placeholder="Telefono"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['telefono'];} ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-sexo">Sexo</label><br>
                                    <select name="sexo" id="sexo" class="form-control">
                                        <option class="form-control" value="Seleccionar">Seleccionar</option>
                                        <option class="form-control" value="Hombre" <?php if (isset($_GET['id'])){if($datos_usuario['sexo']=='Hombre'){?>selected<?php }}?>>Hombre</option>
                                        <option class="form-control" value="Mujer" <?php if (isset($_GET['id'])){if($datos_usuario['sexo']=='Mujer'){?>selected<?php }}?>>Mujer</option>
                                    </select>
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-nacimiento">Fecha Nacimiento</label><br>
                                    <input class="form-control nacimiento" type="date" id="nacimiento" name="nacimiento"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['nacimiento'];} ?>">
                                </div>
                            </div>
                            <?php if (!isset($_GET['id']))
                            {
                            ?>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <label class="input-icon" for="lbl-contrasena">contrasena</label><br>
                                        <input class="form-control" type="password" id="contrasena" name="contrasena" placeholder="contrasena">
                                    </div>
                                    <div class="col col-sm-6">
                                        <label class="input-icon" for="lbl-Repetir_contrasena">Repetir contrasena</label><br>
                                        <input class="form-control" type="password" id="Repetir_contrasena" name="Repetir_contrasena" placeholder="Repetir contrasena">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <hr>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <?php if (!isset($_GET['id']))
                                    {
                                    ?>
                                        <button type="button" name="btn_enviar" value="Enviar" onclick="validar(this.value);" class="btn btn-sm btn-primary BOTONES form-control" style="padding: 8px 10px 10px 7px;">ENVIAR</button>
                                    <?php
                                    } else{
                                    ?>
                                        <button type="button" name="btn_modificar" value="Modificar" onclick="validar(this.value);" class="btn btn-sm btn-primary BOTONES form-control" style="padding: 8px 10px 10px 7px;">MODIFICAR</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col col-sm-6">
                                    <button type="button" name="btn_cancelar" value="Cancelar" onclick="validar(this.value);" class="btn btn-sm btn-danger BOTONES form-control" style="padding: 8px 10px 10px 7px;">CANCELAR</button>
                                    <input type="hidden"  name="accion_btn" id="accion_btn" value="">
                                    <input type="hidden"  name="get_id" id="get_id" value="<?php if (isset($_GET['id'])){ echo $_GET['id'];}?>">
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <!-- LISTA DE USUARIOS -->
    <div id="contenedor-usuarios">
        <div class="card">
            <div class="bg-secondary bg-gradient">
                <div class="row" style="margin: auto; padding: 12px;">
                    <div class="col col-sm-5 col-xs-12" style="display: flex; align-items: start; padding: 15px;">
                            <h4 style="font-size: 25px; padding-right: 10px; color:#fff;">Lista De <span>Usuarios</span></h4>
                            <button id="new-user" class="btn btn-sm btn-primary BOTONES" >Nuevo Usuario</button>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                        <div class="btn_group" style="padding: 10px">
                            <input id="buscador" type="text" placeholder="Buscar">
                            <button id="btn-close" class="btn btn-default" title="Actualizar"><img src="img\menu-icons/reload.png" alt="" width="30px" onclick="#"></button>
                            <button id="btn-close" class="btn btn-default" title="Pdf"><img src="img/menu-icons/pdf.png" alt="" width="30px"></button>
                            <a href="functions\exportexcel.php">
                                <button id="btn-close" class="btn btn-default" title="Excel"><img src="img\menu-icons/exel.png" alt="" width="30px"></button>
                            </a>
                        </div>
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
                                <th>Estado</th>
                                <th>Tipo Usuario</th>
                                <th>Action</th>
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
                                
                                <td  style="padding-top:20px"><?php echo $datos['tipo'];?></td>
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
    <?php
        }else{
            header("Location:error.html");
        }
    ?>
</body>
</html>

<?php
}else{
    header("Location:error.html");
}
?>