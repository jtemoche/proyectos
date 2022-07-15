<script type="text/javascript" src="../js/proyecto.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">ADMINISTRAR PROYECTO</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder=" buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Agregar Proyecto</button>
                   
                </div>
                
            </div>
            <!--/.mostar titulos de la tabla proyecto -->
            <table id="tabla_proyecto" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Archivo</th>
                        <th>Inicio</th>
                        <th>Entrega</th>
                        <th>Estado</th>
                        <th>Genrerar PDF</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Archivo</th>
                        <th>Inicio</th>
                        <th>Entrega</th>
                        <th>Estado</th>
                        <th>Genrerar PDF</th>
                        <th>Acci&oacute;n</th>

                        

                    </tr>
                    
            
              
                </tfoot>
            </table>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
 </div>

<form autocomplete="false" onsubmit="return false">
  <div id="modalRegistro" class="modal fade" role="dialog">

    <div class="modal-dialog ">
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
          
          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Proyecto</h4>

          </div>

          <div class="modal-body">



              <div class="box-body">
                <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="txt_nombre"name="nuevoNombre" placeholder="Ingresar nombre" required>

                </div>

                </div>
              </div>


          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoEstado" id="cbo_estado">
                    
                  </select>

                </div>

          </div>
          <div class="form-group mb-3">
              <label for="">Fecha Inicio</label>
              <input type="datetime-local" id="fecha_inicio" name="event_dt" class="form-control">
          </div>

          <div class="form-group mb-3">
              <label for="">Fecha Entrega</label>
              <input type="datetime-local" id="fecha_fin" name="event_dt" class="form-control">
          </div>
       

           </div>

           <div class="col-lg-12">
              <label for="">Subir Archivo</label>

              <input type="file" id="archivo" accept="file/*" >

            </div>

            

           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="registrar_proyecto()">Guardar Proyecto</button>

          </div>


          </div>




      </form>

      </div>

    </div>

  </div>

</form>

<form autocomplete="false" onsubmit="return false">
  <div id="modal_editar" class="modal fade" role="dialog">

    <div class="modal-dialog ">
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
          
          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Editar Datos del Proyecto</h4>

          </div>

          <div class="modal-body">

              <div class="box-body">
              <input type="text" id="txtidproyecto" hidden>
                <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="txtnombre_editar"name="nuevoNombre" placeholder="Ingresar nombre" required>

                </div>

                </div>
              </div>


         
          <div class="form-group mb-3">
              <label for="">Fecha Inicio</label>
              <input type="datetime-local" id="fecha_inicio_editar" name="event_dt" class="form-control">
          </div>

          <div class="form-group mb-3">
              <label for="">Fecha Entrega</label>
              <input type="datetime-local" id="fecha_fin_editar" name="event_dt" class="form-control">
          </div>
       

           </div>

           <div class="col-lg-12">
              <label for="">Subir Archivo</label>

              <input type="file" id="archivo_editar" accept="file/*" >
              <div class="col-lg-2">
              <label for="">&nbsp;</label><br>
             <button class="btn btn-success" onclick="editar_archivo()" >Actualizar</button>
            </div>

            </div>

            

           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="Modificar_Proyecto()">Guardar Proyecto</button>

          </div>


          </div>




      </form>

      </div>

    </div>

  </div>

</form>




<form autocomplete="false" onsubmit="return false">
  <div id="modal_veractividad" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Ver Datos de la Actividad</h4>

          </div>

          <div class="modal-body">

            <div class="row">
              <table id="tabla_ver_actividad" class="display responsive nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Actividad</th>
                          <th>Usuario</th>
                          <th>Inicio</th>
                          <th>Entrega</th>
                          <th>Estado</th>
                          
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>#</th>
                          <th>Actividad</th>
                          <th>Usuario</th>
                          <th>Inicio</th>
                          <th>Entrega</th>
                          <th>Estado</th>
                         
                      </tr>        
                  </tfoot>
              </table>            
            </div>

          </div>
      </div>

    </div>

  </div>

</form>





<script>
$(document).ready(function() {
    listar_proyecto();
    listar_combo_estado();

} );
$("#modalRegistro").on('shown.bs.modal',function(){
      $("#txt_nombre").focus();
    })

    document.getElementById("archivo").addEventListener("change",()=>{
  var fileName=document.getElementById("archivo").value;
  var idxDot= fileName.lastIndexOf(".") + 1;
  var extFile=fileName.substr(idxDot,fileName.length).toLowerCase();
  if(extFile=="zip" || extFile=="docx" || extFile=="pdf"){

  }else{
    Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN ARCHIVOS-USTED SUBIO UN ARCHIVO CON EXTENSION "+extFile,"warning");
    document.getElementById("archivo").value="";
  }
});

/*editar archivo*/
document.getElementById("archivo_editar").addEventListener("change",()=>{
  var fileName=document.getElementById("archivo_editar").value;
  var idxDot= fileName.lastIndexOf(".") + 1;
  var extFile=fileName.substr(idxDot,fileName.length).toLowerCase();
  if(extFile=="zip" || extFile=="docx" || extFile=="pdf"){

  }else{
    Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN ARCHIVOS-USTED SUBIO UN ARCHIVO CON EXTENSION "+extFile,"warning");
    document.getElementById("archivo_editar").value="";
  }
});

</script>

