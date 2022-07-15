<?php
    class Modelo_Actividad{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
    
 //llamar al procedimiento almacenado//
        function listar_actividad(){
            $sql = "call LISTAR_ACTIVIDAD()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
         //listar actividad del proyecto.....//
        function listar_actividad_proyecto($id){
            $sql = "call LISTAR_ACTIVIDAD_PROYECTO('$id')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

        //listar entrega del proyecto.....//
        function listar_actividad_entrega($id){
            $sql = "call LISTAR_ENTREGA_ACTIVIDAD('$id')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
        

        function listar_actividad_usuario($id){
            $sql = "call LISTAR_ACTIVIDAD_USUARIO('$id')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }

        function listar_combo_actividad(){
            $sql = "call LISTAR_NOMBRE_ACTIVIDAD()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function listar_combo_estado(){
            $sql = "call LISTAR_ESTADO_ACTIVIDAD()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function listar_combo_proyecto(){
            $sql = "call NOMBRE_PROYECTOS()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function listar_combo_usuario(){
            $sql = "call NOMBRE_USUARIOS()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        //modificar estado actividad//
        function modificar_estado_actividad($idactividad,$estado){
            $sql = "call MODIFICAR_ESTADO_ACTIVIDAD('$idactividad','$estado')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            }else{
               return 0;
            }
        }

        //Modificar datos de la actividad//
        function Modificar_datos_actividad($IDACTIVIDAD,$NOM,$FINICIO,$FFIN,$PROY,$USUARIO){
            $sql = "call MODIFICAR_DATOS_ACTIVIDAD('$IDACTIVIDAD','$NOM','$FINICIO','$FFIN','$PROY','$USUARIO')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
          
                return 1;
            }else{
               return 0;
            }
        }
     //Registrar actividad//
     function registrar_actividad($NOM,$ARCHI,$ESTAD,$FINICIO,$FFIN,$PROY,$USUARIO){
        $sql = "call REGISTRAR_ACTIVIDAD('$NOM','$ARCHI','$ESTAD','$FINICIO','$FFIN','$PROY','$USUARIO')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
            return 1;
        }else{
           return 0;
        }
    }

        //Modificar archivo//
       function Editar_archivo($IDACTIVIDAD,$ARCHI){
        $sql = "call MODIFICAR_DATOS_ACTIVIDAD_ARCHIVO('$IDACTIVIDAD','$ARCHI')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        }else{
           return 0;
        }
    }
        
        //subir archivo//
        function Subir_Avance($idactividad,$archi){
            $sql = "call REGISTRAR_AVANCE_ACTIVIDAD('$idactividad','$archi')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                return 1;
            }else{
               return 0;
            }
        }
       //descargar rchivo//
        function Descargar_Avance($idactividad,$num){
            $sql = "call DESCARGAR_AVANCE('$idactividad','$num')";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
    }

?>