<script type="text/javascript" src="../js/usuario.js?rev=<?php echo time();?>"></script>
<div class="col-md-12">
    <div class="box box-warning box-solid">
        <div class="box-header with-border">
              <h3 class="box-title">ADMINISTRAR USUARIOS</h3>

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
                    <button class="btn btn-danger" style="width:100%" onclick="AbrirModalRegistro()"><i class="glyphicon glyphicon-plus"></i>Agregar usuario</button>
                </div>
            </div>
            <!--/.mostar titulos de la tabla usuario -->
            <table id="tabla_usuario" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Perfil</th>
                        <th>Turno</th>
                        <th>Departamento</th>
                        <th>Foto</th>
                        <th>Estado</th>
                        <th>Acci&oacute;n</th>
                        <th>Generar PDF</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Perfil</th>
                        <th>Turno</th>
                        <th>Departamento</th>
                        <th>Foto</th>
                        <th>Estado</th>
                        <th>Acci&oacute;n</th>
                        <th>Generar PDF</th>
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

            <h4 class="modal-title">Agregar usuario</h4>

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
                
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                  <input type="text" class="form-control input-lg" id="txt_usuario" name="nuevoUsuario" placeholder="Ingresar usuario" required>

                </div>

            </div>

            <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                  <input type="password" class="form-control input-lg" id="txt_contra" name="nuevoPassword" placeholder="Ingresar contraseña" required>

                </div>

            </div>

           <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoPerfil" id="cbo_tipo">
                    
                  </select>

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
                
                  <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span> 

                  <select class="form-control input-lg" name="nuevoTurno" id="cbo_turno">
                    
                  </select>

                </div>

          </div>

          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span> 

                  <select class="form-control input-lg" name="nuevodepart" id="cbo_depart">
                    
                  </select>

                </div>

           </div>

           <div class="col-lg-12">
              <label for="">Subir imagen</label>

              <input type="file" id="imagen" accept="image/*" >

            </div>



           <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="registrar_usuario()">Guardar usuario</button>

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

            <h4 class="modal-title">Editar Datos del  Usuario</h4>

          </div>

          <div class="modal-body">

              <div class="box-body">
                <input type="text"  id="txtidusuario" hidden>

                <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <input type="text" class="form-control input-lg" id="txtnombre_editar"name="nuevoNombre" placeholder="Ingresar nombre" required>

                </div>

                </div>
              </div>

             
             <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                  <input type="text" class="form-control input-lg" id="txtusuario_editar" name="nuevoUsuario" placeholder="Ingresar usuario" disabled required>

                </div>

            </div>

            <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                  <input type="password" class="form-control input-lg" id="txtcontra_editar" name="nuevoPassword" placeholder="Ingresar la nueva contraseña" required>

                </div>

            </div>

           <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                  <select class="form-control input-lg" name="nuevoPerfil" id="cbo_tipo_editar">
                    
                  </select>

                </div>

          </div>

          

          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span> 

                  <select class="form-control input-lg" name="nuevoTurno" id="cbo_turno_editar">
                    
                  </select>

                </div>

          </div>

          <div class="form-group">
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span> 

                  <select class="form-control input-lg" name="nuevodepart" id="cbo_depart_editar">
                    
                  </select>

                </div>

           </div>
           <div class="col-lg-12">
              <label for="">Subir imagen</label>

              <input type="file" id="imagen_editar" accept="image/*" >

              <div class="col-lg-2">
              <label for="">&nbsp;</label><br>
             <button class="btn btn-success" onclick="editar_foto()" >Actualizar</button>
            </div>
            
            </div>
            
          


           <div class="modal-footer"> 

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" onclick="Modificar_Usuario()">Modificar</button>

          </div>


          </div>




      </form>

      </div>

    </div>

  </div>

</form>
<script>
$(document).ready(function() {
    listar_usuario();
    listar_combo_rol();
    listar_combo_estado();
    listar_combo_turno();
    listar_combo_depart();

} );
$("#modalRegistro").on('shown.bs.modal',function(){
      $("#txt_nombre").focus();
    })
    /*validacion de la imagen*/
document.getElementById("imagen").addEventListener("change",()=>{
  var fileName=document.getElementById("imagen").value;
  var idxDot= fileName.lastIndexOf(".") + 1;
  var extFile=fileName.substr(idxDot,fileName.length).toLowerCase();
  if(extFile=="jpg" || extFile=="jpeg" || extFile=="png"){

  }else{
    Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN IMAGENES-USTED SUBIO UN ARCHIVO CON EXTENSION "+extFile,"warning");
    document.getElementById("imagen").value="";
  }
});

/*editar imagen*/
document.getElementById("imagen_editar").addEventListener("change",()=>{
  var fileName=document.getElementById("imagen_editar").value;
  var idxDot= fileName.lastIndexOf(".") + 1;
  var extFile=fileName.substr(idxDot,fileName.length).toLowerCase();
  if(extFile=="jpg" || extFile=="jpeg" || extFile=="png"){

  }else{
    Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN IMAGENES-USTED SUBIO UN ARCHIVO CON EXTENSION "+extFile,"warning");
    document.getElementById("imagen_editar").value="";
  }
});
</script>
