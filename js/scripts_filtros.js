// FILTROS PLANTILLAS ACTIVOS
$(document).ready(function(){
    // FILTROS POR NOMBRE ACTIVOS
    $('#filtro_nombre').on('click',function(){
        var nom = $('#nombre_buscqueda').val();
        if (nom =='' ) {
            toastr.error("No se puede dejar el campo de nombre en blanco si desea usar este filtro","Notificación",{
                "progressBar":true
            });
        } else {
            createCookie("nombre",nom,1)
            location.href="Plantilla_empleados_activos.php?Nombre=1";
        }
    })
    // FILTROS POR NOMBRE ACTIVOS
    $('#filtro_RFC_CORTO').on('click',function(){
        var rfc = $('#FiltroRFC').val();
        if (rfc =='' ) {
            toastr.error("No se puede dejar el campo de el RFC corto en blanco si desea usar este filtro","Notificación",{
                "progressBar":true
            });
        } else {
            createCookie("rfc_corto_cokie",rfc,1)
            location.href="Plantilla_empleados_activos.php?RFC=1";
        }
    })
     // FILTROS POR ESTRUCTURA 
     $('#filtro_POR_ESTRUCTURA').on('click',function(){
        sub = $('#sub_admin_filtro').val();
        dep = $('#depto_filtro').val();

         if (sub != 0 && dep != 0 || dep != 0)  {
              createCookie("sub",sub,1)
              createCookie("dep",dep,1)
              location.href="Plantilla_empleados_activos.php?Estructura=1";
         }
         else{
            toastr.error('No puedes dejar el campo de subadministracion o departamento vacio para activar este filtro',"Notificación",{
                "progressBar":true
            });
         }
    })
    //Combos para seleccionar estructura de filtros
    $('#sub_admin_filtro').change(function() {
        $('#sub_admin_filtro option:selected').each(function(){
            sub = $(this).val();
            datos={sub:sub}
            $.post("php/Metodos_filtros.php",{datos:datos},function(data){
            }).done(function(respuesta){
                $('#depto_filtro').html(respuesta);
            })
        })
    })
     // FILTROS POR PUESTO 
     $('#filtro_POR_PUESTO').on('click',function(){
        var puesto = $('#puestos_filtros').val();
        if (puesto ==0 ) {
            toastr.error("Tienes que seleccionar un puesto si desea usar este filtro","Notificación",{
                "progressBar":true
            });
        } else {
            createCookie("puest_adr",puesto,1)
            location.href="Plantilla_empleados_activos.php?Puestos=1";
        }
    })
    // FILTROS POR ANTIGUEDAD 
    $('#filtro_POR_ANTIGUEDAD').on('click',function(){

    })
    $('#quitar_filtros').on('click',function(){
        location.href="Plantilla_empleados_activos.php?pagina=1";
    })
    $("#Ocultar").on('click', function () {
        $("#filtros_reg").hide("fast");
        })

    $("#Monstrar").on('click', function () {
        $("#filtros_reg").show("fast");
        $("#Ocultar").show("fast");
    })
});