<?php
       require '../../modelo/modelo_usuario.php';

       $MU = new Modelo_Usuario();
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
       $USU = htmlspecialchars($_POST['USU'],ENT_QUOTES,'UTF-8');
       $CONTRA = password_hash($_POST['CONTRA'],PASSWORD_DEFAULT,['cost'=>10]);
       $PERF = htmlspecialchars($_POST['PERF'],ENT_QUOTES,'UTF-8');
       $ESTAD = htmlspecialchars($_POST['ESTAD'],ENT_QUOTES,'UTF-8');
       $TURN = htmlspecialchars($_POST['TURN'],ENT_QUOTES,'UTF-8');
       $DEPART = htmlspecialchars($_POST['DEPART'],ENT_QUOTES,'UTF-8');
       $nombrearchivo=htmlspecialchars($_POST['nombrearchivo'],ENT_QUOTES,'UTF-8');
       if(is_array($_FILES) && count($_FILES)>0){
           if(move_uploaded_file($_FILES['FOTO']['tmp_name'],"imagenes/".$nombrearchivo)){
           $ruta='controlador/usuario/imagenes/'.$nombrearchivo;
           $consulta = $MU->registrar_usuario($NOM,$USU,$CONTRA,$PERF,$ESTAD,$TURN,$DEPART,$ruta);
            echo $consulta;
       }else{
           echo 0;
       }
   
       }else{
           $ruta='controlador/usuario/imagenes/user-default.png';
           $consulta=$MU->registrar_usuario($NOM,$USU,$CONTRA,$PERF,$ESTAD,$TURN,$DEPART,$ruta);
           echo $consulta;
       }
       
?>