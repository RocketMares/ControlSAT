

<?php
if (isset($_GET["id_usuario"])) {

    require_once 'fpdf.php';
    require_once 'MetodosUsuarios.php';
    $id_empleado = $_GET["id_usuario"];

    $usuario_1 = new MetodosUsuarios();
    $objUsuario = $usuario_1->Para_responsiva($id_empleado);
    $nombre = $objUsuario["nombre_empleado"];
    $rfc_corto = $objUsuario["rfc_corto"];
    $rfc = $objUsuario["RFC"];
    $fechaAut = $objUsuario["fecha_alta"]->format('d-m-Y');
    $rfcAut = $objUsuario["user_alta"];
    $correo = $objUsuario["correo"];
    $Perfil = $objUsuario["nombre_perfil"];
    $Departamento = $objUsuario["nombre_depto"];
    $admin = $objUsuario["id_admin"];
    $Aut = $usuario_1->Para_responsiva1($id_empleado,$admin);
    $puesto = $usuario_1->Saca_puesto_oficial($objUsuario["rfc_corto"]);
    $nombreAut = $Aut["jefe"];
    $rfcAut = $Aut["rfc_jefe"];
    $CorreoAut = $Aut["correo_jefe"];
    $sistema = 'Control de Ingresos del Personal SAT';
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
        switch ($_GET) {
        case isset($_GET['id_usuario']):	
              $this->Image('../img/Cabecera_espercial.png', 10, 10, 90, 17);
              $this->SetFont('Arial', 'B', 10);
    
              $this->Text(120, 12, utf8_decode('Administración Desconcentrada de Recaudación'));
              $this->SetFont('Arial', '', 9);
              $this->Text(134, 16, utf8_decode('Administración Desconcentrada de Recaudación'));
              $this->Text(132, 20, utf8_decode('Distrito Federal "4" con sede en el Distrito Federal'));
              $this->Text(129, 24, utf8_decode('Subadministración de Control y Análisis Estratégico.'));
        break;
        }
    
      
    
    }
    
    function Footer()
    {	
    
      switch ($_GET) {

        
      case isset($_GET['id_usuario']):
          include_once 'MetodosUsuarios.php';
          $usuario_1 = new MetodosUsuarios();
          $id_empleado = $_GET["id_usuario"];
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
    $pdf->Text(50, 48, utf8_decode("Carta Responsiva ". $sistema.""));

    
    $pdf->Ln();
    $pdf->SetXY(25,55);
    $pdf->SetFont('Arial', '', 8);
    
    //Actual
    $pdf->MultiCell(160,4,utf8_decode("El que suscribe $nombre en mi calidad de servidor público de la Administración Desconcentrada de Recaudación del Servicio de Administración Tributaria (SAT), con número de empleado $no_empleado y Registro Federal de  Contribuyentes $rfc adscrito a la Administración Desconcentrada Distrito Federal 4 (Sur del D.F.) y correo electrónico $correo, manifiesto que con la suscripción   de la  presente responsiva, asumo la responsabilidad del acceso y del  debido  uso  de  la  información  en el  Aplicativo o Carpeta $sistema de la Administración Desconcentrada de Recaudación y de la información contenida en este y del acceso que a través del mismo se realice a los servicios electrónicos del Servicio de Administración Tributaria, de conformidad  con el artículo  2, apartado B, fracción I y Apartado C y artículo 3 del Reglamento Interior del Servicio de Administración Tributaria y directrices  Primera, Tercera y  Cuarta, apartado  4.75., numerales  4.75.7., y  4.75.8.; apartado  4.76., numeral 4.76.6. y apartado 4.79., numerales 4.79.7. a 4.79.63. de las Directrices de Operación en Materia de Seguridad de la Información aplicables a los Servidores Públicos y Terceros del Servicio de Administración Tributaria (DOMSISPTSAT)."),0,'J',0);
    
    // //Letras con negritas pero error al justificar
    // $pdf->MultiCell(160,4,$pdf->WriteHTML("<div style='text-align: justify;'". utf8_decode($html) ."</div>"),0,'J',0);
    // $html = "<p class='text-left' >El que suscribe <b>$nombre</b> en mi calidad de servidor público de la Administración Desconcentrada de Recaudación del Servicio de Administración Tributaria (SAT), con número de empleado <b>$no_empleado</b> y Registro Federal de  Contribuyentes <b>$rfc</b> adscrito a la Administración Desconcentrada Distrito Federal 4 (Sur del D.F.) y correo electrónico <b>$correo</b>, manifiesto que con la suscripción   de la  presente responsiva, asumo la responsabilidad del acceso y del  debido  uso  de  la  información  en el  Aplicativo o Carpeta <b>$sistema</b> de la Administración General de Recaudación y de la información contenida en este y del acceso que a través del mismo se realice a los servicios electrónicos del Servicio de Administración Tributaria, de conformidad  con el artículo  2, apartado B, fracción I y Apartado C y artículo 3 del Reglamento Interior del Servicio de Administración Tributaria y directrices  Primera, Tercera y  Cuarta, apartado  4.75., numerales  4.75.7., y  4.75.8.; apartado  4.76., numeral 4.76.6. y apartado 4.79., numerales 4.79.7. a 4.79.63. de las Directrices de Operación en Materia de Seguridad de la Información aplicables a los Servidores Públicos y Terceros del Servicio de Administración Tributaria (DOMSISPTSAT).</p>";
    
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
    $pdf->MultiCell(30,18,utf8_decode($rfc_corto),1,'C',0);
    $pdf->SetXY(55,128);
    $pdf->SetFont('Arial','U', 7);
    $pdf->Cell(70,18,utf8_decode($nombre),1,0,'C',0);
    $pdf->SetXY(125,128);
    $pdf->SetFont('Arial','U', 7);
    $pdf->MultiCell(30,9,utf8_decode($sistema),1,'C',0);
    $pdf->SetXY(155,128);
    $pdf->SetFont('Arial','U', 8);
    $pdf->MultiCell(30,18,utf8_decode($Perfil),1,'C',0);
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(25);
    $pdf->MultiCell(160, 4, utf8_decode('Asimismo, como resguardante de mi equipo de cómputo y del acceso y uso de la información contenida en el Aplicativo autorizado soy responsable de su conservación, del contenido de los archivos existentes, así como, de la integralidad y confidencialidad de la información y de la que se genere a partir de este momento, así como de realizar las gestiones previstas en la normatividad aplicable en caso de daño, robo o extravío. También  quedo  apercibido de  las  responsabilidades   administrativas  y/o  penales  en   las  que   puedo  incurrir y de las sanciones a que puedo hacerme acreedor en caso de divulgar, sustraer, ocultar, inutilizar, revelar, comunicar, modificar, destruir, provocar pérdida o copiar información a través  de  los  privilegios  en  forma indebida y sin autorización  para  ello, en  términos de  lo previsto  en  los  artículos 7; 49  fracción  V; 55; 75 y  78 de la Ley General de Responsabilidades Administrativas; 270, 277, 277 bis 7,277 bis 2, 277 bis 3,277 bis 4, 277 bis 5 y 274, fracción IV, del Código Penal Federal y Directrices Quinta y Sexta de las DOMSISPTSAT.'), 0, 'J');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetX(25);
    $pdf->MultiCell(160, 4, utf8_decode('De igual forma, manifiesto tener conocimiento de que los activos de información a los que  tenga acceso a través de la cuenta de usuario que me ha sido asignada en este acto, son propiedad del Servicio de Administración Tributaria y que los privilegios de información me son otorgados para el desempeño exclusivo de las funciones que me han sido encomendadas, así como aquellas que sean designadas de forma directa por necesidades del servicio y forman  parte  de  información confidencial, lo anterior, con fundamento en los artículos 773 y 7Í6 de la Ley General de Transparencia y Acceso a la Información Pública; 770, 773 de la Ley Federal de Transparencia y Acceso a la Información en relación con el artículo 69 del Código Fiscal de la Federación, Artículo 3, fracciones X y XXXIII y 37 de la Ley General de Protección de Datos Personales  en Posesión  de Sujetos Obligados; artículo 3, párrafo primero del RISAT; aunado a lo anterior, la fracción Vil del artículo 2 de la Ley Federal de los Derechos del Contribuyente.'), 0, 'J');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->AddPage();        //Creamos un documento
    $pdf->SetXY(25,30);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(160, 4, utf8_decode('Por lo anterior, tengo conocimiento y entendimiento de la obligación de dar cumplimiento a la normatividad aplicable para el adecuado uso de la cuenta de usuario y contraseña y de la información del aplicativo, así como de guardar absoluta y estricta confidencialidad sobre las mismas. Del mismo modo, acepto que mi usuario y contraseña están sujetos a monitoreo y podrán ser auditados en cualquier momento, por lo que autorizo al SAT para llevar a cabo la extracción, uso, presentación y/o aportación de toda la información existente, la que se genere a partir de este momento, incluida la de carácter personal que se encuentre en el Puesto de Servicio.'), 0, 'J');
    $pdf->SetXY(25,60);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(160, 4, utf8_decode('El que suscribe está obligado a utilizar los roles que me han sido autorizados exclusivamente para el desempeño de las funciones que me son encomendadas. Adicionalmente me comprometo a solicitar en tiempo y forma la baja de claves y roles en caso de que concluya mis actividades en el área de adscripción por las que me fueron asignados los roles de acceso a la información.'), 0, 'J');
    $pdf->Ln();
    $pdf->SetXY(25,80);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(160, 4, utf8_decode('En este mismo acto, asumo el compromiso legal y buen uso de la cuenta de usuario y me obligo a no revelarlas bajo ningún concepto, declarándome responsable de su uso y de la información que con ellas se conozca, sustraiga, modifique o altere que pertenecen al Servicio de Administración.'), 0, 'J');
    $pdf->SetXY(25,100);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetFillColor(191,191,191);
    $pdf->Cell(160,8,utf8_decode('Información del Solicitante y del Superior Jerárquico que Autoriza'),1,0,'C',1);
    $pdf->Ln();
    $pdf->SetX(25);
    $pdf->MultiCell(45, 6, utf8_decode('Unidad administrativa de adscripción del usuario'), 1, 'C',1);
    $pdf->SetXY(70,108);
    $pdf->Cell(115,12,utf8_decode('Administración desconcentrada Distrito Federal 4(Sur del D.F.)'),1,0,'C',0);
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
    elseif ($puesto['nombre_puesto'] == "ADMINISTRADOR DESCONCENTRADO METROPOLITANO DE RECAUDACIÓN") {
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
