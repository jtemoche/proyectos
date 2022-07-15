<?php
    require '../../modelo/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $consulta = $MU->listar_combo_turno();
    echo json_encode($consulta);
   
?>
