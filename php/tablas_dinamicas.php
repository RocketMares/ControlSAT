
<?php
class Manda_tabla{
    public function Tabla_usuarios_activos(){
        include_once 'conexion.php';
        include_once 'sesion.php';
        include_once 'ConsultaADR.php';
        $consultaADR = new ConsultaInfoADR();
        $datos = $consultaADR->Consulta_usuarios_activos();
        echo "
    <table class='table table-sm  table-striped table-bordered shadow-sm bg-white rounded table-hover'>
        <thead class='thead-dark'>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>RFC corto</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Subadministración</th>
            <th scope='col'>Departamento</th>
            <th scope='col'>Ocupación</th>
            <th scope='col'>Estado</th>
            <th scope='col'>Acciones</th>
          </tr>
        </thead>
        <tbody>";
        if (isset($datos)) {
            $j = 1;
            for ($i=0; $i < count($datos) ; $i++) { 
                // onclick='Revisa_info_det(\"".$datos[$i]['id_empleado_plant']."\")'
                echo " 
                <tr>
                    <th scope='row'>".$j++."</th>
                    <td> ".$datos[$i]['rfc_corto']."</td>
                    <td>".$datos[$i]['nombre_empleado']."</td>
                    <td>".$datos[$i]['nombre_sub_admin']."</td>
                    <td>".$datos[$i]['nombre_depto']."</td>
                    <td>".$datos[$i]['nombre_puesto']."</td>
                    <td>".$datos[$i]['nombre_proc']."</td>
                    <td> <button type='button' class='btn btn-dark btn-group' id='informacion_user'  onclick='Revisa_info_det_us(\"".$datos[$i]['id_empleado_plant']."\")' > Info.</button> </td>
                </tr>";
            }
        }
        else {
            echo "No hay usuarios registrados por el momento.";
        }
        echo"</tbody>
        </table>";
    }

}