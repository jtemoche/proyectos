<script type="text/javascript" src="../js/actividad.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">ADMINISTRAR ACTIVIDAD</h3>

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
                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Agregar Actividad</button>
                </div>
            </div>
            <!--/.mostar titulos de la tabla actividad -->
            <table id="tabla_actividad" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Actividad</th>
                        <th>Archivo</th>
                        <th>Usuario</th>
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
                        <th>Actividad</th>
                        <th>Archivo</th>
                        <th>Usuario</th>
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

            <h4 class="modal-title">Agregar Actividad</h4>

          </div>

          <div class="modal-body">



              <div class="box-body">
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-book"></i></span> 

                  <select class="form-control input-lg" name="nuevoactividad" id="cbo_actividad">
                    
                  </select>

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
          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-list"></i></span> 

                  <select class="form-control input-lg" name="nuevoEstado" id="cbo_proyecto">
                    
                  </select>

                </div>

          </div>
          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoEstado" id="cbo_usuario">
                    
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

            <button type="submit" class="btn btn-primary" onclick="registrar_actividad()">Guardar Actividad</button>

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

            <h4 class="modal-title">Editar Datos de la Actividad</h4>

          </div>

          <div class="modal-body">

              <div class="box-body">
              <input type="text" id="txtidactividad" hidden>
              <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoactividad" id="cboactividad_editar">
                    
                  </select>

                </div>

              </div>
                
              </div>


          
          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoEstado" id="cboproyecto_editar">
                    
                  </select>

                </div>

          </div>
          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoEstado" id="cbousuario_editar">
                    
                  </select>

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

            <button type="submit" class="btn btn-primary" onclick="Modificar_Actividad()">Guardar Actividad</button>

          </div>


          </div>




      </form>

      </div>

    </div>

  </div>

</form>






<script>
$(document).ready(function() {
    listar_actividad();
    listar_combo_actividad();
    listar_combo_estado();
    listar_combo_proyecto();
    listar_combo_usuario();
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
});

</script>
