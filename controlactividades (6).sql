-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2021 a las 06:02:17
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlactividades`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DESCARGAR_AVANCE` (IN `IDACTIVIDAD` INT, IN `NUM` INT)  SELECT documento from entrega where id_actividad=IDACTIVIDAD AND numeroavance=NUM$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ESTADO_PROYECTO` ()  SELECT *FROM estado LIMIT 2,3$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ESTADO_USUARIO` ()  SELECT *FROM estado LIMIT 0,2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ACTIVIDAD` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
actividad.id_actividad,
actividad.id_nombre_actividad,
actividad.documento,
actividad.id_estado_actividad,
actividad.fecha_inicio,
actividad.fecha_fin,
actividad.id_proyecto,
actividad.id_usuario,
estado_actividad.estado,
proyecto.nombre_proyecto,
usuarios.nombre,
nombre_actividad.nombre_actividad
FROM
actividad
INNER JOIN estado_actividad ON actividad.id_estado_actividad = estado_actividad.id_estado_actividad
INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto
INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
INNER JOIN nombre_actividad ON actividad.id_nombre_actividad=nombre_actividad.id_nombre_actividad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ACTIVIDAD_NOMBRE` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
nombre_actividad.id_nombre_actividad,
nombre_actividad.nombre_actividad
FROM
nombre_actividad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ACTIVIDAD_PROYECTO` (IN `ID` INT)  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
actividad.id_actividad,
actividad.id_nombre_actividad,
actividad.documento,
actividad.id_estado_actividad,
actividad.fecha_inicio,
actividad.fecha_fin,
actividad.id_proyecto,
actividad.id_usuario,
estado_actividad.estado,
proyecto.nombre_proyecto,
usuarios.nombre,
nombre_actividad.nombre_actividad
FROM
actividad
INNER JOIN estado_actividad ON actividad.id_estado_actividad = estado_actividad.id_estado_actividad
INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto
INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
INNER JOIN nombre_actividad ON actividad.id_nombre_actividad=nombre_actividad.id_nombre_actividad
WHERE proyecto.id_proyecto=ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ACTIVIDAD_USUARIO` (IN `ID` INT)  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
actividad.id_actividad,
actividad.id_nombre_actividad,
actividad.documento,
actividad.id_estado_actividad,
actividad.fecha_inicio,
actividad.fecha_fin,
actividad.id_proyecto,
actividad.id_usuario,
estado_actividad.estado,
proyecto.nombre_proyecto,
usuarios.nombre,
nombre_actividad.nombre_actividad,
(SELECT COUNT(*) FROM entrega where entrega.id_actividad=actividad.id_actividad) as porcentaje
FROM
actividad
INNER JOIN estado_actividad ON actividad.id_estado_actividad = estado_actividad.id_estado_actividad
INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto
INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
INNER JOIN nombre_actividad ON actividad.id_nombre_actividad=nombre_actividad.id_nombre_actividad
where actividad.id_usuario=ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_DEPARTAMENTO` ()  SELECT
departamento.id_departamento,
departamento.departamento
FROM
departamento$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ENTREGA` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
nombre_actividad.nombre_actividad,
actividad.id_nombre_actividad,
entrega.numeroavance,
entrega.id_actividad,
entrega.fecha,
entrega.documento,
entrega.id_entrega,
usuarios.usuario,
proyecto.nombre_proyecto
FROM
nombre_actividad
INNER JOIN actividad ON actividad.id_nombre_actividad = nombre_actividad.id_nombre_actividad
INNER JOIN entrega ON entrega.id_actividad = actividad.id_actividad
INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ENTREGA_ACTIVIDAD` (IN `ID` INT)  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
actividad.id_actividad,
actividad.id_nombre_actividad,
actividad.id_estado_actividad,
actividad.fecha_inicio,
actividad.fecha_fin,
actividad.id_proyecto,
actividad.id_usuario,
estado_actividad.estado,
proyecto.nombre_proyecto,
usuarios.nombre,
nombre_actividad.nombre_actividad,
entrega.documento,
entrega.fecha,
entrega.numeroavance
FROM
actividad
INNER JOIN estado_actividad ON actividad.id_estado_actividad = estado_actividad.id_estado_actividad
INNER JOIN proyecto ON actividad.id_proyecto = proyecto.id_proyecto
INNER JOIN usuarios ON actividad.id_usuario = usuarios.id_usuarios
INNER JOIN nombre_actividad ON actividad.id_nombre_actividad = nombre_actividad.id_nombre_actividad
INNER JOIN entrega ON entrega.id_actividad = actividad.id_actividad
WHERE proyecto.id_proyecto=ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ESTADO` ()  SELECT
estado.id_estado,
estado.estado
FROM
estado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_ESTADO_ACTIVIDAD` ()  SELECT
estado_actividad.id_estado_actividad,
estado_actividad.estado
FROM
estado_actividad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_NOMBRE_ACTIVIDAD` ()  SELECT
nombre_actividad.id_nombre_actividad,
nombre_actividad.nombre_actividad
FROM
nombre_actividad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_PERFIL` ()  SELECT
tipo_usuario.id_tipo_usuario,
tipo_usuario.perfil
FROM
tipo_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_PROYECTO` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
proyecto.id_proyecto,
proyecto.nombre_proyecto,
proyecto.descripcion,
proyecto.id_estado,
proyecto.fecha_inicio,
proyecto.fecha_fin,
estado.estado
FROM
proyecto
INNER JOIN estado ON proyecto.id_estado = estado.id_estado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_TURNO` ()  SELECT
turno.id_turno,
turno.descripcion
FROM
turno$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `LISTAR_USUARIO` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
usuarios.id_usuarios,
usuarios.nombre,
usuarios.usuario,
usuarios.id_perfil,
usuarios.id_estado,
usuarios.id_turno,
usuarios.id_departamento,
usuarios.FOTO,
tipo_usuario.perfil,
turno.descripcion,
estado.estado,
departamento.departamento
FROM
usuarios
INNER JOIN tipo_usuario ON usuarios.id_perfil = tipo_usuario.id_tipo_usuario
INNER JOIN turno ON usuarios.id_turno = turno.id_turno
INNER JOIN estado ON usuarios.id_estado = estado.id_estado
INNER JOIN departamento ON usuarios.id_departamento = departamento.id_departamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_ACTIVIDAD` (IN `IDACTIVIDAD` INT, IN `NOMBRE` INT, IN `FINICIO` DATETIME, IN `FFIN` DATETIME, IN `PROY` INT, `USUARIO` INT)  UPDATE actividad SET
id_nombre_actividad=NOMBRE,
fecha_inicio=FINICIO,
fecha_fin=FFIN,
id_proyecto=PROY,
id_usuario=USUARIO
WHERE id_actividad=IDACTIVIDAD$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_ACTIVIDAD_ARCHIVO` (IN `IDACTIVIDAD` INT, IN `ARCHI` VARCHAR(250))  BEGIN
UPDATE actividad SET
documento=ARCHI
WHERE id_actividad=IDACTIVIDAD;
SELECT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_ACTIVIDAD_NOMBRE` (IN `IDACTIVIDAD` INT, IN `NOMBRE` TEXT)  UPDATE nombre_actividad SET
nombre_actividad=NOMBRE

