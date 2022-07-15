<?php
       require '../../modelo/modelo_actividad.php';

       $MU = new Modelo_Actividad();
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
       $ESTAD = htmlspecialchars($_POST['ESTAD'],ENT_QUOTES,'UTF-8');
       $FINICIO = htmlspecialchars($_POST['FINICIO'],ENT_QUOTES,'UTF-8');
       $FFIN = htmlspecialchars($_POST['FFIN'],ENT_QUOTES,'UTF-8');
       $PROY = htmlspecialchars($_POST['PROY'],ENT_QUOTES,'UTF-8');
       $USUARIO = htmlspecialchars($_POST['USUARIO'],ENT_QUOTES,'UTF-8');
       $nombrearchivo=htmlspecialchars($_POST['nombrearchivo'],ENT_QUOTES,'UTF-8');
       if(is_array($_FILES) && count($_FILES)>0){
           if(move_uploaded_file($_FILES['documento']['tmp_name'],"archivos/".$nombrearchivo)){
           $ARCHI='controlador/actividad/archivos/'.$nombrearchivo;
           $consulta = $MU->registrar_actividad($NOM,$ARCHI,$ESTAD,$FINICIO,$FFIN,$PROY,$USUARIO);
            echo $consulta;
       }else{
           echo 0;
       }
   
       }else{
           $ARCHI='controlador/actividad/archivos/suba.docx';
           $consulta = $MU->registrar_actividad($NOM,$ARCHI,$ESTAD,$FINICIO,$FFIN,$PROY,$USUARIO);
           echo $consulta;
       }
       
?>