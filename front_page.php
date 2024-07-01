<?php
include("functions/setup.php");


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/style_index.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.min.js""></script>
    <title>PNK Inmovilaria</title>
    <script>
        $(document).ready(function() {
            cargar_propiedades();
            $("#Region, #Provincia, #Comuna, #Sector, #Tipo, #precioMin, #precioMax").on("change", function() {
                cargar_propiedades();
            });

            $("#Region").on("change", function() {
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
        });

        function cargar_propiedades() {
            var precioMin = $("#precioMin").val() || 0;
            var precioMax = $("#precioMax").val() || 10000000000;
            mostrarLoader(); // Mostrar indicador de carga antes de hacer la petición AJAX
            $.ajax({
                type: "POST",
                url: "functions/cargar_propiedades.php",
                data: {
                    Region: $("#Region").val(),
                    Provincia: $("#Provincia").val(),
                    Comuna: $("#Comuna").val(),
                    Sector: $("#Sector").val(),
                    Tipo: $("#Tipo").val(),
                    precioMin: precioMin,
                    precioMax: precioMax
                },
                success: function(response) {
                    $("#gallery").html(response); // Actualizar el contenido de la galería con las propiedades cargadas
                    ocultarLoader(); // Ocultar indicador de carga después de cargar las propiedades
                },
                error: function(xhr, status, error) {
                    console.error("Error en la carga de propiedades:", error);
                    ocultarLoader(); // En caso de error, asegurar que el loader se oculte también
                }
            });
        }
        // Función para mostrar el indicador de carga
        function mostrarLoader() {
            $("#gallery").find(".loader").css("display", "block");
        }

        function ocultarLoader() {
            $("#gallery").find(".loader").css("display", "none");
        }
    </script>
</head>
<body>
    <header>
        <a href="index.php">
            <div class="logo" id="titulo"><img src="img/logo.png" alt="" width="430px"></div>
        </a> 
        <div class="menu-header">
            <a href="signup_prop.html">Sign up</a>
            <a href="functions/redirection_login.php">Login</a>
            <a href="">Contactanos</a>
            <a href="">Quienes somos</a>
        </div>
    </header>

    <section class="section">

        <div class="main-image">
            <img id="section-image" src="img/main_background_image.png"  alt="">
        </div>

        <div class="image-text" id="image-text">
            <p id="texto1">Buscas un nuevo hogar? Haz llegado al lugar correcto!</p>br
            <p id="texto2">Te invitamos a revisar nuestra pagina y encontrar tus opciones preferidas</p>
        </div>
        <form method="post" action="#">
            <div class="searcher" id="searcher">
                <div class="selects">
                    <span style="font-size:15px; font-weight: bold; color:white; display: flex; justify-content: center; align-items: center; padding:10px;" for="">Región</span>
                    <select id="Region" name="Region">
                        <option value="0">Región</option>
                        <?php
                        $sql= "SELECT * FROM region WHERE estado = 1";
                        $result = mysqli_query(conectar(),$sql);
                        while($datos=mysqli_fetch_array($result)){
                            ?>
                            <option value="<?php echo $datos['idregion'];?>"><?php echo $datos['region'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="selects">
                    <span style="font-size:15px; font-weight: bold; color:white; display: flex; justify-content: center; align-items: center; padding:10px;" for="">Provincia</span>
                    <select id="Provincia" name="Provincia">
                        <option value="0">Provincia</option>
                    </select>
                </div>
                <div class="selects">
                    <span style="font-size:15px; font-weight: bold; color:white; display: flex; justify-content: center; align-items: center; padding:10px;" for="">Comuna</span>
                    <select id="Comuna" name="Comuna">
                        <option value="0">Comuna</option>
                    </select>
                </div>
                <div class="selects">
                    <span style="font-size:15px; font-weight: bold; color:white; display: flex; justify-content: center; align-items: center; padding:10px;" for="">Sector</span>
                    <select id="Sector" name="Sector">
                        <option value="0">Sector</option>
                    </select>
                </div>
                <div class="selects">
                    <span style="font-size:15px; font-weight: bold; color:white; display: flex; justify-content: center; align-items: center; padding:10px;" for="">Tipo Propiedad</span>
                    <select id="Tipo" name="Tipo">
                        <option value="0">Todas</option>
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
                </div>
                <div class="selects">
                    <label style="font-size:15px; color:white" for="precioMin">Precio Mínimo</label><br>
                    <input type="number" id="precioMin" name="precioMin" min="0" max="10000000000" step="1000000" >
                </div>
                <div class="selects">
                    <label style="font-size:15px; color:white" for="precioMax">Precio Máximo</label><br>
                    <input type="number" id="precioMax" name="precioMax" min="0" max="10000000000" step="1000000">
                </div>
            </div>
        </form>
        <br>
        <br>
        
        <div class="gallery" id="gallery">
            <div id="loader" class="loader"></div>
        </div>
        <br><br>
           
            
        
        
    </section>

    <footer>
        <ul>
            <li><a  id="volver" href="#titulo">volver arriba</a></li>
        </ul>
    </footer>
</body>
</html>
