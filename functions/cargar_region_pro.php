<?php

include("functions/setup.php");


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
        <select id="region" name="region" class="form-control">
        <option value="0">Seleccionar</option>
        <?php

        $sql="select * from provincias where idregion=".$_POST['id']." and estado=1";
        $result=mysqli_query(conectar(),$sql);
        while($datos=mysqli_fetch_array($result))
        {
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

        <select id="comuna" name="comuna" class="form-control">
        <option value="0">Seleccionar</option>
        <?php

        $sql="select * from comunas where idprovincias=".$_POST['id']." and estado=1";
        $result=mysqli_query(conectar(),$sql);
        while($datos=mysqli_fetch_array($result))
        {
            ?>
            <option value="<?php echo $datos['idcomunas'];?>"><?php echo $datos['comuna'];?></option>
        <?php
        }
        ?>
        </select>
<?php
}

function cargarp()
{
?>
        <select id="sector" name="sector" class="form-control">
        <option value="0">Seleccionar</option>
        <?php

        $sql="select * from sector where idsector=".$_POST['id']." and estado=1";
        $result=mysqli_query(conectar(),$sql);
        while($datos=mysqli_fetch_array($result))
        {
            ?>
            <option value="<?php echo $datos['idprovincias'];?>"><?php echo $datos['provincia'];?></option>
        <?php
        }
        ?>
        </select>
<?php
}
?>