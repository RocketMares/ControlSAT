

function valida_datos_Act_admin() {
    if ($("#selecciona_admmin").val() == 0) {
        toastr.info("Debes seleccionar una administración para actualizar", 'Notificacion', {
            "progressBar": true
        })
    } else {
        if ($("#nombre_admin_act").val() == '') {
            toastr.info("No puedes dejar el numero de unidad en blanco", 'Notificacion', {
                "progressBar": true
            })
        } else {
            if ($("#unidad_act").val() == '') {
                toastr.info("No puedes dejar el nombre abreviado de la administración en blanco", 'Notificacion', {
                    "progressBar": true
                })
            } else {
                if ($("#direc_act").val() == '') {
                    toastr.info("No puedes dejar el domicilio en blanco", 'Notificacion', {
                        "progressBar": true
                    })
                }
                else{
                    if ($("#telefono_admin1").val() == '') {
                        toastr.info("No puedes dejar el numero telefonico en blanco", 'Notificacion', {
                            "progressBar": true
                        })
                    } else {
                        Actualiza_Administracion()
                    }
                }
            }
            
        }
    }

}
function Actualiza_Administracion() {

    var admin_asoc = $("#selecciona_admmin").val();
    var nombre_admin_cam = $("#nombre_admin_act").val();
    var unidad = $("#unidad_act").val();
    var Abreb_act = $("#Abreb_act").val();
    var direc_act = $("#direc_act").val();
    var telefono_admin = $("#telefono_admin1").val();
    var estatus = $('input:radio[name=estatus_admin_baj]:checked').val();

    var datos = {
        admin_asoc: admin_asoc,
        nombre_admin_cam: nombre_admin_cam,
        unidad: unidad,
        Abreb_act: Abreb_act,
        direc_act: direc_act,
        telefono_admin: telefono_admin,
        estatus: estatus,
    };
    var datos1 = JSON.stringify(datos)
    //alert(datos1)
    $.post("php/Ac_estructrutas.php", {
        Act_admin: datos1
    }, function (data) {
        toastr.info(data, 'Notificacion', {
            "progressBar": true,
        })
        accion(admin_asoc)

    });


}

function Registrar_departamento() {

    var admin = $("#id_admin").val();
    var sub = $("#id_sub_admin").val();
    var nombre_dep = $("#nombre_dep").val();
    var datos = {
        admin: admin,
        sub: sub,
        nombre_dep: nombre_dep,
    }
    var json = JSON.stringify(datos)
     $.post("php/Ac_estructrutas.php", {
         reg_dep: json
     }, function (data) {
         toastr.info(data,"Notificación",{
             "progressBar":true
         })
    });


}

function Actualiza_departamento() {

    var admin = $("#num_admin").val();
    var sub = $("#id_sub_admin_b").val();
    var dep_asoc = $("#deptos_f").val();
    var nombre_dep = $("#nombre_dep_cam").val();
    var estatus = $('input:radio[name=Estatus_activo]:checked').val();

    var datos = {
        admin: admin,
        sub: sub,
        nombre_dep: nombre_dep,
        dep_asoc: dep_asoc,
        estatus: estatus,

    };
    var json = JSON.stringify(datos);

    // toastr.info(json,"Notificación",{
    //     "progressBar":true
    // })
    if (nombre_dep != "") {
        $.post("php/Ac_estructrutas.php", {
            Act_dep: json
        }, function (data) {
            toastr.info(data,"Notificación",{
                "progressBar":true
            })
        });
    } else
        alert('No puede dejar en blanco el nombre del departamento a actualizar');
    //    var json = JSON.stringify(datos);
    //   alert('Si entra aqui' + json);    



}

