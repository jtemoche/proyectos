<?php
    require '../../modelo/modelo_actividad_nombre.php';
    $MU = new Modelo_Actividad_nombre();
    $consulta = $MU->listar_actividad_nombre();
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