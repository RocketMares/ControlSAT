<?php

    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();
    $menu->modals();

    ?>
<br>
<div class="mt-5 my-5">
    <h1 class="display-4 text-center">Plantilla vigente de empleados.</h1>
</div>



<div class="mt-5 my-5 text-center">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <button class="btn btn-success" id="user_more"> Agregar empleado <i class="fas fa-user-plus"></i>
                    </button>
                </li>


            </ul>

        </div>
    </nav>
    <div class="container-fluid" id="tabla_activa">
        <?php
    include_once "php/tablas_dinamicas.php";
    $tablas = new Manda_tabla();
    $tablas->Tabla_usuarios_activos();
    ?>

    </div>

</div>



</div>


<?php

   // se imprime footer
   $menu->Footer();

    ?>