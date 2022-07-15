<?php
    require '../../modelo/modelo_actividad.php';
    $MU = new Modelo_Actividad();
    $consulta = $MU->listar_actividad();
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

?>