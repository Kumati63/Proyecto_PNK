<?php

    // FUNCIÓN PARA CONECTAR A LA BASE DE DATOS
    function conectar(){
        $con=mysqli_connect(
            "localhost",    //servidor
            "root",         //usuario  
            "",             //contrasena
            "proyecto_pnk3"  //base de datos
        );
        return $con;
    }



    function uf()
{
    $apiUrl = 'https://mindicador.cl/api';
    $json = false;
    
    // Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
    if (ini_get('allow_url_fopen')) {
        $json = file_get_contents($apiUrl);
    } else {
        // De otra forma utilizamos cURL
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
        curl_close($curl);
    }

    if ($json === false) {
        echo "Error al obtener los datos de la API.";
        return null; // Devolver null en caso de error
    }
    
    $dailyIndicators = json_decode($json);
    if ($dailyIndicators === null || !isset($dailyIndicators->uf->valor)) {
        echo "Error al decodificar el JSON o valor de UF no encontrado.";
        return null; // Devolver null en caso de error
    }
    
    return $dailyIndicators->uf->valor; // Devolver el valor de la UF
}

?>