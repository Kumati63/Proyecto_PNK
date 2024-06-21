<?php

session_start();
include("functions/setup.php");
if(isset($_SESSION['usu']))
{
    switch($_SESSION['tipo']){
        case 1: $tipo="ADMINISTRADOR";
            break;
        case 2: $tipo="PROPIETARIO";
            break;
        case 3: $tipo="VENDEDOR";
            break;
    }
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
            $("#Region").on("change", function() {
                $.ajax({
                    type: "POST",
                    url: "functions/combobox.php",
                    data: "id="+$("#Region").val()+'&tipo=1',
                    success: function(response) {
                        $("#Provincia").html(response);
                    }
                });
            });
            $("#Provincia").on("change", function() {
                $.ajax({
                    type: "POST",
                    url: "functions/combobox.php",
                    data: "id="+$("#Provincia").val()+'&tipo=2',
                    success: function(response) {
                        $("#Comuna").html(response);
                    }
                });
            });
            $("#Comuna").on("change", function() {
                $.ajax({
                    type: "POST",
                    url: "functions/combobox.php",
                    data: "id="+$("#Comuna").val()+'&tipo=3',
                    success: function(response) {
                        $("#Sector").html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <a href="index.php">
            <div class="logo" id="titulo"><img src="img/logo.png" alt="" width="430px"></div>
        </a>
        
        <div class="menu-header">
            <a href="menu.php">Perfil</a>
            <a href="error.html">Contactanos</a>
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
                    <select id="Provincia" name="Provincia">
                        <option value="0">Provincia</option>
                    </select>
                </div>
                <div class="selects">
                    <select id="Comuna" name="Comuna">
                        <option value="0">Comuna</option>
                    </select>
                </div>
                <div class="selects">
                    <select id="Sector" name="Sector">
                        <option value="0">Sector</option>
                    </select>
                </div>
                <div class="selects">
                    <select id="Tipo" name="Tipo">
                        <option value="0">Tipo</option>
                    </select>
                </div>
                <div class="search-button">
                    <button type="submit">Buscar</button>
                </div>
            </div>
        </form>
        <br><br>
        <div class="gallery">
            <?php
            $sql_propiedades = "SELECT 
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
                    `fotografias`.`principal` = 1";
            $result = mysqli_query(conectar(), $sql_propiedades);

            while($datos=mysqli_fetch_array($result)){
                $precio_CLP = $datos['Precio'];
                $factor = 37527;

                $calculo = $precio_CLP / $factor;
                $precio_UTF = sprintf("%.2f", $calculo);

                ?>
                <div class="gallery-item">
                    <div class="container m-4">
                        <div class="card border-0 rounded-0 shadow" style="width: 18rem;">
                            <img src="img/fotosProp/<?php echo $datos['Foto'];?>" width="auto">
                            <div class="card-body mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="card-title"><?php echo $datos['nombre'];?></h4>
                                        <p class="card-text">
                                            <i class="bi bi-star-fill text-warning">Tipo de vivienda: <?php echo $datos['tipo'];?></i><br>
                                            <i class="bi bi-star-fill text-warning">Sector: <?php echo $datos['sector'];?></i><br>
                                            <i class="bi bi-star-fill text-warning">Dirección:<br><?php echo $datos['Direccion'];?></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center text-center g-0">
                                <div class="col-12">
                                    <h5>$<?php echo $precio_CLP?> CLP</h5>
                                </div>
                            </div>
                            <div class="row align-items-center text-center g-0">
                                <div class="col-12">
                                    
                                    <h5>$<?php echo $precio_UTF?> UF</h5>
                                </div>
                            </div>
                            <div class="row align-items-center text-center g-0">
                                <div class="col-12">
                                    <a href="details_Prop.php?id=<?php echo $datos['idpropiedad'];?>" class="btn btn-dark w-100 p-3 rounded-0 text-warning">MÁS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
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
<?php
}else{
    header("Location:error.html");
}
?>