//listar nombre de la actividad//
var table
function listar_actividad_nombre(){
     table = $("#tabla_actividad_nombre").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/actividad_nombre/controlador_actividad_nombre_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre_actividad"},
           
           //botones de accion//
           {"defaultContent":"<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='glyphicon glyphicon-edit'></i></button>"}
       ],

       "language":idioma_espanol,
       select: true
   });
   document.getElementById("tabla_actividad_nombre_filter").style.display="none";
   $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    });

}

function filterGlobal() {
    $('#tabla_actividad_nombre').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function AbrirModalRegistro(){
    $("#modalRegistro").modal({backdrop:'static',keyboard:false})
    $("#modalRegistro").modal('show');
}

//Registrar actividad//
function registrar_actividad_nombre(){
    var NOM=$("#txt_nombre").val();
    
    if (NOM.length==0 ){
            return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
        }
    $.ajax({
        "url":"../controlador/actividad_nombre/controlador_actividad_nombre_registro.php",
        type:'POST',
        data:{
         NOM:NOM,

        }
    }).done(function(resp){
       
        if(resp>0){
            if(resp==1){
                $("#modalRegistro").modal('hide');
                Swal.fire("Mensaje de Confirmacion","Datos correctamente, Nueva actividad Registrado,success")
                .then((value)=>{
                    LimpiarRegistro();
                   table.ajax.reload();
                });
                
            }else{
                Swal.fire("Mensaje De Advertencia","Lo sentimos,la actividad ya existe","warning");
            }
        }else{
            
             Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar el registro","error");
        }
    })
}

/* EDITAR ACTIVIDAD */
$('#tabla_actividad_nombre').on('click','.editar', function(){
    var data=table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
        var data=table.row(this).data();
    }
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
    $("#txtidactividad").val(data.id_nombre_actividad);
    $("#txtnombre_editar").val(data.nombre_actividad);
    
   
   

})

//Modificar acividad//
function Modificar_Actividad_nombre(){
    
    var IDACTIVIDAD=$("#txtidactividad").val();
    var NOM=$("#txtnombre_editar").val();
   
    if (NOM.length==0  ){
            return Swal.fire("Mensaje De Advertencia","Llene los campos vacios","warning");
        }
    $.ajax({
        "url":"../controlador/actividad_nombre/controlador_actividad_nombre_modificar.php",
        type:'POST',
        data:{
         IDACTIVIDAD:IDACTIVIDAD,
         NOM:NOM,

        }
    }).done(function(resp){
       
        if(resp>0){
            
                $("#modal_editar").modal('hide');
                Swal.fire("Mensaje de Confirmacion","Datos Actualizados correctamente,success")
                .then((value)=>{
                    
                   table.ajax.reload();
                });
          
        }else{
             Swal.fire("Mensaje De Error","Lo sentimos,no se pudo completar la actualizacion","error");
        }
    })
}
