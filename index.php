<?php

session_start();

if(isset($_SESSION['usu']))
{
    switch($_SESSION['tipo']){
        case 1: $tipo=1;
            header("Location:front_page.php");
            exit();
        case 2: $tipo=2;
            header("Location:front_page.php");
            exit();
        case 3: $tipo=3;
            header("Location:front_page.php");
            exit();
        default:
            header("Location:front_page.php");
            exit();
    }
?>

<?php
}else{
    header("Location:front_page.html");
    exit();
}
?>