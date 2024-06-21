<?php
include("setup.php");

switch ($_POST['tipo']){
    case 1: cargarp();
    break;
    case 2:cargarc();
    break;
    case 3:cargars();
    break;
}

function cargarp()
{
?>
    <select id="Region" name="Region">
        <option value="0">Provincia</option>
        <?php
        $sql= "SELECT * From provincias WHERE idregion=".$_POST['id']." AND estado=1";
        $result = mysqli_query(conectar(),$sql);
        while($datos=mysqli_fetch_array($result)){
            ?>
            <option value="<?php echo $datos['idprovincias'];?>"><?php echo $datos['provincia'];?></option>
            <?php
        }
        ?>
    </select>
<?php
}
function cargarc()
{
?>
    <select id="Provincia" name="Provincia">
        <option value="0">Comuna</option>
        <?php
        $sql= "SELECT * From comunas WHERE idprovincias=".$_POST['id']." AND estado=1";
        $result = mysqli_query(conectar(),$sql);
        while($datos=mysqli_fetch_array($result)){
            ?>
            <option value="<?php echo $datos['idcomunas'];?>"><?php echo $datos['comuna'];?></option>
            <?php
        }
        ?>
    </select>
<?php
}
function cargars()
{
?>
    <select id="Comuna" name="Comuna">
        <option value="0">Sector</option>
        <?php
        $sql= "SELECT * From sector WHERE idcomunas=".$_POST['id']." AND estado=1";
        $result = mysqli_query(conectar(),$sql);
        while($datos=mysqli_fetch_array($result)){
            ?>
            <option value="<?php echo $datos['idsector'];?>"><?php echo $datos['sector'];?></option>
            <?php
        }
        ?>
    </select>
<?php
}

?>

