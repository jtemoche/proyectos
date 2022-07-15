<?php
    class Modelo_Usuario{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
    //verificar usuario//
        function VerificarUsuario($usuario,$contra){
            $sql = "call VERIFICAR_USUARIO('$usuario')";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					if(password_verify($contra, $consulta_VU["pass"]))
                    {
                        $arreglo[] = $consulta_VU;
                    }
				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
 //llamar al procedimiento almacenado//
        function listar_usuario(){
            $sql = "call LISTAR_USUARIO()";
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

				}
				return $arreglo;
				$this->conexion->cerrar();
			}
        }
       function listar_combo_rol(){
            $sql = "call LISTAR_PERFIL()";
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
            $sql = "call ESTADO_USUARIO()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function listar_combo_turno(){
            $sql = "call LISTAR_TURNO()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function listar_combo_depart(){
            $sql = "call LISTAR_DEPARTAMENTO()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        //modificar estado usuario//
        function modificar_estado_usuario($idusuario,$estado){
            $sql = "call MODIFICAR_ESTADO_USUARIO('$idusuario','$estado')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            }else{
               return 0;
            }
        }

        //Modificar datos del usuario//
        function Modificar_datos_usuario($IDUSUARIO,$NOM,$CONTRA,$PERF,$TURN,$DEPART){
            $sql = "call MODIFICAR_DATOS_USUARIO('$IDUSUARIO','$NOM','$CONTRA','$PERF','$TURN','$DEPART')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            }else{
               return 0;
            }
        }


        //Registrar usuario//
        function registrar_usuario($NOM,$USU,$CONTRA,$PERF,$ESTAD,$TURN,$DEPART,$ruta){
            $sql = "call REGISTRAR_USUARIOS('$NOM','$USU','$CONTRA','$PERF','$ESTAD','$TURN','$DEPART','$ruta')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                if ($row= mysqli_fetch_array($consulta)) {
                    
                       return $id=trim($row[0]);
                    
                }
    
                $this->conexion->cerrar();
            }
        }


          //Modificar imagen//
          function Editar_foto($IDUSUARIO,$ruta){
            $sql = "call MODIFICAR_DATOS_USUARIO_FOTO('$IDUSUARIO','$ruta')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            }else{
               return 0;
            }
        }

    }

?>