<?php
    require '../../modelo/modelo_usuario.php';

    /*$MU = new Modelo_Usuario();
    $IDUSUARIO = htmlspecialchars($_POST['IDUSUARIO'],ENT_QUOTES,'UTF-8');
    $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
    $CONTRA = password_hash($_POST['CONTRA'],PASSWORD_DEFAULT,['cost'=>10]);
    $PERF = htmlspecialchars($_POST['PERF'],ENT_QUOTES,'UTF-8');
    $TURN = htmlspecialchars($_POST['TURN'],ENT_QUOTES,'UTF-8');
    $DEPART = htmlspecialchars($_POST['DEPART'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_datos_usuario($IDUSUARIO,$NOM,$CONTRA,$PERF,$TURN,$DEPART);
    echo $consulta;*/
    $MU = new Modelo_Usuario();
       $IDUSUARIO= htmlspecialchars($_POST['IDUSUARIO'],ENT_QUOTES,'UTF-8');
       $NOM = htmlspecialchars($_POST['NOM'],ENT_QUOTES,'UTF-8');
       $CONTRA = password_hash($_POST['CONTRA'],PASSWORD_DEFAULT,['cost'=>10]);
       $PERF = htmlspecialchars($_POST['PERF'],ENT_QUOTES,'UTF-8');
       $TURN = htmlspecialchars($_POST['TURN'],ENT_QUOTES,'UTF-8');
       $DEPART = htmlspecialchars($_POST['DEPART'],ENT_QUOTES,'UTF-8');
       
       
        $ruta='controlador/usuario/imagenes/user-default.png';
        $consulta=$MU->Modificar_datos_usuario($IDUSUARIO,$NOM,$CONTRA,$PERF,$TURN,$DEPART);
        echo $consulta;
       
   
?>