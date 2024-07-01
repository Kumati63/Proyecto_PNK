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
    if (isset($_GET['id'])) {
        $id_propiedad = $_GET['id'];
        $sql_propiedad = "SELECT
          `fotografias`.`Foto`,
          `propiedades`.*
        FROM
          `propiedades`
        INNER JOIN `fotografias` ON `fotografias`.`idpropiedad` = `propiedades`.`idpropiedad`
        WHERE `propiedades`.`idpropiedad` = ".$_GET['id'];

        $result_propiedad = mysqli_query(conectar(), $sql_propiedad);

        $fotos = [];
        $datos_propiedad = null;

        while ($row = mysqli_fetch_assoc($result_propiedad)) {
            if (!$datos_propiedad) {
                $datos_propiedad = [
                    'idpropiedad' => $row['idpropiedad'],
                    'nombre' => $row['nombre'],
                    'Direccion' => $row['Direccion'],
                    'Precio' => $row['Precio'],
                    'Descripcion' => $row['Descripcion'],
                    'cant_banos' => $row['cant_banos'],
                    'cant_dorm' => $row['cant_dorm'],
                    'areaTotal_terreno' => $row['areaTotal_terreno'],
                    'areaConstruida' => $row['areaConstruida'],
                    'tipo_propiedad' => $row['tipo_propiedad'],
                    'idregion' => $row['idregion'],
                    'idprovincias' => $row['idprovincias'],
                    'idcomunas' => $row['idcomunas'],
                    'idsector' => $row['idsector']
                ];
            }
            $fotos[] = $row['Foto'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\ges_propiedades.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery-3.7.1.min.js""></script>
    <script src="js\validar_Propiedades.js""></script>
    <title>Adm.propiedades</title>
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
        #invalid, #invalid2 {
            display: none;
            color: red;
            font-weight: bold;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>
    <script>
        $(function() {
            $(document).ready(function() {
                $(document).on("contextmenu", function(e) {
                    e.preventDefault();
                });
            });
            $("#Region").on("change", function() {
                alert($("#Region").val())
                if ($("#Region").val() === "0") {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","green");
                }
                $.ajax({
                    type: "POST",
                    url: "functions/combobox.php",
                    data: {id: $("#Region").val(), tipo: 1},
                    success: function(response) {
                        $("#Provincia").html(response);
                    }
                });
            });

            $("#Provincia").on("change", function() {
                $.ajax({
                    type: "POST",
                    url: "functions/combobox.php",
                    data: {id: $("#Provincia").val(), tipo: 2},
                    success: function(response) {
                        $("#Comuna").html(response);
                    }
                });
            });

            $("#Comuna").on("change", function() {
                $.ajax({
                    type: "POST",
                    url: "functions/combobox.php",
                    data: {id: $("#Comuna").val(), tipo: 3},
                    success: function(response) {
                        $("#Sector").html(response);
                    }
                });
            });

            $('#invalid').hide();
            $('#invalid2').hide();
            $('#editimages').hide();
            cargar_lista_propiedades();
            $("#buscador").on( "keyup", function() {
                cargar_lista_propiedades($("#buscador").val());
            });
            $("#lista-usuarios").on("click", "#openeditimages", function(event) {
                $('#showmsgeditimg').show();
            });
            $("#lista-usuarios").on("click", "#openeditimages", function(event) {
                event.preventDefault(); // Evita que el enlace siga su URL
                $('#editimages').show();
            });
            $("#closeimgeditor").on("click", function(event) {
                $('#editimages').hide();
            });
            $('#Nombre').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");;
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Nombre').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9-. ]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#Direccion').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Direccion').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 !#$%&()*+-."/:;='?@[\]{|}~]/gi, '');
                $(this).val(sanitizedValue);
            });

            $('#Precio').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Precio').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9]/gi, '');
                $(this).val(sanitizedValue);
            });

            $('#Banos').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Banos').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#Dormitorios').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Dormitorios').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#areaTotal').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#areaTotal').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#areaconstruida').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#areaconstruida').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^0-9]/gi, '');
                $(this).val(sanitizedValue);
            });

            $('#Descripcion').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            });
            $('#Descripcion').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 !#$%&()*+-./:;=?@[\]{|}~]/gi, '');
                $(this).val(sanitizedValue);
            });
            
            $('#buscador').on('input', function() {
                var sanitizedValue = $(this).val().replace(/[^a-z0-9 .-]/gi, '');
                $(this).val(sanitizedValue);
            });
            $('#File').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Region').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Provincia').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Comuna').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#Sector').on( "blur", function()
            {
                if ($(this).val() === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            $('#tipo_prop').on( "blur", function()
            {
                if ($(this).val().length === 0) {
                    $(this).css("border","3px solid red");
                }else{
                    $(this).css("border-color","rgba(71, 71, 71, 0.61)");
                }
            } );
            
            const allowedExtensions = ['jpg', 'jpeg', 'png']; // Allowed file extensions
            $('#File').change(function() {
                const files = this.files;
                const previewContainer = $('#preview');
                previewContainer.empty(); // Limpiar el contenedor de previsualización

                if (files.length > 10) {
                    $('#invalid2').show();
                    this.value = '';
                } else {
                    $('#invalid2').hide();

                    Array.from(files).forEach(file => {
                        const fileName = file.name;
                        const fileExtension = fileName.split('.').pop().toLowerCase();

                        if (allowedExtensions.indexOf(fileExtension) === -1) {
                            $('#invalid').show();
                            this.value = ''; // Clear the input value to prevent form submission
                        } else {
                            $('#invalid').hide();
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = $('<img>').attr('src', e.target.result);
                                previewContainer.append(img);
                            }
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });

        });
        
        
        function cargar_lista_propiedades(buscador)
        {
            $.ajax({
                type: "POST",
                url: "functions/lista_propiedades.php",
                data: "buscador="+$("#buscador").val(),
                success: function(response)
                {
                    $("#lista-usuarios").html(response);
                }
            });
        }
    </script>
</head>
<body>

    <?php
        if ($tipo == "ADMINISTRADOR" || $tipo == "PROPIETARIO") {// Si es ADMINISTRADOR mostrara la lista de usuarios
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
                <div class="card-header alineartexto">Administración de Propiedades</div>
                <div class="card-body">
                    <form action="functions/crud_propiedades.php" method="post" name="form" class="form-container" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-Nombre">Nombre</label><br>
                                    <input class="form-control" id="Nombre" name="Nombre" type="text" placeholder="Nombre"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['nombre'];} ?>">
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-Direccion">Dirección</label><br>
                                    <input class="form-control" id="Direccion" name="Direccion" type="text" placeholder="Dirección"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['Direccion'];} ?>">
				<span>Formato recomendable: </span><span style="font-size:13px; color:gray;">[Dirección], [Sector], [ciudad], [estado/provincia], [país]</span><br>
                                    <span style="font-size:13px; color:gray; margin-left:40px;">Puede copiar y pegar la direccion que obtiene desde el google maps,</span><br>
                                    <span style="font-size:13px; color:gray; margin-left:60px;">recomendable para que su dirección aparezca en el mapa</span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-Precio">Precio (CLP)</label><br>
                                    <input class="form-control" id="Precio" name="Precio" type="text" placeholder="Precio"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['Precio'];} ?>"><br>
                                    <label for="Region">Region</label>
                                    <select id="Region" name="Region">
                                        <option value="0">Región</option>
                                        <?php
                                        $sql= "SELECT * FROM region WHERE estado = 1";
                                        $result = mysqli_query(conectar(),$sql);
                                        while($datos=mysqli_fetch_array($result)){
                                            ?>
                                            <option value="
                                            <?php echo $datos['idregion'];?>"<?php if (isset($_GET['id'])){if($datos_propiedad['idregion']==$datos['idregion']){?>selected<?php }}?>>
                                            <?php echo $datos['region'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br><br>
                                    <label for="Provincia">Provincia</label>
                                    <select id="Provincia" name="Provincia">
                                        <option value="0">Provincia</option>
                                        <?php
                                        $sql= "SELECT * FROM provincias WHERE estado = 1";
                                        $result = mysqli_query(conectar(),$sql);
                                        while($datos=mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php echo $datos['idprovincias'];?>"
                                            <?php if (isset($_GET['id'])){if($datos_propiedad['idprovincias']==$datos['idprovincias']){?>selected<?php }}?>>
                                            <?php echo $datos['provincia'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br><br>
                                    <label for="Comuna">Comuna</label>
                                    <select id="Comuna" name="Comuna">
                                        <option value="0">Comuna</option>
                                        <?php
                                        $sql= "SELECT * FROM comunas WHERE estado = 1";
                                        $result = mysqli_query(conectar(),$sql);
                                        while($datos=mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php echo $datos['idcomunas'];?>"
                                            <?php if (isset($_GET['id'])){if($datos_propiedad['idcomunas']==$datos['idcomunas']){?>selected<?php }}?>>
                                            <?php echo $datos['comuna'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br><br>
                                    <label for="Sector">Sector</label>
                                    <select id="Sector" name="Sector">
                                        <option value="0">Sector</option>
                                        <?php
                                        $sql= "SELECT * FROM sector WHERE estado = 1";
                                        $result = mysqli_query(conectar(),$sql);
                                        while($datos=mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php echo $datos['idsector'];?>"
                                            <?php if (isset($_GET['id'])){if($datos_propiedad['idsector']==$datos['idsector']){?>selected<?php }}?>>
                                            <?php echo $datos['sector'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br><br>
                                    <label for="tipo_prop">Tipo Propiedad</label>
                                    <select name="tipo_prop" id="tipo_prop">
                                        <option value="">Tipo Propiedad</option>
                                        <?php
                                            $sql="SELECT * FROM `tipo_propiedad`";
                                            $result=mysqli_query(conectar(),$sql);
                                            while($datos_tipo=mysqli_fetch_array($result)){
                                            ?>
                                                <option class="form-control" value="<?php echo $datos_tipo['idtipo_propiedad'];?>"
                                                <?php if (isset($_GET['id'])){if($datos_propiedad['tipo_propiedad']==$datos_tipo['idtipo_propiedad']){?>selected<?php }}?>>
                                                <?php echo $datos_tipo['tipo'];?></option>  
                                            <?php
                                            }
                                        ?>
                                    </select>
                                    <br>
                                </div>
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-File">Imagenes</label><br>
                                    <input class="form-control" type="file" id="File" name="File" placeholder="File">
                                    <label id="invalid" style="color: red; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">
                                        Archivo invalido, solo se admiten 'jpg', 'jpeg', 'png'</label>
                                    <label id="invalid2" style="color: red; font-weight: bold; font-size: 13px; margin-left: 20px; margin-top: 10px; margin-bottom: -37px;">
                                        Cantidad de imagenes supera el maximo de 10,<br>solo las primeras 10 imagenes seleccionadas se subiran</label>
                                    <label class="input-icon" style="font-weight: bold; font-size: 16px; margin-left: 20px; margin-top: 35px; "
                                    >Nota: no se soportan imagenes con un peso mayor a 20 MB<br>no pueden subir mas de 10 imagenes</label>
                                    <label id="showmsgeditimg" class="input-icon" style="font-weight: bold; font-size: 16px; margin-left: 20px; margin-top: 35px; "
                                    >PARA EDITAR LAS IMAGENES DE LA PROPIEDAD, HACER CLICK EN LA IMAGEN DE LA PROPIEDAD <span style="color:red; font-size:25px;">DESPUES</span> DE QUE SE EMPIEZE A EDITAR<br>
                                    (en la lista de usuarios)<p style="color:red;">aun implementandose</p></label><br><br><br>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <label class="input-icon" for="lbl-Banos">Cantidad de Baños</label><br>
                                    <input class="form-control" id="Banos" name="Banos" type="text" placeholder="Baños"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['cant_banos'];} ?>"><br>
                                    <label class="input-icon" for="lbl-Dormitorios">Cantidad de Dormitorios</label><br>
                                    <input class="form-control" id="Dormitorios" name="Dormitorios" type="text" placeholder="Dormitorios"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['cant_dorm'];} ?>"><br>
                                    <label class="input-icon" for="lbl-areaTotal">Área Total del Terreno en m²</label><br>
                                    <input class="form-control" id="areaTotal" name="areaTotal" type="text" placeholder="areaTotal en m²"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['areaTotal_terreno'];} ?>"><br>
                                    <label class="input-icon" for="lbl-areaconstruida">Área Construida en m²</label><br>
                                    <input class="form-control" id="areaconstruida" name="areaconstruida" type="text" placeholder="areaconstruida en m²"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['areaConstruida'];} ?>"><br>
                                    <label class="input-icon" for="lbl-Descripcion">Descripcion</label><br>
                                    <input class="form-control" maxlength="20000" id="Descripcion" name="Descripcion" type="text" placeholder="Descripcion"
                                    value="<?php if (isset($_GET['id'])){ echo $datos_propiedad['Descripcion'];} ?>">
                                    <input class="form-control" id="idUsuario" name="idUsuario" type="hidden" 
                                    value="<?php echo $_SESSION['id_usuario'];?>">
                                    
                                    
                                </div>
                                <div class="col col-sm-6">
                                    <br><div id="preview">
                                        <?php
                                        if(isset($_GET['id'])) {
                                            foreach ($fotos as $foto) {
                                        ?>
                                                <img src="img/fotosProp/<?php echo $foto; ?>" width="200px">
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            
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
                                    <input type="hidden" name="idpropiedad" value="<?php if (isset($_GET['id'])){ echo $id_propiedad;}?>">
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
                                <a href="functions\exportexcelprop.php">
                                    <button id="btn-close" class="btn btn-default" title="Excel"><img src="img\menu-icons/exel.png" alt="" width="30px"></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- pop up window -->
    <div class="edit_images" id="editimages">
        <div id="editimagescontainer">
            <div id="editimagescontainertitle">
                <span>IMAGENES DE LA PROPIEDAD</span>
                <button id="closeimgeditor">Cerrar</button>
            </div>
            <div id="preview">
                <?php
                if(isset($_GET['id'])) {
                    foreach ($fotos as $foto) {
                ?>
                        <img src="img/fotosProp/<?php echo $foto; ?>" width="200px">
                <?php
                    }
                }
                ?>
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