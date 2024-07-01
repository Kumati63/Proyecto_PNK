<?php
include("functions/setup.php");
session_start();
$id_propiedad = $_GET['id'];

$sql = "SELECT 
                    `fotografias`.`Foto`,
                    `fotografias`.`principal`,
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
                    `propiedades`.`idpropiedad` LIKE '%".$id_propiedad."%'";
$result = mysqli_query(conectar(), $sql);
$imagenes = [];
$datos_propiedad = null;

while ($row = mysqli_fetch_array($result)) {
    $imagenes[] = ['Foto' => $row['Foto'], 'principal' => $row['principal']];
    if (!$datos_propiedad) {
        $datos_propiedad = $row; // Asumiendo que todos los rows tienen los mismos datos de propiedad
    }
}

// Encuentra la imagen principal
$principal = array_filter($imagenes, function($imagen) {
    return $imagen['principal'] == 1;
});
$principal = reset($principal);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.min.js""></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Propiedades</title>
    <style>
        body{background-color: gray}.card{border:none}.product{background-color: #eee}.brand{font-size: 13px}.act-price{color:red;font-weight: 700}.dis-price{text-decoration: line-through}.about{font-size: 14px}.color{margin-bottom:10px}label.radio{cursor: pointer}label.radio input{position: absolute;top: 0;left: 0;visibility: hidden;pointer-events: none}label.radio span{padding: 2px 9px;border: 2px solid #ff0000;display: inline-block;color: #ff0000;border-radius: 3px;text-transform: uppercase}label.radio input:checked+span{border-color: #ff0000;background-color: #ff0000;color: #fff}.btn-danger{background-color: #ff0000 !important;border-color: #ff0000 !important}.btn-danger:hover{background-color: #da0606 !important;border-color: #da0606 !important}.btn-danger:focus{box-shadow: none}.cart i{margin-right: 10px}
        #map {
            margin: 20px;
            height: 350px;
            width: 100%;
            border: 2px solid;
        }
    </style>
    <script>
    function change_image(src) {
        document.getElementById('main-image').src = src;
    }
    </script>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4">
                                <?php if ($principal): ?>
                                    <img id="main-image" src="img/fotosProp/<?php echo $principal['Foto']; ?>" width="450">
                                <?php else: ?>
                                    <img id="main-image" src="img/fotosProp/default.jpg" width="300"> <!-- Imagen por defecto -->
                                <?php endif; ?>
                            </div>
                            <div class="thumbnails text-center">
                                <?php foreach ($imagenes as $imagen): ?>
                                    <img class="thumbnail" onclick="change_image('img/fotosProp/<?php echo $imagen['Foto']; ?>')" src="img/fotosProp/<?php echo $imagen['Foto']; ?>" width="80">
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <a href="index.php"><button class="btn btn-danger text-lowercase mr-2 px-4">Volver</button></a>
                                <div class="mt-4 mb-3">
                                    <span class="text-uppercase text-muted brand"><?php echo $datos_propiedad['fechaPublicacion'];?></span><br>
                                    <span class="text-uppercase text-muted brand"><?php echo $datos_propiedad['tipo'];?></span>
                                    <h5 class="text-uppercase"><?php echo $datos_propiedad['nombre'];?></h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price"></span>
                                        <?php 
                                        $precio_CLP = $datos_propiedad['Precio'];
                                        $factor = uf();
                                        $calculo = $precio_CLP / $factor;
                                        $precio_UF = sprintf("%.2f", $calculo);
                                        ?>
                                        <div class="ml-2"><h4>$<?php echo $precio_CLP?>CLP</h4><span><h4>$<?php echo $precio_UF?></span>UF</h4></div>
                                    </div>
                                </div>
                                <h5 class="about"><span style="font-size:17px"> Dirección: <?php echo $datos_propiedad['Direccion'];?></span></h5>
                                <h5 class="about"><i class='bx bxs-bath bx-sm'></i><span style="font-size:17px"> Baños: <?php echo $datos_propiedad['cant_banos'];?></span></h5>
                                <h5 class="about"><i class='bx bxs-bed bx-sm' ></i><span style="font-size:17px"> Dormitorios: <?php echo $datos_propiedad['cant_dorm'];?></span></>
                                <h5 class="about"><i class='bx bx-move bx-sm'></i><span style="font-size:17px"> Area total: <?php echo $datos_propiedad['areaTotal_terreno'];?> m²</span></>
                                <h5 class="about"><i class='bx bxs-home-alt-2 bx-sm'></i><span style="font-size:17px"> Area construida: <?php echo $datos_propiedad['areaConstruida'];?> m²</span></h5><br>
                                <h6 class="text-uppercase">contacto: <?php echo $datos_propiedad['email'];?></h6>
                                
                                <div class="cart mt-4 align-items-center">
                                    <button class="btn btn-danger text-uppercase mr-2 px-4">Comprar <i class='bx bxs-cart'></i></button>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <p>Si no es posible mostrar la ubicación, o si hay errores en el formato, el mapa mostrara la ciudad de la serena</p>
                    <div id="map"></div>
                    <script>
                    function initMap() {
                        var geocoder = new google.maps.Geocoder();
                        var address = '<?php echo $datos_propiedad['Direccion'];?>'; 

                        geocoder.geocode({'address': address}, function(results, status) {
                            if (status === 'OK') {
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 15,
                                    center: results[0].geometry.location
                                });
                                var marker = new google.maps.Marker({
                                    position: results[0].geometry.location,
                                    map: map
                                });
                            } else {
                                // Si la dirección no da resultado, usar dirección por defecto
                                var defaultAddress = 'Chile, La Serena';
                                geocoder.geocode({'address': defaultAddress}, function(defaultResults, defaultStatus) {
                                    if (defaultStatus === 'OK') {
                                        var map = new google.maps.Map(document.getElementById('map'), {
                                            zoom: 15,
                                            center: defaultResults[0].geometry.location
                                        });
                                        var marker = new google.maps.Marker({
                                            position: defaultResults[0].geometry.location,
                                            map: map
                                        });
                                    } else {
                                        alert('Geocode was not successful for the following reason: ' + defaultStatus);
                                    }
                                });
                            }
                        });
                    }
                </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK2Jxpdg2g5LYlGf-eh-0rUgqXYG9yPAI&callback=initMap" async defer></script>
                </div>
                <div class="col-md-6">
                    <div class="images p-3">
                        <div class="text-center p-4"> 
                            <h3>Descripción:</h3>
                            <p class="about"><?php echo $datos_propiedad['Descripcion'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>

    </div>
    
</body>
</html>