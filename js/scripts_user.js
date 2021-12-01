$("#ver").click(function (e) {
  openNav();
});
$(document).ready(function () {
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
});
$(document).ready(function () {
  $('#user_more').on('click', function () {
    $('#agregar_user_insumo').modal();
  });
  $('#act_tabla_inicio').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })
  $('#registrar_us_ins').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })
  $('#actualiza_area_asig').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })
  $('#cerrar_modal_dat_area').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })
  $('#cerrar_modal_dat_adicio').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })
  $('#actualiza_dat_adicionales_bot').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })
  $('#actualiza_dat_adicionales_bot_baja').on('click', function () {
    $('#tabla_activa').load("php/tabla_bajas_actualiza.php");
  })
  $('#cerrar_mod_actualiza_plazas').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
    limpia_campos_2()
  })
  $('#actualiza_plazas').on('click', function () {
    $('#tabla_activa').load("php/tabla_actualizada.php");
  })

});

function Actualiza_area_asign_y_jefe(id_user_in) {
  var id_empleado = id_user_in;
  var id_admin = $('#id_admin').val();
  var id_sub_admin = $('#id_sub_admin').val();
  var id_depto = $('#ID_DEPA').val();
  var id_jefe = $('#RFC_JEFE').val();
  var id_puesto = $('#ID_PUESTO').val();
  var datos = {
    id_empleado:id_empleado,
    id_admin:id_admin,
    id_sub_admin:id_sub_admin,
    id_depto:id_depto,
    id_jefe:id_jefe,
    id_puesto:id_puesto,
  }
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
  .fail(function () {
    console.log("error");
  });

}
function limpia_campos_2(){
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
    id_empleado:id_empleado,
    genero:genero,
    hijos:hijos,
    estado_civil:estado_civil,
    escolaridad:escolaridad,
    estatus_escolar:estatus_escolar,
    carrera:carrera,
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
   .fail(function () {
     console.log("error");
   });

}
function Actualiza_datos_posision(id_user_in) {
  var id_empleado = id_user_in;
  var posision_act = $('#posision').val();
  var posision_ten = $('#posision_ten').val();
  var nivel = $('#nivel').val();
  var clave_presupuesto = $('#clave_pres2').val();
  var sueldo_neto = $('#sueldo_neto').val();
  var id_proc_plaza = $('#estatus_plazas_act').val();
 
  var datos = {
    id_empleado:id_empleado,
    posision_act:posision_act,
    posision_ten:posision_ten,
    nivel:nivel,
    clave_presupuesto:clave_presupuesto,
    sueldo_neto:sueldo_neto,
    id_proc_plaza:id_proc_plaza
  }
   var json = JSON.stringify(datos)
  if (id_proc_plaza == 4 || id_proc_plaza == 5) {
    if (posision_ten==0) {
      toastr.info('Debes seleccionar una posision para continuar esta acción', "Notificacion", {
        "progressBar": true
      })
    }
    else{
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
      .fail(function () {
        console.log("error");
      });
    }
    
  }
  else if (id_proc_plaza ==13 ){
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
    .fail(function () {
      console.log("error");
    });
  }
  else{
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

function Revisa_info_plaza(id_posision){
  $('#modal_info_posision').modal();
  $.post("php/consulta_dat.php",{posision_info:id_posision},function(data){
 
    $('#pos_posision').val(data[0]['id_num_posision'])
    $('#pos_nivel_add').val(data[0]['nivel'])
    $('#pos_clave_pres_add').val(data[0]['Codigo_pres'])
    $('#pos_Puesto_fump_add').val(data[0]['id_puesto_fump'])
    $('#pos_clav_puesto_add').val(data[0]['clave_puesto'])
    $('#pos_sueldo_neto').val(data[0]['sueldo_neto'])
    $('#pos_plaza_jefe').val(data[0]['posision_jefe'])
    $('#agree_posision_change').attr('onclick','Actualiza_posision_info_mante(' + data[0]['id_posision'] + ')');
  })

}

function Actualiza_posision_info_mante(id_posision){
  var num_posision =  $('#pos_posision').val();
  var nivel =  $('#pos_nivel_add').val();
  var clave_pres =  $('#pos_clave_pres_add').val();
  var id_puesto =  $('#pos_Puesto_fump_add').val();
  var clave_puesto =  $('#pos_clav_puesto_add').val();
  var sueldo =  $('#pos_sueldo_neto').val();
  var jefe_posision =  $('#pos_plaza_jefe').val();

  var datos = {
    id_posision:id_posision,
    num_posision:num_posision,
    nivel:nivel,
    clave_pres:clave_pres,
    id_puesto:id_puesto,
    clave_puesto:clave_puesto,
    sueldo:sueldo,
    jefe_posision:jefe_posision
  }
  
  var json = JSON.stringify(datos);

  $.post("php/consulta_dat.php",{actualiza_mante_posision:json},function(){
  }).done(function(data){
    toastr.info(data,"Notificación",{
      "progressBar":true
    })
  })



}


function Actualiza_dat_basic(id_user_in) {
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
    tipo_nom: tipo_nom
  }
if (estatus == 11 ||estatus == 7 || estatus == 6) {
  if (fec_baja == '') {
    toastr.error("No puedes dejar sin seleccionar la fecha de la baja","Notificación",{
      "progressBar":true
    })
  }
  else{
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
 

}

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
function trae_movimientos_x_personal(id_insumo){
  $.ajax({
    url: 'php/consulta_dat.php',
    type: 'POST',
    dataType: 'html',
    data: {
      mov_insumos: id_insumo
    },
  }).done(function(data){
    $('#caja_mov_personal_insumo').html(data)
  })
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

    }
    var userDate = fec_ingres[0]['date'];
    var date_string = moment(userDate).format("YYYY/MM/DD");
 
//console.log(data)
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
      $("#RFC_JEFE option[value='" + jefe_directo_[0] + "']").attr("selected", true);
      $("#posision").val(posision[0]);
      $("#estado_civ option[value='" + estado_civ[0] + "']").attr("selected", true);
      $("#id_admin option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA option[value='" + depa[0] + "']").attr("selected", true);
      $("#ID_PUESTO option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus option[value='" + estatus[0] + "']").attr("selected", true);
      $("#sex option[value='" + sex[0] + "']").attr("selected", true);
      $("#Hijos option[value='" + hijos[0] + "']").attr("selected", true);
      $("#Escolaridad option[value='" + Escolaridad[0] + "']").attr("selected", true);
      $("#tipo_nombramiento12 option[value='" + num_nombraMIEN[0] + "']").attr("selected", true);
      $("#estatus_esco option[value='" + estat_escolar[0] + "']").attr("selected", true);
      $("#carrera").val(Carrera[0]);
      $("#act_us_in_datos_basicos").attr("onclick", 'Actualiza_dat_basic(' + id_user_in[0] + ')');
      $("#actualiza_dat_adicionales_bot").attr("onclick", 'Actualiza_datos_adicionales(' + id_user_in[0] + ')');
      $("#actualiza_plazas").attr("onclick", 'Actualiza_datos_posision(' + id_user_in[0] + ')');
      $("#actualiza_area_asig").attr("onclick", 'Actualiza_area_asign_y_jefe(' + id_user_in[0] + ')');
      $('#nav-profile-tab').attr('onclick','trae_movimientos_x_personal(' + id_user_in[0] + ')');
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }
  })

}
function Revisa_info_det_us2(id_user_in) {
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

    }
    var userDate = fec_ingres[0]['date'];
    var date_string = moment(userDate).format("YYYY/MM/DD");
 
