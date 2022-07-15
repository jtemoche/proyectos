<?php

$mysqli=new mysqli("localhost","root","","controlactividades");

if($mysqli ->connect_error){
    die('error de conexion('. $mysqli->connect_errno .')'.$mysqli->connect_error);
}

if(mysqli_connect_error()){
    die('error de conexion('. mysqli_connect_errno() .')'.mysqli_connect_error());
}


?>