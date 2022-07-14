$("#ver").click(function (e) {
  openNav();
});
$(document).ready(function () {
  $('#Modal_detalle_usuario_insumo').on('click', function () {
    $('#body_cer').addClass('modal-open');
  })
  $('#RFC_COMP_add').on('keyup', function () {
    var datos = $('#RFC_COMP_add').val();

    if ($('#RFC_COMP_add').val().length >= 10) {
      $.ajax({
        type: 'POST',
        dataType: 'html',
        url: "php/algoritmo.php",
        data: {
          RFC: datos
        },

      }).done(function (respuesta) {
        $('#RFC_CORTO_add').val(respuesta);
      })
    } else {

    }

  });
  $('#Muestra_from_access_sistem').on('click', function () {
    $('#form_agrega_acceso_sis_a_user').toggle(200, function () {});
  })
  $('#agrega_acceso_al_sistema').on('click', function () {
    $('#form_agrega_acceso_sis_a_user').toggle(200, function () {});
  })
  $('#Indice_edicion').on('click', function () {
    $('#formulario_edicion_sistema').toggle(200, function () {});
  })
  $('#muestra_agrega_roles_forms').on('click', function () {
    $('#casilla_para_agregar_roles').toggle(200, function () {});
  })
  $('#selec_sistem_access').change(function () {
    $('#selec_sistem_access option:selected').each(function () {
      var sis = $(this).val();
      $.post("php/consulta_dat.php", {
        rolores_por_sistema: sis
      }, function (data) {
        $('#muestra_roles').html(data);
      })
    })
  })
 


});

function Agrega_sistema_al_empleado(id_empleado) {
  var sistema = $('#selec_sistem_access').val();
  var fecha = $('#fecha_responsiva').val();
  var selected = '';
  var roles = '';
  $('input:checkbox[name=Roles_asign]:checked').each(function () {
    if (this.checked) {
      roles += $(this).val() + ', ';
    }

  });

  if (roles != '') {
    if (fecha == '') {
      alert('Tienes quue sleeccionar la fecha que asigna a la cuenta')
    } else {
      var json = {
        id_empleado: id_empleado,
        roles: roles,
        fecha: fecha,
        sistema: sistema
      }
      var datos = JSON.stringify(json)
      $.ajax({
        type: "POST",
        url: "php/consulta_dat.php",
        data: {
          datos_para_reg: datos
        },
        dataType: "HTML",
        success: function (response) {
          toastr.success(response, 'Notificacion')
          // Revisa_info_det_us(id_empleado)
          Historial_registro_sistemas(id_empleado)
        }
      });
    }
  } else {
    alert('Tienes quue sleeccionar los roles que asigna a la cuenta')
  }
}


function Modifica_roles_resp_empleado2(id_acceso,id_empleado) {
  var selected = '';
  var roles = '';
  $('input:checkbox[name=Roles_asign]:checked').each(function () {
    if (this.checked) {
      roles += $(this).val() + ', ';
    }

  });

  if (roles != '') {
   
      var json = {
        id_acceso: id_acceso,
        roles: roles
      }
      var datos = JSON.stringify(json)
      $.ajax({
        type: 'POST',
        url: 'php/consulta_dat.php',
        data: {
          datos_para_reg2: datos
        },
        dataType: 'HTML',
        success: function (response) {
          toastr.success(response, 'Notificacion')
          // Revisa_info_det_us(id_empleado)
          Retro_responsivas(id_acceso,id_empleado)
          //Historial_registro_sistemas(id_empleado)
        }
      });
    
  } else {
    alert('Tienes quue sleeccionar los roles que asigna a la cuenta')
  }
}

function Actualiza_area_asign_y_jefe(id_user_in) {
  var id_empleado = id_user_in;
  var id_admin = $('#id_admin').val();
  var id_sub_admin = $('#id_sub_admin').val();
  var id_depto = $('#ID_DEPA').val();
  var id_jefe = $('#RFC_JEFE').val();
  var id_puesto = $('#ID_PUESTO').val();
  var fecha_mov_funcional = $('#fecha_mov_funcional').val();
  var opcion_oficio = $('#Si_oficio').val();
  var num_oficio = $('#no_oficio').val();
  var tipo_oficio = $('#tipo_ofifcio').val();
  var fecha_oficio = $('#fecha_de_oficio').val();
  var estructura = $('#estructura_2').val();

  var datos = {
    id_empleado: id_empleado,
    id_admin: id_admin,
    id_sub_admin: id_sub_admin,
    id_depto: id_depto,
    fecha_mov_funcional: fecha_mov_funcional,
    id_jefe: id_jefe,
    id_puesto: id_puesto,
    estructura: estructura,
  }
  var datos_oficios = {
    id_empleado: id_empleado,
    num_oficio: num_oficio,
    tipo_oficio: tipo_oficio,
    fecha_oficio: fecha_oficio,
  }
  if (fecha_mov_funcional == '') {
    toastr.error("Tienes que seleccionar la fecha en la que aplicara el movimiento.", "Notificación")
  } else {
    if (opcion_oficio == 1) {
      if (num_oficio == '') {
        toastr.error("No puedes dejar en bllanco el núumero de oficio.", "Notificación")
      } else {
        if (tipo_oficio == 0) {
          toastr.error("Tienes que seleccionar el tipo de oficio.", "Notificación")

        } else {
          if (fecha_oficio == '') {
            toastr.error("Tienes que seleccionar la fecha del oficio.", "Notificación")

          } else {

            var json = JSON.stringify(datos)
            $.ajax({
                url: 'php/consulta_dat.php',
                type: 'POST',
                dataType: 'html',
                data: {
                  act_area_asignada: json
                },
              })
              .done(function (respuesta) {
                toastr.info(respuesta, "Notificacion", {
                  "progressBar": true
                })
                Revisa_info_det_us(id_user_in)
                var json1 = JSON.stringify(datos_oficios)
                $.ajax({
                    url: 'php/consulta_dat.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                      Genera_oficio_Asignacion: json1
                    },
                  })
                  .done(function (respuesta) {
                    toastr.success(respuesta, "Notificacion", {
                      "progressBar": true
                    })
                    Revisa_info_det_us(id_user_in)
                  })
                  .fail(function () {
                    console.log("error");
                  });
              })
              .fail(function () {
                console.log("error");
              });


          }
        }
      }
    } else {
      var json = JSON.stringify(datos)
      $.ajax({
          url: 'php/consulta_dat.php',
          type: 'POST',
          dataType: 'html',
          data: {
            act_area_asignada: json
          },
        })
        .done(function (respuesta) {
          toastr.info(respuesta, "Notificacion", {
            "progressBar": true
          })
          Revisa_info_det_us(id_user_in)
        })
        .fail(function (error) {
          console.log(error);
        });
    }
  }



}

function limpia_campos_2() {
  $('#Puesto_fump_ten').val("");
  $('#clav_puesto_ten').val("");
  $('#plaza_jefe_ten').val("");
  $('#nombre_jefe_ten').val("");
  $('#clav_puesto_jefe_ten').val("");
  $('#nivel_ten').val("");
  $('#clave_pres2_ten').val("");
  $('#posision_ten').val(0);
}

function Actualiza_datos_adicionales(id_user_in) {
  var id_empleado = id_user_in;
  var genero = $('#sex').val();
  var hijos = $('#Hijos').val();
  var estado_civil = $('#estado_civ').val();
  var escolaridad = $('#Escolaridad').val();
  var estatus_escolar = $('#estatus_esco').val();
  var carrera = $('#carrera').val();
  var datos = {
    id_empleado: id_empleado,
    genero: genero,
    hijos: hijos,
    estado_civil: estado_civil,
    escolaridad: escolaridad,
    estatus_escolar: estatus_escolar,
    carrera: carrera,
  }
  var json = JSON.stringify(datos)

  $.ajax({
      url: 'php/consulta_dat.php',
      type: 'POST',
      dataType: 'html',
      data: {
        act_datos_adicionales: json
      },
    })
    .done(function (respuesta) {
      toastr.info(respuesta, "Notificacion", {
        "progressBar": true
      })
      Revisa_info_det_us(id_user_in)
    })
    .fail(function (error) {
      console.log(error);
    });

}

function Actualiza_datos_posision(id_user_in) {
  var id_empleado = id_user_in;
  var posision_act = $('#posision').val();
  var jefe_posision = $('#plaza_jefe').val();
  var nivel = $('#nivel').val();
  var clave_presupuesto = $('#clave_pres2').val();
  var sueldo_neto = $('#sueldo_neto').val();
  var id_proc_plaza = $('#estatus_plazas_act').val();
  var posision_ten = $('#posision_ten').val();
  var id_proc_plaza = $('#estatus_plazas_act').val();
  var datos = {
    id_empleado: id_empleado,
    posision_act: posision_act,
    posision_ten: posision_ten,
    nivel: nivel,
    clave_presupuesto: clave_presupuesto,
    sueldo_neto: sueldo_neto,
    id_proc_plaza: id_proc_plaza
  }
  var json = JSON.stringify(datos)
  console.log(json)
  if (id_proc_plaza == 4 || id_proc_plaza == 5) {
    if (posision_ten == 0) {
      toastr.info('Debes seleccionar una posision para continuar esta acción', "Notificacion", {
        "progressBar": true
      })
    } else {
      $.ajax({
          url: 'php/consulta_dat.php',
          type: 'POST',
          dataType: 'html',
          data: {
            act_datos_posision: json
          },
        })
        .done(function (respuesta) {
          toastr.info(respuesta, "Notificacion", {
            "progressBar": true
          })
          Revisa_info_det_us(id_user_in)
          limpia_campos_2()
        })
        .fail(function (error) {
          console.log(error);
        });
    }

  } else if (id_proc_plaza == 13) {
    $.ajax({
        url: 'php/consulta_dat.php',
        type: 'POST',
        dataType: 'html',
        data: {
          act_datos_posision_sueldos: json
        },
      })
      .done(function (respuesta) {
        toastr.info(respuesta, "Notificacion", {
          "progressBar": true
        })
        Revisa_info_det_us(id_user_in)
        limpia_campos_2()
      })
      .fail(function (error) {
        console.log(error);
      });
  } else {
    toastr.error('Debes seleccionar un proceso de acuerdo a tu solicitud', "Notificacion", {
      "progressBar": true
    })
  }



}