//console.log(data)
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
      $("#RFC_JEFE option[value='" + jefe_directo_[0] + "']").attr("selected", true);
      $("#posision").val(posision[0]);
      $("#estado_civ option[value='" + estado_civ[0] + "']").attr("selected", true);
      $("#id_admin option[value='" + local[0] + "']").attr("selected", true);
      $("#id_sub_admin option[value='" + area[0] + "']").attr("selected", true);
      $("#ID_DEPA option[value='" + depa[0] + "']").attr("selected", true);
      $("#ID_PUESTO option[value='" + id_puesto[0] + "']").attr("selected", true);
      $("#estatus option[value='" + estatus[0] + "']").attr("selected", true);
      $("#sex option[value='" + sex[0] + "']").attr("selected", true);
      $("#Hijos option[value='" + hijos[0] + "']").attr("selected", true);
      $("#Escolaridad option[value='" + Escolaridad[0] + "']").attr("selected", true);
      $("#tipo_nombramiento12 option[value='" + num_nombraMIEN[0] + "']").attr("selected", true);
      $("#estatus_esco option[value='" + estat_escolar[0] + "']").attr("selected", true);
      $("#carrera").val(Carrera[0]);
      $("#act_us_in_datos_basicos").attr("onclick", 'Actualiza_dat_basic(' + id_user_in[0] + ')');
      $("#actualiza_dat_adicionales_bot").attr("onclick", 'Actualiza_datos_adicionales(' + id_user_in[0] + ')');
      $("#actualiza_plazas").attr("onclick", 'Actualiza_datos_posision(' + id_user_in[0] + ')');
      $("#actualiza_area_asig").attr("onclick", 'Actualiza_area_asign_y_jefe(' + id_user_in[0] + ')');
      $('#nav-profile-tab').attr('onclick','trae_movimientos_x_personal(' + id_user_in[0] + ')');
    } else {
      alert('Los datos del usuario no estan disponibles.')
    }
  })

}
$(document).ready(function () {
  $('#estatus').change(function () {
    $('#estatus option:selected').each(function () {
      var est = $(this).val();
      if (est == 11 || est == 7) {
        $('#fec_baja_reg').show(200);
      } else {
        $('#fec_baja_reg').hide(200);
      }
    })
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
    $('#posision_ten').each(function (){ 
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
    $('#estatus_plazas_act').each(function (){ 
      var inc = $(this).val();
      if (inc == 4|| inc == 5) {
        $('#democion_promocion').show(200)
      } 
     else if(inc == 13 || inc == 7 || inc == 0){
      $('#democion_promocion').hide(200)
     }
     })
  })
  $('#tipo_nombramiento12').change(function () {  
    $('#tipo_nombramiento12').each(function (){ 
      var inc = $(this).val();
      if (inc == 1) {
        $('#opcion_sindical').show(200)
      } 
     else {
      $('#opcion_sindical').hide(200)
     }
     })
  })

})

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



function Actualizar_user(id_empleado) {

  if ($("#RFC_CORTO_A").val().length < 4 || 
  $("#NOMBRE_A").val().length < 10 ||
   $("#APELLIDO_P").val().length < 5 ||
    $("#APELLIDO_M").val().length < 5 ||
     $("#NO_EMPLEADO_A").val().length < 3 ||
      $("#CORREO_A").val().length < 20 ||
       $("#id_admin_A").val() == 0 ||
        $("#id_sub_admin_A").val() == 0 ||
         $("#ID_DEPA_A").val() == 0 ||
          $("#RFC_JEFE_A").val() == 0 ||
           $("#ID_PERFIL_A").val() == 0 ||
            $("#ID_PUESTO_A").val() == 0 ||
             $("#estatus_A").val() == 0) {
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
  $('#fecha_ingreso_add').datepicker({
    endDate: "today",
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
  $('#fecha_baja_add').datepicker({
    //endDate: "today",
    autoclose: true,
    todayHighlight: true,
     //daysOfWeekDisabled: [0, 6],
    format: "yyyy/mm/dd",
    toggleActive: true,
    language: "es"
  });
  $('#posision_add').on('keyup',function(){
    var cons = $(this).val();
    $.post("php/consulta_dat.php",{posision_predic:cons},function (data) { 
      $('#opciones').html(data);
     })
  })


});


