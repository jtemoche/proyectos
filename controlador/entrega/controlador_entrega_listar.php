<?php
    require '../../modelo/modelo_entrega.php';
    $MU = new Modelo_Entrega();
    $consulta = $MU->listar_entrega();
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
