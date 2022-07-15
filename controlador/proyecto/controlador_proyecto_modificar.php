<?php
    require '../../modelo/modelo_proyecto.php';
    $MU = new Modelo_Proyecto();
       $IDPROYECTO= htmlspecialchars($_POST['IDPROYECTO'],ENT_QUOTES,'UTF-8');
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
       $FINICIO = htmlspecialchars($_POST['FINICIO'],ENT_QUOTES,'UTF-8');
       $FFIN = htmlspecialchars($_POST['FFIN'],ENT_QUOTES,'UTF-8');
       
       
        $ruta='controlador/proyecto/archivos/suba.docx';
        $consulta=$MU->Modificar_datos_proyecto($IDPROYECTO,$NOM,$FINICIO,$FFIN);
        echo $consulta;
       
   
?>