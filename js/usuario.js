function VerificarUsuario(){
    var usu = $("#txt_usu").val();
    var con = $("#txt_con").val();

    if(usu.length==0 || con.length==0){
        return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
    }
    $.ajax({
        url:'../controlador/usuario/controlador_verificar_usuario.php',
        type:'POST',
        data:{
            user:usu,
            pass:con
        }
    }).done(function(resp){
        if(resp==0){
            Swal.fire("Mensaje De Error",'Usuario y/o contrase\u00f1a incorrecta',"error");
        }else{
            var data= JSON.parse(resp);
            if(data[0][10]==='INACTIVO'){
                return Swal.fire("Mensaje De Advertencia","Lo sentimos el usuario "+usu+" no esta activo, comuniquese con el administrador","warning");
            }
            $.ajax({
                url:'../controlador/usuario/controlador_crear_session.php',
                type:'POST',
                data:{
                    idusuario:data[0][0],
                    user:data[0][2],
                    rol:data[0][8],
                    img:data[0][7]
                }
            }).done(function(resp){
                let timerInterval
                Swal.fire({
                title: 'BIENVENIDO AL SISTEMA DE CONTROL DE ACTIVIDADES',
                html: 'Usted sera derivado en <b></b> milisegundos.',
                timer: 2000,
                timerProgressBar: true,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
})
            })
           
        }
    })
}
//listar usuario
var table
function listar_usuario(){
     table = $("#tabla_usuario").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/usuario/controlador_usuario_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre"},
           {"data":"usuario"},
           {"data":"perfil"},
           {"data":"descripcion"},
           {"data":"departamento"},
           {"data":"FOTO",
            render: function (data, type, row ){
                return '<img src="../'+data+'"  style="width:35px;">';
            }
            },
           {"data":"estado",
             render: function (data, type, row ) {
               if(data=='ACTIVO'){
                   return "<span class='label label-success'>"+data+"</span>";                   
               }else{
                 return "<span class='label label-danger'>"+data+"</span>";                 
               }
             }
           },  
           {"data":"id_usuarios",
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
   document.getElementById("tabla_usuario_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}
/* DESACTIVAR USUARIO */
$('#tabla_usuario').on('click','.desactivar', function(){
   var data=table.row($(this).parents('tr')).data();
   if(table.row(this).child.isShown()){
       var data=table.row(this).data();
   }
   Swal.fire({
    title: 'Esta seguro de desactivar al usuario?',
    text: "Si no lo esta puede cancelar la accion!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, desactivar usuario!'
  }).then((result) => {
    if (result.value) {
     modificar_estado(data.id_usuarios,'2');
    }
  })
})


/*ACTIVAR  USUARIO */
$('#tabla_usuario').on('click','.activar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    Swal.fire({
     title: 'Esta seguro de activar al usuario?',
     text: "Si no lo esta puede cancelar la accion!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Si, activar usuario!'
   }).then((result) => {
     if (result.value) {
      modificar_estado(data.id_usuarios,'1');
     }
   })
 })

 /* EDITAR USUARIO */
$('#tabla_usuario').on('click','.editar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    $("#txtidusuario").val(data.id_usuarios);
    $("#txtnombre_editar").val(data.nombre);
    $("#txtusuario_editar").val(data.usuario);
    $("#txtcontra_editar").val(data.password);
    $("#cbo_tipo_editar").val(data.id_perfil).trigger("change");
    $("#cbo_turno_editar").val(data.id_turno).trigger("change");
    $("#cbo_depart_editar").val(data.id_departamento).trigger("change");
   
   

})

/* imprimir USUARIO */
$('#tabla_usuario').on('click','.pdf', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    window.open("../vista/MPDF/generar_usuario.php?id="+parseInt(data.id_usuarios)+"#zoom=100%","Ticket","scrollbars=NO");
})
function modificar_estado(idusuario,estado){
    
    
    $.ajax({
        "url":"../controlador/usuario/controlador_modificar_estado_usuario.php",
        type:'POST',
        data:{
         idusuario:idusuario,
         estado:estado

        }
    }).done(function(resp){
       
        if(resp>0){
            Swal.fire("Mensaje de Confirmacion","El usuario se desactivo con exito","success")
            .then((value)=>{
               
               table.ajax.reload();
            });
        }
    })
}
function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function AbrirModalRegistro(){
    $("#modalRegistro").modal({backdrop:'static',keyboard:false})
    $("#modalRegistro").modal('show');
}

//listar combos//

