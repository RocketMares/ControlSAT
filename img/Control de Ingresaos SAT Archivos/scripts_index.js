
$("#ver").click(function (e) { 
    openNav();
});

$(document).ready(function(){
    $('#pag_activos').on('click',function(){
        location.href="Plantilla_empleados_activos.php";
    });
    $('#pag_inactivos').on('click',function(){
        location.href="#";
    });
    $('#pag_estructura').on('click',function(){
        location.href="Estructura.php";
    });
    $('#pag_sistemas').on('click',function(){
        location.href="#";
    });

})

function BuscarDatosContrib(id_contrib) {
    var con = id_contrib
    createCookie('contribuyente',con,1)
    location.href="detalle_contribuyente.php";
}

function vermas() {
    $('#vermasdiv').toggle();
    $('#link_ver').toggle();
}

function renovar() {
    location.reload();
}
function numero(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

    function ConfirmarCarga(valor) {
        $.post("php/validar_carga_masiva.php", {constante:valor},function (data) {
            $("#texto_result").html(data);
            $("#resultado_carga").modal({backdrop: 'static', keyboard: false});
        });
    }

    function ConfirmarCarga_pagos(valor) {
        $.post("php/validar_carga_masiva.php", {pagos:valor},function (data) {
            $("#texto_result").html(data);
            $("#resultado_carga").modal({backdrop: 'static', keyboard: false});
        });
    }

    function BuscarContribuyentes(id_empleado){
        var id_operativo = id_empleado
        createCookie('id_operativo',id_operativo,1)
        location.href="Contribuyentes_asig.php?operativo=1";
    }

    function BuscarContribuyentesA(id_empleado){
        var id_analista = id_empleado
        createCookie('id_analista',id_analista,1)
        location.href="Contribuyentes_asig.php?analista=1";
    }


    function Buscar_analistas(id_empleado){
        var id_jefe = id_empleado
        createCookie('id_jefe',id_jefe,1)
        location.href="Contribuyentes_asig.php?jefedepto=1";
    }

    function Buscar_jefes(id_empleado){
        var id_sub = id_empleado
        createCookie('id_sub',id_sub,1)
        location.href="Contribuyentes_asig.php?id_sub=1";
    }

    function DetalleEntrevista(id_ent) {
        var id_ent = id_ent
        createCookie('id_ent',id_ent,1)
        location.href="Detalle_entrevista.php";
    }

    function ocultar_detalles() { 
        $("#detalles_ent").toggle();
        $("#detalles_mot").toggle();
        $("#detalles_insumo").toggle();
    }

    function detalles_ent(){
        $("#detalles_ent").toggle('slow');
    }

    function detalles_insumo(){
        $("#detalles_insumo").toggle('slow');
    }

    function detalles_mot(){
        $("#detalles_mot").toggle('slow');
    }

    function modal_retro() {
        $('#modal_retro').modal({backdrop: 'static', keyboard: false})
    }

    function modal_detalle_calendario(fecha) {

       $.post("php/valida_dia_pendientes.php", {fechas:fecha},function (data) {
         $("#contenido").html(data); //Carga los elementos al body/content del modal
         $('#detalle').modal('toggle'); // eManada a llamar el modal
        });
     
     }

    $('.numeros').on('input', function () { 
        this.value = this.value.replace(/[^0-9]/g,'');
    });


      $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });

     
      function myTimer() {
      
        var hora = new Date();
        var myhora = hora.toLocaleTimeString();
        var dia_f = (hora.getDate() < 10) ? "0"+hora.getDate() : hora.getDate();
        var mes = hora.getMonth()+1
        var mes_f = (mes < 10) ? "0"+mes : mes;
        var dia = (dia_f + "/" + mes_f + "/" + hora.getFullYear()); 
        var hora7 = hora.getHours();
        var min = hora.getMinutes();
        var sec = hora.getSeconds();

        if ((hora7 >= 13 && hora7 <= 15) && min >= 00 && sec >= 00){
            $.post("php/valida_dia_pendientes.php", {fechas_alertas:dia},function (data) {
                var res = data;
                if (res == 1) {

                } else {
                    modal_detalle_calendario(dia);
                }
            });
        }
    }

    function myTimer_delay() { //jefes
      
        var hora = new Date();
        var myhora = hora.toLocaleTimeString();
        var dia_f = (hora.getDate() < 10) ? "0"+hora.getDate() : hora.getDate();
        var mes = hora.getMonth()+1;
        var mes_f = (mes < 10) ? "0"+mes : mes;
        var dia = (dia_f + "/" + mes_f + "/" + hora.getFullYear());
        var hora7 = hora.getHours();
        var min = hora.getMinutes();
        var sec = hora.getSeconds();
            
        if ((hora7 >= 13 && hora7 <= 15 ) ){
            $.post("php/valida_dia_pendientes.php", {fechas_alertas:dia},function (data) {
                var res = data;
                if (res == 1) {
                        
                } else {
                    modal_detalle_calendario(dia);
                }
            });
        }
    }
$(document).ready(function () {
    $("#busquedas").keypress(function(event) { 
        if (event.keyCode === 13) { 
            Buscar_contribuyente();
        } 
    }); 
});
    

