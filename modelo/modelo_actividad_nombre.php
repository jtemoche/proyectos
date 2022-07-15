<?php
    class Modelo_Actividad_nombre{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
    
 //llamar al procedimiento almacenado//
        function listar_actividad_nombre(){
            $sql = "call LISTAR_ACTIVIDAD_NOMBRE()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
       
       


        //Modificar datos de la actividad//
        function Modificar_datos_actividad_nombre($IDACTIVIDAD,$NOM){
            $sql = "call MODIFICAR_DATOS_ACTIVIDAD_NOMBRE('$IDACTIVIDAD','$NOM')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
          
                return 1;
            }else{
               return 0;
            }
        }
    
     //Registrar actividad//
     function registrar_actividad_nombre($NOM){
        $sql = "call REGISTRAR_ACTIVIDAD_NOMBRE('$NOM')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
          
            return 1;
        }else{
           return 0;
        }
        
    }
        
        

    }

?>