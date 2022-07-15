<?php
    require '../../modelo/modelo_actividad.php';
    $MU = new Modelo_Actividad();
       $IDACTIVIDAD= htmlspecialchars($_POST['IDACTIVIDAD'],ENT_QUOTES,'UTF-8');
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
       $FINICIO = htmlspecialchars($_POST['FINICIO'],ENT_QUOTES,'UTF-8');
       $FFIN = htmlspecialchars($_POST['FFIN'],ENT_QUOTES,'UTF-8');
       $PROY= htmlspecialchars($_POST['PROY'],ENT_QUOTES,'UTF-8');
       $USUARIO=htmlspecialchars($_POST['USUARIO'],ENT_QUOTES,'UTF-8');
        $ruta='controlador/actividad/archivos/suba.docx';
        $consulta=$MU->Modificar_datos_actividad($IDACTIVIDAD,$NOM,$FINICIO,$FFIN,$PROY,$USUARIO);
        echo $consulta;
       
   
?>