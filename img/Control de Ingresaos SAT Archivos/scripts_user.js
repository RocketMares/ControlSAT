$("#ver").click(function (e) {
  openNav();
});
$(document).ready(function () {
  $('#RFC_COMP').on('keyup', function () {
    var datos = $('#RFC_COMP').val();

    if ($('#RFC_COMP').val().length >= 10) {
      $.ajax({
        type: 'POST',
        dataType: 'html',
        url: "algoritmo.php",
        data: {
          RFC: datos
        },

      }).done(function (respuesta) {
        $('#RFC_CORTO').val(respuesta);
      })
    } else {

    }

  });
});
$(document).ready(function () {
  $('#user_more').on('click', function () {
    //alert('entra aqui')
    $('#agregar_user_insumo').modal();
  });
})

function valida_formulario_registro_user() {

  if ($("#RFC_CORTO").val().length < 4 ||
    $("#NOMBRE").val().length < 10 ||
    $("#NO_EMPLEADO").val().length < 3 ||
    $("#CORREO").val().length < 20 ||
    $("#id_admin").val() == 0 ||
    $("#id_sub_admin").val() == 0 ||
    $("#ID_DEPA").val() == 0 ||
    $("#RFC_JEFE").val() == 0 ||
    $("#ID_PERFIL").val() == 0 ||
    $("#ID_PUESTO").val() == 0 ||
    $("#estatus").val() == 0) {
    alert('Los datos marcados con el asterico no deben ser dejados en blanco y deben de cumplir con el tamño considerable.\n Para asistencia consulte con el administrador del sistema.');
  } else {
    Registrar_usuario();
  }
}

function Revisa_info_det_us(id_user_in) {
  // createCookie('users',id_user_in);
  var id_us = id_user_in;
  $("#Modal_detalle_usuario_insumo").modal();
  $.post("php/consulta_dat.php", {
    datos: id_us
  }, function (data) {
    $('#datos_princip_us').html(data);
  })
  $.post("php/consulta_dat.php", {
    busca_info_us: id_us
  }, function (data) {
    // var id_usuario = [];

    
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
  
    for (var i in data) {

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
      // jefe_directo.push(data.jefe_directo);
      estatus.push(data.estatus);


    }
    var userDate = fec_ingres[0]['date'];
      var date_string = moment(userDate).format("MM/DD/YYYY");
      //console.log(date_string);
    
    if (rfc != null) {
      $("#RFC_COMP").val(rfc[0]);
      $("#RFC_CORTO").val(rfc_c[0]);
      $("#CURP2").val(curp[0]);
      $("#NOMBRE").val(nombre[0]);
      $("#APELLIDO_P").val(apellido_p[0]);
      $("#APELLIDO_M").val(apellido_m[0]);
      $("#NO_EMPLEADO").val(no_empleado[0]);
      $("#CORREO").val(correo[0]);
      $("#CORREO_P").val(correo_p[0]);
      $("#num_1").val(num_tel1[0]);
      $("#num_2").val(num_tel2[0]);
      $("#ext_tel").val(ext[0]);
      $("#fecha_ingreso").val(date_string);
      $("#id_admin option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA option[value='" + depa[0] + "']").attr("selected", true);
      $("#ID_PUESTO option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus option[value='" + estatus[0] + "']").attr("selected", true);
     
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }
  })

}

function Registrar_usuario() {

  var rfc = $("#RFC_CORTO").val();
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
  $.post("php/Valida_R_User.php", {
    array: json
  }, function (data) {
    alert(data);
    location.reload();
  });

}

function ConsultarDatosUser_us(id_usuario) {

  $.post("php/consulta_datos_user.php", {
    id_usuario: id_usuario
  }, function (data) {


    var id_usuario = [];
    var rfc = [];
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
      id_usuario.push(data.id_empleado);
      rfc.push(data.rfc_corto);
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
      $("#NOMBRE_A").val(nombre[0]);
      $("#CORREO_A").val(correo[0]);
      $("#NO_EMPLEADO_A").val(no_empleado[0]);
      $("#id_admin_A option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin_A option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA_A option[value='" + depa[0] + "']").attr("selected", true);
      $("#RFC_JEFE_A option[value='" + jefe_directo[0] + "']").attr("selected", true);
      $("#ID_PERFIL_A option[value='" + id_perfil[0] + "']").attr("selected", true);
      $("#ID_PUESTO_A option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus_A option[value='" + estatus[0] + "']").attr("selected", true);
      $("#btn_RU_A").attr("onclick", 'Actualizar_user(' + id_usuario[0] + ')');
      $("#Modal_form_editar").modal();
      $("#estatus_responsiva option[value='" + responsiva[0] + "']").attr("selected", true);
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }

  });

}

