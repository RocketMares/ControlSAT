<?php

if (isset($_POST['RFC'])) {
   $datos = $_POST['RFC'];
    $divi = str_split($datos);
switch ($divi) {// Seleccion del mes 
    case $divi[6]== 0 && $divi[7] == 1:
        $mes = 1;
    break;
    case $divi[6]== 0 && $divi[7] == 2:
        $mes = 2;
    break;
    case $divi[6]== 0 && $divi[7] == 3:
        $mes = 3;
        break;
    case $divi[6]== 0 && $divi[7] == 4:
        $mes = 4;
    break;
    case $divi[6]== 0 && $divi[7] == 5:
        $mes = 5;
    break;
    case $divi[6]== 0 && $divi[7] == 6:
        $mes = 6;
        break;
    case $divi[6]== 0 && $divi[7] == 7:
        $mes = 7;
        break;
    case $divi[6]== 0 && $divi[7] == 8:
        $mes = 8;
    break;
    case $divi[6]== 0 && $divi[7] == 9:
        $mes = 9;
    break;
    case $divi[6]== 1 && $divi[7] == 0:
        $mes = 'A';
    break;
    case $divi[6]== 1 && $divi[7] == 1:
        $mes = 'B';
        break;
    case $divi[6]== 1 && $divi[7] == 2:
        $mes = 'C';
    break;
    
    }
    // Seleccion del dia
    if ($divi[8]== 0 && $divi[9] == 1) {
        $dia = 1;
    }
    if ($divi[8]== 0 && $divi[9] == 2) {
        $dia = 2;
    }
    if ($divi[8]== 0 && $divi[9] == 3) {
        $dia = 3;
    }
    if ($divi[8]== 0 && $divi[9] == 4) {
        $dia = 4;
    }
    if ($divi[8]== 0 && $divi[9] == 5) {
        $dia = 5;
    }
    if ($divi[8]== 0 && $divi[9] == 6) {
        $dia = 6;
    }
    if ($divi[8]== 0 && $divi[9] == 7) {
        $dia = 7;
    }
    if ($divi[8]== 0 && $divi[9] == 8) {
        $dia = 8;
    }
    if ($divi[8]== 0 && $divi[9] == 9) {
        $dia = 9;
    }
    if ($divi[8]== 1 && $divi[9] == 0) {
        $dia = 'A';
    }
    if ($divi[8]== 1 && $divi[9] == 1) {
        $dia = 'B';
    }

    if ($divi[8]== 1 && $divi[9] == 2) {
        $dia = 'C';
    }
    if ($divi[8]== 1 && $divi[9] == 3) {
        $dia = 'D';
    }
    if ($divi[8]== 1 && $divi[9] == 4) {
        $dia = 'E';
    }
    if ($divi[8]== 1 && $divi[9] == 5) {
        $dia = 'F';
    }

    if ($divi[8]== 1 && $divi[9] == 6) {
        $dia = 'G';
    }
    if ($divi[8]== 1 && $divi[9] == 7) {
        $dia = 'H';
    }
    if ($divi[8]== 1 && $divi[9] == 8) {
        $dia = 'I';
    }
    if ($divi[8]== 1 && $divi[9] == 9) {
        $dia = 'J';
    }
    if ($divi[8]== 2 && $divi[9] == 0) {
        $dia = 'K';
    }
    if ($divi[8]== 2 && $divi[9] == 1) {
        $dia = 'L';
    }
    if ($divi[8]== 2 && $divi[9] == 2) {
        $dia = 'M';
    }
    if ($divi[8]== 2 && $divi[9] == 3) {
        $dia ='N';
    }
    if ($divi[8]== 2 && $divi[9] == 4) {
        $dia = 'O';
    }
    if ($divi[8]== 2 && $divi[9] == 5) {
        $dia = 'P';
    }
    if ($divi[8]== 2 && $divi[9] == 6) {
        $dia = 'Q';
    }
    if ($divi[8]== 2 && $divi[9] == 7) {
        $dia = 'R';
    }
    if ($divi[8]== 2 && $divi[9] == 8) {
        $dia = 'S';
    }
    if ($divi[8]== 2 && $divi[9] == 9) {
        $dia = 'T';
    }
    if ($divi[8]== 3 && $divi[9] == 0) {
        $dia = 'U';
    }
    if ($divi[8]== 3 && $divi[9] == 1) {
        $dia = 'V';
    }
    $Rfc_letras =$divi[0].$divi[1].$divi[2].$divi[3]; // Primeras 4 letras del RFC
    $año = $divi[4].$divi[5]; // Año de nacimiento del usuario ejem: 2001 = 01 ,1995 = 95... 
    $rfc_corto = $Rfc_letras.$año.$mes.$dia; // Se concatena de la siguiente manera 

    echo $rfc_corto;

}

?>