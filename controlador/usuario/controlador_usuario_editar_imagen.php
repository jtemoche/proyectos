<?php
       require '../../modelo/modelo_usuario.php';

       $MU = new Modelo_Usuario();
       $IDUSUARIO= htmlspecialchars($_POST['IDUSUARIO'],ENT_QUOTES,'UTF-8');
       $nombrearchivo=htmlspecialchars($_POST['nombrearchivo'],ENT_QUOTES,'UTF-8');
       if(is_array($_FILES) && count($_FILES)>0){
           if(move_uploaded_file($_FILES['FOTO']['tmp_name'],"imagenes/".$nombrearchivo)){
           $ruta='controlador/usuario/imagenes/'.$nombrearchivo;
           $consulta = $MU->Editar_foto($IDUSUARIO,$ruta);
            echo $consulta;
       }else{
           echo 0;
       }
   
       }else{
           echo0;
       }
       
?>