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
                <div class="col-lg-12">
                    <div class="input-group">
                        <input type="text" class="global_filter form-control" id="global_filter" placeholder=" buscar">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <!--/.mostar titulos de la tabla actividad -->
            <table id="tabla_actividad" class="display responsive compact" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Actividad</th>
                        <th>Archivo</th>
                        <th>Usuario</th>
                        <th>Inicio</th>
                        <th>Entrega</th>
                        <th>Porcentaje</th>
                        <th>Avances</th>
                        <th>Estado</th>
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
                        <th>Porcentaje</th>
                        <th>Avances</th>
                        <th>Estado</th>
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
  <div id="modalSubir" class="modal fade" role="dialog">

    <div class="modal-dialog ">
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
          
          <div class="modal-header" style="background:#3c8dbc; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Subir archivo de avance</h4>

          </div>

          <div class="modal-body">
           
           <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Mensaje de Advertencia!</h4>
                Solo se podra subir 2 avances a tus actividades, revisar bien el archivo antes de subir.
            </div>
           </div>
           <div class="col-lg-12">
              <input type="text" id="txtidactividad" hidden>
              <label for="">Subir Archivo</label>

              <input type="file" id="archivo" accept="file/*" >
            <br><br>
            </div>
          </div>

            

           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="Subir_Avance()">Guardar Avance</button>

          </div>


          </div>




      </form>

      </div>

    </div>

  </div>

</form>

<script>
$(document).ready(function() {
    listar_actividad_usuario();

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