WHERE id_nombre_actividad=IDACTIVIDAD$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_PROYECTO` (IN `IDPROYECTO` INT, IN `NOMBRE` TEXT, IN `FINICIO` DATETIME, IN `FFIN` DATETIME)  UPDATE proyecto SET
nombre_proyecto=NOMBRE,
fecha_inicio=FINICIO,
fecha_fin=FFIN
WHERE id_proyecto=IDPROYECTO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_PROYECTO_ARCHIVO` (IN `IDPROYECTO` INT, IN `ARCHI` VARCHAR(250))  BEGIN
UPDATE proyecto SET
descripcion=ARCHI
WHERE id_proyecto=IDPROYECTO;
SELECT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_USUARIO` (IN `IDUSUARIO` INT, IN `NOMBRE` TEXT, IN `PASSW` TEXT, IN `IDPERF` INT, IN `IDTURN` INT, IN `IDDEPART` INT)  UPDATE usuarios SET
nombre=NOMBRE,
pass=PASSW,
id_perfil=IDPERF,
id_turno=IDTURN,
id_departamento=IDDEPART
WHERE id_usuarios=IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_DATOS_USUARIO_FOTO` (IN `IDUSUARIO` INT, IN `FOTO` VARCHAR(250))  BEGIN
UPDATE usuarios SET
FOTO=FOTO
WHERE id_usuarios=IDUSUARIO;
SELECT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_ESTADO_ACTIVIDAD` (IN `IDACTIVIDAD` INT, IN `ESTATUS` VARCHAR(20))  UPDATE actividad SET
id_estado_actividad=ESTATUS
WHERE id_nombre_actividad=IDACTIVIDAD$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_ESTADO_PROYECTO` (IN `IDPROYECTO` INT, IN `ESTATUS` VARCHAR(20))  UPDATE proyecto SET
id_estado=ESTATUS
WHERE id_proyecto=IDPROYECTO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `MODIFICAR_ESTADO_USUARIO` (IN `IDUSUARIO` INT, IN `ESTATUS` VARCHAR(20))  UPDATE usuarios SET
id_estado=ESTATUS
WHERE id_usuarios=IDUSUARIO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NOMBRE_PROYECTOS` ()  SELECT
proyecto.id_proyecto,
proyecto.nombre_proyecto
FROM
proyecto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NOMBRE_USUARIOS` ()  SELECT
usuarios.id_usuarios,
usuarios.nombre
FROM
usuarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PERSONAL` ()  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=0;
SELECT
@CANTIDAD:=@CANTIDAD+1 AS posicion,
usuarios.id_usuarios,
usuarios.nombre,
usuarios.id_turno,
usuarios.id_departamento,
usuarios.FOTO,
turno.descripcion,
departamento.departamento
FROM
usuarios
INNER JOIN turno ON usuarios.id_turno = turno.id_turno
INNER JOIN departamento ON usuarios.id_departamento = departamento.id_departamento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRAR_ACTIVIDAD` (IN `NOM` INT, IN `ARCHI` TEXT, IN `ESTAD` INT, IN `FINICIO` DATETIME, IN `FFIN` DATETIME, IN `PROY` INT, IN `USUARIO` INT)  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*)FROM actividad WHERE id_nombre_actividad=BINARY NOM);

   INSERT INTO actividad(id_nombre_actividad,documento,id_estado_actividad,fecha_inicio,fecha_fin,id_proyecto,id_usuario) 
