<?php
    require '../../modelo/modelo_empleado.php';
    $MU = new Modelo_Empleado();
    $consulta = $MU->listar_empleado();
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