<?php
    require '../../modelo/modelo_actividad.php';
    $MU = new Modelo_Actividad();
    $consulta = $MU->listar_combo_usuario();
    echo json_encode($consulta);
   
?>