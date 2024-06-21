<?php

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/menu_style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Menu</title>
    <style>
        #profile-button{
            position: absolute;
            top:0;
            right:0;
            margin-top: 60px;
            margin-right: 30px;
        }
    </style>
    <script>
        $(function() {
            $(document).ready(function() {
                    $(document).on("contextmenu", function(e) {
                        e.preventDefault();
                    });
                });
        });
    </script>
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-12 col-xl-4">
            <div class="card" style="border-radius: 15px;">
            <div class="card-body text-center">
                <h1 id="title">Bienvenido al sistema</h1>
                <div id="profile-button">
                    <button type="button" id="btn-close" class="btn1">
                        <a id="cerrar-sesion" href="perfil.php">My profile</a>
                    </button>
                </div>
                <!-- DECLARACIÓN DE IMAGEN DEL MENU SEGÚN TIPO DE USUARIO-->
                <div class="mt-3 mb-4">
                    <?php
                        if($_SESSION['tipo']==1){ // Si es ADMINISTRADOR mostrara imagen de ADMINISTRADOR
                    ?>
                    <img src="img\menu-icons\admin.png"class="rounded-circle img-fluid" style="width: 140px;" />
                    <?php
                        }else{?>
                    <?php
                        }
                    ?>
                    <?php
                        if($_SESSION['tipo']==3){// Si es VENDEDOR mostrara imagen de VENDEDOR
                    ?>
                    <img src="img\menu-icons\vendedor.jpg" class="rounded-circle img-fluid" style="width: 140px;" />
                    <?php
                        }else{?>
                    <?php
                        }
                    ?>
                    <?php
                        if($_SESSION['tipo']==2){// Si es PROPIETARIO mostrara imagen de PROPIETARIO
                    ?>
                    <img src="img\menu-icons\prop.jpg" class="rounded-circle img-fluid" style="width: 140px;" />
                    <?php
                        }else{?>
                    <?php
                        }
                    ?>
                </div>
                <h4 class="mb-2"><?php echo $_SESSION['usu']; ?></h4>
                <p class="text-muted mb-4">
                <?php
                 if ($_SESSION['tipo'] == 1){ ?> 
                    <span class="mx-2">ADMINISTRADOR</span>
                <?php 
                } 
                ?>
                <?php
                 if ($_SESSION['tipo'] == 2){ ?> 
                    <span class="mx-2">PROPIETARIO</span>
                <?php 
                } 
                ?>
                <?php
                 if ($_SESSION['tipo'] == 3){ ?> 
                    <span class="mx-2">VENDEDOR</span>
                <?php 
                } 
                ?> 
                <span class="mx-2"></span></p>
                

                <!-- DECLARACIÓN DE BOTONES SEGUN TIPO DE USUARIO-->
                <div class="mb-4 pb-2">
                    <?php
                        if($_SESSION['tipo']==1){ // Si es ADMINISTRADOR mostrara el botón de administrar usuarios
                    ?>
                    <a href="menu_adm.php"> <!-- BOTÓN QUE LLEVARA A UNA LISTA CON LOS USUARIOS Y UN FORMATO PARA AGREGAR MÁS USUARIOS -->
                        <button type="button" id="adm-usu" class="btn1">
                            <img src="img\menu-icons\admusu.jpg" alt="" style="width: 90px"><br>
                            Adm. <br>Usuarios
                        </button>
                    </a>
                    <?php
                        }else{?>
                    <?php
                        }
                    ?>
                    <?php
                        if(($_SESSION['tipo']==1) || ($_SESSION['tipo']==3)){// Si es ADMINISTRADOR Y VENDEDOR mostrara el botón de administrar usuarios
                    ?>
                    <a href="perfil.php">
                        <button type="button" class="btn1">
                            <img src="img\menu-icons\admven.jpg" alt="" style="width: 90px"><br>
                            Adm. <br>Vendedores
                        </button> 
                    </a>
                    <?php
                        }else{?>
                    <?php
                        }
                    ?>
                    <?php
                        if(($_SESSION['tipo']==1) || ($_SESSION['tipo']==2)){// Si es ADMINISTRADOR Y PROPIETARIO mostrara el botón de administrar usuarios
                    ?>
                    <a href="Propiedades.php">
                        <button type="button" class="btn1">
                            <img src="img\menu-icons\admprop.jpg" alt="" style="width: 90px"><br>
                            Adm. <br>Propietarios
                        </button>
                    </a>
                    <?php
                        }else{?>
                    <?php
                        }
                    ?>
                </div>
                    <button type="button" id="btn-close" class="btn1">
                        <a id="cerrar-sesion" href="functions/cerrar.php">Cerrar Sesión</a>
                    </button>
                    <button type="button" id="btn-close" class="btn1">
                        <a id="cerrar-sesion" href="index.php">Menu Principal</a>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </div>
    </section>
</body>
</html>

<?php
}else{
    header("Location:error.html");
}
?>