function ConsultarDatosUser_insumo(id_usuario) {

  $.post("php/consulta_datos_user.php", {
    id_usuario: id_usuario
  }, function (data) {


    var id_usuario = [];
    var rfc = [];
    var nombre = [];
    var apellido_p = [];
    var apellido_m = [];
    var no_empleado = [];
    var id_perfil = [];
    var id_puesto = [];
    var correo = [];
    var correo_p = [];
    var local = [];
    var area = [];
    var depa = [];
    var jefe_directo = [];
    var estatus = [];
    var responsiva = [];

    for (var i in data) {
      id_usuario.push(data.id_empleado);
      rfc.push(data.rfc_corto);
      nombre.push(data.nombre_s);
      apellido_p.push(data.apellido_p);
      apellido_m.push(data.apellido_m);
      no_empleado.push(data.no_empleado);
      id_perfil.push(data.id_perfil);
      id_puesto.push(data.id_puesto);
      correo.push(data.correo_inst);
      correo_p.push(data.correo_personal);
      local.push(data.id_admin);
      area.push(data.id_sub_admin);
      depa.push(data.id_depto);
      jefe_directo.push(data.jefe_directo);
      estatus.push(data.estatus);
      responsiva.push(data.responsiva);
    }

    if (rfc != null) {
      $("#RFC_CORTO_A").val(rfc[0]);
      $("#NOMBRE_A").val(nombre[0]);
      $("#APELLIDO_P").val(apellido_p[0]);
      $("#APELLIDO_M").val(apellido_m[0]);
      $("#NO_EMPLEADO_A").val(no_empleado[0]);
      $("#CORREO_A").val(correo[0]);
      $("#CORREO_O").val(correo_p[0]);
      $("#id_admin_A option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin_A option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA_A option[value='" + depa[0] + "']").attr("selected", true);
      $("#RFC_JEFE_A option[value='" + jefe_directo[0] + "']").attr("selected", true);
      $("#ID_PERFIL_A option[value='" + id_perfil[0] + "']").attr("selected", true);
      $("#ID_PUESTO_A option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus_A option[value='" + estatus[0] + "']").attr("selected", true);
      $("#estatus_responsiva option[value='" + responsiva[0] + "']").attr("selected", true);
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }

  });

}

$(document).ready(function () { 
  $('#estatus').change(function(){
    $('#estatus option:selected').each(function(){
      var est = $(this).val();
      if (est == 'N') {
        $('#fec_baja_reg').show(200);
      }
      else{
        $('#fec_baja_reg').hide(200);
      }
    })
  })
  $('#Escolaridad').change(function(){
    $('#Escolaridad option:selected').each(function(){
      var est = $(this).val();
      //alert(est)
       switch (est) {
           case 4:
             $('#actv_carrera').show(200);
           break;
           case 5:
             $('#actv_carrera').show(200);
           break;
           case 6:
             $('#actv_carrera').show(200);
           break;
           case 7:
             $('#actv_carrera').show(200);
           break;
           case 8:
             $('#actv_carrera').show(200);
             break;
           default:
          $('#actv_carrera').hide(200);
           break;
       }
    })
  })
 })

