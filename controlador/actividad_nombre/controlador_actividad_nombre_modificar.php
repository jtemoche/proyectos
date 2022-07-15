<?php
    require '../../modelo/modelo_actividad_nombre.php';

    $MU = new Modelo_Actividad_nombre();
    $IDACTIVIDAD = htmlspecialchars($_POST['IDACTIVIDAD'],ENT_QUOTES,'UTF-8');
    $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
    
    $consulta = $MU->Modificar_datos_actividad_nombre($IDACTIVIDAD,$NOM);
    echo $consulta;
   
?>