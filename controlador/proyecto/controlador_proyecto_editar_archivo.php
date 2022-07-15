<?php
       require '../../modelo/modelo_proyecto.php';

       $MU = new Modelo_Proyecto();
       $IDPROYECTO= htmlspecialchars($_POST['IDPROYECTO'],ENT_QUOTES,'UTF-8');
       $nombrearchivo=htmlspecialchars($_POST['nombrearchivo'],ENT_QUOTES,'UTF-8');
       if(is_array($_FILES) && count($_FILES)>0){
           if(move_uploaded_file($_FILES['ARCHI']['tmp_name'],"archivos/".$nombrearchivo)){
           $ARCHI='controlador/proyecto/archivos/'.$nombrearchivo;
           $consulta = $MU->Editar_archivo($IDPROYECTO,$ARCHI);
            echo $consulta;
       }else{
           echo 0;
       }
   
       }else{
           echo0;
       }
       
?>