function numero(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
  return true;
}

function Revisa_info_plaza(id_posision) {
  $('#modal_info_posision').modal();
  $.post("php/consulta_dat.php", {
    posision_info: id_posision
  }, function (data) {}).done(function (data) {
    $('#pos_posision').val(data[0]['id_num_posision'])
    $('#pos_nivel_add').val(data[0]['nivel'])
    $('#pos_clave_pres_add').val(data[0]['Codigo_pres'])
    $('#pos_Puesto_fump_add').val(data[0]['id_puesto_fump'])
    $('#pos_clav_puesto_add').val(data[0]['clave_puesto'])
    $('#pos_sueldo_neto').val(data[0]['sueldo_neto'])
    $('#pos_plaza_jefe').val(data[0]['posision_jefe'])
    $('#agree_posision_change').attr('onclick', 'Actualiza_posision_info_mante(' + data[0]['id_posision'] + ')');
    $('#Nav_posision_mov').attr('onclick', 'Revisa_mov_plazas(' + data[0]['id_posision'] + ')');
  }).fail(function () {
    toastr.error("No hay datos relacionados de esta plaza", "Notificacion", {
      "progressBar": true
    })
  })

}

function Revisa_mov_plazas(id_pos) {
  $.ajax({
      url: 'php/consulta_dat.php',
      type: 'POST',
      dataType: 'html',
      data: {
        revisa_mov_plazas: id_pos
      },
    })
    .done(function (respuesta) {
      //console.log(respuesta)
      $('#Caja_mov_plazas').html(respuesta);

    })
    .fail(function () {
      console.log("error");
    });
}

function Actualiza_posision_info_mante(id_posision) {
  var num_posision = $('#pos_posision').val();
  var nivel = $('#pos_nivel_add').val();
  var clave_pres = $('#pos_clave_pres_add').val();
  var id_puesto = $('#pos_Puesto_fump_add').val();
  var clave_puesto = $('#pos_clav_puesto_add').val();
  var sueldo = $('#pos_sueldo_neto').val();
  var jefe_posision = $('#pos_plaza_jefe').val();
  var proc = $('#estatus_plazas_act_mante').val()
  var datos = {
    id_posision: id_posision,
    num_posision: num_posision,
    nivel: nivel,
    clave_pres: clave_pres,
    id_puesto: id_puesto,
    clave_puesto: clave_puesto,
    sueldo: sueldo,
    jefe_posision: jefe_posision,
    proc: proc
  }
  if (proc == 0) {
    toastr.error("Debes seleccionar un proceso.", "Notificación", {
      "progressBar": true
    })
  } else {
    var json = JSON.stringify(datos);

    $.post("php/consulta_dat.php", {
      actualiza_mante_posision: json
    }, function () {}).done(function (data) {
      toastr.info(data, "Notificación", {
        "progressBar": true
      })
      Revisa_info_plaza(id_posision)
    })
  }




}

function Actualiza_dat_basic(id_user_in) {

  var rfc = $("#RFC_COMP").val();
  var rfc_c = $("#RFC_CORTO").val();
  var curp = $("#CURP2").val();
  var nombre_s = $("#NOMBRE").val();
  var apellido_p = $("#APELLIDO_P1").val();
  var apellido_m = $("#APELLIDO_M").val();
  var correo = $("#CORREO").val();
  var correo_p = $("#CORREO_P").val();
  var num_tel1 = $("#num_1").val();
  var num_tel2 = $("#num_2").val();
  var ext = $("#ext_tel").val();
  var fec_ingres = $("#fecha_ingreso").val();
  var fec_baja = $("#fecha_baja").val();
  var estatus = $("#estatus").val();
  var no_empleado = $("#NO_EMPLEADO").val();
  var id_nivel_jerar = $("#nivel_jerar_detalle").val();
  var tipo_nom = $("#tipo_nombramiento12").val();
  var sindicato = $("#sindicato").val();
  var Motivo_especial_por_est = $("#Motivo_baja_option").val();
  var datos = {
    rfc: rfc,
    rfc_c: rfc_c,
    curp: curp,
    nombre_s: nombre_s,
    apellido_p: apellido_p,
    apellido_m: apellido_m,
    correo: correo,
    correo_p: correo_p,
    num_tel1: num_tel1,
    num_tel2: num_tel2,
    ext: ext,
    fec_ingres: fec_ingres,
    fec_baja: fec_baja,
    estatus: estatus,
    no_empleado: no_empleado,
    id_emp: id_user_in,
    tipo_nom: tipo_nom,
    id_nivel_jerar:id_nivel_jerar,
    sindicato: sindicato,
    Motivo_especial_por_est: Motivo_especial_por_est
  }
  if (estatus == 11 || estatus == 7 || estatus == 6 || estatus == 25 || estatus == 32) {
    if (fec_baja == '') {
      toastr.error("No puedes dejar sin seleccionar la fecha de la baja", "Notificación", {
        "progressBar": true
      })
      if (estatus == 11 && Motivo_especial_por_est == 0) {
        toastr.error("No puedes dejar sin seleccionar el motivo de la baja", "Notificación", {
          "progressBar": true
        })
      } else {
        var dato_json = JSON.stringify(datos);
        //console.log(dato_json)
        $.ajax({
            url: 'php/consulta_dat.php',
            type: 'POST',
            dataType: 'html',
            data: {
              act_datos_basic_ins: dato_json
            },
          })
          .done(function (respuesta) {
            console.log(respuesta)
            toastr.info(respuesta, "Notificacion", {
              "progressBar": true
            })
            Revisa_info_det_us(id_user_in)

          })
          .fail(function () {
            console.log("error");
          });
      }
      if (estatus == 32 && Motivo_especial_por_est == 0) {
        toastr.error("No puedes dejar sin seleccionar el acuerdo", "Notificación", {
          "progressBar": true
        })
      } else {
        var dato_json = JSON.stringify(datos);
        //console.log(dato_json)
        $.ajax({
            url: 'php/consulta_dat.php',
            type: 'POST',
            dataType: 'html',
            data: {
              act_datos_basic_ins: dato_json
            },
          })
          .done(function (respuesta) {
            console.log(respuesta)
            toastr.info(respuesta, "Notificacion", {
              "progressBar": true
            })
            Revisa_info_det_us(id_user_in)

          })
          .fail(function () {
            console.log("error");
          });
      }
    } else {
      var dato_json = JSON.stringify(datos);
      //console.log(dato_json)
      $.ajax({
          url: 'php/consulta_dat.php',
          type: 'POST',
          dataType: 'html',
          data: {
            act_datos_basic_ins: dato_json
          },
        })
        .done(function (respuesta) {
          console.log(respuesta)
          toastr.info(respuesta, "Notificacion", {
            "progressBar": true
          })
          Revisa_info_det_us(id_user_in)

        })
        .fail(function () {
          console.log("error");
        });
    }

  } else {
    var dato_json = JSON.stringify(datos);
    //console.log(dato_json)
    $.ajax({
        url: 'php/consulta_dat.php',
        type: 'POST',
        dataType: 'html',
        data: {
          act_datos_basic_ins: dato_json
        },
      })
      .done(function (respuesta) {
        console.log(respuesta)
        toastr.info(respuesta, "Notificacion", {
          "progressBar": true
        })
        Revisa_info_det_us(id_user_in)

      })
      .fail(function () {
        console.log("error");
      });
  }

}

