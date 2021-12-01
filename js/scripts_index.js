$("#ver").click(function (e) {
    openNav();
});

$(document).ready(function () {
    $('#pag_activos').on('click', function () {
        location.href = "Plantilla_empleados_activos.php";
    });
    $('#pag_inactivos').on('click', function () {
        location.href = "#";
    });
    $('#pag_estructura').on('click', function () {
        location.href = "Estructura.php";
    });
    $('#pag_sistemas').on('click', function () {
        location.href = "#";
    });

})

function BuscarDatosContrib(id_contrib) {
    var con = id_contrib
    createCookie('contribuyente', con, 1)
    location.href = "detalle_contribuyente.php";
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
    $.post("php/validar_carga_masiva.php", {
        constante: valor
    }, function (data) {
        $("#texto_result").html(data);
        $("#resultado_carga").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
}

function ConfirmarCarga_pagos(valor) {
    $.post("php/validar_carga_masiva.php", {
        pagos: valor
    }, function (data) {
        $("#texto_result").html(data);
        $("#resultado_carga").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
}

function BuscarContribuyentes(id_empleado) {
    var id_operativo = id_empleado
    createCookie('id_operativo', id_operativo, 1)
    location.href = "Contribuyentes_asig.php?operativo=1";
}

function BuscarContribuyentesA(id_empleado) {
    var id_analista = id_empleado
    createCookie('id_analista', id_analista, 1)
    location.href = "Contribuyentes_asig.php?analista=1";
}


function Buscar_analistas(id_empleado) {
    var id_jefe = id_empleado
    createCookie('id_jefe', id_jefe, 1)
    location.href = "Contribuyentes_asig.php?jefedepto=1";
}

function Buscar_jefes(id_empleado) {
    var id_sub = id_empleado
    createCookie('id_sub', id_sub, 1)
    location.href = "Contribuyentes_asig.php?id_sub=1";
}

function DetalleEntrevista(id_ent) {
    var id_ent = id_ent
    createCookie('id_ent', id_ent, 1)
    location.href = "Detalle_entrevista.php";
}

function ocultar_detalles() {
    $("#detalles_ent").toggle();
    $("#detalles_mot").toggle();
    $("#detalles_insumo").toggle();
}

function detalles_ent() {
    $("#detalles_ent").toggle('slow');
}

function detalles_insumo() {
    $("#detalles_insumo").toggle('slow');
}

function detalles_mot() {
    $("#detalles_mot").toggle('slow');
}

function modal_retro() {
    $('#modal_retro').modal({
        backdrop: 'static',
        keyboard: false
    })
}

function modal_detalle_calendario(fecha) {

    $.post("php/valida_dia_pendientes.php", {
        fechas: fecha
    }, function (data) {
        $("#contenido").html(data); //Carga los elementos al body/content del modal
        $('#detalle').modal('toggle'); // eManada a llamar el modal
    });

}
function numero(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$('.numeros').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});


$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip()
});


function myTimer() {

    var hora = new Date();
    var myhora = hora.toLocaleTimeString();
    var dia_f = (hora.getDate() < 10) ? "0" + hora.getDate() : hora.getDate();
    var mes = hora.getMonth() + 1
    var mes_f = (mes < 10) ? "0" + mes : mes;
    var dia = (dia_f + "/" + mes_f + "/" + hora.getFullYear());
    var hora7 = hora.getHours();
    var min = hora.getMinutes();
    var sec = hora.getSeconds();

    if ((hora7 >= 13 && hora7 <= 15) && min >= 00 && sec >= 00) {
        $.post("php/valida_dia_pendientes.php", {
            fechas_alertas: dia
        }, function (data) {
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
    var dia_f = (hora.getDate() < 10) ? "0" + hora.getDate() : hora.getDate();
    var mes = hora.getMonth() + 1;
    var mes_f = (mes < 10) ? "0" + mes : mes;
    var dia = (dia_f + "/" + mes_f + "/" + hora.getFullYear());
    var hora7 = hora.getHours();
    var min = hora.getMinutes();
    var sec = hora.getSeconds();

    if ((hora7 >= 13 && hora7 <= 15)) {
        $.post("php/valida_dia_pendientes.php", {
            fechas_alertas: dia
        }, function (data) {
            var res = data;
            if (res == 1) {

            } else {
                modal_detalle_calendario(dia);
            }
        });
    }
}
$(document).ready(function () {
    $("#busquedas").keypress(function (event) {
        if (event.keyCode === 13) {
            Buscar_contribuyente();
        }
    });
});



$(document).ready(function () {
    $('#id_admin_add').change(function () {
        $('#id_admin_add option:selected').each(function () {
            var admin = $(this).val();
            $.post("php/Obtener_combos.php", {
                id_admin: admin
            }, function (data) {
                $('#id_sub_admin_add').html(data)
            })
        })
    })
    $('#id_sub_admin_add').change(function () {
        $('#id_sub_admin_add option:selected').each(function () {
            var admin = $(this).val();
            $.post("php/Obtener_combos.php", {
                id_sub_admin: admin
            }, function (data) {
                $('#ID_DEPA_add').html(data)
            })
        })
    })
    $('#posision_add').change(function () {
        $('#posision_add').each(function () {
            var inc = $(this).val();

            $.post("php/consulta_dat.php", {
                posi: inc
            }, function (data) {
                $('#Puesto_fump_add').val(data[0]['nombre_puesto']);
                $('#clav_puesto_add').val(data[0]['clave_puesto']);
                $('#plaza_jefe_add').val(data[0]['posision_jefe']);
                $('#nombre_jefe_add').val(data[0]['nombre_jefe']);
                $('#clav_puesto_jefe_add').val(data[0]['clave_jefe']);
                $('#nivel_add').val(data[0]['nivel']);
                $('#clave_pres_add').val(data[0]['Codigo_pres']);
            })
        })
    })
    $('#registrar_us_ins').on('click', function () {
        var miArchvio = $("#archvioID").prop('files')[0];
        var formData_example = new FormData($(".form_example")[0]);
        formData_example.append('archvioID', miArchvio);
        var CURP = $("#CURP2_Add").val();
        var rfc_comp = $("#RFC_COMP_add").val();
        var rfc_corto = $("#RFC_CORTO_add").val();
        var num_empleado = $("#NO_EMPLEADO_add").val();
        var nombre_S = $("#NOMBRE_add").val();
        var apllido_p = $("#APELLIDO_P_add").val();
        var apllido_m = $("#APELLIDO_M_add").val();
        var correo_ins = $("#CORREO_add").val();
        var correo_p = $("#CORREO_P_add").val();
        var tel_1 = $("#num_1_add").val();
        var tel_2 = $("#num_2_add").val();
        var tel_ext = $("#ext_tel_add").val();
        var estatus_op = $("#estatus_add").val();
        var fec_ingreso = $("#fecha_ingreso_add").val();
        var genero = $("#sex_add").val();
        var hijos = $("#Hijos_add").val();
        var est_civil = $("#estado_civ_add").val();
        var escolaridad = $("#Escolaridad_add").val();
        var est_escolar = $("#estatus_esco_add").val();
        var carrera = $("#carrera_add").val();
        var admin = $("#id_admin_add").val();
        var sub = $("#id_sub_admin_add").val();
        var dep = $("#ID_DEPA_add").val();
        var jefe_dir_adr = $("#RFC_JEFE_add").val();
        var puesto_adr = $("#ID_PUESTO_add").val();
        var num_plaza = $("#posision_add").val();
        var nivel = $("#nivel_add").val();
        var clave_presu = $("#clave_pres_add").val();
        var clave_puesto = $("#clav_puesto_add").val();
        var nombramiento = $("#tipo_nombramiento12_add").val();
        var nivel_jerarq = $("#nivel_jerarquico_add").val(); 
        var sindicato = $("#sindicato_add").val();  
        var salario_net = $("#sueldo_neto_add").val();       
        var ext = $('#archvioID').val().split('.').pop().toLowerCase();

        if($.inArray(ext, ['jpg']) == -1) {
            toastr.error('Extencion invalida, solo se pueden aceptar imagenes con extencion .jpg','Notificacion',{
                "progressBar":true
            });
        }
        else{
            var datoss = {
                CURP: CURP,
                rfc_comp: rfc_comp,
                rfc_corto: rfc_corto,
                num_empleado: num_empleado,
                nombre_S: nombre_S,
                apllido_p: apllido_p,
                apllido_m: apllido_m,
                correo_ins: correo_ins,
                correo_p: correo_p,
                tel_1: tel_1,
                tel_2: tel_2,
                tel_ext: tel_ext,
                estatus_op: estatus_op,
                fec_ingreso: fec_ingreso,
                genero: genero,
                hijos: hijos,
                est_civil: est_civil,
                escolaridad: escolaridad,
                est_escolar: est_escolar,
                carrera: carrera,
                admin: admin,
                sub: sub,
                dep: dep,
                jefe_dir_adr: jefe_dir_adr,
                puesto_adr: puesto_adr,
                num_plaza: num_plaza,
                nivel: nivel,
                clave_presu: clave_presu,
                clave_puesto: clave_puesto,
                nombramiento:nombramiento,
                nivel_jerarq:nivel_jerarq,
                sindicato:sindicato,
                salario_net:salario_net

             
            }
            var json = JSON.stringify(datoss);
    
            if (CURP == '' || CURP.length < 18) {
                toastr.error("La CURP no puedes dejarla en blanco o puede tener menos de 18 caracteres", 'Notificación:', {
                    "progressBar": true
                })
            } else {
    
                if (rfc_comp == '' || rfc_comp.length < 13) {
                    toastr.error("El RFC no puedes dejarlo en blanco o puede tener menos de 13 caracteres", 'Notificación:', {
                        "progressBar": true
                    })
                } else {
                    if (num_empleado == '') {
                        toastr.error("No puedes dejar el número de empleado en blanco", 'Notificación:', {
                            "progressBar": true
                        })
                    } else {
                        if (nombre_S == '') {
                            toastr.error("Tienes que agregar el nombre del empleado", 'Notificación:', {
                                "progressBar": true
                            })
                        } else {
                            if (apllido_p == '' || apllido_m == '') {
                                toastr.error("Tienes que agregar los apellidos del empleado", 'Notificación:', {
                                    "progressBar": true
                                })
                            } else {
                                if (correo_ins == '') {
                                    toastr.error("Tienes que agregar el correo instituciónal", 'Notificación:', {
                                        "progressBar": true
                                    })
                                } else {
                                    if (estatus_op == 0) {
                                        toastr.error("Tienes que agregar el estatus de actividad que tiene el empleado", 'Notificación:', {
                                            "progressBar": true
                                        })
                                    } else {
                                        if (fec_ingreso == '') {
                                            toastr.error("Falta agregar la fecha de ingreso a la institución del empleado", 'Notificación:', {
                                                "progressBar": true
                                            })
                                        } else {
                                            if (genero == 0) {
                                                toastr.error("Falta agregar el genero del empleado", 'Notificación:', {
                                                    "progressBar": true
                                                })
                                            } else {
                                                if (escolaridad == 0) {
                                                    toastr.error("Falta agregar la escolaridad del empleado", 'Notificación:', {
                                                        "progressBar": true
                                                    })
                                                } else {
                                                    if (est_escolar == 0) {
                                                        toastr.error("Falta agregar el estatus de la escolaridad del empleado", 'Notificación:', {
                                                            "progressBar": true
                                                        })
                                                    } else {
                                                        if (escolaridad == 4 && est_escolar == 3 || escolaridad == 4 && est_escolar == 4 || escolaridad == 4 && est_escolar == 5) {
    
                                                            if (carrera == '') {
                                                                toastr.error("Falta agregar la carrera o titulo del empleado ", 'Notificación:', {
                                                                    "progressBar": true
                                                                })
                                                            } else {
                                                                if (admin == 0 || sub == 0 || dep == 0) {
                                                                    toastr.error("Falta agregar la administracíon, subadministracion o departamento donde estara el empleado", 'Notificación:', {
                                                                        "progressBar": true
                                                                    })
                                                                } else {
                                                                    if (puesto_adr == 0) {
                                                                        toastr.error("Falta agregar el puesto ocupante del empleado", 'Notificación:', {
                                                                            "progressBar": true
                                                                        })
                                                                    } else {
                                                                        if (num_plaza == '') {
                                                                            toastr.error("Tienes que seleccionar la plaza ocupante del empleado", 'Notificación:', {
                                                                                "progressBar": true
                                                                            })
                                                                        } else {
                                                                            $.post("php/valida_carga_fotos.php", {
                                                                                datos: json
                                                                            }, function (respuesta) {
                                                                                toastr.info(respuesta, 'Notificación:', {
                                                                                    "progressBar": true
                                                                                })
                                                                            }).done(function (data_in) {
                                                                                if (data_in == true) {
                                                                                    $.ajax({
                                                                                        url: "./php/valida_carga_fotos.php",
                                                                                        type: "POST",
                                                                                        contentType: false,
                                                                                        processData: false,
                                                                                        data: formData_example,
                                                                                    }).done(function (respuesta) {
                                                                                        toastr.success(respuesta, 'Notificación:', {
                                                                                            "progressBar": true
                                                                                        })
                                                                                        limpia_campos_form_agrega()
                                                                                    })
                                                                                } else {
                                                                                    toastr.error('No hay respuesta del servidor', 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
    
                                                                            })
                                                                        }
    
    
                                                                    }
    
                                                                }
    
                                                            }
    
                                                        } else if (escolaridad == 5 && est_escolar == 3 || escolaridad == 5 && est_escolar == 4 || escolaridad == 5 && est_escolar == 5) {
                                                            if (carrera == '') {
                                                                toastr.error("Falta agregar la carrera o titulo del empleado ", 'Notificación:', {
                                                                    "progressBar": true
                                                                })
                                                            } else {
                                                                if (admin == 0 || sub == 0 || dep == 0) {
                                                                    toastr.error("Falta agregar la administracíon, subadministracion o departamento donde estara el empleado", 'Notificación:', {
                                                                        "progressBar": true
                                                                    })
                                                                } else {
                                                                    if (puesto_adr == 0) {
                                                                        toastr.error("Falta agregar el puesto ocupante del empleado", 'Notificación:', {
                                                                            "progressBar": true
                                                                        })
                                                                    } else {
                                                                        if (num_plaza == '') {
                                                                            toastr.error("Tienes que seleccionar la plaza ocupante del empleado", 'Notificación:', {
                                                                                "progressBar": true
                                                                            })
                                                                        } else {
                                                                            $.post("php/valida_carga_fotos.php", {
                                                                                datos: json
                                                                            }, function (respuesta) {
                                                                                // toastr.info(respuesta, 'Notificación:', {
                                                                                //     "progressBar": true
                                                                                // })
                                                                            }).done(function (data_in) {
                                                                                if (data_in == true) {
                                                                                    $.ajax({
                                                                                        url: "./php/valida_carga_fotos.php",
                                                                                        type: "POST",
                                                                                        contentType: false,
                                                                                        processData: false,
                                                                                        data: formData_example,
                                                                                    }).done(function (respuesta) {
                                                                                        toastr.success(respuesta, 'Notificación:', {
                                                                                            "progressBar": true
                                                                                        })
                                                                                        limpia_campos_form_agrega()
                                                                                    })
                                                                                } else {
                                                                                    toastr.error('No hay respuesta del servidor', 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
    
                                                                            })
                                                                        }
    
    
                                                                    }
    
                                                                }
    
                                                            }
                                                        } else if (escolaridad == 6 && est_escolar == 3 ||escolaridad == 6 && est_escolar == 4 || escolaridad == 6 && est_escolar == 5) {
                                                            if (carrera == '') {
                                                                toastr.error("Falta agregar la carrera o titulo del empleado ", 'Notificación:', {
                                                                    "progressBar": true
                                                                })
                                                            } else {
                                                                if (admin == 0 || sub == 0 || dep == 0) {
                                                                    toastr.error("Falta agregar la administracíon, subadministracion o departamento donde estara el empleado", 'Notificación:', {
                                                                        "progressBar": true
                                                                    })
                                                                } else {
                                                                    if (puesto_adr == 0) {
                                                                        toastr.error("Falta agregar el puesto ocupante del empleado", 'Notificación:', {
                                                                            "progressBar": true
                                                                        })
                                                                    } else {
                                                                        if (num_plaza == '') {
                                                                            toastr.error("Tienes que seleccionar la plaza ocupante del empleado", 'Notificación:', {
                                                                                "progressBar": true
                                                                            })
                                                                        } else {
                                                                            $.post("php/valida_carga_fotos.php", {
                                                                                datos: json
                                                                            }, function (respuesta) {
                                                                                 toastr.info(respuesta, 'Notificación:', {
                                                                                     "progressBar": true
                                                                                 })
                                                                            }).done(function (data_in) {
                                                                                if (data_in == true) {
                                                                                    $.ajax({
                                                                                        url: "./php/valida_carga_fotos.php",
                                                                                        type: "POST",
                                                                                        contentType: false,
                                                                                        processData: false,
                                                                                        data: formData_example,
                                                                                    }).done(function (respuesta) {
                                                                                        toastr.success(respuesta, 'Notificación:', {
                                                                                            "progressBar": true
                                                                                        })
                                                                                        limpia_campos_form_agrega()
                                                                                    })
                                                                                } else {
                                                                                    toastr.error('No hay respuesta del servidor', 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
    
                                                                            })
                                                                        }
    
    
                                                                    }
    
                                                                }
    
                                                            }
                                                        } else if (escolaridad == 7 && est_escolar == 3 || escolaridad == 7 && est_escolar == 4 || escolaridad == 7 && est_escolar == 5) {
                                                            if (carrera == '') {
                                                                toastr.error("Falta agregar la carrera o titulo del empleado ", 'Notificación:', {
                                                                    "progressBar": true
                                                                })
                                                            } else {
                                                                if (admin == 0 || sub == 0 || dep == 0) {
                                                                    toastr.error("Falta agregar la administracíon, subadministracion o departamento donde estara el empleado", 'Notificación:', {
                                                                        "progressBar": true
                                                                    })
                                                                } else {
                                                                    if (puesto_adr == 0) {
                                                                        toastr.error("Falta agregar el puesto ocupante del empleado", 'Notificación:', {
                                                                            "progressBar": true
                                                                        })
                                                                    } else {
                                                                        if (num_plaza == '') {
                                                                            toastr.error("Tienes que seleccionar la plaza ocupante del empleado", 'Notificación:', {
                                                                                "progressBar": true
                                                                            })
                                                                        } else {
                                                                            $.post("php/valida_carga_fotos.php", {
                                                                                datos: json
                                                                            }, function (respuesta) {
                                                                                toastr.info(respuesta, 'Notificación:', {
                                                                                    "progressBar": true
                                                                                })
                                                                            }).done(function (data_in) {
                                                                                if (data_in == true) {
                                                                                    $.ajax({
                                                                                        url: "./php/valida_carga_fotos.php",
                                                                                        type: "POST",
                                                                                        contentType: false,
                                                                                        processData: false,
                                                                                        data: formData_example,
                                                                                    }).done(function (respuesta) {
                                                                                        toastr.success(respuesta, 'Notificación:', {
                                                                                            "progressBar": true
                                                                                        })
                                                                                        limpia_campos_form_agrega()
                                                                                    })
                                                                                } else {
                                                                                    toastr.error('No hay respuesta del servidor', 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
    
                                                                            })
                                                                        }
    
                                                                    }
    
                                                                }
    
                                                            }
                                                        } else if (escolaridad == 8 && est_escolar == 3 || escolaridad == 8 && est_escolar == 4 || escolaridad == 8 && est_escolar == 5) {
                                                            if (carrera == '') {
                                                                toastr.error("Falta agregar la carrera o titulo del empleado ", 'Notificación:', {
                                                                    "progressBar": true
                                                                })
                                                            } else {
                                                                if (admin == 0 || sub == 0 || dep == 0) {
                                                                    toastr.error("Falta agregar la administracíon, subadministracion o departamento donde estara el empleado", 'Notificación:', {
                                                                        "progressBar": true
                                                                    })
                                                                } else {
                                                                    if (puesto_adr == 0) {
                                                                        toastr.error("Falta agregar el puesto ocupante del empleado", 'Notificación:', {
                                                                            "progressBar": true
                                                                        })
                                                                    } else {
                                                                        if (num_plaza == '') {
                                                                            toastr.error("Tienes que seleccionar la plaza ocupante del empleado", 'Notificación:', {
                                                                                "progressBar": true
                                                                            })
                                                                        } else {
                                                                            $.post("php/valida_carga_fotos.php", {
                                                                                datos: json
                                                                            }, function (respuesta) {
                                                                                toastr.info(respuesta, 'Notificación:', {
                                                                                    "progressBar": true
                                                                                })
                                                                            }).done(function (data_in) {
                                                                                if (data_in == true) {
                                                                                    $.ajax({
                                                                                        url: "./php/valida_carga_fotos.php",
                                                                                        type: "POST",
                                                                                        contentType: false,
                                                                                        processData: false,
                                                                                        data: formData_example,
                                                                                    }).done(function (respuesta) {
                                                                                        toastr.success(respuesta, 'Notificación:', {
                                                                                            "progressBar": true
                                                                                        })
                                                                                        limpia_campos_form_agrega()
                                                                                    })
                                                                                } else {
                                                                                    toastr.error('No hay respuesta del servidor', 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
    
                                                                            })
                                                                        }
    
    
                                                                    }
    
                                                                }
    
                                                            }
                                                        } else {
                                                            if (admin == 0 || sub == 0 || dep == 0) {
                                                                toastr.error("Falta agregar la administracíon, subadministracion o departamento donde estara el empleado", 'Notificación:', {
                                                                    "progressBar": true
                                                                })
                                                            } else {
                                                                if (puesto_adr == 0) {
                                                                    toastr.error("Falta agregar el puesto ocupante del empleado", 'Notificación:', {
                                                                        "progressBar": true
                                                                    })
                                                                } else {
                                                                    if (num_plaza == '') {
                                                                        toastr.error("Tienes que seleccionar la plaza ocupante del empleado", 'Notificación:', {
                                                                            "progressBar": true
                                                                        })
                                                                    } else {
                                                                        $.post("php/valida_carga_fotos.php", {
                                                                            datos: json
                                                                        }, function (respuesta) {
                                                                            toastr.info(respuesta, 'Notificación:', {
                                                                                "progressBar": true
                                                                            })
                                                                        }).done(function (data_in) {
                                                                            if (data_in == true) {
                                                                                $.ajax({
                                                                                    url: "./php/valida_carga_fotos.php",
                                                                                    type: "POST",
                                                                                    contentType: false,
                                                                                    processData: false,
                                                                                    data: formData_example,
                                                                                }).done(function (respuesta) {
                                                                                    toastr.success(respuesta, 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                    limpia_campos_form_agrega()
                                                                                })
                                                                            } else {
                                                                                toastr.error('No hay respuesta del servidor', 'Notificación:', {
                                                                                    "progressBar": true
                                                                                })
                                                                            }
    
                                                                        })
                                                                    }
    
    
                                                                }
    
                                                            }
    
    
                                                        }
    
                                                    }
    
                                                }
    
                                            }
    
                                        }
    
    
                                    }
    
                                }
    
                            }
                        }
    
    
                    }
    
                }
    
    
    
    
            }
        }
  
       

    });

})


function limpia_campos_form_agrega(){
    $("#archvioID").val("");
    $("#CURP2_Add").val("");
    $("#RFC_COMP_add").val("");
    $("#RFC_CORTO_add").val("");
    $("#NO_EMPLEADO_add").val("");
    $("#NOMBRE_add").val("");
    $("#APELLIDO_P_add").val("");
    $("#APELLIDO_M_add").val("");
    $("#CORREO_add").val("");
    $("#CORREO_P_add").val("");
    $("#num_1_add").val("");
    $("#num_2_add").val("");
    $("#ext_tel_add").val("");
    $("#estatus_add").val(0);
    $("#fecha_ingreso_add").val("");
    $("#sex_add").val(0);
    $("#Hijos_add").val(0);
    $("#estado_civ_add").val(0);
    $("#Escolaridad_add").val(0);
    $("#estatus_esco_add").val(0);
    $("#carrera_add").val("");
    $("#id_admin_add").val(0);
    $("#id_sub_admin_add").val(0);
    $("#ID_DEPA_add").val(0);
    $("#RFC_JEFE_add").val(0);
    $("#ID_PUESTO_add").val(0);
    $("#posision_add").val("");
    $("#nivel_add").val("");
    $("#clave_pres_add").val("");
    $("#clav_puesto_add").val("");
}



