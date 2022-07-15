
//listar empleado
var table
function listar_empleado(){
     table = $("#tabla_empleado").DataTable({
       "ordering":false,
       "paging": false,
       "searching": { "regex": true },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax":{
           "url":"../controlador/empleado/controlador_empleado_listar.php",
           type:'POST'
       },
       "columns":[
           {"data":"posicion"},
           {"data":"nombre"},
           {"data":"descripcion"},
           {"data":"departamento"},
           {"data":"FOTO",
            render: function (data, type, row ){
                return '<img src="../'+data+'"  style="width:35px;">';
            }
            },
          
    
       ],

       "language":idioma_espanol,
       select: true
   });
   

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
