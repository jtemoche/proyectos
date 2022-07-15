//listar proyecto
var table
function listar_entrega(){
     table = $("#tabla_entrega").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/proyecto/controlador_proyecto_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre_proyecto"},
           
           //botones de accion//
           {"defaultContent":"<button style='font-size:13px;' type='button' class='verentrega btn btn-default' title='veractividad'><i class='fa fa-eye'></i></button>"}
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_proyecto_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}
/* DESACTIVAR PROYECTO */
$('#tabla_proyecto').on('click','.desactivar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    Swal.fire({
     title: 'Esta seguro de desactivar el proyecto?',
     text: "Si no lo esta puede cancelar la accion!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Si, desactivar proyecto!'
   }).then((result) => {
     if (result.value) {
      modificar_estado(data.id_proyecto,'4');
     }
   })
 })
 
 
 /*ACTIVAR  PROYECTO*/
 $('#tabla_proyecto').on('click','.activar', function(){
     var data=table.row($(this).parents('tr')).data();
     if(table.row(this).child.isShown()){
         var data=table.row(this).data();
     }
     Swal.fire({
      title: 'Esta seguro de activar el proyecto?',
      text: "Si no lo esta puede cancelar la accion!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, activar proyecto!'
    }).then((result) => {
      if (result.value) {
       modificar_estado(data.id_proyecto,'3');
      }
    })
  })

 /* EDITAR PROYECTO */
$('#tabla_proyecto').on('click','.editar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    $("#txtidproyecto").val(data.id_proyecto);
    $("#txtnombre_editar").val(data.nombre_proyecto);
    $("#fecha_inicio_editar").val(data.fecha_inicio).trigger("change");
    $("#fecha_fin_editar").val(data.fecha_fin).trigger("change");

})

 /* VER ACTIVIDAD */
 $('#tabla_entrega').on('click','.verentrega', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_veractividad").modal({backdrop:'static',keyboard:false})
    $("#modal_veractividad").modal('show');
    listar_actividad(data.id_proyecto);

})


var tableactividad;
function listar_actividad(id){
    tableactividad = $("#tabla_ver_actividad").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/actividad/controlador_actividad_entrega_proyecto.php",
           type:'POST',
           data:{
               id:id
           }
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre_actividad"},
           {"data":"nombre"},
           {"data":"numeroavance"},
           {"data":"documento",
           render: function (data, type, row ) {
            return '<a href="../'+data+'" target="_blank" ><i class="fa fa-search"></i></a>';                   

      }
    },  
           {"data":"estado",
             render: function (data, type, row ) {
               if(data=='EJECUCION'){
                   return "<span class='label label-success'>"+data+"</span>";                   
               }else{
                 return "<span class='label label-danger'>"+data+"</span>";                 
               }
             }
           },  


         /* {"data":"id_actividad",
          render: function (data, type, row ) {
             return "<button style='font-size:13px;' type='button' class='pdf btn btn-danger' title='verpdf'><i class='fa fa-print'></i></button>"
           }
         },  */
       ],

       "language":idioma_espanol,
       select: true
   });
}



function modificar_estado(idproyecto,estado){
    
    
    $.ajax({
        "url":"../controlador/proyecto/controlador_modificar_estado_proyecto.php",
        type:'POST',
        data:{
         idproyecto:idproyecto,
         estado:estado

        }
    }).done(function(resp){
       
        if(resp>0){
            Swal.fire("Mensaje de Confirmacion","El proyecto se desactivo con exito","success")
            .then((value)=>{
               
               table.ajax.reload();
            });
        }
    })
}
function filterGlobal() {
    $('#tabla_proyecto').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function AbrirModalRegistro(){
    $("#modalRegistro").modal({backdrop:'static',keyboard:false})
    $("#modalRegistro").modal('show');
}

//listar combos//


function listar_combo_estado(){
    $.ajax({
        "url":"../controlador/proyecto/controlador_combo_estado_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_estado").html(cadena);
            
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}








//Registrat proyecto//
function registrar_proyecto(){
    var NOM=document.getElementById('txt_nombre').value;
    var ESTAD=document.getElementById('cbo_estado').value;
    var FINICIO=document.getElementById('fecha_inicio').value;
    var FFIN=document.getElementById('fecha_fin').value;
    var archivo=document.getElementById('archivo').value;
    var f = new Date();
    var extension=archivo.split('.').pop();
    var nombrearchivo=""+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+
    f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var descripcion=$("#archivo")[0].files[0];

    formData.append('NOM',NOM);
    formData.append('ESTAD',ESTAD);
    formData.append('FINICIO',FINICIO);
    formData.append('FFIN',FFIN);
    formData.append('descripcion',descripcion);
    formData.append('nombrearchivo',nombrearchivo);


    //if (NOM.length==0 || USU.length==0 || CONTRA.length==0 || PERF.length==0//
      //  || ESTAD.length==0 || TURN.length==0 || DEPART.length==0 || archivo.length==0){//
       //     return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");//
        //}//
        
    $.ajax({
        
        "url":"../controlador/proyecto/controlador_proyecto_registro.php",
        
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        success:function(respuesta){
            if(respuesta!=0){
                if(respuesta==1){
                    
                    LimpiarRegistro();
                    table.ajax.reload();
                    $("#modalRegistro").modal('hide');
                    Swal.fire("Mensaje de Confirmacion","Datos correctamente, Nuevo Proyecto Registrado,success")
                  
                    
                }else{
                    
                    Swal.fire("Mensaje De Advertencia","Lo sentimos,el proyecto ya existe","warning");
                }
            }else{
              
                 Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar el registro","error");
            }
        }
    });
            return false;
}
//Modificar proyecto//
$('#Modificar_Proyecto').on('click','.editar',function(){
    
    var data=tabla_proyecto.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');

    document.getElementById('txtidproyecto').value=data.id_proyecto;
    document.getElementById('txtnombre_editar').value=data.nombre_proyecto;
    $("#fecha_inicio_editar").val(data.fecha_inicio).trigger("change");
    $("#fecha_fin_editar").val(data.fecha_fin).trigger("change");
    
});
function Modificar_Proyecto(){
    var IDPROYECTO=document.getElementById('txtidproyecto').value;
    var NOM=document.getElementById('txtnombre_editar').value;
    var FINICIO=document.getElementById('fecha_inicio_editar').value;
    var FFIN=document.getElementById('fecha_fin_editar').value;
    
    $.ajax({
        "url":"../controlador/proyecto/controlador_proyecto_modificar.php",
        type:'POST',
        data:{
            IDPROYECTO:IDPROYECTO,
            NOM:NOM,
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

                Swal.fire("Mensaje De Advertencia","Lo sentimos,el proyecto ya existe","warning");
            }
                
                
          
        }else{
             Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar la actualizacion","error");
        }
    })
}
/*EDITAR ARCHIVO*/
function editar_archivo(){
    var IDPROYECTO=document.getElementById('txtidproyecto').value;
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
    formData.append('IDPROYECTO',IDPROYECTO);
    formData.append('ARCHI',ARCHI);
    formData.append('nombrearchivo',nombrearchivo);


    //if (NOM.length==0 || USU.length==0 || CONTRA.length==0 || PERF.length==0//
      //  || ESTAD.length==0 || TURN.length==0 || DEPART.length==0 || archivo.length==0){//
       //     return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");//
        //}//

    $.ajax({
        "url":"../controlador/proyecto/controlador_proyecto_editar_archivo.php",
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