function Actualiza_dat_basic_baja(id_user_in) {

  var rfc = $("#RFC_COMP").val();
  var rfc_c = $("#RFC_CORTO").val();
  var curp = $("#CURP2").val();
  var nombre_s = $("#NOMBRE").val();
  var apellido_p = $("#APELLIDO_P").val();
  var apellido_m = $("#APELLIDO_M").val();
  var correo = $("#CORREO").val();
  var correo_p = $("#CORREO_P").val();
  var num_tel1 = $("#num_1").val();
  var num_tel2 = $("#num_2").val();
  var ext = $("#ext_tel").val();
  var fec_ingres = $("#fecha_ingreso").val();
  var fec_baja = $("#fecha_baja").val();
  var estatus = $("#estatus").val();
  var no_empleado = $("#NO_EMPLEADO").val();
  var tipo_nom = $("#tipo_nombramiento12").val();
  var sindicato = $("#sindicato1").val();
  var datos = {
    rfc: rfc,
    rfc_c: rfc_c,
    curp: curp,
    nombre_s: nombre_s,
    apellido_p: apellido_p,
    apellido_m: apellido_m,
    correo: correo,
    correo_p: correo_p,
    num_tel1: num_tel1,
    num_tel2: num_tel2,
    ext: ext,
    fec_ingres: fec_ingres,
    fec_baja: fec_baja,
    estatus: estatus,
    no_empleado: no_empleado,
    id_emp: id_user_in,
    tipo_nom: tipo_nom,
    sindicato: sindicato
  }
  // toastr.info("entra aqui","Notif",{
  //   "progressBar":true
  // })
  if (estatus == 11 || estatus == 7 || estatus == 6 || estatus == 25) {
    if (fec_baja == '') {
      toastr.error("No puedes dejar sin seleccionar la fecha de la baja", "Notificación", {
        "progressBar": true
      })
    } else {
      var dato_json = JSON.stringify(datos);
      //console.log(dato_json)
      $.ajax({
          url: 'php/consulta_dat.php',
          type: 'POST',
          dataType: 'html',
          data: {
            act_datos_basic_ins: dato_json
          },
        })
        .done(function (respuesta) {
          console.log(respuesta)
          toastr.info(respuesta, "Notificacion", {
            "progressBar": true
          })
          Revisa_info_det_us(id_user_in)

        })
        .fail(function () {
          console.log("error");
        });
    }

  } else {
    var dato_json = JSON.stringify(datos);
    //console.log(dato_json)
    $.ajax({
        url: 'php/consulta_dat.php',
        type: 'POST',
        dataType: 'html',
        data: {
          act_datos_basic_ins: dato_json
        },
      })
      .done(function (respuesta) {
        console.log(respuesta)
        toastr.info(respuesta, "Notificacion", {
          "progressBar": true
        })
        Revisa_info_det_us(id_user_in)

      })
      .fail(function () {
        console.log("error");
      });
  }


}

function valida_formulario_registro_user() {

  if (
    $("#RFC_CORTO").val().length < 4 ||
    //$("#RFC_COMPLE").val().length < 13 ||
    $("#NOMBRE").val().length < 10 ||
    $("#NO_EMPLEADO").val().length < 3 ||
    $("#CORREO").val().length < 20 ||
    $("#id_admin").val() == 0 ||
    $("#id_sub_admin").val() == 0 ||
    $("#ID_DEPA").val() == 0 ||
    $("#ID_PERFIL").val() == 0 ||
    $("#ID_PUESTO").val() == 0 ||
    $("#estatus").val() == 0
  ) {
    toastr.error('Los datos marcados con el asterico no deben ser dejados en blanco y deben de cumplir con el tamño considerable.\n Para asistencia consulte con el administrador del sistema.', "Notificación", {
      "porgressBar": true
    });
  } else {
    Registrar_usuario();
  }
}

function trae_movimientos_x_personal(id_insumo) {
  $.ajax({
    url: 'php/consulta_dat.php',
    type: 'POST',
    dataType: 'html',
    data: {
      mov_insumos: id_insumo
    },
  }).done(function (data) {
    $('#caja_mov_personal_insumo').html(data)
  })
}

function trae_Oficios_historial(id_insumo) {
  $.ajax({
    url: 'php/consulta_dat.php',
    type: 'POST',
    dataType: 'html',
    data: {
      mov_oficios_his: id_insumo
    },
  }).done(function (data) {
    $('#caja_oficios_historial_ins').html(data)
  })
}




function detalle_sistema_muestra(id_sistema) {
  var id_system = id_sistema
  $('#Rockers').modal()
  Vista_general_sistema_indiv(id_system)

  $.post("php/consulta_dat.php", {
    detalle_sistema: id_system
  }, function () {}).done(function (resp) {
    // alert('hola')

    // STAR UP DE SISTEMA, PRESENTACIÓN
    $('#nombre_sistema_titulo').html(resp['nombre_sistema'])
    $('#nombre_sistema_titulo_').html(resp['nombre_sistema'])
    $('#tarjeta_presentacion_sistema').html(resp['Descripcion_sistema'])
    $('#tipo_sistema').html(resp['tipo_sistema_traducido'])
    $('#adminin_sis').html(resp['Administraciion_sistema_traducido'])
    $('#aprob_sis').html(resp['Aprobador_Sistemas'])
    $('#Indice_empleados_actiovos_baja').attr('onclick', 'Muestra_roles(' + id_system + ')')
    $('#agrega_rol_al_sistema').attr('onclick', 'Agrega_rol_al_sistema(' + id_system + ')')
    $('#indice_otros').attr('onclick', 'Reg_usuarios_x_sistema(' + id_system + ')')
    $('#modifica_sistema_matriz').attr('onclick', 'mod_matriz(' + id_system + ')')
    //EDICION DE DATOS
    $('#name_sistema2').val(resp['nombre_sistema'])
    $('#Autorizador_sistema2').val(resp['Aprobador_Sistemas'])
    $('#num_cuentas_sistema2').val(resp['Num_cuentas_Siistema'])
    $('#desc_sistema2').html(resp['Descripcion_sistema'])
    $("#admin_sistema2 option[value='" + resp['Administraciion_sistema'] + "']").attr("selected", true);
    $("#Tipo_acceso2 option[value='" + resp['tipo_sistema'] + "']").attr("selected", true);

    if (resp['tipo_sistema'] == 3 || resp['tipo_sistema'] == 4) {
      $('#input_liga2').hide(200);
      $('#Liga_acces_sistema2').val("");
      if (resp['tipo_sistema'] == '' || resp['tipo_sistema'] == null) {
        $('#div_option_archivo2').show(200);
        $('#Selecciona_Opicion_sis2').prop('checked', false)
      } else {
        $('#div_option_archivo2').hide();
        $('#Selecciona_Opicion_sis2').prop('checked', true)
      }

      $('#input_carga_sis2').prop('checked', true)
      $('#Selecciona_Opicion_sis2').prop('checked', false)
    } else {
      $('#input_liga2').show(200);
      $('#Liga_acces_sistema2').val(resp['url/acceso']);
      $('#div_option_archivo2').hide(200);
      $("#input_carga_sis2").hide(200);
      $('#Selecciona_Opicion_sis2').prop('checked', false)
      $('#input_carga_sis2').prop('checked', false)
    }
    if (resp['Num_cuentas_Siistema'] == null) {
      $('#cuentas_ilimitadas_sis2').prop('checked', true)
      $("#num_cuentas_sistema2").val("");
      $("#num_cuentas_sistema2").prop("disabled", true);

    } else {
      $("#num_cuentas_sistema2").prop("disabled", false);
      $('#num_cuentas_sistema2').val(resp['Num_cuentas_Siistema'])
      $("#num_cuentas_sistema2").prop("disabled", false);
      $('#cuentas_ilimitadas_sis2').prop('checked', false)
    }

  }).fail(function (error) {
    console.log(error)
  })
  $.post("php/consulta_dat.php", {
    detalle_sistema1: id_system
  }, function () {}).done(function (resp) {
    // alert('hola')
    $('#aqui_van_links').html(resp)



  }).fail(function (error) {
    console.log(error)
  })
  $.post("php/consulta_dat.php", {
    detalle_sistema2: id_system
  }, function () {}).done(function (resp) {
    // alert('hola')

    $('#descarg').html(resp)


  }).fail(function (error) {
    console.log(error)
  })


}

