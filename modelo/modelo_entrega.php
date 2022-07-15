<?php
    class Modelo_Entrega{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }
   
 //llamar al procedimiento almacenado//
        function listar_entrega(){
            $sql = "call LISTAR_PROYECTO()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;

                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
       
        function listar_combo_estado(){
            $sql = "call ESTADO_PROYECTO()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    
                        $arreglo[] = $consulta_VU;
                    
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }


         //modificar estado del proyecto//
        function modificar_estado_proyecto($idproyecto,$estado){
            $sql = "call MODIFICAR_ESTADO_PROYECTO('$idproyecto','$estado')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                //$id_retornado = mysqli_insert_ind($this->conexion->conexion);
                return 1;
            }else{
               return 0;
            }
        }
          //Modificar datos del proyecto//
          function Modificar_datos_proyecto($IDPROYECTO,$NOM,$FINICIO,$FFIN){
            $sql = "call MODIFICAR_DATOS_PROYECTO('$IDPROYECTO','$NOM','$FINICIO','$FFIN')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
          
                return 1;
            }else{
               return 0;
            }
        }

           //Registrar proyecto//
           function registrar_proyecto($NOM,$ARCHI,$ESTAD,$FINICIO,$FFIN){
            $sql = "call REGISTRAR_PROYECTO('$NOM','$ARCHI','$ESTAD','$FINICIO','$FFIN')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                if ($row= mysqli_fetch_array($consulta)) {
                    
                       return $id=trim($row[0]);
                    
                }
    
                $this->conexion->cerrar();
            }
        }
       //Modificar archivo//
       function Editar_archivo($IDPROYECTO,$ARCHI){
        $sql = "call MODIFICAR_DATOS_PROYECTO_ARCHIVO('$IDPROYECTO','$ARCHI')";
        if ($consulta = $this->conexion->conexion->query($sql)) {
            return 1;
        }else{
           return 0;
        }
    }
        


     

    }

?>