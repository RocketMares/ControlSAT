// FILTROS PLANTILLAS ACTIVOS
$(document).ready(function () {
    // FILTROS POR NOMBRE ACTIVOS
    $('#filtro_nombre').on('click', function () {
        var nom = $('#nombre_buscqueda').val();
        if (nom == '') {
            toastr.error("No se puede dejar el campo de nombre en blanco si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("nombre", nom, 1)
            location.href = "Plantilla_empleados_activos.php?Nombre=1";
        }
    })
    // FILTROS POR NOMBRE ACTIVOS
    $('#filtro_RFC_CORTO').on('click', function () {
        var rfc = $('#FiltroRFC').val();
        if (rfc == '') {
            toastr.error("No se puede dejar el campo de el RFC corto en blanco si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("rfc_corto_cokie", rfc, 1)
            location.href = "Plantilla_empleados_activos.php?RFC=1";
        }
    })
    $('#filtro_no_empleado').on('click', function () {
        var no_emp = $('#id_filtro_no_empleado').val();
        if (no_emp == '') {
            toastr.error("No se puede dejar el campo de el No. Empleado  en blanco si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("no_empleado_cokie", no_emp, 1)
            location.href = "Plantilla_empleados_activos.php?no_empleado=1";
        }
    })
    // FILTROS POR ESTRUCTURA 
    $('#filtro_POR_ESTRUCTURA').on('click', function () {
        sub = $('#sub_admin_filtro').val();
        dep = $('#depto_filtro').val();

        if (sub != 0) {
            createCookie("sub", sub, 1)
            createCookie("dep", dep, 1)
            location.href = "Plantilla_empleados_activos.php?Estructura=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    //Combos para seleccionar estructura de filtros
    $('#sub_admin_filtro').change(function () {
        $('#sub_admin_filtro option:selected').each(function () {
            sub = $(this).val();
            datos = {
                sub: sub
            }
            $.post("php/Metodos_filtros.php", {
                datos: datos
            }, function (data) {}).done(function (respuesta) {
                $('#depto_filtro').html(respuesta);
            })
        })
    })
    // FILTROS POR PUESTO 
    $('#filtro_POR_PUESTO').on('click', function () {
        var puesto = $('#puestos_filtros').val();
        if (puesto == 0) {
            toastr.error("Tienes que seleccionar un puesto si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("puest_adr", puesto, 1)
            location.href = "Plantilla_empleados_activos.php?Puestos=1";
        }
    })
    $('#filtro_POR_nivel').on('click', function () {
        var niv = $('#nivel_sec').val();
        if (niv == 0) {
            toastr.error("Tienes que seleccionar un nivel si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("nivels", niv, 1)
            location.href = "Plantilla_empleados_activos.php?nivel=1";
        }
    })
    // FILTROS POR ANTIGUEDAD 
    $('#filtro_POR_ANTIGUEDAD').on('click', function () {

    })
    $('#quitar_filtros').on('click', function () {
        location.href = "Plantilla_empleados_activos.php?pagina=1";
    })
    $('#quitar_filtros2').on('click', function () {
        location.href = "Posisiones.php?pagina=1";
    })
    $("#Monstrar").on('click', function () {
        $('#filtros_reg').toggle(200, function () {});
    })
    $('#filtro_cod_puesto').on('click', function () {

        var puest = $('#puesto_fump_filtro').val();
        if (puest != 0) {
            createCookie("Cod_puest", puest, 1)

            location.href = "Posisiones.php?Cod_puesto=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#filtro_nivel').on('click', function () {

        var nivel = $('#Nivel_select').val();
        if (nivel != 0) {
            createCookie("Nivel_select", nivel, 1)

            location.href = "Posisiones.php?Nivel=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#Posision__gerente_filtro').on('click', function () {

        var pos_ger = $('#posision_gerente_busc').val();
        if (pos_ger != 0) {
            createCookie("pos_gerentes", pos_ger, 1)

            location.href = "Posisiones.php?Pos_gerente=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#Posision__filtro').on('click', function () {
        var posision = $('#posiscion_busc').val();
        if (posision != '') {
            createCookie("posiscion_busc", posision, 1)

            location.href = "Posisiones.php?Posision=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#filtro_extra').on('click', function () {
        var extra = $('#filtros_extra_select').val();
        if (extra != 0) {
            createCookie("extra", extra, 1)

            location.href = "Posisiones.php?Stock=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#filtro_extra_activos').on('click', function () {
        var extra = $('#filtros_extras_option').val();
        if (extra != 0) {
            createCookie("extra_option", extra, 1)

            location.href = "Plantilla_empleados_activos.php?Stock=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#filtro_fecha_ingreso_activi').on('click', function () {
        var fec_ini = $('#fech_ingre_fil_part_1').val();
        var fec_fin = $('#fech_ingre_fil_part_2').val();

        if (fec_ini == '' || fec_fin == '') {
            toastr.error("La fecha inicial y la fecha final no pueden estar en blanco para aplicar este filtro", 'Notificación')
        } else {
            if (fec_ini > fec_fin) {
                toastr.error("La fecha inicial no puede ser mayor a la fecha final", 'Notificación')
            } else {

                createCookie("fec_ini_filtro", fec_ini, 1)
                createCookie("fec_fin_filtro", fec_fin, 1)
                location.href = "Plantilla_empleados_activos.php?fecha_ingreso=1";
            }
        }

       
    })
    $('#fech_ingre_fil_part_1').datepicker({
        endDate: "today",
        autoclose: true,
        //daysOfWeekDisabled: [0, 6],
        todayHighlight: true,
        format: "yyyy/mm/dd",
        toggleActive: true,
        language: 'es'
    });
    $('#fech_ingre_fil_part_2').datepicker({
        endDate: "today",
        autoclose: true,
        //daysOfWeekDisabled: [0, 6],
        todayHighlight: true,
        format: "yyyy/mm/dd",
        toggleActive: true,
        language: 'es'
    });
   
   

});

 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////filtros de bajas((((((((((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){
    $('#sub_admin_filtro2').change(function () {
        $('#sub_admin_filtro2 option:selected').each(function () {
            sub = $(this).val();
            datos = {
                sub: sub
            }
            $.post("php/Metodos_filtros.php", {
                datos: datos
            }, function (data) {}).done(function (respuesta) {
                $('#depto_filtro2').html(respuesta);
            })
        })
    })
    $('#filtro_nombre2').on('click', function () {
        var nom = $('#nombre_buscqueda2').val();
        if (nom == '') {
            toastr.error("No se puede dejar el campo de nombre en blanco si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("nombre", nom, 1)
            location.href = "Plantilla_empleados_baja.php?Nombre=1";
        }
    })
    // FILTROS POR NOMBRE ACTIVOS
    $('#filtro_RFC_CORTO2').on('click', function () {
        var rfc = $('#FiltroRFC2').val();
        if (rfc == '') {
            toastr.error("No se puede dejar el campo de el RFC corto en blanco si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("rfc_corto_cokie", rfc, 1)
            location.href = "Plantilla_empleados_baja.php?RFC=1";
        }
    })
    $('#filtro_no_empleado2').on('click', function () {
        var no_emp = $('#id_filtro_no_empleado2').val();
        if (no_emp == '') {
            toastr.error("No se puede dejar el campo de el No. Empleado  en blanco si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("no_empleado_cokie", no_emp, 1)
            location.href = "Plantilla_empleados_baja.php?no_empleado=1";
        }
    })
    // FILTROS POR ESTRUCTURA 
    $('#filtro_POR_ESTRUCTURA2').on('click', function () {
        sub = $('#sub_admin_filtro2').val();
        dep = $('#depto_filtro2').val();

        if (sub != 0) {
            createCookie("sub", sub, 1)
            createCookie("dep", dep, 1)
            location.href = "Plantilla_empleados_baja.php?Estructura=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#filtro_POR_PUESTO2').on('click', function () {
        var puesto = $('#puestos_filtros').val();
        if (puesto == 0) {
            toastr.error("Tienes que seleccionar un puesto si desea usar este filtro", "Notificación", {
                "progressBar": true
            });
        } else {
            createCookie("puest_adr", puesto, 1)
            location.href = "Plantilla_empleados_baja.php?Puestos=1";
        }
    })
    $('#quitar_filtros3').on('click', function () {
        location.href = "Plantilla_empleados_baja.php?pagina=1";
    })
    $('#filtro_extra_activos2').on('click', function () {
        var extra = $('#filtros_extras_option2').val();
        if (extra != 0) {
            createCookie("extra_option", extra, 1)

            location.href = "Plantilla_empleados_baja.php?Stock=1";
        } else {
            toastr.error('No puedes dejar el campo de subadministracion vacia para activar este filtro', "Notificación", {
                "progressBar": true
            });
        }
    })
    $('#filtro_fecha_ingreso_activi22').on('click', function () {
        var fec_ini = $('#fech_ingre_fil_part2_1').val();
        var fec_fin = $('#fech_ingre_fil_part2_2').val();

        if (fec_ini == '' || fec_fin == '') {
            toastr.error("La fecha inicial y la fecha final no pueden estar en blanco para aplicar este filtro", 'Notificación')
        } else {
            if (fec_ini > fec_fin) {
                toastr.error("La fecha inicial no puede ser mayor a la fecha final", 'Notificación')
            } else {

              var uno =  createCookie("fec_ini_filtro2", fec_ini, 1)
              var dos =  createCookie("fec_fin_filtro2", fec_fin, 1)

                //console.log(uno,dos)
                location.href = "Plantilla_empleados_baja.php?fecha_baja=1";
            }
        }
    })
    $('#fech_ingre_fil_part2_1').datepicker({
        endDate: "today",
        autoclose: true,
        //daysOfWeekDisabled: [0, 6],
        todayHighlight: true,
        format: "yyyy/mm/dd",
        toggleActive: true,
        language: 'es'
    });
    $('#fech_ingre_fil_part2_2').datepicker({
        endDate: "today",
        autoclose: true,
        //daysOfWeekDisabled: [0, 6],
        todayHighlight: true,
        format: "yyyy/mm/dd",
        toggleActive: true,
        language: 'es'
    });
})