function mod_matriz(id_system) {
  var nombre_sistema = $('#name_sistema2').val();
  var administra_sistem = $('#admin_sistema2').val();
  var num_cuentas = $('#num_cuentas_sistema2').val();
  var quien_autoriza = $('#Autorizador_sistema2').val();
  var tipo_sistema = $('#Tipo_acceso2').val();
  var liga_acceso = $('#Liga_acces_sistema2').val();
  var descripcion_sistema = $('#desc_sistema2').val();
  var miArchvio = $("#archivo_sistema_app2").prop('files')[0];
  var formData_example = new FormData($(".Carga_sistemas_nuevos_con_app2")[0]);
  formData_example.append('archivo_sistema_app', miArchvio);
  var ext = $('#archivo_sistema_app2').val().split('.').pop().toLowerCase();
  console.log(miArchvio)
  var data = {
    id_system: id_system,
    nombre_sistema: nombre_sistema,
    administra_sistem: administra_sistem,
    num_cuentas: num_cuentas,
    quien_autoriza: quien_autoriza,
    tipo_sistema: tipo_sistema,
    liga_acceso: liga_acceso,
    descripcion_sistema: descripcion_sistema,
    opcion_carga: ''
  }
  console.log(data)
  var datos = JSON.stringify(data);
  if (nombre_sistema == '') {
    toastr.error('No puedes dejar el nombre del sistema o carpeta en blanco', 'Notificacion', {
      "progressBar": true
    });
  } else {
    if (administra_sistem == 0) {
      toastr.error('Debes seleccionar el area que administra el sistema o carpeta.', 'Notificacion', {
        "progressBar": true
      });
    } else {
      if ($('#cuentas_ilimitadas_sis2').prop("checked") == true) {
        if (tipo_sistema == 3 || tipo_sistema == 4) {

          if ($('#Selecciona_Opicion_sis2').prop("checked") == true) {
            var data = {
              nombre_sistema: nombre_sistema,
              administra_sistem: administra_sistem,
              num_cuentas: num_cuentas,
              quien_autoriza: quien_autoriza,
              tipo_sistema: tipo_sistema,
              liga_acceso: liga_acceso,
              descripcion_sistema: descripcion_sistema,
              opcion_carga: 'si',
              id_system: id_system,
            }
            console.log(data)
            if ($.inArray(ext, ['zip']) == -1) {
              toastr.error('Extencion invalida, solo se pueden aceptar archivos con extencion .zip', 'Notificacion', {
                "progressBar": true
              });
            } else {
              $.post("php/consulta_dat.php", {
                Actualiza_sistema: datos
              }, function () {}).done(function (respuesta) {
                if (respuesta == false) {
                  toastr.error(respuesta, 'Notificacion', {
                    "progressBar": true
                  });
                } else {
                  $.ajax({
                    url: "./php/valida_carga_fotos.php",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData_example,
                  }).done(function (respuesta) {
                    toastr.success(respuesta + ' 1  con sistema', 'Notificación:', {
                      "progressBar": true
                    })

                  }).fail(function () {
                    toastr.error(error, 'Notificacion', {
                      "progressBar": true
                    });
                  })
                }

              }).fail(function () {
                toastr.error(error, 'Notificacion', {
                  "progressBar": true
                });
              })
            }
          } else {
            var data = {
              nombre_sistema: nombre_sistema,
              administra_sistem: administra_sistem,
              num_cuentas: num_cuentas,
              quien_autoriza: quien_autoriza,
              tipo_sistema: tipo_sistema,
              liga_acceso: liga_acceso,
              descripcion_sistema: descripcion_sistema,
              opcion_carga: '',
              id_system: id_system,
            }
            console.log(data)
            $.post("./php/consulta_dat.php", {
              Actualiza_sistema: datos
            }, function () {}).done(function (respuesta) {
              toastr.success(respuesta, 'Notificacion', {
                "progressBar": true
              });
            }).fail(function (error) {
              toastr.error(error, 'Notificacion', {
                "progressBar": true
              });
            })
          }
        } else if (tipo_sistema == 0) {
          toastr.error('Debes seleccionar el tipo de acceso que tiene el sistema o carpeta', 'Notificacion', {
            "progressBar": true
          });
        } else {
          if (liga_acceso == '') {
            toastr.error('No puedes dejar la liga del sistema o carpeta en blanco', 'Notificacion', {
              "progressBar": true
            });
          } else {
            $.post("php/consulta_dat.php", {
              Actualiza_sistema: datos
            }, function () {}).done(function (respuesta) {
              toastr.success(respuesta, 'Notificacion', {
                "progressBar": true
              });
            }).fail(function (error) {
              toastr.error(error, 'Notificacion', {
                "progressBar": true
              });
            })
          }
        }

      } else {
        if (num_cuentas == '') {
          toastr.error('Debes indicar el numero de cuentas que puede tener el sistema o carpeta.', 'Notificacion', {
            "progressBar": true
          });
        } else {
          if (tipo_sistema == 3 || tipo_sistema == 4) {

            if ($('#Selecciona_Opicion_sis2').prop("checked") == true) {
              var data = {
                nombre_sistema: nombre_sistema,
                administra_sistem: administra_sistem,
                num_cuentas: num_cuentas,
                quien_autoriza: quien_autoriza,
                tipo_sistema: tipo_sistema,
                liga_acceso: liga_acceso,
                descripcion_sistema: descripcion_sistema,
                opcion_carga: 'si',
                id_system: id_system,
              }
              console.log(data)
              if ($.inArray(ext, ['zip']) == -1) {
                toastr.error('Extencion invalida, solo se pueden aceptar archivos con extencion .zip', 'Notificacion', {
                  "progressBar": true
                });
              } else {
                $.post("php/consulta_dat.php", {
                  Actualiza_sistema: datos
                }, function () {}).done(function (respuesta) {
                  if (respuesta == false) {
                    toastr.error(respuesta, 'Notificacion', {
                      "progressBar": true
                    });
                  } else {
                    $.ajax({
                      url: "./php/valida_carga_fotos.php",
                      type: "POST",
                      contentType: false,
                      processData: false,
                      data: formData_example,
                    }).done(function (respuesta) {
                      toastr.success(respuesta + ' 2 sin sistema', 'Notificación:', {
                        "progressBar": true
                      })

                    }).fail(function () {
                      toastr.error(error, 'Notificacion', {
                        "progressBar": true
                      });
                    })
                  }

                }).fail(function () {
                  toastr.error(error, 'Notificacion', {
                    "progressBar": true
                  });
                })
              }
            } else {
              $.post("php/consulta_dat.php", {
                Actualiza_sistema: datos
              }, function () {}).done(function (respuesta) {
                toastr.success(respuesta, 'Notificacion', {
                  "progressBar": true
                });
              }).fail(function (error) {
                toastr.error(error, 'Notificacion', {
                  "progressBar": true
                });
              })
            }
          } else if (tipo_sistema == 0) {
            toastr.error('Debes seleccionar el tipo de acceso que tiene el sistema o carpeta', 'Notificacion', {
              "progressBar": true
            });
          } else {
            if (liga_acceso == '') {
              toastr.error('No puedes dejar la liga del sistema o carpeta en blanco', 'Notificacion', {
                "progressBar": true
              });
            } else {
              $.post("php/consulta_dat.php", {
                Actualiza_sistema: datos
              }, function () {

              }).done(function (respuesta) {
                toastr.success(respuesta, 'Notificacion', {
                  "progressBar": true
                });
              }).fail(function (error) {
                toastr.error(error, 'Notificacion', {
                  "progressBar": true
                });
              })
            }
          }
        }
      }
    }
  }
}

function Reg_usuarios_x_sistema(id_system) {
  var id_system = id_system
  $.post("php/consulta_dat.php", {
    vista_users_x_sistem: id_system
  }, function () {}).done(function (resp) {
    $('#ussers_x_sistems').html(resp);
  })
}

function Agrega_rol_al_sistema(id_system) {
  var nombre_rol = $('#nombre_rol').val();
  var clave_rol = $('#clave_rol').val();
  var id_system_ = id_system;
  var datos = {
    nombre_rol: nombre_rol,
    clave_rol: clave_rol,
    id_system_: id_system_
  }
  var json = JSON.stringify(datos);
  if (nombre_rol == '') {
    toastr.error('No puedes agregar un Rol nuevo sin nombre', 'Notificación')
  } else {
    $.post("php/consulta_dat.php", {
      agre_rol_sis: json
    }, function () {}).done(function (resp) {
      toastr.success(resp, 'Notificación')
      Muestra_roles(id_system_)
    }).fail(function () {
      toastr.error(error, 'Notificación')
    })
  }

}

function Muestra_roles(id_system) {
  $.post("php/consulta_dat.php", {
    tabla_roles: id_system
  }, function () {}).done(function (resp) {
    // alert('hola')
    $('#Tabla_roles').html(resp)


  }).fail(function (error) {
    console.log(error)
  })
}

function Vista_general_sistema_indiv(id_system) {

  $.post("php/consulta_dat.php", {
    detalle_sistema_tarjeta: id_system
  }, function () {}).done(function (resp) {
    // alert('hola')
    $('#tarjeta_presentacion_sistema').html(resp)

  }).fail(function (error) {
    console.log(error)
  })
}

