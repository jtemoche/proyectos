<script type="text/javascript" src="../js/empleado.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">ADMINISTRAR EMPLEADOS</h3>

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
                    
                </div>
                <div class="col-lg-2">
                    
                </div>
            </div>
            <!--/.mostar titulos de la tabla usuario -->
            <table id="tabla_empleado" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Turno</th>
                        <th>Departamento</th>
                        <th>Foto</th>
                        
                       
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Turno</th>
                        <th>Departamento</th>
                        <th>Foto</th>
                        
                        
                    </tr>
                </tfoot>
            </table>
            </div>
            <!-- /.box-body -->
    </div>
          <!-- /.box -->
 </div>


<script>
$(document).ready(function() {
    listar_empleado();
    

} );




</script>
