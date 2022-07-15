<?php
    require '../../modelo/modelo_proyecto.php';

    $MU = new Modelo_Proyecto();
    $idproyecto = htmlspecialchars($_POST['idproyecto'],ENT_QUOTES,'UTF-8');
    $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');
    
    
    $consulta = $MU->modificar_estado_proyecto($idproyecto,$estado);
    echo $consulta;
   
?>