<?php
    require '../../modelo/modelo_actividad.php';
    $MU = new Modelo_Actividad();
    $idactividad = htmlspecialchars($_POST['idactividad'],ENT_QUOTES,'UTF-8');
    $num = htmlspecialchars($_POST['num'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Descargar_Avance($idactividad,$num);
    echo json_encode($consulta);
   
?>