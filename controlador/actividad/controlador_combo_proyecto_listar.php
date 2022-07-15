<?php
    require '../../modelo/modelo_actividad.php';
    $MU = new Modelo_Actividad();
    $consulta = $MU->listar_combo_proyecto();
    echo json_encode($consulta);
   
?>