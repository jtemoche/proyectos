<?php
       require '../../modelo/modelo_actividad_nombre.php';

       $MU = new Modelo_Actividad_nombre();
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');

       $consulta = $MU->registrar_actividad_nombre($NOM);
    echo $consulta;
       
?>