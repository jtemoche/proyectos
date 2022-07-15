<?php
    require '../../modelo/modelo_proyecto.php';
    $MU = new Modelo_Proyecto();
    $consulta = $MU->listar_combo_estado();
    echo json_encode($consulta);
   
?>