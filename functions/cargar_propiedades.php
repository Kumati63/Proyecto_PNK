<?php
include("setup.php");

$region = $_POST['Region'] ?? '';
$provincia = $_POST['Provincia'] ?? '';
$comuna = $_POST['Comuna'] ?? '';
$sector = $_POST['Sector'] ?? '';
$tipo = $_POST['Tipo'] ?? '';
$buscador = $_POST['buscador'] ?? '';
$precioMin = $_POST['precioMin'] ?? 0;
$precioMax = $_POST['precioMax'] ?? 10000000000;

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
    `fotografias`.`principal` = 1
    AND `propiedades`.`Precio` BETWEEN $precioMin AND $precioMax";

// if ($region) {
//     $sql_propiedades .= " AND `propiedades`.`idregion` = '$region'";
// }
// if ($provincia) {
//     $sql_propiedades .= " AND `propiedades`.`idprovincia` = '$provincia'";
// }
// if ($comuna) {
//     $sql_propiedades .= " AND `propiedades`.`idcomuna` = '$comuna'";
// }
if ($sector) {
    $sql_propiedades .= " AND `propiedades`.`idsector` = '$sector'";
}
if ($tipo) {
    $sql_propiedades .= " AND `tipo_propiedad`.`idtipo_propiedad` = '$tipo'";
}


$conn = conectar();
$result = mysqli_query($conn, $sql_propiedades);

if (!$result) {
    echo "Error en la consulta: " . mysqli_error($conn);
    exit;
}

while ($datos = mysqli_fetch_array($result)) {
    $precio_CLP = $datos['Precio'];
$factor = uf();
if ($factor !== null) {
    $calculo = $precio_CLP / $factor;
    $precio_UTF = sprintf("%.2f", $calculo);
} else {
    // Manejar el caso donde no se pudo obtener el valor de la UF
    $precio_UTF = "No disponible";
}
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
