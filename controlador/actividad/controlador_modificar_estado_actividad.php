<?php
    require '../../modelo/modelo_actividad.php';

    $MU = new Modelo_Actividad();
    $idactividad = htmlspecialchars($_POST['idactividad'],ENT_QUOTES,'UTF-8');
    $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
    
    
    $consulta = $MU->modificar_estado_actividad($idactividad,$estado);
    echo $consulta;
   
?>