function Revisa_info_det_us(id_user_in) {
  // createCookie('users',id_user_in);
  var id_us = id_user_in;
  $("#Modal_detalle_usuario_insumo").modal();
  $('#dat_basc_ac').addClass('active');
  $('#nav-home-tab').attr('aria-selected', true);
  $('#datos_basc').addClass('active show');
  $('#DATOS_GEN').addClass('active show');
  $('#nav-profile-tab').removeClass('active');
  $('#nav-sistemas-tab').removeClass('active');
  $('#nav-Oficios_his-tab').removeClass('active');
  $('#MOVIMIENTOS').removeClass(' active show');
  $('#SISTEMAS').removeClass(' active show');
  $('#RESPONSIVAS').removeClass(' active show');
  $('#datos_basc_adic').removeClass(' active show');
  $('#dat_est_cent_ac').removeClass(' active show');
  $('#datos_op').removeClass(' active show');
  $('#dat_est_fun_ac').removeClass('active');
  $('#dat_est_cent_ac').removeClass('active');
  $.post("php/consulta_dat.php", {
    consulta_jefe_dep: id_user_in
  }, function (data) {
    //console.log(data)
    if (data == 1) {
      $("#estructura_2 option[value='1']").attr("selected", true);
    } else {
      $("#estructura_2 option[value='2']").attr("selected", true);
    }
  })

  $.post("php/consulta_dat.php", {
    datos: id_us
  }, function (data) {
    $('#datos_princip_us').html(data);
  })
  $.post("php/consulta_dat.php", {
    busca_info_us: id_us
  }, function (data) {
    // var id_usuario = [];

    var id_user_in = [];
    var rfc_c = [];
    var rfc = [];
    var curp = [];
    var nombre = [];
    var apellido_p = [];
    var apellido_m = [];
    var no_empleado = [];
    var id_puesto = [];
    var correo = [];
    var correo_p = [];
    var local = [];
    var area = [];
    var depa = [];
    var estatus = [];
    var num_tel1 = [];
    var num_tel2 = [];
    var ext = [];
    var fec_ingres = [];
    var Escolaridad = [];
    var estat_escolar = [];
    var Carrera = [];
    var sex = [];
    var hijos = [];
    var estado_civ = [];
    var puesto_fump = [];
    var clav_puesto = [];
    var posision = [];
    var posision_jefe_ = [];
    var clave_jefe_ = [];
    var nom_jefe = [];
    var nivel_ = [];
    var clave_pres_ = [];
    var jefe_directo_ = [];
    var suel_net = [];
    var num_nombraMIEN = [];
    var sindicato = [];
    var fecha_fin_relacion = [];
    var jer = [];
    var Motiv_especial = [];

    for (var i in data) {
      id_user_in.push(data.id_empleado_plant);
      rfc.push(data.rfc_comp);
      rfc_c.push(data.rfc_corto);
      curp.push(data.curp_comp);
      nombre.push(data.nombre_s);
      apellido_p.push(data.apellido_p);
      apellido_m.push(data.apellido_m);
      no_empleado.push(data.no_empleado);
      id_puesto.push(data.id_puesto);
      correo.push(data.correo_inst);
      num_tel1.push(data.numero_contacto_1);
      num_tel2.push(data.numero_contacto_2);
      ext.push(data.ext_tel);
      correo_p.push(data.correo_personal);
      local.push(data.id_admin);
      area.push(data.id_sub_admin);
      depa.push(data.id_depto);
      fec_ingres.push(data.fec_ingreso);
      estatus.push(data.id_proc);
      Escolaridad.push(data.Escolaridad);
      estat_escolar.push(data.estatus_escolaridad);
      Carrera.push(data.Carrera);
      sex.push(data.Genero);
      hijos.push(data.Hijos);
      estado_civ.push(data.estado_civil);
      puesto_fump.push(data.nombre_puesto_fun);
      clav_puesto.push(data.clave_puesto);
      posision.push(data.id_num_posision);
      posision_jefe_.push(data.posision_jefe);
      clave_jefe_.push(data.clave_jefe);
      nom_jefe.push(data.nombre_jefe);
      nivel_.push(data.nivel);
      clave_pres_.push(data.Codigo_pres);
      jefe_directo_.push(data.jefe_directo);
      suel_net.push(data.sueldo_neto);
      num_nombraMIEN.push(data.num_nombramiento)
      jer.push(data.id_nivel_jer)
      fecha_fin_relacion.push(data.fec_fin_rel_laboral)
      sindicato.push(data.id_sindicato)
      Motiv_especial.push(data.id_motivo_esp)
    }

    var userDate = fec_ingres[0]['date'];
    var date_string = moment(userDate).format("YYYY/MM/DD");

    // console.log(data)
    if (rfc != null) {
      $("#RFC_COMP").val(rfc[0]);
      $("#RFC_CORTO").val(rfc_c[0]);
      $("#CURP2").val(curp[0]);
      $("#NOMBRE").val(nombre[0]);
      $("#APELLIDO_P1").val(apellido_p[0]);
      $("#APELLIDO_M").val(apellido_m[0]);
      $("#NO_EMPLEADO").val(no_empleado[0]);
      $("#CORREO").val(correo[0]);
      $("#CORREO_P").val(correo_p[0]);
      $("#num_1").val(num_tel1[0]);
      $("#num_2").val(num_tel2[0]);
      $("#Puesto_fump").val(puesto_fump[0]);
      $("#clav_puesto").val(clav_puesto[0]);
      $("#ext_tel").val(ext[0]);
      $("#clave_pres2").val(clave_pres_[0]);
      $("#nivel").val(nivel_[0]);
      $("#plaza_jefe").val(posision_jefe_[0]);
      $("#clav_puesto_jefe").val(clave_jefe_[0]);
      $("#nombre_jefe").val(nom_jefe[0]);
      $("#sueldo_neto").val(suel_net[0]);
      $("#fecha_ingreso").val(date_string);
      $("#sindicato").val(sindicato[0]);
      $("#RFC_JEFE option[value='" + jefe_directo_[0] + "']").attr("selected", true);
      $("#posision").val(posision[0]);
      $("#estado_civ option[value='" + estado_civ[0] + "']").attr("selected", true);
      $("#id_admin option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA option[value='" + depa[0] + "']").attr("selected", true);
      $("#ID_PUESTO option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus option[value='" + estatus[0] + "']").attr("selected", true);
      $("#sex option[value='" + sex[0] + "']").attr("selected", true);
      $("#nivel_jerar_detalle option[value='" + jer[0] + "']").attr("selected", true);
      $("#Hijos option[value='" + hijos[0] + "']").attr("selected", true);
      $("#Escolaridad option[value='" + Escolaridad[0] + "']").attr("selected", true);
      $("#tipo_nombramiento12 option[value='" + num_nombraMIEN[0] + "']").attr("selected", true);
      $("#estatus_esco option[value='" + estat_escolar[0] + "']").attr("selected", true);
      $("#carrera").val(Carrera[0]);
      $("#act_us_in_datos_basicos").attr("onclick", 'Actualiza_dat_basic(' + id_user_in[0] + ')');
      $("#actualiza_dat_adicionales_bot").attr("onclick", 'Actualiza_datos_adicionales(' + id_user_in[0] + ')');
      $("#actualiza_plazas").attr("onclick", 'Actualiza_datos_posision(' + id_user_in[0] + ')');
      $("#nav-sistemas-tab").attr("onclick", 'Historial_registro_sistemas(' + id_user_in[0] + ')');
      $("#actualiza_area_asig").attr("onclick", 'Actualiza_area_asign_y_jefe(' + id_user_in[0] + ')');
      $('#nav-profile-tab').attr('onclick', 'trae_movimientos_x_personal(' + id_user_in[0] + ')');
      $('#nav-Oficios_his-tab').attr('onclick', 'trae_Oficios_historial(' + id_user_in[0] + ')');
      $('#Agregar_oficio_nuevo').attr('onclick', 'Abre_modal_oficio_nuevo(' + id_user_in[0] + ')');
      $('#agrega_acceso_al_sistema').attr('onclick', 'Agrega_sistema_al_empleado(' + id_user_in[0] + ')');
      if (estatus[0] == 11 || estatus[0] == 28 || estatus[0] == 7 || estatus[0] == 6 || estatus[0] == 32 || estatus[0] == 25) {
        var fec_baja = fecha_fin_relacion[0]['date'];
        var date_string2 = moment(fec_baja).format("YYYY/MM/DD");
        $("#fecha_baja").val(date_string2);
        if (estatus[0] == 11 || estatus[0] == 32) {
          if (estatus[0] == 11) {
            $("#texto_referencia_baj").html('Motivo de Baja:');
          }
          if (estatus[0] == 32) {
            $("#texto_referencia_baj").html('Acuerdo:');
          }

          $("#Motivo_baja_option option[value='" + Motiv_especial[0] + "']").attr("selected", true);
          $("#Motivo_baj").show();
        }
        if (estatus[0] == 28 || estatus[0] == 7 || estatus[0] == 6 || estatus[0] == 25) {
          $("#Motivo_baj").hide();
        }
      } else {
        $("#fec_baja_reg").hide();
        $("#Motivo_baj").hide();

      }
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }
  })

}

function Historial_registro_sistemas(id_user) {
  $.ajax({
    type: "POST",
    url: "php/consulta_dat.php",
    data: {
      Matriz_empleado: id_user
    },
    dataType: "HTML",
    success: function (response) {
      $('#historial_matriz_por_empleados').html(response)
    }
  });
}

function Abre_modal_oficio_nuevo(id_user_insumo) {
  $('#oficio_nuevo_modal').modal();
  $('#revisa_datos_oficio').attr('onclick', 'Registra_nuevo_oficio(' + id_user_insumo + ')');
  $('#Cerrar_mod_oficio_nuevo').attr('onclick', 'trae_Oficios_historial(' + id_user_insumo + ')');
}

function Registra_nuevo_oficio(id_user) {



  var tipo_doc = $('#Tipo_de_oficio').val();
  var no_oficio = $('#No_oficio_nuevo').val();
  var fecha_oficio = $('#fecha_oficio_doc').val();


  var miArchvio = $("#documento_nuevo_oficio").prop('files')[0];
  var formData_example = new FormData($(".Formato_oficios_nuevos")[0]);
  formData_example.append('documento_nuevo_oficio', miArchvio);
  var ext = $('#documento_nuevo_oficio').val().split('.').pop().toLowerCase();
  var datos = {
    id_user: id_user,
    tipo_doc: tipo_doc,
    no_oficio: no_oficio,
    fecha_oficio: fecha_oficio
  }

  if ($.inArray(ext, ['pdf', 'docs', 'zip']) == -1) {
    toastr.error('Extencion invalida, solo se pueden aceptar documentos con extencion .pdf, .docs, .zip', 'Notificacion', {
      "progressBar": true
    });
  } else {
    $.post("php/valida_carga_fotos.php", {
      nombre_doc: datos
    }, function () {

    }).done(function (respuesta) {
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
        Revisa_info_det_us(id_user)
      })
    })

  }

}