function listar_combo_rol(){
    $.ajax({
        "url":"../controlador/usuario/controlador_combo_rol_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_tipo").html(cadena);
            //llamar para mostrar a//
            $("#cbo_tipo_editar").html(cadena);
            // la ventana editar//

        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}
function listar_combo_estado(){
    $.ajax({
        "url":"../controlador/usuario/controlador_combo_estado_listar.php",
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

function listar_combo_turno(){
    $.ajax({
        "url":"../controlador/usuario/controlador_combo_turno_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_turno").html(cadena);
            //llamar para mostrar a//
            $("#cbo_turno_editar").html(cadena);
            // la ventana editar//

        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}
function listar_combo_depart(){
    $.ajax({
        "url":"../controlador/usuario/controlador_combo_depart_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            for(var i=0; i < data.length; i++){
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#cbo_depart").html(cadena);
            //llamar para mostrar a//
            $("#cbo_depart_editar").html(cadena);
            // la ventana editar//
        }else{
            cadena+="<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
    })
}

//Registrat usuario//
function registrar_usuario(){
    var NOM=document.getElementById('txt_nombre').value;
    var USU=document.getElementById('txt_usuario').value;
    var CONTRA=document.getElementById('txt_contra').value;
    var PERF=document.getElementById('cbo_tipo').value;
    var ESTAD=document.getElementById('cbo_estado').value;
    var TURN=document.getElementById('cbo_turno').value;
    var DEPART=document.getElementById('cbo_depart').value;
    var archivo=document.getElementById('imagen').value;
    var f = new Date();
    var extension=archivo.split('.').pop();
    var nombrearchivo="IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+
    f.getMinutes()+""+f.getSeconds()+"."+extension;
    var formData= new FormData();
    var FOTO=$("#imagen")[0].files[0];

    formData.append('NOM',NOM);
    formData.append('USU',USU);
    formData.append('CONTRA',CONTRA);
    formData.append('PERF',PERF);
    formData.append('ESTAD',ESTAD);
    formData.append('TURN',TURN);
    formData.append('DEPART',DEPART);
    formData.append('FOTO',FOTO);
    formData.append('nombrearchivo',nombrearchivo);


    //if (NOM.length==0 || USU.length==0 || CONTRA.length==0 || PERF.length==0//
      //  || ESTAD.length==0 || TURN.length==0 || DEPART.length==0 || archivo.length==0){//
       //     return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");//
        //}//

    $.ajax({
        "url":"../controlador/usuario/controlador_usuario_registro.php",
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
                    Swal.fire("Mensaje de Confirmacion","Datos correctamente, Nuevo Usuario Registrado,success")
                  
                    
                }else{
                    Swal.fire("Mensaje De Advertencia","Lo sentimos,el usuario ya existe","warning");
                }
            }else{
                 Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar el registro","error");
            }
        }
    });
            return false;
}
//Modificar usuario//
$('#Modificar_Usuario').on('click','.editar',function(){
    
        var data=tabla_usuario.row($(this).parents('tr')).data();
        if(table.row(this).child.isShown()){
            var data=table.row(this).data();
        }
        $("#modal_editar").modal({backdrop:'static',keyboard:false})
        $("#modal_editar").modal('show');

        document.getElementById('txtidusuario').value=data.id_usuarios;
        document.getElementById('txtnombre_editar').value=data.nombre;
        document.getElementById('txtcontra_editar').value=data.pass;
        $('#cbo_tipo_editar').val(data.id_perfil).trigger("change");
        $('#cbo_turno_editar').val(data.id_turno).trigger("change");
        $('#cbo_depart_editar').val(data.id_departamento).trigger("change");
       
        
    });
    function Modificar_Usuario(){
        var IDUSUARIO=document.getElementById('txtidusuario').value;
        var NOM=document.getElementById('txtnombre_editar').value;
        var CONTRA=document.getElementById('txtcontra_editar').value;
        var PERF=document.getElementById('cbo_tipo_editar').value;
        var TURN=document.getElementById('cbo_turno_editar').value;
        var DEPART=document.getElementById('cbo_depart_editar').value;
        
        $.ajax({
            "url":"../controlador/usuario/controlador_usuario_modificar.php",
            type:'POST',
            data:{
                IDUSUARIO:IDUSUARIO,
                NOM:NOM,
                CONTRA:CONTRA,
                PERF:PERF,
                TURN:TURN,
                DEPART:DEPART
       
               }
            
        }).done(function(resp){
        
            if(resp>0){
                if(resp==1){
                    table.ajax.reload();
                    $("#modal_editar").modal('hide');
                    Swal.fire("Mensaje de Confirmacion","Datos Actualizados correctamente,success");
                }else{

                    Swal.fire("Mensaje De Advertencia","Lo sentimos,el usuario ya existe","warning");
                }
                    
                    
              
            }else{
                 Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar la actualizacion","error");
            }
        })
    }
    /*EDITAR IMAGEN*/
    function editar_foto(){
        var IDUSUARIO=document.getElementById('txtidusuario').value;
        var archivo=document.getElementById('imagen_editar').value;
        var f = new Date();
        var extension=archivo.split('.').pop();
        var nombrearchivo="IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+
        f.getMinutes()+""+f.getSeconds()+"."+extension;
        var formData= new FormData();
        var FOTO=$("#imagen_editar")[0].files[0];
        if(archivo.length==0){
            return Swal.fire("Mensaje de advertencia","Debe selccionar un archivo","warning");
        }
        formData.append('IDUSUARIO',IDUSUARIO);
        formData.append('FOTO',FOTO);
        formData.append('nombrearchivo',nombrearchivo);
    
    
        //if (NOM.length==0 || USU.length==0 || CONTRA.length==0 || PERF.length==0//
          //  || ESTAD.length==0 || TURN.length==0 || DEPART.length==0 || archivo.length==0){//
           //     return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");//
            //}//
    
        $.ajax({
            "url":"../controlador/usuario/controlador_usuario_editar_imagen.php",
            type:'POST',
            data:formData,
            contentType:false,
            processData:false,
            success:function(respuesta){
                if(respuesta!=0){
                    if(respuesta==1){
                        table.ajax.reload();
                        $("#modalRegistro").modal('hide');
                        Swal.fire("Mensaje de Confirmacion","Foto actualizada","success");
                      
                        
                    }else{
                        Swal.fire("Mensaje De Advertencia","Lo sentimos,el usuario ya existe","warning");
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
    $("imagen").val("");
}
