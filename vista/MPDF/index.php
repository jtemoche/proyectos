<?php

require_once __DIR__ . '/vendor/autoload.php';


$html='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo" >
        <img src="css/logo.png" style="width:100px">
      </div>
      <h1>REPORTE DE ACTIVIDADES</h1>
    
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">#</th>
            <th class="desc">Proyecto</th>
            <th>Actividad</th>
            <th>Archivo</th>
            <th>Entrega</th>
            <th>Usuario</th>

          </tr>
        </thead>
        <tbody>';
        $conexion=new mysqli("localhost","root","","controlactividades");
        $consulta="SELECT
        entrega.documento,
        nombre_actividad.nombre_actividad,
        entrega.fecha,
        usuarios.nombre,
        proyecto.nombre_proyecto
        FROM
        entrega
        INNER JOIN actividad ON entrega.id_actividad = actividad.id_actividad
        INNER JOIN nombre_actividad ON actividad.id_nombre_actividad = nombre_actividad.id_nombre_actividad
        INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
        INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto
        
        ";
        $resultado=$conexion->query($consulta);
        $contador=0;
        while($filas=$resultado ->fetch_assoc()){
          $contador++;
        
         $html.='<tr>
         <td class="service">'.$contador.'</td>
         <td class="service">'.$filas['documento'].'</td>
         <td class="service">'.$filas['nombre_actividad'].'</td>
         <td class="service">'.$filas['fecha'].'</td>
         <td class="service">'.$filas['nombre'].'</td>
         <td class="service">'.$filas['nombre_proyecto'].'</td>';
         
        }
        $html.=' </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>';
$mpdf = new \Mpdf\Mpdf();
$css=file_get_contents('css/style.css');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();