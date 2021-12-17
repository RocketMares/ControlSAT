<?php
if (isset($_GET["id_usuario"])) {
  $oficio = $_GET['oficio'];
    require_once 'fpdf.php';
    require_once 'ConsultaADR.php';
    $id_empleado = $_GET["id_usuario"];
    $usuario_1 = new ConsultaInfoADR();
    $deter = $usuario_1->Dame_el_numero_de_oficio($oficio);
    $nombre_subadministrador = $usuario_1->dame_el_encargado_sub_actual($id_empleado);
    $nombre_administrador = $usuario_1->dame_el_encargado_admin_actual($id_empleado);
    $oficio_compilado = $deter['determinante'];
    $nom_sub_encarg = $nombre_subadministrador['nombre_sub'];
    $nombre_honorario = $nombre_subadministrador['nombre_honor'];
    $est_esco = $nombre_subadministrador['estatus_escolaridad'];
    $nom_admin_encarg = $nombre_administrador['nombre_sub'];
    $nombre_honorario_admin = $nombre_administrador['nombre_honor'];
    $est_esco_admin = $nombre_administrador['estatus_escolaridad'];
    $puesto = $nombre_administrador['nombre_puesto'];
    $objUsuario = $usuario_1->info_datos_us_2($id_empleado);
    $nombre = $objUsuario["nombre_s"];
    $genero = $objUsuario["Genero"];
    $apellidoP = $objUsuario["apellido_p"];
    $apellidoM = $objUsuario["apellido_m"];
    $rfc_corto = $objUsuario["rfc_corto"];
    $rfc = $objUsuario["rfc_comp"];
    $fechaAut = $objUsuario["fecha_alta"]->format('d-m-Y');
    $correo = $objUsuario["correo_inst"];
    $Departamento = $objUsuario["nombre_depto"];
    $Sub_admin = $objUsuario["nombre_sub_admin"];
    $admin = $objUsuario["nombre_admin"];

    date_default_timezone_set('America/Mexico_City');
    $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
    $Fecha_hoy=date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
 
    // $Aut = $usuario_1->Para_responsiva1($id_empleado,$admin);
    // $nombreAut = $Aut["jefe"];
    // $rfcAut = $Aut["rfc_jefe"];
    // $CorreoAut = $Aut["correo_jefe"];
    // $sistema = 'Control de Ingresos SAT';
    // $domicilio = $Aut["direccion"];
    // $no_empleado = $Aut['no_empleado'];
  
    //Constante del FPDF de donde jala la fuente
    define('FPDF_FONTPATH', 'font/');
    //Objeto FPDF
    $pdf = new FPDF();
    class pdf extends FPDF{
        function Header()
    {	
        switch ($_GET) {
        case isset($_GET['id_usuario']):	
          $this->AddFont('Montserrat-Bold','','Montserrat-Bold.php');
              $this->Image('../img/Cabecera.png', 10, 10, 90, 17);
              $this->SetFont('Montserrat-Bold', '', 10);
              $this->Text(118, 12, utf8_decode('Administración Desconcentrada de Recaudación'));
              $this->AddFont('Montserrat-Light','','Montserrat-Light.php');
              $this->SetFont('Montserrat-Light', '', 10);
              $this->Text(122, 16, utf8_decode('Administración Desconcentrada de Recaudación'));
              $this->Text(122, 20, utf8_decode('Distrito Federal "4" con sede en el Distrito Federal'));
              $this->Text(118, 24, utf8_decode('Subadministración de Control y Análisis Estratégico.'));
        break;
        }
    
      
    
    }
    
    function Footer()
    {	
    
      switch ($_GET) {

        
      case isset($_GET['id_usuario']):
          include_once 'ConsultaADR.php';
          $usuario_1 = new ConsultaInfoADR();
          $id_empleado = $_GET["id_usuario"];
          $objUsuario = $usuario_1->info_datos_us_2($id_empleado);
          $admin = $objUsuario["id_admin"];
          $Aut = $usuario_1->info_datos_us_2($id_empleado);
    
          $domicilio = $Aut["direccion"];
          $this->SetDrawColor(188,149,0);
        //   $this->SetLineWidth(3);
        //   $this->Line(168, 282, 20, 282);
        $this->AddFont('Montserrat-Light','','Montserrat-Light.php');
        $this->SetFont('Montserrat-Light', '', 7);
          $this->SetTextColor(188,149,0);
          $this->Text(10, 275, utf8_decode($domicilio.""));
          $this->Text(10, 278, utf8_decode("Marca SAT 55 627 22 728 sat.gob.mx  "));
          $this->Image('../img/margen_inst.png', 10, 278, 182, 10);
          $this->Image('../img/pie_pag,png.png', 168, 264, 30, 26);
          $this->SetTextColor(0,0,0);
          $this->SetFont('Arial', 'B', 7);
          // $this->Text(195, 286, utf8_decode( 'Pag. '. $this->PageNo()));
    
      break;
      }
    
    }
    
    }


switch ($est_esco) {
  case 4:
   $nombre_honorario = $nombre_honorario;
  break;
  
 default:
 $nombre_honorario = '';
 break;
}
switch ($est_esco_admin) {
  case 4:
   $nombre_honorario_admin = $nombre_honorario_admin;
  break;
  
 default:
 $nombre_honorario_admin = '';
 break;
}



      $pdf = new pdf();
    //Creamos un documento
   

    date_default_timezone_set('America/Mexico_City');
    $pdf->SetTitle("Oficio");


    $pdf->AddPage();
    //$pdf->AddFont('Montserrat-BlackItalic','','Montserrat-BlackItalic.php');
    $pdf->AddFont('Montserrat-Bold','','Montserrat-Bold');
    $pdf->SetFont('Montserrat-Bold', '', 10);
    $pdf->Text(25, 35, utf8_decode("Oficio: ". $oficio_compilado.""));
    $pdf->Text(25, 43, utf8_decode("Asunto: "));
    $pdf->AddFont('Montserrat-Light','','Montserrat-Light.php');
    $pdf->SetFont('Montserrat-Light', '', 10);
    $pdf->Text(42, 43, utf8_decode("Designación"));
    $pdf->Text(101, 58, utf8_decode('Ciudad de México, '.$Fecha_hoy.'.'));
    $pdf->SetFont('Montserrat-Bold', '', 10);
    $pdf->Text(25, 77, utf8_decode("C.$nombre $apellidoP $apellidoM"));
    $pdf->SetFont('Montserrat-Light', '', 10);
    $pdf->Text(25, 85, utf8_decode("P r e s e n t e"));
    if ($genero == 'M') {
      $asgnar = "asignarla";
    }
    else {
      $asgnar = "asignarlo";
    }
    
    $pdf->Ln();
    $pdf->SetXY(25,100);
    $pdf->SetFont('Montserrat-Light', '', 9);
    $pdf->MultiCell(160,5,utf8_decode("De conformidad con las facultades que me confieren los artículos 1; 2, Apartado B, fracción I, Apartado C y antepenúltimo párrafo; 5, tercer párrafo; 6, primer párrafo, apartado A, fracción XXXII, inciso d), 14, primer párrafo, fracción V, y 16, tercer párrafo, numeral 9 y 18 último párrafo, del Reglamento Interior del Servicio de Administración Tributaria, publicado en el Diario Oficial de la Federación el 24 de agosto de 2015 en vigor, diverso 88 fracción III, me permito comunicarle que:"),0,'J',0);
    $pdf->SetXY(25,130);
    $pdf->SetFont('Montserrat-Light', '', 9);
    $pdf->MultiCell(160,5,utf8_decode("Tengo a bien $asgnar al departamento de $Departamento dependiente de la $Sub_admin de la $admin, con sede en la Ciudad de México, esto a partir del día $Fecha_hoy."),0,'J',0);
    $pdf->SetXY(25,155);
    $pdf->SetFont('Montserrat-Light', '', 9);
    $pdf->MultiCell(160,5,utf8_decode("Toda vez que existe la necesidad de brindar apoyo en esta Unidad Administrativa, para que ésta tenga capacidad de respuesta en el ejercicio de las atribuciones que conforme al Reglamento Interior del Servicio de Administración Tributaria tiene encomendadas y dar así cumplimiento a los programas, metas y estrategias establecidas."),0,'J',0);
    $pdf->SetXY(25,180);
    $pdf->SetFont('Montserrat-Light', '', 9);
    $pdf->MultiCell(160,5,utf8_decode("En razón de lo anterior, deberá presentarse en la fecha citada con el $nombre_honorario $nom_sub_encarg, a efectos de que se le asignen las funciones específicas."),0,'J',0);
    $pdf->Text(25, 200, utf8_decode("Sin más por el momento, reciba un cordial saludo."));
    $pdf->SetFont('Montserrat-Bold', '', 12);
    $pdf->Text(25, 210, utf8_decode("A t e n t a m e n t e"));
    $pdf->SetFont('Montserrat-Bold', '', 12);
    $pdf->Text(25, 240, utf8_decode("$nombre_honorario_admin $nom_admin_encarg"));
    $pdf->SetFont('Montserrat-Light', '', 8);
    $pdf->Text(25, 245, utf8_decode("$puesto"));
    
    $pdf->Close();
    $pdf->Output();


    // Pagina para agregar fuentes y estilos y generar archivo php y archivo .z, despues solo se copia y se pega en la carpeta FONT y se agrega con la sentencia
    //  $pdf->AddFont('Montserrat-Bold','','Montserrat-Bold'); y se usa con el siguiente   $pdf->SetFont('Montserrat-Light', '', 9);
    //http://www.fpdf.org/makefont/index.php
  }
