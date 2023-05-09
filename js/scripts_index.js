$("#ver").click(function (e) {
    openNav();
});

$(document).ready(function () {
    $('#pag_activos').on('click', function () {
        location.href = "Plantilla_empleados_activos.php";
    });
    $('#pag_inactivos').on('click', function () {
        location.href = "Plantilla_empleados_baja.php";
    });
    $('#pag_estructura').on('click', function () {
        location.href = "Estructura.php";
    });
    $('#pag_sistemas').on('click', function () {
        location.href = "Matriz_sistemas.php";
    });


})
function Cancelar_responsiva2(id_acceso,id_empleado){
    var id = id_acceso
    $.ajax({
        type: "POST",
        url: "php/consulta_dat.php",
        data: {
            cancelar_acceso2: id
        },
        dataType: "html",
        success: function (response) {
            toastr.error(response, 'Notificacion');
            Historial_registro_sistemas(id_empleado)
        }
    });
}
function Editar_oficio(id_oficio,id_empleado) {
    $('#Modal_editor_documento_oficios').modal();
    $('#carga_documento_oficio_firmado_asig').attr('onclick','Subir_archivo_firmado('+id_oficio+','+id_empleado+')');
    $('#cerrar_modal_editor_oficios').attr('onclick','trae_Oficios_historial('+id_empleado+')');
}
function Retro_responsivas(id_acceso,id_empleado) {
    $('#Modal_retro_responsivas').modal();
     $('#carga_modal_responsiva_retro').attr('onclick','Subir_responsiva_firmada('+id_acceso+','+id_empleado+')');
     
     $('#cerrar_modal_responsiva_retro').attr('onclick','Historial_registro_sistemas('+id_empleado+')');

     $.post("php/consulta_dat.php",{saca_roles_res:id_acceso},function(){
     }).done(function(resp){
         $('#Contenedor_principal').html(resp);
     }).fail(function(){
         console.log(error)
     })
     $.post("php/consulta_dat.php",{saca_roles_res_activos:id_acceso},function(){
    }).done(function(resp){
        $('#Contenedor_principal').html(resp);
    })
    
}
function cambiaroceso_resp(acceso){
    $('#mod_edit_estado_proc').modal();
    $('#Mares_obser').attr('onclick','Accion_cambio_est_resp('+acceso+')');
    //console.log(acceso)
}
function vermas() {
    $('#vermasdiv').toggle();
    $('#link_ver').toggle();
}
function Accion_cambio_est_resp(acceso){

    const estado =  $('#Cambia_estado_cuenta').val();
    const fecha =  $('#fecha_cambio_est_resp').val();
    const datos = {estado:estado,
        fecha:fecha,
        id_acc:acceso}
    var json = JSON.stringify(datos)
    if (estado == 0 || estado == 11 && fecha == '') {
        toastr.error("Tienes que seleccionar un estado y una fecha para poder activar el cambio","Notificación")
    } else {
        $.ajax({
            type: "POST",
            url: "php/consulta_dat.php",
            data: {cambia_est_resp: json},
            dataType: "HTML",
            success: function (response) {
                if (response == true) {
                    toastr.success("Cambio exitoso","Notificación")
                    $('#Cambia_estado_cuenta').val(0)
                    $('#fecha_cambio_est_resp').val("")
                } else {
                    toastr.error(response,"Notificación")
                }
              
            }
        });
    }
    //alert('hola')
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
    $('#ID_DEPA').change(function () {
        $('#ID_DEPA option:selected').each(function () {
            var dep = $(this).val();
            $.post("php/Obtener_combos.php", {
                filtra_jefe_por_dep: dep
            }, function (data) {
                $('#RFC_JEFE').html(data)
                // console.log(data)
            })
        })
    })
    $('#Si_oficio').change(function () {
        $('#Si_oficio option:selected').each(function () {
            var si_ofi = $(this).val();

            if (si_ofi == 1) {
                $('#Bloque_genera_tipo_oficio').show();
            } else {
                $('#Bloque_genera_tipo_oficio').hide();
            }
            // $.post("php/Obtener_combos.php", {
            //     id_admin: admin
            // }, function (data) {
            //     $('#id_sub_admin_add').html(data)
            // })
        })
    })

    $('#id_puesto_adr').change(function () {
        $('#id_puesto_adr option:selected').each(function () {
            var id_puesto = $(this).val();
            $.post("php/Obtener_combos.php", {
                nombre_puesto_adr: id_puesto
            }, function (data) {
                $('#nombre_puesto_adr').val(data[0]['nombre_puesto'])
                $("#Estatus_activo_adr option[value='" + data[0]['estatus'] + "']").attr("selected", true);
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

        if ($.inArray(ext, ['jpg']) == -1) {
            toastr.error('Extencion invalida, solo se pueden aceptar imagenes con extencion .jpg', 'Notificacion', {
                "progressBar": true
            });
        } else {
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
                nombramiento: nombramiento,
                nivel_jerarq: nivel_jerarq,
                sindicato: sindicato,
                salario_net: salario_net


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
                                                                                if (respuesta == true) {
                                                                                    toastr.success("Usuario registrado con exito!", 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                } else {
                                                                                    toastr.error(respuesta, 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
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
                                                                                if (respuesta == true) {
                                                                                    toastr.success("Usuario registrado con exito!", 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                } else {
                                                                                    toastr.error(respuesta, 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }

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
                                                                                    toastr.error('El usuario no se pudo registrar', 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }

                                                                            })
                                                                        }


                                                                    }

                                                                }

                                                            }
                                                        } else if (escolaridad == 6 && est_escolar == 3 || escolaridad == 6 && est_escolar == 4 || escolaridad == 6 && est_escolar == 5) {
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
                                                                                if (respuesta == true) {
                                                                                    toastr.success("Usuario registrado con exito!", 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                } else {
                                                                                    toastr.error(respuesta, 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
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
                                                                                    toastr.error('El usuario no se pudo registrar', 'Notificación:', {
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
                                                                                if (respuesta == true) {
                                                                                    toastr.success("Usuario registrado con exito!", 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                } else {
                                                                                    toastr.error(respuesta, 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
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
                                                                                    toastr.error('El usuario no se pudo registrar', 'Notificación:', {
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
                                                                                if (respuesta == true) {
                                                                                    toastr.success("Usuario registrado con exito!", 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                } else {
                                                                                    toastr.error(respuesta, 'Notificación:', {
                                                                                        "progressBar": true
                                                                                    })
                                                                                }
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
                                                                                    toastr.error('El usuario no se pudo registrar', 'Notificación:', {
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
                                                                            if (respuesta == true) {
                                                                                toastr.success("Usuario registrado con exito!", 'Notificación:', {
                                                                                    "progressBar": true
                                                                                })
                                                                            } else {
                                                                                toastr.error(respuesta, 'Notificación:', {
                                                                                    "progressBar": true
                                                                                })
                                                                            }
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
                                                                                toastr.error('El usuario no se pudo registrar', 'Notificación:', {
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


function limpia_campos_form_agrega() {
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
    $("#posision_ten").val(0);
    $("#estatus_plazas_act").val(0);
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





function ConfirmarCargaUSU(valor) {
    //alert("si entra") 

    $.ajax({
        type: "POST",
        url: "php/accion_carga.php",
        data: {
            USU1: valor
        },
        dataType: "html",
        success: function (response) {
            //    $("#resultado_carga").modal();
            toastr.success(response, 'Notificacion');
            console.log(response);
        }
    });
}

$(document).ready(function () {
    $('#fecha_de_oficio_editar').datepicker({
        endDate: 'today',
        autoclose: true,
        //daysOfWeekDisabled: [0, 6],
        todayHighlight: true,
        format: 'yyyy/mm/dd',
        toggleActive: true,
        language: 'es'
    });
  


})

function Subir_archivo_firmado(id_oficio,id_empleado) {
    var miArchvio_firmado = $('#carga_oficio_firm_asig').prop('files')[0];
    var fecha_oficio = $('#fecha_de_oficio_editar').val();
    var id_oficio = id_oficio;
    var ext = $('#carga_oficio_firm_asig').val().split('.').pop().toLowerCase();

    if ($.inArray(ext, ['pdf','zip']) == -1) {
        toastr.error('Extencion invalida, solo se pueden aceptar documentos con extencion .pdf o .zip', 'Notificacion', {
            "progressBar": true
        });
    } else {
        if (fecha_oficio == '') {
            toastr.error('Debes agregar la fecha en la que se firmo el documento.', 'Notificacion', {
                "progressBar": true
            });
        }else{
            var json3 = {
                fecha_oficio: fecha_oficio,
                id_oficio: id_oficio
            }
            //console.log(json3)
            var formData_example = new FormData($('.form_example_asigna')[0]);
            formData_example.append('miArchvio_firmado', miArchvio_firmado);
            $.post('php/valida_carga_fotos.php', {
                Aactualiza_oficio: json3
            }, function (respuesta) {
                if (respuesta == true) {
                    toastr.success('Se actualizo el estado del oficio satisfactoriamente!', 'Notificación:', {
                        'progressBar': true
                    })
                } else {
                    toastr.error(respuesta, 'Notificación:', {
                        'progressBar': true
                    })
                    //console.log(respuesta)
                }
            }).done(function (data_in) {
                if (data_in == true) {
                    $.ajax({
                        url: './php/valida_carga_fotos.php',
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData_example,
                    }).done(function (respuesta) {
                        toastr.success(respuesta, 'Notificación:', {
                            'progressBar': true
                        })
    
                    })
                } else {
                    toastr.error('El documento no se pudo cargar correctamente', 'Notificación:', {
                        'progressBar': true
                    })
                    $('#cerrar_modal_editor_oficios').attr('onclick','trae_Oficios_historial('+id_empleado+')');
                }
    
            })
        }
       
    }

}
function Subir_responsiva_firmada(id_acceso,id_empleado) {
    var miArchvio_firmado = $('#Carga_responsiva_firmada').prop('files')[0];
    var fecha_resp_alta = $('#fec_firma_responsiva').val();
    var id_acceso = id_acceso;
    var ext = $('#Carga_responsiva_firmada').val().split('.').pop().toLowerCase();
    console.log(miArchvio_firmado);
    if ($.inArray(ext, ['pdf','zip']) == -1) {
        toastr.error('Extencion invalida, solo se pueden aceptar documentos con extencion .pdf o .zip', 'Notificacion', {
            "progressBar": true
        });
    } else {
        if (fecha_resp_alta == '') {
            toastr.error('Debes agregar la fecha en la que se firmo el documento.', 'Notificacion', {
                "progressBar": true
            });
        }else{
            var json3 = {
                fecha_resp_alta: fecha_resp_alta,
                id_acceso: id_acceso
            }
            console.log(miArchvio_firmado)
            console.log(json3)
            var Json3 = JSON.stringify(json3)
            var formData_example = new FormData($('.form_example_asigna')[0]);
            formData_example.append('miArchvio_firmado_resp', miArchvio_firmado);
            $.post('php/consulta_dat.php', {
                Actualiza_resp: Json3
            }, function (respuesta) {
                // toastr.info(respuesta,"Noticias")
                if (respuesta == true) {
                    toastr.success('Se actualizo el estado de la responsiva!', 'Notificación:', {
                        'progressBar': true
                    })
                } else {
                    toastr.error(respuesta, 'Notificación:', {
                        'progressBar': true
                    })
                    //console.log(respuesta)
                }
            }).done(function (data_in) {
                if (data_in == true) {
                    $.ajax({
                        url: './php/valida_carga_fotos.php',
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData_example,
                    }).done(function (respuesta) {
                        toastr.success(respuesta, 'Notificación:', {
                            'progressBar': true
                        })
    
                    })
                } else {
                    toastr.error('El documento no se pudo cargar correctamente', 'Notificación:', {
                        'progressBar': true
                    })
                    //$('#carga_modal_responsiva_retro').attr('onclick','trae_Oficios_historial('+id_empleado+')');
                }
    
            })
        }
       
    }

}

function descarga_documento(rfc,no_empleado,id_oficio,num_oficio,tipo_oficio)

	{
  
        var nombre_doc=no_empleado+"_"+id_oficio+"_"+num_oficio+"_"+tipo_oficio;
        createCookie('nombre_doc',nombre_doc,1)
        createCookie('Carpeta',rfc,1)
        location.href='php/Descarga_documentos.php'

	}
  

    function modal_actualiza(id_empleado,no_emp) {
        $('#Muestra_modal_cambios_fotos').modal()
        $('#cerrar_modal_foto').attr('onclick','Revisa_info_det_us('+id_empleado+')')
        $('#subir_foto').attr('onclick','subir_foto('+id_empleado+','+no_emp+')')
    }
    
    
function subir_foto(id_empleado,no_emp) {
    var miArchvio = $("#Foto_nueva").prop('files')[0];
    var formData_example = new FormData($(".formulario_cambia_foto")[0]);
    formData_example.append('Foto_nueva', miArchvio);
    var datos = {no_emp:no_emp}
    var ext = $('#Foto_nueva').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg']) == -1) {
        toastr.error('Extencion invalida, solo se pueden aceptar imagenes con extencion .jpg', 'Notificacion', {
            "progressBar": true
        });
    }
    else{
        $.post("php/valida_carga_fotos.php",{nombre_foto:datos},function(){
        }).done(function(respuesta){
            //toastr.info(respuesta,'Notificacion')
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
                Revisa_info_det_us(id_empleado)
            })
        })
       
    }
}
  
function descarga_aplicacion(id_sistema)
{

 var id_sistema= id_sistema;
 var carpeta = 'Sistemas_almacenados'
 createCookie('Num_sistema',id_sistema,1)
 createCookie('Carpeta',carpeta,1)
 location.href='php/descarga_aplicacion.php'
}
function descarga_responsiva_firmada(rfc,no_empleado,id_reg_acceso,nombre_sistema)
{


 var carpeta = rfc;
 var no_empleado= no_empleado;
 var id_reg_acceso = id_reg_acceso;
 var nombre_sistema= nombre_sistema;

 createCookie('no_empleado',no_empleado,1)
 createCookie('Carpeta',carpeta,1)
 createCookie('id_reg_acceso',id_reg_acceso,1)
 createCookie('nombre_sistema',nombre_sistema,1)


 location.href='php/descarga_responsiva.php'
}
function genera_reporte_gestor()
{
    var id_sistema = 1;
 createCookie('hol',id_sistema,1)
 location.href='php/genera_reporte_excel_gestor.php'
}

