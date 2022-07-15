<?php
    require '../../modelo/modelo_proyecto.php';
    $MU = new Modelo_Proyecto();
    $consulta = $MU->listar_proyecto();
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
