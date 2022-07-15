<?php
       require '../../modelo/modelo_proyecto.php';

       $MU = new Modelo_Proyecto();
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
       $ESTAD = htmlspecialchars($_POST['ESTAD'],ENT_QUOTES,'UTF-8');
       $FINICIO = htmlspecialchars($_POST['FINICIO'],ENT_QUOTES,'UTF-8');
       $FFIN = htmlspecialchars($_POST['FFIN'],ENT_QUOTES,'UTF-8');
       $nombrearchivo=htmlspecialchars($_POST['nombrearchivo'],ENT_QUOTES,'UTF-8');
       if(is_array($_FILES) && count($_FILES)>0){
           if(move_uploaded_file($_FILES['descripcion']['tmp_name'],"archivos/".$nombrearchivo)){
           $ARCHI='controlador/proyecto/archivos/'.$nombrearchivo;
           $consulta = $MU->registrar_proyecto($NOM,$ARCHI,$ESTAD,$FINICIO,$FFIN);
            echo $consulta;
       }else{
           echo 0;
       }
   
       }else{
           $ARCHI='controlador/proyecto/archivos/suba.docx';
           $consulta = $MU->registrar_proyecto($NOM,$ARCHI,$ESTAD,$FINICIO,$FFIN);
           echo $consulta;
       }
       
?>