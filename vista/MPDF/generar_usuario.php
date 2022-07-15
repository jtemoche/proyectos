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
      <h1>REPORTE DE USUARIOS</h1>
    
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">#</th>
            <th class="desc">Nombre</th>
            <th>Usuario</th>
            <th>Perfil</th>
            <th>Turno</th>
            <th>Departamento</th>
       
            <th>Estado</th>

          </tr>
        </thead>
        <tbody>';
        $consulta="SELECT
        usuarios.id_usuarios,
        usuarios.nombre,
        usuarios.usuario,
        usuarios.FOTO,
        tipo_usuario.perfil,
        turno.descripcion,
        estado.estado,
        departamento.departamento,
        turno.id_turno
        FROM
        usuarios
        INNER JOIN tipo_usuario ON usuarios.id_perfil = tipo_usuario.id_tipo_usuario
        INNER JOIN turno ON usuarios.id_turno = turno.id_turno
        INNER JOIN estado ON usuarios.id_estado = estado.id_estado
        INNER JOIN departamento ON usuarios.id_departamento = departamento.id_departamento        
        where usuarios.id_usuarios='".$_GET['id']."'";
        $resultado=$mysqli->query($consulta);
        while($row=$resultado->fetch_assoc()){

            $contador++;
        
            $html.='<tr>
            <td class="service">'.$contador.'</td>
            <td class="service">'.$row['nombre'].'</td>
            <td class="service">'.$row['usuario'].'</td>
            <td class="service">'.$row['perfil'].'</td>
            <td class="service">'.$row['id_turno'].'</td>
            <td class="service">'.$row['departamento'].'</td>
            
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