VALUES(NOM,ARCHI,ESTAD,FINICIO,FFIN,PROY,USUARIO);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRAR_ACTIVIDAD_NOMBRE` (IN `NOM` TEXT)  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*)FROM nombre_actividad WHERE nombre_actividad=BINARY NOM);

   INSERT INTO nombre_actividad(nombre_actividad) 
VALUES(NOM);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRAR_AVANCE_ACTIVIDAD` (IN `IDACTIVIDAD` INT, IN `ARCHIVO` VARCHAR(255))  BEGIN
DECLARE num INT;
SET @num:=(SELECT COUNT(*)+1 FROM entrega where id_actividad=IDACTIVIDAD);
INSERT INTO entrega(id_actividad,documento,fecha,numeroavance) VALUES(IDACTIVIDAD,ARCHIVO,CURDATE(),@num);
IF @num=2 THEN
UPDATE actividad set
id_estado_actividad='2'
where id_actividad=IDACTIVIDAD;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRAR_PROYECTO` (IN `NOM` TEXT, IN `ARCHI` TEXT, IN `ESTAD` INT, IN `FINICIO` DATETIME, IN `FFIN` DATETIME)  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*)FROM proyecto WHERE nombre_proyecto=BINARY NOM);
IF @CANTIDAD=0 THEN
   INSERT INTO proyecto(nombre_proyecto,descripcion,id_estado,fecha_inicio,fecha_fin) VALUES(NOM,ARCHI,ESTAD,FINICIO,FFIN);

  SELECT 1;
ELSE
   SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRAR_USUARIOS` (IN `NOM` TEXT, IN `USU` TEXT, IN `CONTRA` TEXT, IN `PERF` INT, IN `ESTAD` INT, IN `TURN` INT, IN `DEPART` INT, IN `ruta` VARCHAR(250))  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*)FROM usuarios WHERE nombre=BINARY NOM);
IF @CANTIDAD=0 THEN
   INSERT INTO usuarios(nombre,usuario,pass,id_perfil,id_estado,id_turno,id_departamento,FOTO) VALUES(NOM,USU,CONTRA,PERF,ESTAD,TURN,DEPART,ruta);

  SELECT 1;