function Actualizar_user(id_empleado) {

  if ($("#RFC_CORTO_A").val().length < 4 || $("#NOMBRE_A").val().length < 10 || $("#APELLIDO_P").val().length < 5 || $("#APELLIDO_M").val().length < 5 || $("#NO_EMPLEADO_A").val().length < 3 || $("#CORREO_A").val().length < 20 || $("#id_admin_A").val() == 0 || $("#id_sub_admin_A").val() == 0 || $("#ID_DEPA_A").val() == 0 || $("#RFC_JEFE_A").val() == 0 || $("#ID_PERFIL_A").val() == 0 || $("#ID_PUESTO_A").val() == 0 || $("#estatus_A").val() == 0) {
    alert('Los datos marcados con el asterico no deben ser dejados en blanco y deben de cumplir con el tamño considerable.\n Para asistencia consulte con el administrador del sistema.');
  } else {
    var rfc = $("#RFC_CORTO_A").val();
    var nombre = $("#NOMBRE_A").val();
    var apellido_p = $("#APELLIDO_P").val();
    var apellido_m = $("#APELLIDO_M").val();
    var no_empleado = $("#NO_EMPLEADO_A").val();
    var correo = $("#CORREO_A").val();
    var correo_p = $("#CORREO_O").val();
    var local = $("#id_admin_A").val();
    var area = $("#id_sub_admin_A").val();
    var depa = $("#ID_DEPA_A").val();
    var rfc_jefe = $("#RFC_JEFE_A").val();
    var id_perfil = $("#ID_PERFIL_A").val();
    var id_puesto = $("#ID_PUESTO_A").val();
    var estus = $("#estatus_A").val();
    var responsiva = $("#estatus_responsiva").val();

    var datos = {
      id_empleado: id_empleado,
      rfc_corto: rfc,
      nombre_u: nombre,
      apellido_p: apellido_p,
      apellido_m: apellido_m,
      no_emp: no_empleado,
      correo: correo,
      correo_p: correo_p,
      id_admin: local,
      id_sub_admin: area,
      id_depa: depa,
      jefe: rfc_jefe,
      perfil: id_perfil,
      puesto: id_puesto,
      estatus: estus,
      responsiva: responsiva
    };

    var json = JSON.stringify(datos);

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







function buscar_datos_observaciones(tiket) {
  $.ajax({
      url: 'php/detalle_tiket_peticion.php',
      type: 'POST',
      dataType: 'html',
      data: {
        RDFDA_observacion: tiket
      },
    })
    .done(function (respuesta) {
      //alert(respuesta);
      $("#datosObservaciones").html(respuesta);
    })
    .fail(function () {
      console.log("error");
    });
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



function ConfirmarCargaUSU(valor) {
  $.post("php/validar_carga_masiva.php", {
    USU: valor
  }, function (data) {
    $("#texto_result").html(data);
    $("#resultado_carga").modal({
      backdrop: 'static',
      keyboard: false
    });
  });
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









function modal_detalle_calendario(fecha) {

  $.post("php/valida_dia_pendientes.php", {
    fechas: fecha
  }, function (data) {
    $("#contenido").html(data); //Carga los elementos al body/content del modal
    $('#detalle').modal('toggle'); // eManada a llamar el modal
  });
}

$('.numeros').on('input', function () {
  this.value = this.value.replace(/[^0-9]/g, '');
});


$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip()
});








// ---------------- Busqueda-------------------------------






function MandaTiketImpreso(tiket) {
  $.ajax({
      url: 'php/Crear_Bolante.php',
      type: 'POST',
      dataType: 'html',
      data: {
        tiket: tiket
      },
    })
    .done(function (respuesta) {
      //alert(respuesta);
      $("#datostiket").html(respuesta);
    })
    .fail(function () {
      console.log("error");
    });
}
















function Registrar_usuario() {

  var rfc = $("#RFC_CORTO").val();
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
  $.post("php/Valida_R_User.php", {
    array: json
  }, function (data) {
    alert(data);
    location.reload();
  });

}









function Actualiza_autoridad() {

  var id_autoridad = $("#id_autoridad").val();
  var Nombre_autor = $("#Nombre_autor").val();
  var estatus = $('input:radio[name=estatus]:checked').val();

  var datos = {
    id_autoridad: id_autoridad,
    Nombre_autor: Nombre_autor,
    estatus: estatus
  };
  //  var json = JSON.stringify(datos);
  //  alert('Si entra aqui' + json);    
  if (Nombre_autor != "") {
    $.post("php/Ac_area.php", {
      autoridad: datos
    }, function (data) {
      alert(data);
      location.reload();

    });
  } else {
    alert('No puede dejar en blanco el nombre de la Sub Administración.');
  }

}


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

// $(document).ready(function() {
//  $("#subadmin_b").change(function () {
//    $("#subadmin_b option:selected").each(function () {
//         var id_sub_admin = $(this).val();
//      $.post("php/Obtener_Combos.php",{id_sub_admin:id_sub_admin},function (data) {
//        $("#deptos_b").html(data);
//      })
//    })
//  })
// });

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
    daysOfWeekDisabled: [0, 6],
    todayHighlight: true,
    format: "dd/mm/yyyy",
    toggleActive: true,
    language: 'es'
  });

  $('#fecha_baja').datepicker({
    //endDate: "today",
    autoclose: true,
    todayHighlight: true,
    format: "dd/mm/yyyy",
    toggleActive: true,
    language: "es"
  });
});