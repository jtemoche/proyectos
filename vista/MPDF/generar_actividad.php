<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../../Login/index.php');
}

?>
<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once '../conexion_reportes/r_conexion.php';

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
        <img src="css/logo.png" style="width:200px">
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
            <th>Usuario</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>

          </tr>
        </thead>
        <tbody>';
        $consulta="SELECT
        estado_actividad.estado,
        proyecto.nombre_proyecto,
        usuarios.nombre,
        nombre_actividad.nombre_actividad,
        actividad.id_actividad,
        actividad.fecha_inicio,
        actividad.fecha_fin,
        actividad.documento
        FROM
        actividad
        INNER JOIN estado_actividad ON actividad.id_estado_actividad = estado_actividad.id_estado_actividad
        INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto
        INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
        INNER JOIN nombre_actividad ON actividad.id_nombre_actividad=nombre_actividad.id_nombre_actividad
        where actividad.id_actividad='".$_GET['id']."'";
        $resultado=$mysqli->query($consulta);
        while($row=$resultado->fetch_assoc()){

            $contador++;
        
            $html.='<tr>
            <td class="service">'.$contador.'</td>
            <td class="service">'.$row['nombre_proyecto'].'</td>
            <td class="service">'.$row['nombre_actividad'].'</td>
            <td class="service">'.$row['nombre'].'</td>
            <td class="service">'.$row['fecha_inicio'].'</td>
            <td class="service">'.$row['fecha_fin'].'</td>
            <td class="service">'.$row['estado'].'</td>';
            
           }
           $html.=' </tr>
           </tbody>
         </table>
        
       </main>
       <footer>
         Invoice was created on a computer and is valid without the signature and seal.
       </footer>
     </body>
   </html>';


        $mpdf = new \Mpdf\Mpdf(['mode'=> 'utf-8','format'=>'A4']);
        $css=file_get_contents('css/style.css');
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output();





?>