ELSE
   SELECT 2;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VERIFICAR_USUARIO` (IN `usuarios` TEXT)  SELECT
usuarios.id_usuarios,
usuarios.nombre,
usuarios.usuario,
usuarios.`pass`,
usuarios.id_perfil,
usuarios.id_estado,
usuarios.id_turno,
usuarios.id_departamento,
tipo_usuario.perfil,
departamento.departamento,
estado.estado,
turno.descripcion
FROM
usuarios
INNER JOIN tipo_usuario ON usuarios.id_perfil = tipo_usuario.id_tipo_usuario
INNER JOIN departamento ON usuarios.id_departamento = departamento.id_departamento
INNER JOIN estado ON usuarios.id_estado = estado.id_estado
INNER JOIN turno ON usuarios.id_turno = turno.id_turno
WHERE usuario=BINARY usuarios$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `id_nombre_actividad` int(11) NOT NULL,
  `documento` text NOT NULL,
  `id_estado_actividad` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` datetime NOT NULL DEFAULT current_timestamp(),
  `id_proyecto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `id_nombre_actividad`, `documento`, `id_estado_actividad`, `fecha_inicio`, `fecha_fin`, `id_proyecto`, `id_usuario`) VALUES
(22, 3, 'controlador/actividad/archivos/96202102925.pdf', 2, '2021-06-09 02:00:00', '2021-06-10 03:00:00', 1, 56),
(23, 2, 'controlador/actividad/archivos/suba.docx', 2, '2021-06-14 03:02:00', '2021-06-30 05:02:00', 1, 52),
(24, 13, 'controlador/actividad/archivos/962021183449.docx', 2, '2021-06-09 18:34:00', '2021-07-30 18:34:00', 3, 50),
(25, 2, 'controlador/actividad/archivos/1162021205554.pdf', 2, '2021-06-11 20:55:00', '2021-06-11 20:55:00', 6, 54),
(26, 6, 'controlador/actividad/archivos/1562021103434.docx', 2, '2021-06-15 10:34:00', '2021-07-15 10:34:00', 41, 55),
(27, 11, 'controlador/actividad/archivos/1662021184752.pdf', 2, '2021-06-16 18:47:00', '2021-07-30 18:47:00', 4, 52),
(28, 6, 'controlador/actividad/archivos/1662021185547.docx', 2, '2021-06-16 18:55:00', '2021-07-23 18:55:00', 41, 51),
(29, 1, 'controlador/actividad/archivos/1662021185918.docx', 2, '2021-08-17 18:58:00', '2021-08-24 18:58:00', 41, 51),
(30, 1, 'controlador/actividad/archivos/186202120552.docx', 2, '2021-06-18 20:54:00', '2021-07-18 20:54:00', 42, 53),
(31, 2, 'controlador/actividad/archivos/2362021182742.pdf', 1, '2021-06-23 18:27:00', '2021-06-23 18:27:00', 42, 51),
(32, 1, 'controlador/actividad/archivos/572021202320.docx', 2, '2021-07-06 20:23:00', '2021-08-11 20:23:00', 43, 57);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `departamento` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `departamento`) VALUES
(1, 'Piura'),
(2, 'Amazonas'),
(3, 'Tumbes'),
(4, 'Ancash'),
(5, 'Apurimac'),
(6, 'Arequipa'),
(7, 'Ayacucho'),
(8, 'Cajamarca'),
(9, 'Callao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `id_entrega` int(11) NOT NULL,
  `documento` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_actividad` int(11) NOT NULL,
  `numeroavance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`id_entrega`, `documento`, `fecha`, `id_actividad`, `numeroavance`) VALUES
(1, 'controlador/actividad/avance/1162021205645.pdf', '2021-06-11 05:00:00', 25, 1),
(2, 'controlador/actividad/avance/1162021205658.docx', '2021-06-11 05:00:00', 25, 2),
(3, 'controlador/actividad/avance/116202122129.docx', '2021-06-11 05:00:00', 24, 1),
(4, 'controlador/actividad/avance/116202122141.docx', '2021-06-11 05:00:00', 24, 2),
(5, 'controlador/actividad/avance/1562021103557.pdf', '2021-06-15 05:00:00', 26, 1),
(6, 'controlador/actividad/avance/1562021103620.pdf', '2021-06-15 05:00:00', 26, 2),
(7, 'controlador/actividad/avance/1562021131812.pdf', '2021-06-15 05:00:00', 22, 1),
(8, 'controlador/actividad/avance/1562021131824.docx', '2021-06-15 05:00:00', 22, 2),
(9, 'controlador/actividad/avance/166202118508.docx', '2021-06-16 05:00:00', 27, 1),
(10, 'controlador/actividad/avance/1662021185054.docx', '2021-06-16 05:00:00', 27, 2),
(11, 'controlador/actividad/avance/166202119052.docx', '2021-06-16 05:00:00', 28, 1),
(12, 'controlador/actividad/avance/166202119120.docx', '2021-06-16 05:00:00', 28, 2),
(13, 'controlador/actividad/avance/1662021193114.docx', '2021-06-16 05:00:00', 29, 1),
(14, 'controlador/actividad/avance/1662021193126.pdf', '2021-06-16 05:00:00', 29, 2),
(15, 'controlador/actividad/avance/2362021184622.pdf', '2021-06-23 05:00:00', 30, 1),
(16, 'controlador/actividad/avance/2362021184647.docx', '2021-06-23 05:00:00', 30, 2),
(17, 'controlador/actividad/avance/572021202522.pdf', '2021-07-05 05:00:00', 32, 1),
(18, 'controlador/actividad/avance/57202120275.pdf', '2021-07-05 05:00:00', 32, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO'),
(3, 'EJECUCION'),
(4, 'ENTREGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_actividad`
--

