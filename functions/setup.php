<?php

    // FUNCIÓN PARA CONECTAR A LA BASE DE DATOS
    function conectar(){
        $con=mysqli_connect(
            "localhost",    //servidor
            "root",         //usuario  
            "",             //contrasena
            "proyecto_pnk"  //base de datos
        );
        return $con;
    }

?>