$(document).ready(function () {
  $('#estatus').change(function () {
    $('#estatus option:selected').each(function () {
      var est = $(this).val();
      if (est == 11 || est == 7 || est == 6 || est == 25 || est == 32) {
        $('#fec_baja_reg').show(200);
        if (est == 11 || est == 32) {
          $('#Motivo_baj').show(200);
          if (est == 11) {
            $('#texto_referencia_baj').html('Motivo de la baja:');
          } else {
            $('#texto_referencia_baj').html('Acuerdo:');
          }

          $.post("php/consulta_dat.php", {
            motivo_baj_filtro: est
          }, function (data) {
            $('#Motivo_baja_option').html(data);
          })

        }


      } else {
        $('#fec_baja_reg').hide(200);
        $('#Motivo_baj').hide(200);
      }
    })
  })
  $('#forma').on('click', function () {
    var estado = $('#Sin_no_oficio').prop('indeterminate', true)
    if (estado == true) {
      console.log('hola')
    } else {
      console.log('no detecta')
    }
  })
  $('#Escolaridad').change(function () {
    $('#Escolaridad option:selected').each(function () {
      var est = $(this).val();
      //alert(est)
      if (est == 4) {
        $('#asdas').show(200);
      } else if (est == 5) {
        $('#asdas').show(200);
      } else if (est == 6) {
        $('#asdas').show(200);
      } else if (est == 7) {
        $('#asdas').show(200);
      } else if (est == 8) {
        $('#asdas').show(200);
      } else {
        $('#asdas').hide(200);
      }
    })
  })
  $('#posision_ten').change(function () {
    $('#posision_ten').each(function () {
      var inc = $(this).val();

      $.post("php/consulta_dat.php", {
        posi2: inc
      }, function (data) {
        //console.log(data)
        $('#Puesto_fump_ten').val(data[0]['nombre_puesto']);
        $('#clav_puesto_ten').val(data[0]['clave_puesto']);
        $('#plaza_jefe_ten').val(data[0]['posision_jefe']);
        $('#nombre_jefe_ten').val(data[0]['nombre_jefe']);
        $('#clav_puesto_jefe_ten').val(data[0]['clave_jefe']);
        $('#nivel_ten').val(data[0]['nivel']);
        $('#clave_pres2_ten').val(data[0]['Codigo_pres']);
      })
    })
  })
  $('#estatus_plazas_act').change(function () {
    $('#estatus_plazas_act').each(function () {
      var inc = $(this).val();
      if (inc == 4 || inc == 5) {
        $('#democion_promocion').show(200)
      } else if (inc == 13 || inc == 7 || inc == 0) {
        $('#democion_promocion').hide(200)
      }
    })
  })


})

function Registrar_usuario() {

  var rfc = $("#RFC_CORTO").val();
  var rfc_comp = $("#RFC_COMPLE").val();
  var nombre = $("#NOMBRE").val();
  var no_empleado = $("#NO_EMPLEADO").val();
  var correo = $("#CORREO").val();
  var local = $("#id_admin").val();
  var area = $("#id_sub_admin").val();
  var depa = $("#ID_DEPA").val();
  var rfc_jefe = $("#RFC_JEFE").val();
  var id_perfil = $("#ID_PERFIL").val();
  var id_puesto = $("#ID_PUESTO").val();
  var estus = $("#estatus").val();

  var datos = {
    rfc_corto: rfc,
    rfc_comp: rfc_comp,
    nombre_u: nombre,
    no_emp: no_empleado,
    correo: correo,
    id_admin: local,
    id_sub_admin: area,
    id_depa: depa,
    jefe: rfc_jefe,
    perfil: id_perfil,
    puesto: id_puesto,
    estatus: estus
  };

  var json = JSON.stringify(datos);
  console.log(json)
  $.post("php/Valida_R_User.php", {
    array: json
  }, function (data) {
    toastr.info(data, 'Notificación', {
      "progressBar": true,
    });

  });

}

function ConsultarDatosUser_us(id_usuario) {

  $.post("php/consulta_datos_user.php", {
    id_usuario: id_usuario
  }, function (data) {


    var id_usuario = [];
    var rfc = [];
    var rfc_comp = [];
    var nombre = [];
    var no_empleado = [];
    var id_perfil = [];
    var id_puesto = [];
    var correo = [];
    var local = [];
    var area = [];
    var depa = [];
    var jefe_directo = [];
    var estatus = [];
    var responsiva = [];

    for (var i in data) {
      id_usuario.push(data.id_empleado_us);
      rfc.push(data.rfc_corto);
      rfc_comp.push(data.RFC);
      nombre.push(data.nombre_empleado);
      no_empleado.push(data.no_empleado);
      id_perfil.push(data.id_perfil);
      id_puesto.push(data.id_puesto);
      correo.push(data.correo);
      local.push(data.id_admin);
      area.push(data.id_sub_admin);
      depa.push(data.id_depto);
      jefe_directo.push(data.jefe_directo);
      estatus.push(data.estatus);
      responsiva.push(data.responsiva);
    }

    if (rfc != null) {
      $("#RFC_CORTO_A").val(rfc[0]);
      $("#RFC_COMP_A").val(rfc_comp[0]);
      $("#NOMBRE_A").val(nombre[0]);
      $("#CORREO_A").val(correo[0]);
      $("#NO_EMPLEADO_A").val(no_empleado[0]);
      $("#id_admin_A option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin_A option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA_A option[value='" + depa[0] + "']").attr("selected", true);
      $("#id_JEFE_A option[value='" + jefe_directo[0] + "']").attr("selected", true);
      $("#ID_PERFIL_A option[value='" + id_perfil[0] + "']").attr("selected", true);
      $("#ID_PUESTO_A option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus_Actividad option[value='" + estatus[0] + "']").attr("selected", true);
      $("#btn_RU_A").attr("onclick", 'Actualizar_user(' + id_usuario[0] + ')');
      $("#Modal_form_editar").modal();
      $("#estatus_responsiva option[value='" + responsiva[0] + "']").attr("selected", true);
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }

  });

}





function Actualizar_user(id_empleado) {

  if (
    $("#RFC_CORTO_A").val().length < 4 ||
    $("#RFC_COMP_A").val().length < 4 ||
    $("#NOMBRE_A").val().length < 10 ||
    $("#NO_EMPLEADO_A").val().length < 3 ||
    $("#CORREO_A").val().length < 20 ||
    $("#id_admin_A").val() == 0 ||
    $("#id_sub_admin_A").val() == 0 ||
    $("#ID_DEPA_A").val() == 0 ||
    $("#ID_PERFIL_A").val() == 0 ||
    $("#ID_PUESTO_A").val() == 0 ||
    $("#estatus_Actividad").val() == 0) {
    alert('Los datos marcados con el asterico no deben ser dejados en blanco y deben de cumplir con el tamño considerable.\n Para asistencia consulte con el administrador del sistema.');
  } else {
    var id_emp = id_empleado;
    var rfc = $("#RFC_CORTO_A").val();
    var rfc_comp = $("#RFC_COMP_A").val();
    var nombre = $("#NOMBRE_A").val();
    var no_empleado = $("#NO_EMPLEADO_A").val();
    var correo = $("#CORREO_A").val();
    var correo_p = $("#CORREO_O").val();
    var local = $("#id_admin_A").val();
    var area = $("#id_sub_admin_A").val();
    var depa = $("#ID_DEPA_A").val();
    var id_jefe = $("#id_JEFE_A").val();
    var id_perfil = $("#ID_PERFIL_A").val();
    var id_puesto = $("#ID_PUESTO_A").val();
    var estus = $("#estatus_Actividad").val();
    var responsiva = $("#estatus_responsiva").val();

    var datos = {
      rfc_corto: rfc,
      rfc_comp: rfc_comp,
      nombre_u: nombre,
      no_emp: no_empleado,
      correo: correo,
      correo_p: correo_p,
      id_admin: local,
      id_sub_admin: area,
      id_depa: depa,
      jefe: id_jefe,
      perfil: id_perfil,
      puesto: id_puesto,
      estatus: estus,
      responsiva: responsiva,
      id_emp: id_emp,
    };

    var json = JSON.stringify(datos);
    //console.log(json)
    $.post("php/Valida_R_User.php", {
      objeto_user: json
    }, function (data) {
      alert(data);
      location.reload();
    });
  }


}





function vermas() {
  $('#vermasdiv').toggle();
  $('#link_ver').toggle();
}

function renovar() {
  location.reload();
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





$('.numeros').on('input', function () {
  this.value = this.value.replace(/[^0-9]/g, '');
});


$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip()
});




// ---------------- Busqueda-------------------------------








