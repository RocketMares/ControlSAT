<?php

    require_once 'php/menu_dinamico.php';
   

    $menu = new Menu();
    ?>

<?php
    $menu->cabecera_principal();
    $menu->Crear_menu();


    ?>
    <br>
    <div class="mt-5 my-5" id="prueba_titulos">
        <h1 class="display-4 text-center"  >Sistema de Control de Ingresos del Personal SAT  </h1>
     
    </div>
    <div class="mt-5 container-fluid my-5">

        <div class="" >
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators bg-dark">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner" >
                    <div class="carousel-item active"id="pag_activos">
                        <img src="img/Empleados_act.png" class="d-block " alt="..."   >
                        <div class="carousel-caption d-none d-md-block text-dark text-truncate" >
                        <button type="button" class=" btn btn-outline-dark">Da click Aqui</button>
                            
                        <h4>Empleados Activos</h4>
                            <p>Visualiza a detalle la plantilla de empleados activos o licencia.</p>
                        </div>
                    </div>
                    <div class="carousel-item" id="pag_inactivos" >
                        <img src="img/Empleados_baja.png" class="d-block " alt="..." >
                        <div class="carousel-caption d-none d-md-block text-dark">
                        <button type="button" class=" btn btn-outline-dark">Da click Aqui</button>
                            <h5>Empleados en estado de baja, comisión o suspendidos de labores</h5>
                            <p>Visualiza a detalle la plantilla de empleados en estado de baja, comisión o suspendidos de labore</p>
                        </div>
                    </div>
                    <div class="carousel-item" id="pag_estructura">
                        <img src="img/126373.png" class="d-block" alt="..."  >
                        <div class="carousel-caption d-none d-md-block text-dark ">
                        <button type="button" class=" btn btn-outline-dark">Da click Aqui</button>
                            <h5>Organigrama</h5>
                            <p>Visualiza la estructura general de manera mas detallada.</p>
                        </div>
                    </div>
                    <div class="carousel-item"id="pag_sistemas">
                        <img src="img/host.png" class="d-block" alt="..."  style="height: 515px;">
                    
                        <div class="carousel-caption d-none d-md-block text-dark" >
                        <button type="button" class=" btn btn-outline-dark">Da click Aqui</button>
                            <h5>Matriz de Sistemas</h5>
                            <p>Vista general de sistemas activos.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev " href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark" hight="500" aria-hidden="true"></span>
                    <span class="sr-only ">Previous</span>
                </a>
                <a class="carousel-control-next " href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                    <span class="sr-only text-dark">Next</span>
                </a>
            </div>
        </div>


    </div>








<br>
<br>


<?php

   // se imprime footer
   $menu->Footer();

?>


