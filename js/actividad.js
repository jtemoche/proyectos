//listar actividad
var table
function listar_actividad(){
     table = $("#tabla_actividad").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/actividad/controlador_actividad_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre_proyecto"},
           {"data":"nombre_actividad"},
           {"data":"documento",
            //para descargar el archivo//
            render: function (data, type, row ) {
                return '<a href="../'+data+'" target="_blank" ><i class="fa fa-search"></i></a>';                   

      }
    },
           {"data":"nombre"},
           {"data":"fecha_inicio"},
           {"data":"fecha_fin"},
           {"data":"estado",
             render: function (data, type, row ) {
               if(data=='EJECUCION'){
                   return "<span class='label label-success'>"+data+"</span>";                   
               }else{
                 return "<span class='label label-danger'>"+data+"</span>";                 
               }
             }
           },  
           {"data":"id_actividad",
             render: function (data, type, row ) {
               return"<button style='font-size:13px;' type='button' class='pdf btn btn-danger'><i class='fa fa-print'></i></button>"
             }
           },  
           //botones de accion//
           {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='glyphicon glyphicon-edit'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='glyphicon glyphicon-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button>"}
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_actividad_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}
/* DESACTIVAR ACTIVIDAD */
$('#tabla_actividad').on('click','.desactivar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    Swal.fire({
     title: 'Esta seguro de desactivar la actividad?',
     text: "Si no lo esta puede cancelar la accion!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Si, desactivar actividad!'
   }).then((result) => {
     if (result.value) {
      modificar_estado(data.id_nombre_actividad,'2');
     }
   })
 })
 
 
 /*ACTIVAR  actividad*/
 $('#tabla_actividad').on('click','.activar', function(){
     var data=table.row($(this).parents('tr')).data();
     if(table.row(this).child.isShown()){
         var data=table.row(this).data();
     }
     Swal.fire({
      title: 'Esta seguro de activar la actividad?',
      text: "Si no lo esta puede cancelar la accion!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, activar actividad!'
    }).then((result) => {
      if (result.value) {
       modificar_estado(data.id_nombre_actividad,'1');
      }
    })
  })
/* EDITAR ACTIVIDAD */
$('#tabla_actividad').on('click','.editar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    $("#txtidactividad").val(data.id_actividad);
    $("#cboactividad_editar").val(data.id_nombre_actividad).trigger("change");
    $("#cboproyecto_editar").val(data.id_proyecto).trigger("change");
    $("#cbousuario_editar").val(data.id_usuario).trigger("change");
    $("#fecha_inicio_editar").val(data.fecha_inicio).trigger("change");
    $("#fecha_fin_editar").val(data.fecha_fin).trigger("change");

})