function filtros_users() {

  var nombre = $("#nombre_b").val();
  // var nombre = $("#num_admin").val();
  var area = $("#id_sub_admin_b").val();
  var dep = $("#deptos_f").val();
  var perfil = $("#perfil_b").val();

  console.log(nombre)
  console.log(area)
  console.log($(dep).val())
  console.log(perfil)

  if (($("#nombre_b").val().length > 1) && area == '0' && dep == '0' && perfil == '0') {
    createCookie("nombre", nombre, 1)
    location.href = "usuarios_ingresos.php?por_nombre=1";
  } else if (($("#nombre_b").val().length > 1) && area != '0' && dep == '0' && perfil == '0') {
    createCookie("nombre", nombre, 1)
    createCookie("subadmin", area, 1)
    location.href = "usuarios_ingresos.php?por_nomb_sub=1";
  } else if (($("#nombre_b").val().length > 1) && area != '0' && dep != '0' && perfil == '0') {
    createCookie("nombre", nombre, 1)
    createCookie("subadmin", area, 1)
    createCookie("deptos", dep, 1)
    location.href = "usuarios_ingresos.php?por_nomb_sub_dep=1";
  } else if (($("#nombre_b").val().length > 1) && area != '0' && dep != '0' && perfil != '0') {
    createCookie("nombre", nombre, 1)
    createCookie("subadmin", area, 1)
    createCookie("deptos", dep, 1)
    createCookie("perfil", perfil, 1)
    location.href = "usuarios_ingresos.php?por_nomb_sub_dep_per=1";
  } else if (($("#nombre_b").val().length < 1 || $("#nombre_b").val() == " ") && area != '0' && dep == '0' && perfil == '0') {
    createCookie("subadmin", area, 1)
    location.href = "usuarios_ingresos.php?por_sub=1";
  } else if (($("#nombre_b").val().length < 1) && area != '0' && dep != '0' && perfil == '0') {
    createCookie("subadmin", area, 1)
    createCookie("deptos", dep, 1)
    location.href = "usuarios_ingresos.php?por_sub_dep=1";
  } else if (($("#nombre_b").val().length < 1) && area == '0' && dep == '0' && perfil != '0') {
    createCookie("perfil", perfil, 1)
    location.href = "usuarios_ingresos.php?por_perfil=1";
  } else if (($("#nombre_b").val().length < 1) && area != '0' && dep != '0' && perfil != '0') {
    createCookie("perfil", perfil, 1)
    createCookie("subadmin", area, 1)
    createCookie("deptos", dep, 1)
    location.href = "usuarios_ingresos.php?por_perfil_sub_dep=1";
  } else if (($("#nombre_b").val().length < 1) && area == '0' && dep == '0' && perfil == '0') {
    location.href = "usuarios_ingresos.php?usuarios=1";
  }
}

$(document).ready(function () {
  $("#agregar_user").click(function (e) {
    //alert('hola')
    $("#Modal_form_registrar").modal();
  });
});

$(document).ready(function () {
  $("#id_admin_A").change(function () {
    $("#ID_DEPA_A").find('option').remove().end().append(
      '<option value="whatever"></option>').val('whatever');
    $("#id_admin_A option:selected").each(function () {
      id_admin = $(this).val();
      $.post("Obtener_Combos.php", {
        id_admin: id_admin
      }, function (data) {
        $("#id_sub_admin_A").html(data);
      })
    })
  })
});
$(document).ready(function () {
  $("#num_admin").change(function () {
    $("#id_sub_admin_b").find('option').remove().end().append(
      '<option value="whatever"></option>').val('whatever');
    $("#num_admin option:selected").each(function () {
      id_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_admin: id_admin
      }, function (data) {
        $("#id_sub_admin_b").html(data);
      })
    })
  })
});

$(document).ready(function () {
  $("#id_sub_admin_A").change(function () {
    $("#id_sub_admin_A option:selected").each(function () {
      var id_sub_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_sub_admin: id_sub_admin
      }, function (data) {
        $("#ID_DEPA_A").html(data);
      })
    })
  })
});



$(document).ready(function () {
  $("#id_sub_admin_b").change(function () {
    $("#deptos_b").find('option').remove().end().append(
      '<option value="whatever"></option>').val('whatever');
    $("#id_sub_admin_b option:selected").each(function () {
      var id_sub_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_sub_admin: id_sub_admin
      }, function (data) {
        $("#deptos_b").html(data);
      })
    })
  })
});


$(document).ready(function () {
  $("#id_admin").change(function () {
    $("#ID_DEPA").find('option').remove().end().append(
      '<option value="whatever"></option>').val('whatever');
    $("#id_admin option:selected").each(function () {
      id_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_admin: id_admin
      }, function (data) {
        $("#id_sub_admin").html(data);
      })
    })
  })
});


$(document).ready(function () {
  $("#id_admin_A").change(function () {
    $("#ID_DEPA_A").find('option').remove().end().append(
      '<option value="whatever"></option>').val('whatever');
    $("#id_admin_A option:selected").each(function () {
      id_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_admin: id_admin
      }, function (data) {
        $("#id_sub_admin_A").html(data);
      })
    })
  })
});


$(document).ready(function () {
  $("#id_sub_admin").change(function () {
    $("#id_sub_admin option:selected").each(function () {
      id_sub_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_sub_admin: id_sub_admin
      }, function (data) {
        $("#ID_DEPA").html(data);
      })
    })
  })
});
$(document).ready(function () {
  $("#num_admin").change(function () {
    $("#num_admin option:selected").each(function () {
      id_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_admin: id_admin
      }, function (data) {
        $("#id_sub_admin_b").html(data);
      })
    })
  })
});
$(document).ready(function () {
  $("#id_sub_admin_b").change(function () {
    $("#id_sub_admin_b option:selected").each(function () {
      id_sub_admin = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_sub_admin: id_sub_admin
      }, function (data) {
        $("#deptos_f").html(data);
      })
    })
  })
});

$(document).ready(function () {
  $("#id_autoridad").change(function () {
    $("#id_autoridad option:selected").each(function () {
      id_sub_admin1 = $(this).val();
      $.post("php/Obtener_Combos.php", {
        id_autoridad: id_autoridad
      }, function (data) {
        $("#Nombre_autor").text(data);
      })
    })
  })
});

//// ESTOS SON LOS COMBOS DE LA PAGINA DE INTEGRACION


$(document).ready(function () {

  /*
    Listener de num_objeto
  */
  $("#num_objeto").change(function () {
    $("#num_objeto option:selected").each(function () {
      id_obj = $(this).val();
      //alert(id_obj);
      $.post("php/Obtener_Combos.php", {
        id_obj: id_obj
      }, function (data) {
        $("#id_situacion").html(data);
      })
    })
  })

  /*
    Listener de id_situacion
  */
  $("#id_situacion").change(function () {
    $("#id_situacion option:selected").each(function () {
      id_sit = $(this).val();
      id_obj = $('#num_objeto').val();
      datos = {
        id_sit: id_sit,
        id_obj: id_obj
      }
      //alert(id_sit);
      $.post("php/Obtener_Combos.php", {
        Etapa: datos
      }, function (data) {
        $("#id_etapas_select").html(data);
      })
    })
  })

});

$(document).ready(function () {
  $('#fecha_ingreso').datepicker({
    endDate: "today",
    autoclose: true,
    //daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: 'es'
  });
  $('#fecha_oficio_doc').datepicker({
    endDate: "today",
    autoclose: true,
    //daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: 'es'
  });
  $('#fecha_ingreso_add').datepicker({
    endDate: "today",
    autoclose: true,
    //daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: 'es'
  });
  $('#fecha_mov_funcional').datepicker({
    //endDate: "today",
    autoclose: true,
    //daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: 'es'
  });
  $('#fecha_cambio_est_resp').datepicker({
    endDate: "today",
    autoclose: true,
    //daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: 'es'
  });

  $('#fecha_de_oficio').datepicker({
    //endDate: "today",
    autoclose: true,
    //daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: 'es'
  });
  $('#fecha_baja').datepicker({
    //endDate: "today",
    autoclose: true,
    todayHighlight: true,
    //daysOfWeekDisabled: [0, 6],
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: "es"
  });
  $('#fecha_responsiva').datepicker({
    //endDate: "today",
    autoclose: true,
    todayHighlight: true,
    //daysOfWeekDisabled: [0, 6],
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: "es"
  });
  $('#fecha_baja_add').datepicker({
    //endDate: "today",
    autoclose: true,
    todayHighlight: true,
    //daysOfWeekDisabled: [0, 6],
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: "es"
  });
  $('#posision_add').on('keyup', function () {
    var cons = $(this).val();
    $.post("php/consulta_dat.php", {
      posision_predic: cons
    }, function (data) {
      if (data == false) {
        toastr.error("No hay datos que relacionen el numero de esta plaza en el sistema", "Notifición", {
          "progressBar": true
        })
      } else {
        $('#opciones').html(data);
      }
    })
  })
  $('#Selecciona_Opicion').on('click', function () {

    if ($('#Selecciona_Opicion').prop('checked') == true) {
      $("#No_oficio_nuevo").val("");
      $("#No_oficio_nuevo").prop('disabled', true);

    } else {
      $("#No_oficio_nuevo").prop('disabled', false);
    }

  })
  $('#Tipo_de_oficio').change(function () {
    $('#Tipo_de_oficio option:selected').each(function () {
      var opcion = $(this).val();

      if (opcion == 3) {
        $('#Selecciona_Opicion').prop('checked', true)
        $("#No_oficio_nuevo").val("");
        $("#No_oficio_nuevo").prop('disabled', true);
        $("#Selecciona_Opicion").prop('disabled', true);
      } else {
        $('#Selecciona_Opicion').prop('checked', false)
        $("#No_oficio_nuevo").val("");
        $("#No_oficio_nuevo").prop('disabled', false);
        $("#Selecciona_Opicion").prop('disabled', false);
      }
    })
  })
  $('#Abre_modal_agre_sistema').on('click', function () {
    $('#mod_agree_sistema').modal();
  })
  $('#Tipo_acceso').change(function () {
    $('#Tipo_acceso option:selected').each(function () {
      var option = $(this).val();
      if (option == 3 || option == 4) {
        $('#input_liga').hide(200);
        $('#div_option_archivo').show(200);
      } else {
        $('#input_liga').show(200);
        $('#div_option_archivo').hide(200);
        $("#input_carga_sis").hide(200);
        $('#Selecciona_Opicion_sis').prop('checked', false)
      }
    })
  })
  $('#Selecciona_Opicion_sis').on('click', function () {

    if ($('#Selecciona_Opicion_sis').prop('checked') == true) {
      $("#Liga_acces_sistema").val("");
      $("#input_carga_sis").show(200);

    } else {
      $("#input_carga_sis").hide(200);

    }

  })
  $('#cuentas_ilimitadas_sis').on('click', function () {

    if ($('#cuentas_ilimitadas_sis').prop('checked') == true) {
      $("#num_cuentas_sistema").val("");
      $("#num_cuentas_sistema").prop("disabled", true);

    } else {
      $("#num_cuentas_sistema").prop("disabled", false);

    }
  })
  $('#Tipo_acceso2').change(function () {
    $('#Tipo_acceso2 option:selected').each(function () {
      var option = $(this).val();
      if (option == 3 || option == 4) {
        $('#input_liga2').hide(200);

        $('#div_option_archivo2').show(200);
        $('#input_carga_sis2').prop('checked', true)
        $('#Selecciona_Opicion_sis2').prop('checked', false)
      } else {
        $('#input_liga2').show(200);

        $('#div_option_archivo2').hide(200);
        $("#input_carga_sis2").hide(200);
        $('#Selecciona_Opicion_sis2').prop('checked', false)
        $('#input_carga_sis2').prop('checked', false)
      }
    })
  })
  $('#Selecciona_Opicion_sis2').on('click', function () {

    if ($('#Selecciona_Opicion_sis2').prop('checked') == true) {
      $("#Liga_acces_sistema2").val("");
      $("#input_carga_sis2").show(200);

    } else {
      $("#input_carga_sis2").hide(200);

    }

  })
  $('#cuentas_ilimitadas_sis2').on('click', function () {
    if ($('#cuentas_ilimitadas_sis2').prop('checked') == true) {
      $("#num_cuentas_sistema2").val("");
      $("#num_cuentas_sistema2").prop("disabled", true);

    } else {
      $("#num_cuentas_sistema2").prop("disabled", false);

    }
  })
});

