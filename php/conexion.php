<?php

 class ConexionSQL
 {
     public function ObtenerConexionBD()
     {
        $BD_NAME = 'Control_Ingresos';
        $USER = 'Analisis';
        $pass = 'Malitos20';
        //$ServerName = '99.85.24.8';
        $ServerName = 'DESKTOP-4Q2P8VT\SQLEXPRESS';
        $connectionInfo = ['Database' => "$BD_NAME",
         'CharacterSet' => 'UTF-8', 'UID' => "$USER", 'PWD' => "$pass", ];
        //Se prepara la conexi�n
        $con = sqlsrv_connect($ServerName, $connectionInfo);
        // if ($con) {
        //     echo "Hay conexion" ;        
        
        // }
        // else {
        //     echo "No entra <br>";
        //     die( print_r( sqlsrv_errors(), true));
        // }
         return $con;
     }

     public function CerrarConexion($con)
     {
         sqlsrv_close($con);
         
     }
 }
