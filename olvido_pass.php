
<?php
// redirecionar en caso de no contar con el perfil adecuado.
// valida que si son usuarios que no sean Super Admin no puedan acceder por medio de la URL.
if (isset($_GET['error'])) {
  if ($_GET['error'] == 1) {
    echo "<script>
      alert('La contraseña no debe tener menos de 6 caracteres.')
    </script>";
  }elseif ($_GET['error'] == 2) {
    echo "<script>
            alert('Las contraseñas ingresadas deben de ser iguales.')
          </script>";
  }elseif ($_GET['error'] == 3) {
    echo "<script>
            alert('El usuario no esta dado de alta en el sistema.\n
             Para mayor información consulte con el administrador del sistema.')
        </script>";
  }
}

include_once "php/menu_dinamico.php";
$menu = new Menu();
$menu->cabecera_principal_log();
?>


<!-- Fin de la barra de navegación -->


<!-- Inicio de contenido -->
<div class="container-fluid py-5">
<div class="text-center py-4">
  <p class="h1">Cambio de contraseña.</p>
  <br>
   <div class="container">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-end align-items-center col-sm-12">
          <form id="formularioPass" method="post" action="php/validar_cambio_contrasena.php">
          <div class="form-row">
              <div class="form-group">
                <label for="Password">Numero de empleado:<samp class="text-danger">*</samp></label>
                <input type="number" class="form-control numeros" id="no_empleado" name="no_empleado"  maxlength="6"  required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="Password">Nueva contraseña:<samp class="text-danger">*</samp></label>
                <input type="password" class="form-control letras2" id="Password" name="Password"  maxlength="15" minlength="6" required onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="Password_C">Confirmar contraseña:<samp class="text-danger">*</samp></label>
                <input type="password" class="form-control letras2" id="Password_C" name="Password_C" maxlength="15" minlength="6" required onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>
            </div>
            <button type="submit" id="btn_CP" class="btn btn-block small btn-primary">Confirmar cambio</button>
          </form>
        </div>
        <div class="d-flex justify-content-start  col-md-6 col-sm-12">
          <img src="img/seguridad.png" class="img-fluid" style="heigth:50%; padding-top:none;">
        </div>
    </div>
  </div>
</div>

</div>


<!-- Footer inicio -->
<?php

$menu->Footer_login();