function Agrega_sistema_nuevo() {
  
  var nombre_sistema = $('#name_sistema').val();
  var administra_sistem = $('#admin_sistema').val();
  var num_cuentas = $('#num_cuentas_sistema').val();
  var quien_autoriza = $('#Autorizador_sistema').val();
  var tipo_sistema = $('#Tipo_acceso').val();
  var liga_acceso = $('#Liga_acces_sistema').val();
  var descripcion_sistema = $('#desc_sistema').val();
  var miArchvio = $("#archivo_sistema_app").prop('files')[0];
  var formData_example = new FormData($(".Carga_sistemas_nuevos_con_app")[0]);
  formData_example.append('archivo_sistema_app', miArchvio);
  var ext = $('#archivo_sistema_app').val().split('.').pop().toLowerCase();
  console.log(miArchvio)
  var data = {
    nombre_sistema: nombre_sistema,
    administra_sistem: administra_sistem,
    num_cuentas: num_cuentas,
    quien_autoriza: quien_autoriza,
    tipo_sistema: tipo_sistema,
    liga_acceso: liga_acceso,
    descripcion_sistema: descripcion_sistema,
    opcion_carga: ''
  }
  var datos = JSON.stringify(data);
  if (nombre_sistema == '') {
    toastr.error('No puedes dejar el nombre del sistema o carpeta en blanco', 'Notificacion', {
      "progressBar": true
    });
  } else {
    if (administra_sistem == 0) {
      toastr.error('Debes seleccionar el area que administra el sistema o carpeta.', 'Notificacion', {
        "progressBar": true
      });
    } else {
      if ($('#cuentas_ilimitadas_sis').prop("checked") == true) {
        if (tipo_sistema == 3 || tipo_sistema == 4) {

          if ($('#Selecciona_Opicion_sis').prop("checked") == true) {
            var data = {
              nombre_sistema: nombre_sistema,
              administra_sistem: administra_sistem,
              num_cuentas: num_cuentas,
              quien_autoriza: quien_autoriza,
              tipo_sistema: tipo_sistema,
              liga_acceso: liga_acceso,
              descripcion_sistema: descripcion_sistema,
              opcion_carga: 'si'
            }
            if ($.inArray(ext, ['zip']) == -1) {
              toastr.error('Extencion invalida, solo se pueden aceptar archivos con extencion .zip', 'Notificacion', {
                "progressBar": true
              });
            } else {
              $.post("php/consulta_dat.php", {
                reg_sistema: datos
              }, function () {}).done(function (respuesta) {
                if (respuesta == false) {
                  toastr.error(respuesta, 'Notificacion', {
                    "progressBar": true
                  });
                } else {
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

                  }).fail(function () {
                    toastr.error(error, 'Notificacion', {
                      "progressBar": true
                    });
                  })
                }

              }).fail(function () {
                toastr.error(error, 'Notificacion', {
                  "progressBar": true
                });
              })
            }
          } else {
            var data = {
              nombre_sistema: nombre_sistema,
              administra_sistem: administra_sistem,
              num_cuentas: num_cuentas,
              quien_autoriza: quien_autoriza,
              tipo_sistema: tipo_sistema,
              liga_acceso: liga_acceso,
              descripcion_sistema: descripcion_sistema,
              opcion_carga: ''
            }
            $.post("./php/consulta_dat.php", {
              reg_sistema: datos
            }, function () {}).done(function (respuesta) {
              toastr.success(respuesta, 'Notificacion', {
                "progressBar": true
              });
            }).fail(function (error) {
              toastr.error(error, 'Notificacion', {
                "progressBar": true
              });
            })
          }
        } else if (tipo_sistema == 0) {
          toastr.error('Debes seleccionar el tipo de acceso que tiene el sistema o carpeta', 'Notificacion', {
            "progressBar": true
          });
        } else {
          if (liga_acceso == '') {
            toastr.error('No puedes dejar la liga del sistema o carpeta en blanco', 'Notificacion', {
              "progressBar": true
            });
          } else {
            $.post("php/consulta_dat.php", {
              reg_sistema: datos
            }, function () {}).done(function (respuesta) {
              toastr.success(respuesta, 'Notificacion', {
                "progressBar": true
              });
            }).fail(function (error) {
              toastr.error(error, 'Notificacion', {
                "progressBar": true
              });
            })
          }
        }

      } else {
        if (num_cuentas == '') {
          toastr.error('Debes indicar el numero de cuentas que puede tener el sistema o carpeta.', 'Notificacion', {
            "progressBar": true
          });
        } else {
          if (tipo_sistema == 3 || tipo_sistema == 4) {

            if ($('#Selecciona_Opicion_sis').prop("checked") == true) {
              var data = {
                nombre_sistema: nombre_sistema,
                administra_sistem: administra_sistem,
                num_cuentas: num_cuentas,
                quien_autoriza: quien_autoriza,
                tipo_sistema: tipo_sistema,
                liga_acceso: liga_acceso,
                descripcion_sistema: descripcion_sistema,
                opcion_carga: 'si'
              }
              if ($.inArray(ext, ['zip']) == -1) {
                toastr.error('Extencion invalida, solo se pueden aceptar archivos con extencion .zip', 'Notificacion', {
                  "progressBar": true
                });
              } else {
                $.post("php/consulta_dat.php", {
                  reg_sistema: datos
                }, function () {}).done(function (respuesta) {
                  if (respuesta == false) {
                    toastr.error(respuesta, 'Notificacion', {
                      "progressBar": true
                    });
                  } else {
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

                    }).fail(function () {
                      toastr.error(error, 'Notificacion', {
                        "progressBar": true
                      });
                    })
                  }

                }).fail(function () {
                  toastr.error(error, 'Notificacion', {
                    "progressBar": true
                  });
                })
              }
            } else {
              $.post("php/consulta_dat.php", {
                reg_sistema: datos
              }, function () {}).done(function (respuesta) {
                toastr.success(respuesta, 'Notificacion', {
                  "progressBar": true
                });
              }).fail(function (error) {
                toastr.error(error, 'Notificacion', {
                  "progressBar": true
                });
              })
            }
          } else if (tipo_sistema == 0) {
            toastr.error('Debes seleccionar el tipo de acceso que tiene el sistema o carpeta', 'Notificacion', {
              "progressBar": true
            });
          } else {
            if (liga_acceso == '') {
              toastr.error('No puedes dejar la liga del sistema o carpeta en blanco', 'Notificacion', {
                "progressBar": true
              });
            } else {
              $.post("php/consulta_dat.php", {
                reg_sistema: datos
              }, function () {

              }).done(function (respuesta) {
                toastr.success(respuesta, 'Notificacion', {
                  "progressBar": true
                });
              }).fail(function (error) {
                toastr.error(error, 'Notificacion', {
                  "progressBar": true
                });
              })
            }
          }
        }
      }
    }
  }


}



//---------Oculta modal de la vita con solo un boton------------------//
// $('#mod_agree_sistema').modal('hide');//ocultamos el modal
// $('#body_cer').removeClass('modal-open');
// $('.modal-backdrop').remove();
//---------fin Oculta modal de la vita con solo un boton------------------//