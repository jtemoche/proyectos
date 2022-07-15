<script type="text/javascript" src="../js/actividad_nombre.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">CREAR ACTIVIDAD</h3>

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
                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Agregar actividad</button>
                </div>
            </div>
            <!--/.mostar titulos de la tabla usuario -->
            <table id="tabla_actividad_nombre" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Actividad</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Actividad</th>
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

            <h4 class="modal-title">Agregar actividad</h4>

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

         


           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="registrar_actividad_nombre()">Guardar actividad</button>

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

            <h4 class="modal-title">Agregar actividad</h4>

          </div>

          <div class="modal-body">



              <div class="box-body">
              <input type="text"  id="txtidactividad" hidden>
                <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="txtnombre_editar"name="nuevoNombre" placeholder="Ingresar nombre" required>

                </div>

                </div>
              </div>

         


           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="Modificar_Actividad_nombre()">Modificar actividad</button>

          </div>


          </div>




      </form>

      </div>

    </div>

  </div>

</form>


<script>
$(document).ready(function() {
    listar_actividad_nombre();
   

} );
$("#modalRegistro").on('shown.bs.modal',function(){
      $("#txt_nombre").focus();
    })
    


</script>
