<?php
       require '../../modelo/modelo_actividad.php';

       $MU = new Modelo_Actividad();
       $idactividad= htmlspecialchars($_POST['idactividad'],ENT_QUOTES,'UTF-8');
       $nombrearchivo=htmlspecialchars($_POST['nombrearchivo'],ENT_QUOTES,'UTF-8');
       if(is_array($_FILES) && count($_FILES)>0){
           if(move_uploaded_file($_FILES['archi']['tmp_name'],"avance/".$nombrearchivo)){
           $archi='controlador/actividad/avance/'.$nombrearchivo;
           $consulta = $MU->Subir_Avance($idactividad,$archi);
            echo $consulta;
       }else{
           echo 0;
       }
   
       }else{
           echo0;
       }
       
?>