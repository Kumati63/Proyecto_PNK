<?php

include("functions/setup.php");

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
        #buscador-lista-usuarios{
            width: 300px;
            height: 40px;
            border-radius: 10px;
            border: none;
        }

        #buscador-lista-usuarios:focus{
            box-shadow: none;
            outline: none;
        }
        #buscador-lista-usuarios::placeholder{
            font-size: 15px;
            font-weight: 500;
            padding-top: 10px;
        }
        #preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        #preview img {
            margin-top:25px;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
    </style>
    <script>
        $(function() {
            $(document).ready(function() {
                $(document).on("contextmenu", function(e) {
                    e.preventDefault();
                });
            });
            $("#no1").hide();
            $("#yes1").hide();
            $("#no2").hide();
            $("#yes2").hide();
            $('#invalid').hide();
            cargar_lista_usuarios();
            $("#buscador").on( "keyup", function() {
                cargar_lista_usuarios($("#buscador").val());
            });

            $('#email').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","whrgba(71, 71, 71, 0.61)ite");
                    validaremailrepetido();
                }
            } );
            $('#email').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9@. ]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#rut').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                    validarrutrepetido();
                }
            } );
            
            $('#rut').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9@.-]/gi, '');
                $(this).val(sanitizedValue);
            });
            
            $('#tipo_usuario').on( "blur", function()
            {
                if ($(this).val() === "9") {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#telefono').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            
            $('#Nombre').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");;
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Nombre').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 ]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#contrasena').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#contrasena').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 !#$%&()*+-./:;=?@[\]{|}~]/gi, '');
                $(this).val(sanitizedValue);
            });

            $('#Repetir_contrasena').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Repetir_contrasena').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 !#$%&()*+-./:;=?@[\]{|}~]/gi, '');
                $(this).val(sanitizedValue);
            });

            $('#antecedentes').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#nacimiento').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );

            //setting the date of birthday not more than the 16 years ago
            var today = new Date();
        
            // Calculate max date (16 years ago)
            var maxYear = today.getFullYear() - 16;
            var maxMonth = today.getMonth() + 1; // Months are zero-indexed, so we add 1
            var maxDay = today.getDate();
            
            if (maxMonth < 10) maxMonth = '0' + maxMonth;
            if (maxDay < 10) maxDay = '0' + maxDay;
            
            var maxDate = maxYear + '-' + maxMonth + '-' + maxDay;
            
            // Calculate min date (100 years ago)
            var minYear = today.getFullYear() - 100;
            var minMonth = today.getMonth() + 1; // Months are zero-indexed, so we add 1
            var minDay = today.getDate();
            
            if (minMonth < 10) minMonth = '0' + minMonth;
            if (minDay < 10) minDay = '0' + minDay;
            
            var minDate = minYear + '-' + minMonth + '-' + minDay;
            
            // Set min and max attributes
            document.getElementById('nacimiento').setAttribute("max", maxDate);
            document.getElementById('nacimiento').setAttribute("min", minDate);
            "9"
            $('#estado').on( "blur", function()
            {
                if ($(this).val() === "9") {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border","3px solid rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#sexo').on( "blur", function()
            {
                if ($(this).val() === "Seleccionar") {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border","3px solid rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#buscador').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 .-]/gi, '');
                $(this).val(sanitizedValue);
            });

            $('#Repetir_contrasena').on('keyup', function() {
                var password = $('#contrasena').val();
                var confirmPassword = $(this).val();

                if (password !== confirmPassword) {
                    $('#contrasena').css('border', '3px solid red');
                    $('#Repetir_contrasena').css('border', '3px solid red');
                } else {
                    $('#contrasena').css('border', '3px solid green');
                    $('#Repetir_contrasena').css('border', '3px solid green');
                }
            });
            $('#File').on("blur", function() {
            if ($(this).val().length === 0) {
                $(this).css("border-color","red");
            } else {
                $(this).css("border-color","white");
            }
            });

            const allowedExtensions = ['jpg', 'jpeg', 'png']; // Allowed file extensions
            $('#File').change(function() {
                const file = this.files[0];
                if (file) {
                    const fileName = file.name;
                    const fileExtension = fileName.split('.').pop().toLowerCase();
                    if (allowedExtensions.indexOf(fileExtension) === -1) {
                        $('#invalid').show();
                        $(this).css("border","3px solid red");
                        this.value = ''; // Clear the input value to prevent form submission
                    } else {
                        $('#invalid').hide();
                        $(this).css("border","3px solid green");
                        showPreview(file);
                    }
                }
            });

            function showPreview(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').html('<img src="' + e.target.result + '" width="200px">');
                }
                reader.readAsDataURL(file);
            }

        });
        
        
        function cargar_lista_usuarios(buscador)
        {
            $.ajax({
                type: "POST",
                url: "functions/lista_usuarios_adm.php",
                data: "buscador="+$("#buscador").val(),
                success: function(response)
                {
                    $("#lista-usuarios").html(response);
                }
            });
        }

        function validarrutrepetido()
        {
                $.ajax({
                type: "POST",
                url: 'functions/validarrepetido.php',
                data: "rut-usu="+$("#rut").val(),
                success: function(response)
                    {
                        if (response==0){
                            $("#no1").hide();
                            $("#yes1").show();
                            
                            $('#rut').css("border-color","green");
                        }else{
                            $("#no1").show();
                            $("#yes1").hide();
                            
                            $('#rut').css("border-color","red"); 
                        }
                    }
                });
            
        }

        function validaremailrepetido()
        { 
            $.ajax({
            type: "POST",
            url: 'functions/validarrepetido.php',
            data: "email-usu="+$("#email").val(),
            success: function(response)
                {
                   if (response==0){
                        $("#no2").hide();
                        $("#yes2").show();
                        
                        $('#email').css("border-color","green");
                    }else{
                        $("#no2").show();
                        $("#yes2").hide();
                        
                        $('#email').css("border-color","red"); 
                    }
                }
            });
        }
        
    </script>