function valida_datos_reg_admin() {
    if ($("#nom_Admin_reg").val() == '') {
        toastr.warning("No puedes dejar el nombre de la admin en blanco", 'Notificacion', {
            "progressBar": true
        })
    } else {
        if ($("#unidad_admin_reg").val() == '') {
            toastr.warning("No puedes dejar el numero de unidad en blanco", 'Notificacion', {
                "progressBar": true
            })
        } else {
            if ($("#abrev_admin_reg").val() == '') {
                toastr.warning("No puedes dejar el nombre abreviado de la administración en blanco", 'Notificacion', {
                    "progressBar": true
                })
            } else {
                if ($("#direccion_admin_reg").val() == '') {
                    toastr.warning("No puedes dejar el domicilio en blanco", 'Notificacion', {
                        "progressBar": true
                    })
                }
                else{
                    if ($("#admin_telefono_reg").val() == '') {
                        toastr.warning("No puedes dejar el numero telefonico en blanco", 'Notificacion', {
                            "progressBar": true
                        })
                    } else {
                        Registrar_Administracion()
                    }
                }
            }
            
        }
    }

}

function Registrar_Administracion() {

    var nombre_admin = $("#nom_Admin_reg").val();
    var unidad = $("#unidad_admin_reg").val();
    var Abreb_act = $("#abrev_admin_reg").val();
    var direc_act = $("#direccion_admin_reg").val();
    var telefono_admin = $("#admin_telefono_reg").val();
    var datos = {
        nombre_admin: nombre_admin,
        unidad: unidad,
        Abreb_act: Abreb_act,
        direc_act: direc_act,
        telefono_admin: telefono_admin,

    }
    var datos2 = JSON.stringify(datos)
    $.post("php/Ac_estructrutas.php", {
        reg_admin: datos2
    }, function (data) {
        toastr.info(data,'Notifacion',{
            "progressBar":true,
        })
       
    });
    //  //location.reload();

}

function Actualiza_Sub_administracion() {

    var admin = $("#num_admin").val();
    var sub_admin_asoc = $("#id_sub_admin_b").val();
    var nombre_sub = $("#nombre_area_1").val();
    var estatus = $('input:radio[name=Estatus_activo]:checked').val();

    var datos = {
        admin: admin,
        sub_admin_asoc: sub_admin_asoc,
        nombre_sub: nombre_sub,
        estatus: estatus,

    };
    // var json = JSON.stringify(datos);
    //alert('Si entra aqui' + json);    
    if (nombre_sub != "") {
        $.post("php/Ac_estructrutas.php", {
            array2: datos
        }, function (data) {
            alert(data);
            location.reload();

        });
    } else {
        alert('No puede dejar en blanco el nombre de la Sub Administración.')
    }


}

function Registrar_Sub_administracion() {

    var admin = $("#id_admin_1").val();
    var nombre_sub = $("#nombre_area").val();
    var datos = {
        admin: admin,
        nombre_sub: nombre_sub,
    };
    //  var json = JSON.stringify(datos);
    // alert('Si entra aqui' + json);
    if (nombre_sub != "") {
        $.post("php/Ac_estructrutas.php", {
            array: datos
        }, function (data) {
            //alert(data);
            location.reload();
        });
    } else {
        alert('No puede dejar en blanco el nombre de la Sub Administración.')
    }
    //  //location.reload();

}
$(document).ready(function () {
    $('#selecciona_admmin').change(function () {
        $('#selecciona_admmin option:selected').each(function () {
            admin = $(this).val();
            accion(admin)
        })

    })
})

