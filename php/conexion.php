<?php

 class ConexionSQL
 {
     public function ObtenerConexionBD()
     {
        $BD_NAME = 'Control_Ingresos';
        $USER = 'Analisis';
        $pass = 'Malitos20';
       // $ServerName = '99.85.26.227';
        //$ServerName = '99.85.24.8';
        $ServerName = 'DESKTOP-4Q2P8VT\SQLEXPRESS';
        $connectionInfo = ['Database' => "$BD_NAME",
         'CharacterSet' => 'UTF-8', 'UID' => "$USER", 'PWD' => "$pass", ];
        //Se prepara la conexi�n
        $con = sqlsrv_connect($ServerName, $connectionInfo);
         return $con;
     }
     public function ObtenerConexionBD2()
     {
        $BD_NAME = 'COMUNICADOS';
        $USER = 'Analisis';
        $pass = 'Malitos20';
        //$ServerName = '99.85.26.227';
        $ServerName = '99.85.24.8';
        //$ServerName = 'DESKTOP-4Q2P8VT\SQLEXPRESS';
        $connectionInfo = ['Database' => "$BD_NAME",
         'CharacterSet' => 'UTF-8', 'UID' => "$USER", 'PWD' => "$pass", ];
        //Se prepara la conexi�n
        $con = sqlsrv_connect($ServerName, $connectionInfo);
         return $con;
     }
     public function ObtenerConexionBD3()
     {
        $BD_NAME = 'GestorSat';
        $USER = 'gestorUser';
        $pass = 'Alva%1999';
        //$ServerName = '99.85.26.227';
        $ServerName = '99.85.25.255';
        //$ServerName = 'DESKTOP-4Q2P8VT\SQLEXPRESS';
        $connectionInfo = ['Database' => "$BD_NAME",
         'CharacterSet' => 'UTF-8', 'UID' => "$USER", 'PWD' => "$pass", ];
        //Se prepara la conexi�n
        $con = sqlsrv_connect($ServerName, $connectionInfo);
         return $con;
     }

     public function CerrarConexion($con)
     {
         sqlsrv_close($con);
         
     }
 }