</head>
<body>

    <?php
        if($tipo="ADMINISTRADOR"){// Si es ADMINISTRADOR mostrara la lista de usuarios
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
                <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
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
                    <form action="functions/crud_usuarios.php" method="post" name="form" class="form-container" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-rut">Rut</label><br>
                                    <input class="form-control" maxlength="12" id="rut" name="rut" type="text" placeholder="Rut"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['rut'];} ?>">
                                    <p id="no1" style="color: red; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">Rut ya registrado</p>
                                    <p id="yes1" style="color: green; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">Rut disponible</p>
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
                                    <input class="form-control" id="Nombre" name="Nombre" type="text" placeholder="Nombre Completo"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['nombre'];} ?>">
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-email">Email</label><br>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_usuario['email'];} ?>">
                                    <p id="no2" style="color: red; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">Email ya registrado</p>
                                    <p id="yes2" style="color: green; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">Email disponible</p>
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
                                    <input class="form-control" type="text" maxlength="12" id="telefono" name="Telefono" placeholder="Telefono"
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
                            <br>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-File">Imagenes</label><br>
                                    <input class="form-control" type="file" id="File" name="File" placeholder="File">
                                    <label id="invalid" style="color: red; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">Archivo invalido, solo se admiten 'jpg', 'jpeg', 'png'</label>
                                    <label class="input-icon" style="font-weight: bold; font-size: 16px; margin-left: 20px; margin-top: 35px; "
                                    >Nota: no se soportan imagenes con un peso mayor a 20 MB</label><br>
                                </div>
                                <div class="col col-sm-6">
                                    <div id="preview">
                                        <?php
                                            if(isset($_GET['id'])){
                                        ?>
                                            <!-- <img src="img\fotos\monk_ravee_2__dnd__by_0tacoon_ddhle67-fullview.jpg" alt="" width="150px" style="margin-left: 150px;"> -->
                                            <img src="img/fotos/<?php if($datos_usuario['imgPerfil']==''){ echo "no_prof_pic.jpg"; }else{ echo $datos_usuario['imgPerfil'];}?>" width="200px">
                                        <?php
                                        }
                                        ?>
                                    </div>
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

    <div id="cabecera" class="bg-secondary bg-gradient">
                    <div class="row" style="margin: auto; padding: 12px;">
                        <div class="col col-sm-5 col-xs-12" style="display: flex; align-items: start; padding: 15px;">
                                <h4 style="font-size: 25px; padding-right: 10px; color:#fff;">Lista De <span>Usuarios</span></h4>
                                <button id="new-user" class="btn btn-sm btn-primary BOTONES" >Nuevo Usuario</button>
                        </div>
                        <div class="col-sm-7 col-xs-12">
                            <div class="btn_group" style="padding: 10px">
                                <input type="text" id="buscador" placeholder="Buscar">
                                <button id="btn-close" class="btn btn-default" title="Actualizar"><img src="img\menu-icons/reload.png" alt="" width="30px" onclick="#"></button>
                                <button id="btn-close" class="btn btn-default" title="Pdf"><img src="img/menu-icons/pdf.png" alt="" width="30px"></button>
                                <a href="functions\exportexcel.php">
                                    <button id="btn-close" class="btn btn-default" title="Excel"><img src="img\menu-icons/exel.png" alt="" width="30px"></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- LISTA DE USUARIOS -->
    <div id="lista-usuarios">
        
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