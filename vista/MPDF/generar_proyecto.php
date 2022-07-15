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
      <h1>REPORTE DE PROYECTOS</h1>
    
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">#</th>
            <th class="desc">Proyecto</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>

          </tr>
        </thead>
        <tbody>';
        $consulta="SELECT

        proyecto.id_proyecto,
        proyecto.nombre_proyecto,
        proyecto.descripcion,
        proyecto.id_estado,
        proyecto.fecha_inicio,
        proyecto.fecha_fin,
        estado.estado
        FROM
        proyecto
        INNER JOIN estado ON proyecto.id_estado = estado.id_estado
        
        where proyecto.id_proyecto='".$_GET['id']."'";
        $resultado=$mysqli->query($consulta);
        while($row=$resultado->fetch_assoc()){

            $contador++;
        
            $html.='<tr>
            <td class="service">'.$contador.'</td>
            <td class="service">'.$row['nombre_proyecto'].'</td>
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