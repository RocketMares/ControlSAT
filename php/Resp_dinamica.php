<?php


if (isset($_GET["id_acceso"])) {

    require_once 'fpdf.php';
    require_once 'ConsultaADR.php';
    $id_acceso = $_GET['id_acceso'];

    $usuario_1 = new ConsultaInfoADR();
    $saca_info_responsiva = $usuario_1->saca_roles_sistemas($id_acceso);
    $roles_acceso = $usuario_1->saca_roles_sistemas_acceso($id_acceso);
    $id_empleado = $saca_info_responsiva["id_empleado_plant"];
    $id_sistema = $saca_info_responsiva["id_system"];
    $objUsuario = $usuario_1->Para_responsiva($id_empleado);
    $nombre = $objUsuario["nombre_empleado"];
    $rfc_corto = $objUsuario["rfc_corto"];
    $rfc = $objUsuario["rfc_comp"];
    $fechaAut = $objUsuario["fecha_alta"]->format('d-m-Y');
    $rfcAut = $objUsuario["user_alta"];
    $correo = $objUsuario["correo_inst"];

    $Departamento = $objUsuario["nombre_depto"];
    $admin = $objUsuario["id_admin"];
    $Aut = $usuario_1->Para_responsiva1($id_empleado,$admin);
    $puesto = $usuario_1->Saca_puesto_oficial($objUsuario["rfc_corto"]);
    $datos_sistema = $usuario_1->Consulta_sistema_responsiva($id_sistema);
    $nombreAut = $Aut["jefe"];
    $rfcAut = $Aut["rfc_jefe"];
    $CorreoAut = $Aut["correo_jefe"];
    $sistema = $datos_sistema['nombre_sistema'];

    $medidas_nombre = strlen($sistema);
    $cuentas_palabras_x_tit = str_word_count($sistema);
    $numero_roles_ac = count($roles_acceso);

    if ($medidas_nombre <= 18) {
       $medida_tituloX = 70;
      
       if ($numero_roles_ac <= 1 ) {
         if ($cuentas_palabras_x_tit != 1) {
          $Ancho_titulo_text = 10;
         }
         else {
          $Ancho_titulo_text = 20;
         }
        $Ancho_roles = 20;
     
        $ancho_escalafon = 20;
       } else if($numero_roles_ac <= 2) {
        $Ancho_roles = 10;
        if ($cuentas_palabras_x_tit != 1) {
          $Ancho_titulo_text = 10;
         }
         else {
          $Ancho_titulo_text = 20;
         }
        $ancho_escalafon = 20;
       }
       else if($numero_roles_ac <= 3) {
        $Ancho_roles = 8;
        if ($cuentas_palabras_x_tit != 1) {
          $Ancho_titulo_text = 10;
         }
         else {
          $Ancho_titulo_text = 20;
         }
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 4) {
        $Ancho_roles = 6;
        $ancho_escalafon = 24;
        if ($cuentas_palabras_x_tit != 1) {
          $Ancho_titulo_text = 10;
         }
         else {
          $Ancho_titulo_text = 24;
         }
       }
       else if($numero_roles_ac <= 5) {
        $Ancho_roles = 6;
        $ancho_escalafon = 30;
        if ($cuentas_palabras_x_tit != 1) {
          $Ancho_titulo_text = 10;
         }
         else {
          $Ancho_titulo_text = 30;
         }
       }
       
    }
    else if ($medidas_nombre >= 18  && $medidas_nombre <= 45 ) {
       $medida_tituloX = 40;

       if ($numero_roles_ac <= 1 ) {
        $Ancho_roles = 20;
        $Ancho_titulo_text = 10;
        $ancho_escalafon = 20;
       } else if($numero_roles_ac <= 2) {
        $Ancho_roles = 10;
        $Ancho_titulo_text = 20;
        $ancho_escalafon = 20;
       }
       else if($numero_roles_ac <= 3) {
        $Ancho_roles = 8;
        $Ancho_titulo_text = 20;
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 4) {
        $Ancho_roles = 6;
        $Ancho_titulo_text = 20;
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 5) {
        $Ancho_roles = 6;
        $ancho_escalafon = 30;
       }
    }
    else if ($medidas_nombre >= 45  && $medidas_nombre <= 68) {
       $medida_tituloX = 25;
       if ($numero_roles_ac <= 1 ) {
        $Ancho_roles = 20;
        $ancho_escalafon = 20;
       } else if($numero_roles_ac <= 2) {
        $Ancho_roles = 10;
        $ancho_escalafon = 20;
       }
       else if($numero_roles_ac <= 3) {
        $Ancho_roles = 8;
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 4) {
        $Ancho_roles = 6;
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 5) {
        $Ancho_roles = 6;
        $ancho_escalafon = 30;
       }
    }
    else if ($medidas_nombre >= 68  && $medidas_nombre <= 80) {
       $medida_tituloX = 15;
       if ($numero_roles_ac <= 1 ) {
        $Ancho_roles = 20;
        $ancho_escalafon = 20;
       } else if($numero_roles_ac <= 2) {
        $Ancho_roles = 10;
        $ancho_escalafon = 20;
       }
       else if($numero_roles_ac <= 3) {
        $Ancho_roles = 8;
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 4) {
        $Ancho_roles = 6;
        $ancho_escalafon = 24;
       }
       else if($numero_roles_ac <= 5) {
        $Ancho_roles = 6;
        $ancho_escalafon = 30;
       }
    }
    
    else {
      echo "no encuentro nada 0";
    }

    $domicilio = $Aut["direccion"];
    $no_empleado = $Aut['no_empleado'];
    $nombreAut_sub = $Aut["jefe_sub"];
    $rfcAut_sub = $Aut["rfc_jefe_sub"];
    $CorreoAut_sub = $Aut["correo_jefe_sub"];

   


    
    
    //Constante del FPDF de donde jala la fuentea
    define('FPDF_FONTPATH', 'font/');
    //Objeto FPDF
    $pdf = new FPDF();
    class pdf extends FPDF{
        function Header()
    {	
      require_once 'ConsultaADR.php';
      $id_acceso = $_GET['id_acceso'];
      $usuario_1 = new ConsultaInfoADR();
      $saca_info_responsiva = $usuario_1->saca_roles_sistemas($id_acceso);
      $id_empleado = $saca_info_responsiva["id_empleado_plant"];
      $id_sistema = $saca_info_responsiva["id_system"];
        switch ($id_empleado) {
        case isset($id_empleado):	
              $this->Image('../img/Cabecera_espercial.png', 10, 10, 90, 17);
              $this->SetFont('Arial', 'B', 10);
    
              $this->Text(120, 12, utf8_decode('Administraci??n Desconcentrada de Recaudaci??n'));
              $this->SetFont('Arial', '', 9);
              $this->Text(134, 16, utf8_decode('Administraci??n Desconcentrada de Recaudaci??n'));
              $this->Text(132, 20, utf8_decode('Distrito Federal "4" con sede en el Distrito Federal'));
              $this->Text(129, 24, utf8_decode('Subadministraci??n de Control y An??lisis Estrat??gico.'));
        break;
        }
    
      
    
    }
    
    function Footer()
    {	
    
      require_once 'ConsultaADR.php';
      $id_acceso = $_GET['id_acceso'];
      $usuario_1 = new ConsultaInfoADR();
      $saca_info_responsiva = $usuario_1->saca_roles_sistemas($id_acceso);
      $id_empleado = $saca_info_responsiva["id_empleado_plant"];
      $id_sistema = $saca_info_responsiva["id_system"];
        switch ($id_empleado) {
        case isset($id_empleado):	
        require_once 'ConsultaADR.php';
          $usuario_1 = new ConsultaInfoADR();
          
          $objUsuario = $usuario_1->Para_responsiva($id_empleado);
          $admin = $objUsuario["id_admin"];
          $Aut = $usuario_1->Para_responsiva1($id_empleado,$admin);
    
          $domicilio = $Aut["direccion"];
          $this->SetDrawColor(188,149,0);
        //   $this->SetLineWidth(3);
        //   $this->Line(168, 282, 20, 282);
          $this->SetFont('Arial', 'B', 7);
          $this->SetTextColor(188,149,0);
          $this->Text(10, 275, utf8_decode($domicilio.""));
          $this->Text(10, 278, utf8_decode("Marca SAT 55 627 22 728 sat.gob.mx  "));
          $this->Image('../img/margen_inst.png', 10, 278, 189, 10);
          $this->Image('../img/pie_pag,png.png', 168, 264, 30, 26);
          $this->SetTextColor(0,0,0);
          $this->SetFont('Arial', 'B', 7);
          // $this->Text(195, 286, utf8_decode( 'Pag. '. $this->PageNo()));
    
      break;
      }
    
    }
    
    }
      $pdf = new pdf();
    //Creamos un documento
    $pdf->AddPage();
    date_default_timezone_set('America/Mexico_City');
    $pdf->SetTitle("$sistema | Carta responsiva");




    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Text($medida_tituloX, 48, utf8_decode("Carta Responsiva ". $sistema.""));

    
    $pdf->Ln();
    $pdf->SetXY(25,55);
    $pdf->SetFont('Arial', '', 8);
    
    //Actual
    $pdf->MultiCell(160,4,utf8_decode("El que suscribe $nombre en mi calidad de servidor p??blico de la Administraci??n Desconcentrada de Recaudaci??n del Servicio de Administraci??n Tributaria (SAT), con n??mero de empleado $no_empleado y Registro Federal de  Contribuyentes $rfc adscrito a la Administraci??n Desconcentrada Distrito Federal 4 (Sur del D.F.) y correo electr??nico $correo, manifiesto que con la suscripci??n   de la  presente responsiva, asumo la responsabilidad del acceso y del  debido  uso  de  la  informaci??n  en el  Aplicativo o Carpeta $sistema de la Administraci??n Desconcentrada de Recaudaci??n y de la informaci??n contenida en este y del acceso que a trav??s del mismo se realice a los servicios electr??nicos del Servicio de Administraci??n Tributaria, de conformidad  con el art??culo  2, apartado B, fracci??n I y Apartado C y art??culo 3 del Reglamento Interior del Servicio de Administraci??n Tributaria y directrices  Primera, Tercera y  Cuarta, apartado  4.75., numerales  4.75.7., y  4.75.8.; apartado  4.76., numeral 4.76.6. y apartado 4.79., numerales 4.79.7. a 4.79.63. de las Directrices de Operaci??n en Materia de Seguridad de la Informaci??n aplicables a los Servidores P??blicos y Terceros del Servicio de Administraci??n Tributaria (DOMSISPTSAT)."),0,'J',0);
    
    // //Letras con negritas pero error al justificar
    // $pdf->MultiCell(160,4,$pdf->WriteHTML("<div style='text-align: justify;'". utf8_decode($html) ."</div>"),0,'J',0);
    // $html = "<p class='text-left' >El que suscribe <b>$nombre</b> en mi calidad de servidor p??blico de la Administraci??n Desconcentrada de Recaudaci??n del Servicio de Administraci??n Tributaria (SAT), con n??mero de empleado <b>$no_empleado</b> y Registro Federal de  Contribuyentes <b>$rfc</b> adscrito a la Administraci??n Desconcentrada Distrito Federal 4 (Sur del D.F.) y correo electr??nico <b>$correo</b>, manifiesto que con la suscripci??n   de la  presente responsiva, asumo la responsabilidad del acceso y del  debido  uso  de  la  informaci??n  en el  Aplicativo o Carpeta <b>$sistema</b> de la Administraci??n General de Recaudaci??n y de la informaci??n contenida en este y del acceso que a trav??s del mismo se realice a los servicios electr??nicos del Servicio de Administraci??n Tributaria, de conformidad  con el art??culo  2, apartado B, fracci??n I y Apartado C y art??culo 3 del Reglamento Interior del Servicio de Administraci??n Tributaria y directrices  Primera, Tercera y  Cuarta, apartado  4.75., numerales  4.75.7., y  4.75.8.; apartado  4.76., numeral 4.76.6. y apartado 4.79., numerales 4.79.7. a 4.79.63. de las Directrices de Operaci??n en Materia de Seguridad de la Informaci??n aplicables a los Servidores P??blicos y Terceros del Servicio de Administraci??n Tributaria (DOMSISPTSAT).</p>";
    
    $pdf->SetFillColor(191,191,191);
     $pdf->SetXY(25,112);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(30,8,utf8_decode('RFC USUARIO ACCESO'),1,'C',1);
    $pdf->SetXY(55,112);
    $pdf->MultiCell(70,16,utf8_decode('NOMBRE DEL ANALISTA'),1,'C',1);
    $pdf->SetXY(125,112);
    $pdf->MultiCell(30,16,utf8_decode('SISTEMA'),1,'C',1);
    $pdf->SetXY(155,112);
    $pdf->MultiCell(30,16,utf8_decode('ROL/PRIVILEGIO'),1,'C',1);
    $pdf->SetXY(25,128);
    $pdf->SetFont('Arial','B', 9);
    $pdf->MultiCell(30,$ancho_escalafon,utf8_decode($rfc_corto),1,'C',0);
    $pdf->SetXY(55,128);
    $pdf->SetFont('Arial','B', 7);
    $pdf->Cell(70,$ancho_escalafon,utf8_decode($nombre),1,0,'C',0);
    $pdf->SetXY(125,128);
    $pdf->SetFont('Arial','B', 8);
    $pdf->MultiCell(30,10,utf8_decode($sistema),1,'C',0);
    $pdf->SetXY(155,128);
    $pdf->SetFont('Arial','B', 8);
    $a ='';
    for ($i=0; $i < count($roles_acceso) ; $i++) { 
       $a .= "- ".$roles_acceso[$i]['nombre_rol']."\n";
    }
    $pdf->MultiCell(30,20,utf8_decode($a),1,'L',0);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(25);
    $pdf->MultiCell(160, 4, utf8_decode('Asimismo, como resguardante de mi equipo de c??mputo y del acceso y uso de la informaci??n contenida en el Aplicativo autorizado soy responsable de su conservaci??n, del contenido de los archivos existentes, as?? como, de la integralidad y confidencialidad de la informaci??n y de la que se genere a partir de este momento, as?? como de realizar las gestiones previstas en la normatividad aplicable en caso de da??o, robo o extrav??o. Tambi??n  quedo  apercibido de  las  responsabilidades   administrativas  y/o  penales  en   las  que   puedo  incurrir y de las sanciones a que puedo hacerme acreedor en caso de divulgar, sustraer, ocultar, inutilizar, revelar, comunicar, modificar, destruir, provocar p??rdida o copiar informaci??n a trav??s  de  los  privilegios  en  forma indebida y sin autorizaci??n  para  ello, en  t??rminos de  lo previsto  en  los  art??culos 7; 49  fracci??n  V; 55; 75 y  78 de la Ley General de Responsabilidades Administrativas; 270, 277, 277 bis 7,277 bis 2, 277 bis 3,277 bis 4, 277 bis 5 y 274, fracci??n IV, del C??digo Penal Federal y Directrices Quinta y Sexta de las DOMSISPTSAT.'), 0, 'J');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(25);
    $pdf->MultiCell(160, 4, utf8_decode('De igual forma, manifiesto tener conocimiento de que los activos de informaci??n a los que  tenga acceso a trav??s de la cuenta de usuario que me ha sido asignada en este acto, son propiedad del Servicio de Administraci??n Tributaria y que los privilegios de informaci??n me son otorgados para el desempe??o exclusivo de las funciones que me han sido encomendadas, as?? como aquellas que sean designadas de forma directa por necesidades del servicio y forman  parte  de  informaci??n confidencial, lo anterior, con fundamento en los art??culos 773 y 7??6 de la Ley General de Transparencia y Acceso a la Informaci??n P??blica; 770, 773 de la Ley Federal de Transparencia y Acceso a la Informaci??n en relaci??n con el art??culo 69 del C??digo Fiscal de la Federaci??n, Art??culo 3, fracciones X y XXXIII y 37 de la Ley General de Protecci??n de Datos Personales  en Posesi??n  de Sujetos Obligados; art??culo 3, p??rrafo primero del RISAT; aunado a lo anterior, la fracci??n Vil del art??culo 2 de la Ley Federal de los Derechos del Contribuyente.'), 0, 'J');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->AddPage(); //Creamos un documento
    $pdf->SetXY(25,30);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(160, 4, utf8_decode('Por lo anterior, tengo conocimiento y entendimiento de la obligaci??n de dar cumplimiento a la normatividad aplicable para el adecuado uso de la cuenta de usuario y contrase??a y de la informaci??n del aplicativo, as?? como de guardar absoluta y estricta confidencialidad sobre las mismas. Del mismo modo, acepto que mi usuario y contrase??a est??n sujetos a monitoreo y podr??n ser auditados en cualquier momento, por lo que autorizo al SAT para llevar a cabo la extracci??n, uso, presentaci??n y/o aportaci??n de toda la informaci??n existente, la que se genere a partir de este momento, incluida la de car??cter personal que se encuentre en el Puesto de Servicio.'), 0, 'J');
    $pdf->SetXY(25,60);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(160, 4, utf8_decode('El que suscribe est?? obligado a utilizar los roles que me han sido autorizados exclusivamente para el desempe??o de las funciones que me son encomendadas. Adicionalmente me comprometo a solicitar en tiempo y forma la baja de claves y roles en caso de que concluya mis actividades en el ??rea de adscripci??n por las que me fueron asignados los roles de acceso a la informaci??n.'), 0, 'J');
    $pdf->Ln();
    $pdf->SetXY(25,80);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(160, 4, utf8_decode('En este mismo acto, asumo el compromiso legal y buen uso de la cuenta de usuario y me obligo a no revelarlas bajo ning??n concepto, declar??ndome responsable de su uso y de la informaci??n que con ellas se conozca, sustraiga, modifique o altere que pertenecen al Servicio de Administraci??n.'), 0, 'J');
    $pdf->SetXY(25,100);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(191,191,191);
    $pdf->Cell(160,8,utf8_decode('Informaci??n del Solicitante y del Superior Jer??rquico que Autoriza'),1,0,'C',1);
    $pdf->Ln();
    $pdf->SetX(25);
    $pdf->MultiCell(45, 6, utf8_decode('Unidad administrativa de adscripci??n del usuario'), 1, 'C',1);
    $pdf->SetXY(70,108);
    $pdf->Cell(115,12,utf8_decode('Administraci??n desconcentrada Distrito Federal 4(Sur del D.F.)'),1,0,'C',0);
    $pdf->Ln();
    $pdf->SetX(25);
    $pdf->MultiCell(45, 6, utf8_decode('Domicilio de la Unidad Administrativa'), 1, 'C',1);
    $pdf->SetXY(70,120);
    $pdf->Cell(115,12,utf8_decode($domicilio),1,0,'C',0);
    $pdf->Ln();
    $pdf->SetX(25);

    $pdf->Cell(45,8,utf8_decode('Puesto'),1,0,'C',1);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetX(70);
    $pdf->Cell(115,8,utf8_decode($puesto['nombre_puesto']),1,0,'C',0);
    $pdf->Ln();
    $pdf->SetX(25);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->MultiCell(45,16,utf8_decode('RFC CORTO del Solicitante.'),1,'C',1);
    $pdf->SetXY(70,140);
    $pdf->Cell(115,16,utf8_decode($rfc_corto ),1,0,'C',0);
    $pdf->SetXY(25,156);
    $pdf->MultiCell(45,8,utf8_decode('FECHA'),1,'C',1);
    $pdf->SetXY(70,156);
    $pdf->Cell(115,8,utf8_decode(''),1,0,'C',0);
    $pdf->Ln();
    $pdf->SetX(25);
    $pdf->MultiCell(45,8,utf8_decode('NOMBRE Y FIRMA DEL USUARIO'),1,'C',1);
    $pdf->SetXY(70,164);
    $pdf->Cell(115,16,utf8_decode(''),1,0,'C',0);
    $pdf->Ln();
    $pdf->SetX(25);
    if ($puesto['nombre_puesto'] == "SUBADMINISTRADOR DESCONCENTRADO METROPOLITANO DE REGISTRO Y CONTROL") {
          $pdf->MultiCell(45,8,utf8_decode('RFC corto del Administrador vigente'),1,'C',1);
          $pdf->SetXY(70,180);
          $pdf->Cell(115,16,utf8_decode($rfcAut),1,0,'C',0);
          $pdf->Ln();
          $pdf->SetX(25);
          $pdf->MultiCell(45,7,utf8_decode('Nombre y firma del Administrador que autoriza uso del aplicativo.'),1,'C',1);
          $pdf->SetXY(70,196);
          $pdf->Cell(115,21,utf8_decode(""),1,0,'C',0);
          $pdf->Ln();     
  
    }
    elseif ( $puesto['nombre_puesto'] == "ANALISTA DESCONCENTRADO DE COBRANZA" && $puesto['puesto_funcional'] == "ENCARGADO DEL DEPARTAMENTO") {
      $pdf->MultiCell(45,8,utf8_decode('RFC corto del Subadministrador Autorizador'),1,'C',1);
      $pdf->SetXY(70,180);
      $pdf->Cell(115,16,utf8_decode($rfcAut),1,0,'C',0);
      $pdf->Ln();
      $pdf->SetX(25);
      $pdf->MultiCell(45,7,utf8_decode('Nombre y firma del Subadministrador que autoriza uso del aplicativo.'),1,'C',1);
      $pdf->SetXY(70,196);
      $pdf->Cell(115,21,utf8_decode(""),1,0,'C',0);
      $pdf->Ln();
      $pdf->SetX(25);
      $pdf->MultiCell(45,8,utf8_decode('RFC corto del Administrador vigente'),1,'C',1);
      $pdf->SetXY(70,217);
      $pdf->Cell(115,16,utf8_decode($rfcAut_sub),1,0,'C',0);
      $pdf->Ln();
      $pdf->SetX(25);
      $pdf->MultiCell(45,7,utf8_decode('Nombre y firma del Administrador que autoriza uso del aplicativo.'),1,'C',1);
      $pdf->SetXY(70,233);
      $pdf->Cell(115,21,utf8_decode(""),1,0,'C',0);
      $pdf->Ln();     

    }
    elseif ($puesto['nombre_puesto'] == "ADMINISTRADOR DESCONCENTRADO METROPOLITANO DE RECAUDACI??N") {
      $pdf->Ln();
    }
     else {
      $pdf->MultiCell(45,8,utf8_decode('RFC corto del Jefe Deparamental'),1,'C',1);
      $pdf->SetXY(70,180);
      $pdf->Cell(115,16,utf8_decode($rfcAut),1,0,'C',0);
      $pdf->Ln();
      $pdf->SetX(25);
      $pdf->MultiCell(45,7,utf8_decode('Nombre y firma del Jefe departamental que autoriza uso del aplicativo.'),1,'C',1);
      $pdf->SetXY(70,196);
      $pdf->Cell(115,21,utf8_decode(""),1,0,'C',0);
      $pdf->Ln();
      $pdf->SetX(25);
      $pdf->MultiCell(45,8,utf8_decode('RFC corto del Subadministrador Autorizador'),1,'C',1);
      $pdf->SetXY(70,217);
      $pdf->Cell(115,16,utf8_decode($rfcAut_sub),1,0,'C',0);
      $pdf->Ln();
      $pdf->SetX(25);
      $pdf->MultiCell(45,7,utf8_decode('Nombre y firma del Subadministrador que autoriza uso del aplicativo.'),1,'C',1);
      $pdf->SetXY(70,233);
      $pdf->Cell(115,21,utf8_decode(""),1,0,'C',0);
      $pdf->Ln();

    }
    

   
    $pdf->Ln();
    $pdf->Close();
    $pdf->Output("$sistema"."_"."$nombre.pdf",'I');
}

?>