CREATE TABLE `estado_actividad` (
  `id_estado_actividad` int(11) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `estado_actividad`
--

INSERT INTO `estado_actividad` (`id_estado_actividad`, `estado`) VALUES
(1, 'EJECUCION'),
(2, 'ENTREGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombre_actividad`
--

CREATE TABLE `nombre_actividad` (
  `id_nombre_actividad` int(11) NOT NULL,
  `nombre_actividad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `nombre_actividad`
--

INSERT INTO `nombre_actividad` (`id_nombre_actividad`, `nombre_actividad`) VALUES
(1, 'BASE DE DATOS '),
(2, 'DESARROLLO DEL CODIGO'),
(3, 'INTERFACES'),
(5, 'MOCKUPS'),
(6, 'PROTOTIO DE SISTEMA'),
(11, 'INFORME'),
(12, 'DESARROLLO'),
(13, 'BD'),
(14, 'INFORME');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` text NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `fecha_fin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre_proyecto`, `descripcion`, `id_estado`, `fecha_inicio`, `fecha_fin`) VALUES
(1, 'SISTEMAS DE VENTAS', 'controlador/proyecto/archivos/262021122352.pdf', 4, '2021-06-23 10:46:19', '2021-06-23 10:46:19'),
(3, 'SISTEMA DE BIBLIOTECA', 'controlador/proyecto/archivos/262021181251.pdf', 4, '2021-06-23 10:46:10', '2021-06-23 10:46:10'),
(4, 'SISTEMA DE BODEGA', 'DOC', 4, '2021-06-01 20:58:08', '2021-06-01 20:58:08'),
(6, 'SISTEMA DE REGISTRO DE TAREAS', 'DOC', 4, '2021-06-01 20:59:16', '2021-06-01 20:59:16'),
(41, 'SISTEMA DE FERRETERIA', 'controlador/proyecto/archivos/ARCHIVO295202122652.docx', 4, '2021-06-23 11:06:58', '2021-06-23 11:06:58'),
(42, 'SISTEMA DE FARMACIA', 'controlador/proyecto/archivos/3052021223056.docx', 3, '2021-05-30 22:30:00', '2021-06-30 22:30:00'),
(43, 'SISTEMA DE VENTA DE CAFE', 'controlador/proyecto/archivos/57202120224.docx', 3, '2021-07-05 20:21:00', '2021-08-31 20:21:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `perfil` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `perfil`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_turno` int(11) NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_turno`, `descripcion`) VALUES
(1, 'mañana'),
(2, 'tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `pass` text COLLATE utf8_spanish_ci NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `FOTO` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `usuario`, `pass`, `id_perfil`, `id_estado`, `id_turno`, `id_departamento`, `FOTO`) VALUES
(1, 'JAIRO ALEXIS TEMOCHE IMAN', 'jairo', '$2y$10$QPhllEG7SePOJ/kixhwjM.5vhEN3WmqUY8u1f9NxZ5QhhLAq/n9lK', 1, 1, 1, 3, 'controlador/usuario/imagenes/IMG862021123423.jpg'),
(50, 'JHAN CARLOS TEMOCHE IMAN', 'jhan', '$2y$10$zJVHgrQgdokvpMEN3eZU0Oxpc1m1lBAAsyanZM.HsHLtjyeJUXCBK', 2, 1, 1, 1, 'controlador/usuario/imagenes/IMG2552021221257.jpg'),
(51, 'DANITZA DEL PILAR TEMOCHE IMAN', 'danitza', '$2y$10$5DVCCIOxkoZBqtiU13AafeXO00l9scqjR2NiRf8BwtjMv26FUdEwu', 2, 1, 1, 1, 'controlador/usuario/imagenes/IMG2552021221428.jpg'),
(52, 'MERCEDES TEMOCHE PANTA', 'mercedes', '$2y$10$/TUeTFZm4jl.A5gqWE9kFuyN5lr6ih6gXCUz5K/eepQMLU44yZJAG', 2, 1, 1, 1, 'controlador/usuario/imagenes/IMG2552021221537.jpg'),
(53, 'MARIA DEL MILAGRO IMAN ELIAS', 'milagros', '$2y$10$/ezm6lsHCxvMV2uHR47uU.atxvGAVkBbHTu3lsgDWbgaHqAMLzhvm', 2, 1, 1, 1, 'controlador/usuario/imagenes/IMG2552021221636.jpg'),
(54, 'YERALDIN ALVARADO PEÑA', 'yeraldin', '$2y$10$smuH5eXT1/0jW71rz2Sk.eaQnk4TlF1do9O3h/uwonwfsL6FGOYau', 2, 1, 1, 1, 'controlador/usuario/imagenes/IMG2552021222321.jpg'),
(55, 'LUCERO MARIBEL IMAN ELIAS', 'lucero', '$2y$10$dPLJhriQ.RMKYiT2JKRgeui2JHrp.yWxifNPi1aZBSuoiygaLgjR.', 2, 1, 1, 1, 'controlador/usuario/imagenes/IMG265202105543.jpg'),
(56, 'JOAN SUAREZ SULLON', 'joan', '$2y$10$n0RTDJ2DKhfkTKT1xSiTEOIB8JtFj3FKH4iwtyfeNwx.vDnfJdWJu', 2, 1, 1, 7, 'controlador/usuario/imagenes/IMG262021182738.jpg'),
(57, 'JULIO JUAREZ CORDOVA', 'julio', '$2y$10$LcCAFu5KD1HUHJMdcdEvZ.QE4MXq.PdzN1RH6xCfs0KtxVo3DUU0K', 2, 1, 2, 3, 'controlador/usuario/imagenes/IMG572021202026.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`) USING BTREE,
  ADD KEY `id_proyecto` (`id_proyecto`) USING BTREE,
  ADD KEY `estado` (`id_estado_actividad`) USING BTREE,
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE,
  ADD KEY `id_nombre_actividad` (`id_nombre_actividad`) USING BTREE,
  ADD KEY `id_nombre_actividad_2` (`id_nombre_actividad`) USING BTREE;

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`) USING BTREE;

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id_entrega`) USING BTREE,
  ADD KEY `id_actividad` (`id_actividad`) USING BTREE;

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`) USING BTREE;

--
-- Indices de la tabla `estado_actividad`
--
ALTER TABLE `estado_actividad`
  ADD PRIMARY KEY (`id_estado_actividad`) USING BTREE,
  ADD KEY `id_estado_actividad` (`id_estado_actividad`) USING BTREE;

--
-- Indices de la tabla `nombre_actividad`
--
ALTER TABLE `nombre_actividad`
  ADD PRIMARY KEY (`id_nombre_actividad`) USING BTREE,
  ADD KEY `id_nombre_actividad` (`id_nombre_actividad`) USING BTREE;

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`) USING BTREE,
  ADD KEY `estado` (`id_estado`) USING BTREE;

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`) USING BTREE;

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`) USING BTREE,
  ADD KEY `perfil` (`id_perfil`) USING BTREE,
  ADD KEY `id_turno` (`id_turno`,`id_departamento`) USING BTREE,
  ADD KEY `id_domicilio` (`id_departamento`) USING BTREE,
  ADD KEY `estado` (`id_estado`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `entrega`
--
ALTER TABLE `entrega`
  MODIFY `id_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_actividad`
--
ALTER TABLE `estado_actividad`
  MODIFY `id_estado_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nombre_actividad`
--
ALTER TABLE `nombre_actividad`
  MODIFY `id_nombre_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_4` FOREIGN KEY (`id_estado_actividad`) REFERENCES `estado_actividad` (`id_estado_actividad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actividad_ibfk_5` FOREIGN KEY (`id_nombre_actividad`) REFERENCES `nombre_actividad` (`id_nombre_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `entrega_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `actividad` (`id_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