/* imprimir ACTIVIDAD */
$('#tabla_actividad').on('click','.pdf', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    window.open("../vista/MPDF/generar_actividad.php?id="+parseInt(data.id_actividad)+"#zoom=100%","Ticket","scrollbars=NO");
})
function modificar_estado(idactividad,estado){
    
    
    $.ajax({
        "url":"../controlador/actividad/controlador_modificar_estado_actividad.php",
        type:'POST',
        data:{
         idactividad:idactividad,
         estado:estado

        }
    }).done(function(resp){
       
        if(resp>0){
            Swal.fire("Mensaje de Confirmacion","La actividad se desactivo con exito","success")
            .then((value)=>{
               
               table.ajax.reload();
            });
        }
    })
}
function filterGlobal() {
    $('#tabla_actividad').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function AbrirModalRegistro(){
    $("#modalRegistro").modal({backdrop:'static',keyboard:false})
    $("#modalRegistro").modal('show');
}

//listar combos//
function listar_combo_actividad(){
    $.ajax({
        "url":"../controlador/actividad/controlador_combo_actividad_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_actividad").html(cadena);
             //llamar para mostrar a//
             $("#cboactividad_editar").html(cadena);
             // la ventana editar//
            
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}

function listar_combo_estado(){
    $.ajax({
        "url":"../controlador/actividad/controlador_combo_estado_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_estado").html(cadena);
             //llamar para mostrar a//
             $("#cboestado_editar").html(cadena);
             // la ventana editar//
            
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}

function listar_combo_proyecto(){
    $.ajax({
        "url":"../controlador/actividad/controlador_combo_proyecto_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_proyecto").html(cadena);
            //llamar para mostrar a//
            $("#cboproyecto_editar").html(cadena);
            // la ventana editar//

        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}
function listar_combo_usuario(){
    $.ajax({
        "url":"../controlador/actividad/controlador_combo_usuario_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_usuario").html(cadena);
            //llamar para mostrar a//
            $("#cbousuario_editar").html(cadena);
            // la ventana editar//
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}

//Registrar Actividad//
function registrar_actividad(){
    var NOM=document.getElementById('cbo_actividad').value;
    var ESTAD=document.getElementById('cbo_estado').value;
    var PROY=document.getElementById('cbo_proyecto').value;
    var USUARIO=document.getElementById('cbo_usuario').value;
    var FINICIO=document.getElementById('fecha_inicio').value;
    var FFIN=document.getElementById('fecha_fin').value;
    var archivo=document.getElementById('archivo').value;
    var f = new Date();
    var extension=archivo.split('.').pop();
    var nombrearchivo=""+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+
    f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var documento=$("#archivo")[0].files[0];

    formData.append('NOM',NOM);
    formData.append('ESTAD',ESTAD);
    formData.append('FINICIO',FINICIO);
    formData.append('FFIN',FFIN);
    formData.append('PROY',PROY);
    formData.append('USUARIO',USUARIO);
    formData.append('documento',documento);
    formData.append('nombrearchivo',nombrearchivo);


    //if (NOM.length==0 || USU.length==0 || CONTRA.length==0 || PERF.length==0//
      //  || ESTAD.length==0 || TURN.length==0 || DEPART.length==0 || archivo.length==0){//
       //     return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");//
        //}//
        
    $.ajax({
        
        "url":"../controlador/actividad/controlador_actividad_registro.php",
        
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        success:function(respuesta){
            if(respuesta!=0){
                
                   
                    LimpiarRegistro();
                    table.ajax.reload();
                    $("#modalRegistro").modal('hide');
                    Swal.fire("Mensaje de Confirmacion","Datos correctamente, Nueva Actividad Registrado,success")
                  
                
                
            }else{
                
                 Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar el registro","error");
            }
        }
    });
            return false;
}
//Modificar actividad//
$('#Modificar_Actividad').on('click','.editar',function(){
    
    var data=tabla_actividad.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');

    document.getElementById('txtidactividad').value=data.id_actividad;
    $("#cboactividad_editar").val(data.id_nombre_actividad).trigger("change");
    $("#cboproyecto_editar").val(data.id_proyecto).trigger("change");
    $("#cbousuario_editar").val(data.id_usuario).trigger("change");
    $("#fecha_inicio_editar").val(data.fecha_inicio).trigger("change");
    $("#fecha_fin_editar").val(data.fecha_fin).trigger("change");
    
});
function Modificar_Actividad(){
    var IDACTIVIDAD=document.getElementById('txtidactividad').value;
    var NOM=document.getElementById('cboactividad_editar').value;
    var PROY=document.getElementById('cboproyecto_editar').value;
    var USUARIO=document.getElementById('cbousuario_editar').value;
    var FINICIO=document.getElementById('fecha_inicio_editar').value;
    var FFIN=document.getElementById('fecha_fin_editar').value;
    
    $.ajax({
        "url":"../controlador/actividad/controlador_actividad_modificar.php",
        type:'POST',
        data:{
            IDACTIVIDAD:IDACTIVIDAD,
            NOM:NOM,
            PROY:PROY,
            USUARIO:USUARIO,
            FINICIO:FINICIO,
            FFIN:FFIN
           }
        
    }).done(function(resp){
      
        if(resp>0){
            if(resp==1){
                table.ajax.reload();
                $("#modal_editar").modal('hide');
                Swal.fire("Mensaje de Confirmacion","Datos Actualizados correctamente,success");
            }else{

                Swal.fire("Mensaje De Advertencia","Lo sentimos,la actividad ya existe","warning");
            }
                
                
          
        }else{
             Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar la actualizacion","error");
        }
    })
}
/*EDITAR ARCHIVO*/
function editar_archivo(){
    var IDACTIVIDAD=document.getElementById('txtidactividad').value;
    var archivo=document.getElementById('archivo_editar').value;
    var f = new Date();
    var extension=archivo.split('.').pop();
    var nombrearchivo=""+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+
    f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var ARCHI=$("#archivo_editar")[0].files[0];
    if(archivo.length==0){
        return Swal.fire("Mensaje de advertencia","Debe selccionar un archivo","warning");
    }
    formData.append('IDACTIVIDAD',IDACTIVIDAD);
    formData.append('ARCHI',ARCHI);
    formData.append('nombrearchivo',nombrearchivo);


    //if (NOM.length==0 || USU.length==0 || CONTRA.length==0 || PERF.length==0//
      //  || ESTAD.length==0 || TURN.length==0 || DEPART.length==0 || archivo.length==0){//
       //     return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");//
        //}//

    $.ajax({
        "url":"../controlador/actividad/controlador_actividad_editar_archivo.php",
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        success:function(respuesta){
            if(respuesta!=0){
                if(respuesta==1){
                    table.ajax.reload();
                    $("#modalRegistro").modal('hide');
                    Swal.fire("Mensaje de Confirmacion","ARCHIVO actualizada","success");
                  
                    
                }else{
                    Swal.fire("Mensaje De Advertencia","Lo sentimos,el archivo ya existe","warning");
                }
            }
        }
    });
            return false;
}     

//limpiar cajas de textos//
function LimpiarRegistro(){
    $("#txt_nombre").val("");
    $("#txt_usuario").val("");
    $("#txt_contra").val("");
    $("#txt_tipo").val("");
    $("#txt_estado").val("");
    $("#txt_turno").val("");
    $("#txt_depart").val("");
}

//listar actividad de los usuarios//
var table
function listar_actividad_usuario(){
    let idusuario = $("#idusuarioprincipal").val();
     table = $("#tabla_actividad").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/actividad/controlador_actividad_usuario_listar.php",
           type:'POST',
           data:{
               id:idusuario
           }
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre_proyecto"},
           {"data":"nombre_actividad"},
           {"data":"documento",
            //para descargar el archivo//
            render: function (data, type, row ) {
                return '<a href="../'+data+'" target="_blank" ><i class="fa fa-search"></i></a>';                   

      }
    },
           {"data":"nombre"},
           {"data":"fecha_inicio"},
           {"data":"fecha_fin"},
           {"data":"porcentaje",
            render: function (data, type, row ) {
                if(data=='0'){
                    return '<br><div class="progress progress-xs" style="height:20px !important">'+
                    '<div class="progress-bar progress-bar-primary" style="width: 0%;height:20px !important;color:black;text-aling:center !important">0%</div>'+
                  '</div>';                   
                }

                if(data=='1'){
                    return '<br><div class="progress progress-xs" style="height:20px !important">'+
                    '<div class="progress-bar progress-bar-primary" style="width: 50%;height:20px !important">50%</div>'+
                  '</div>';                   
                }

                if(data>'1'){
                    return '<br><div class="progress progress-xs" style="height:20px !important">'+
                    '<div class="progress-bar progress-bar-primary" style="width: 100%;height:20px !important">100%</div>'+
                  '</div>';                   
                }

            }
            }, 
            {"defaultContent":"<button style='font-size:13px;' type='button' class='avance1 btn btn-danger'><i class='fa  fa-file-pdf-o'></i>Avance 1</button>&nbsp;<button style='font-size:13px;padding-top:4px' type='button' class='avance2 btn btn-success'><i class='fa  fa-file-pdf-o'></i>Avance 2</button>&nbsp;"},
           {"data":"estado",
             render: function (data, type, row ) {
               if(data=='EJECUCION'){
                   return "<span class='label label-success'>"+data+"</span>";                   
               }else{
                 return "<span class='label label-danger'>"+data+"</span>";                 
               }
             }
           },  
           {"data":"estado",
            render: function (data, type, row ) {
                if(data=='EJECUCION'){
                    return "<button style='font-size:13px;' type='button' class='subir btn btn-danger'><i class='fa fa-cloud-upload'></i> Subir Avances</button>";                   
                }else{
                return "<button style='font-size:13px;' type='button' class='btn btn-danger' disabled><i class='fa fa-cloud-upload'></i> Subir Avances</button>";                 
                }
            }
            }
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_actividad_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}

$('#tabla_actividad').on('click','.subir', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modalSubir").modal({backdrop:'static',keyboard:false})
    $("#modalSubir").modal('show');
    $("#txtidactividad").val(data.id_actividad);

 })

 $('#tabla_actividad').on('click','.avance1', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    Descargar_Avance(parseInt(data.id_actividad),1);

 })

 $('#tabla_actividad').on('click','.avance2', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    Descargar_Avance(parseInt(data.id_actividad),2);

 })
//descargar avance
 function Descargar_Avance(idactividad,num){
    $.ajax({
        "url":"../controlador/actividad/controlador_descargar_avance.php",
        type:'POST',
        data:{
            idactividad:idactividad,
            num:num
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            window.open("../"+data[0][0]);
        }else{
            Swal.fire("Mensaje de advertencia","No existe un avance registrado","warning");
        }
    })
 }

 /*subir avance*/
function Subir_Avance(){
    var idactividad =document.getElementById('txtidactividad').value;
    var archivo=document.getElementById('archivo').value;
    if(archivo.length==0){
        return Swal.fire("Mensaje de advertencia","Debe selccionar un archivo","warning");
    }
    var f = new Date();
    var extension=archivo.split('.').pop();
    var nombrearchivo=""+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+
    f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var archi=$("#archivo")[0].files[0];
    formData.append('idactividad',idactividad);
    formData.append('archi',archi);
    formData.append('nombrearchivo',nombrearchivo);
    $.ajax({
        "url":"../controlador/actividad/controlador_actividad_avance_archivo.php",
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        success:function(respuesta){
            if(respuesta!=0){
                if(respuesta==1){
                    table.ajax.reload();
                    document.getElementById('archivo').value="";
                    $("#modalSubir").modal('hide');
                    Swal.fire("Mensaje de Confirmacion","Avance Registrado","success");
                    
                  
                    
                }else{
                    Swal.fire("Mensaje De Advertencia","Lo sentimos el avace no se pudo registrar","warning");
                }
            }
        }
    });
            return false;
}     
function filterGlobal() {
    $('#tabla_actividad').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}