function accion(admin) {
    var admin = admin;
    if (admin != 0) {

        $.post("php/Ac_estructrutas.php", {
            Obtener_datos_admin: admin
        }, function (data) {
            //console.log(data);

            var id_admin = [];
            var nombre_admin = [];
            var nombre_corto = [];
            var unidad = [];
            var telefono = [];
            var direccion = [];


            for (var i in data) {
                id_admin.push(data.id_admin);
                nombre_admin.push(data.nombre_admin);
                nombre_corto.push(data.nombre_corto);
                unidad.push(data.unidad);
                telefono.push(data.telefono);
                direccion.push(data.direccion);


            }

            if (id_admin != null) {
                $("#nombre_admin_act").val(nombre_admin[0]);
                $("#Abreb_act").val(nombre_corto[0]);
                $("#unidad_act").val(unidad[0]);
                $("#telefono_admin").val(telefono[0]);
                $("#direc_act").val(direccion[0]);

            } else {
                alert('Los datos del usuario no estan disponibles.')
            }
        })
    } else {

    }
}
$(document).ready(function () {
    $('#id_sub_admin_b').change(function () {
        $('#id_sub_admin_b option:selected').each(function () {
            sub = $(this).val();

            $.post("php/Ac_estructrutas.php", {
                auto_sbu_name: sub
            }, function (data) {}).done(function (data) {
                $("#nombre_sub_admin2").val(data);
            })
        })
    })
})
$(document).ready(function () {
    $('#deptos_f').change(function () {
        $('#deptos_f option:selected').each(function () {
            dep = $(this).val();

            $.post("php/Ac_estructrutas.php", {
                auto_dep_name: dep
            }, function (data) {}).done(function (data) {
                $("#nombre_dep_cam").val(data);
            })
        })
    })

    $('#registra_posison').on('click',function(){
        var posision_new = $('#New_posision').val();
        var nivel_new = $('#New_nivel_add').val();
        var clave_presupuestal = $('#New_clave_pres_add').val();
        var id_puesto_fun = $('#New_Puesto_fump_add').val();
        var clave_puesto = $('#New_clav_puesto_add').val();
        var sueldo_neto = $('#New_sueldo_neto').val();
        var jefe_plaza = $('#New_plaza_jefe').val();

        var json = {
            posision_new:posision_new,
            nivel_new:nivel_new,
            clave_presupuestal:clave_presupuestal,
            id_puesto_fun:id_puesto_fun,
            clave_puesto:clave_puesto,
            sueldo_neto:sueldo_neto,
            jefe_plaza:jefe_plaza
        }
        var datos = JSON.stringify(json);

        if (posision_new.length < 8) {
            toastr.error("No puedes agregar un número de posision menor a 8 caracteres","Notificiación",{
                "progressBar":true
            })
        }else{
            if (nivel_new = '') {
                toastr.error("No puedes dejar la posision sin asignarle un nivel o que el nivel tenga menos de 3 caracteres","Notificiación",{
                    "progressBar":true
                })
            }else{
                if (clave_presupuestal=='') {
                    toastr.error("No puedes dejar en blanco la clave presupuestal","Notificiación",{
                        "progressBar":true
                    })
                }
                else{
                    if (id_puesto_fun==0) {
                        toastr.error("Tienes que asignarle un puesto","Notificiación",{
                            "progressBar":true
                        })
                    }
                    else{

                            $.post("php/Ac_estructrutas.php",{registra_posision:datos},function(data){
                            }).done(function(data){
                                toastr.success(data,"Notificiación",{
                                    "progressBar":true
                                })
                            })
                        
                    }
                }
            }
        }


    })

})


function Registrar_puesto_ADR() {

    var nombre_puesto = $("#nombre_puesto_adr_reg").val();
    data = {nombre_puesto:nombre_puesto}
    var json = JSON.stringify(data)
     $.post("php/Ac_estructrutas.php", {
         reg_puesto_adr: json
     }, function (data) {
         toastr.info(data,"Notificación",{
             "progressBar":true
         })
    });


}
function Actualiza_puesto_ADR() {
    var id_puesto = $("#id_puesto_adr").val();
    var nombre_puesto = $("#nombre_puesto_adr").val();
    var estatus = $('input:radio[name=Estatus_activo_adr]:checked').val();
    data = {id_puesto:id_puesto,
        nombre_puesto:nombre_puesto,
        estatus:estatus}

    if (nombre_puesto != '') {
        var json = JSON.stringify(data)
     $.post("php/Ac_estructrutas.php", {
         act_puesto_adr: json
     }, function (data) {
         toastr.info(data,"Notificación",{
             "progressBar":true
         })
    });
    } else {
        toastr.error('No puedes dejar en blanco el nombre del puesto seleccionado',"Notificación",{
            "progressBar":true
        })
    }
    


}