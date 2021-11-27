<?php

class VistasPlantilla
{
    public function Consulta_Sub($id_admin)
    {
        include_once("conexion.php");
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI�N
        //SE MANDA A LLAMAR LA CONEXI�N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "SELECT * FROM SubAdmin 
        WHERE estatus = 'A'
        AND id_admin = $id_admin 
        ORDER BY nombre_sub_admin ASC";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI�N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function Consulta_Local()
    {
        include_once("conexion.php");
        $conexion = new ConexionSQL(); // SE INSTANCIA LA CLASE CONEXI?N
        //SE MANDA A LLAMAR LA CONEXI?N Y SE ABRE
        $con = $conexion->ObtenerConexionBD();
        //SE CREA UN QUERY
        $query = "SELECT * FROM Administracion WHERE estatus = 'A' ORDER BY nombre_admin ASC";
        //SE VALIDA EL QUERY CON FORME A LA CONEXI?N
        $prepare = sqlsrv_query($con, $query);
        if ($prepare) {
            while ($rows = sqlsrv_fetch_array($prepare, SQLSRV_FETCH_ASSOC)) {
                $filas[] = $rows;
            }
            sqlsrv_close($con);

            if (isset($filas)) {
                return $filas;
            } else {
                return null;
            }
        } else {
            print_r(sqlsrv_errors(), true);
        }
    }
    public function paginacion_adaptable($datos)
    {
        $URL_ = "99.85.24.8:8282";
        
        //$URL_ = "localhost:8282";

        if ($datos["pagina_actual"] > $datos["ultima_pag"]) {
            echo "<script>
                    location.href='http://$URL_/ControlSAT/" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["ultima_pag"] . "'
                    </script>";
        }

        echo "
        <div class='container'>
          <nav aria-label='Page navigation example'>
            <ul class='pagination justify-content-center pagination-sm'>";
        if ($datos["pagina_actual"] <= 1) {
            echo "<li class='page-item disabled'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["primera_pag"] . "'>Primera</a></li>
                    <li class='page-item disabled'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["pag_anterior"] . "'>Anterior</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["primera_pag"] . "'>Primera</a></li>
                  <li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["pag_anterior"] . "'>Anterior</a></li>";
        }
        $j = 0;
        if ($datos["ultima_pag"] < 10) {
            for ($i = 0; $i < $datos["ultima_pag"]; $i++) {
                $j = $i + 1;
                if ($datos["pagina_actual"] == $j) {
                    echo "<li class='page-item active'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                }
            }
        } else {
            if ($datos["ultima_pag"] > 10) {
                if ($datos["pagina_actual"] <= 10) {
                    for ($i = 0; $i < 10; $i++) {
                        $j = $i + 1;
                        if ($datos["pagina_actual"] == $j) {
                            echo "<li class='page-item active'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                        }
                    }
                    $j++;
                    echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>...</a></li>";
                } elseif ($datos["pagina_actual"] > 10 && $datos["pagina_actual"] < $datos["ultimas_pag"]) {
                    for ($i = $datos["pagina_actual"]; $i < $datos["pagina_actual"] + 10; $i++) {
                        $j = $i;
                        if ($datos["pagina_actual"] == $j) {
                            echo "<li class='page-item active'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                        }
                    }
                    $j++;
                    echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>...</a></li>";
                } elseif ($datos["pagina_actual"] >= $datos["ultimas_pag"]) {
                    $j = $datos["pagina_actual"] - 1;
                    echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>...</a></li>";
                    $j + 2;
                    for ($i = $datos["ultimas_pag"]; $i <= $datos["ultima_pag"]; $i++) {
                        $j = $i;
                        if ($datos["pagina_actual"] == $j) {
                            echo "<li class='page-item active'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=$j'>$j</a></li>";
                        }
                    }
                }
            }
        }
        if ($datos["pagina_actual"] == $datos["ultima_pag"] || $datos["pagina_actual"] > $datos["ultima_pag"]) {
            echo "<li class='page-item disabled'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["pag_siguiente"] . "'>Siguiente</a></li>
                <li class='page-item disabled'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["ultima_pag"] . "'>Ultima</a></li>
              </ul>
            </nav>
          </div>";
        } else {
            echo " <li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["pag_siguiente"] . "'>Siguiente</a></li>
            <li class='page-item'><a class='page-link' href='" . $datos["nombre_pag"] . ".php?" . $datos["nombre_get"] . "=" . $datos["ultima_pag"] . "'>Ultima</a></li>
            </ul>
          </nav>
        </div>";
        }
    }
}
