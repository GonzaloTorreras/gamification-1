-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2013 a las 15:50:11
-- Versión del servidor: 5.6.11
-- Versión de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gamificacion`
--
CREATE DATABASE IF NOT EXISTS `gamificacion` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `gamificacion`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `autor` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idrequisito` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `contenido` varchar(350) NOT NULL,
  `resuelto` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`autor`,`idrequisito`),
  KEY `requisito` (`idrequisito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`autor`, `idrequisito`, `contenido`, `resuelto`) VALUES
('admin', 'RF-001', 'Resuelveme', 0),
('dani', 'RNF-002', 'Y mi primer comentario', 0),
('luis', 'RF-002', 'Probando incremento de puntos', 1);

--
-- Disparadores `comentario`
--
DROP TRIGGER IF EXISTS `PrimerComentario`;
DELIMITER //
CREATE TRIGGER `PrimerComentario` AFTER INSERT ON `comentario`
 FOR EACH ROW BEGIN
IF ((SELECT COUNT(idUser) FROM logrouser WHERE idUser=NEW.autor AND idLogro=2)=0) THEN
		INSERT INTO logrouser VALUES(NEW.autor,2);
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logro`
--

CREATE TABLE IF NOT EXISTS `logro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(24) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Contiene los distintos logros ' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `logro`
--

INSERT INTO `logro` (`id`, `titulo`, `descripcion`) VALUES
(1, 'Primer Requisito', 'El logro se desbloquea cuando aportas el primer requisito al sistema.'),
(2, 'Primer Comentario', 'El logro se desbloquea cuando aportas tu primer comentario a un requisito del sistema.'),
(3, 'Principiante', 'Obtén 10 puntos en el sistema.'),
(4, 'Profesional', 'Obtén 100 puntos en el sistema.'),
(5, 'Inhumano', 'Obtén 1000 puntos en el sistema.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logrouser`
--

CREATE TABLE IF NOT EXISTS `logrouser` (
  `idUser` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `idLogro` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`idLogro`),
  KEY `logro` (`idLogro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Almacena todos los logros de todos los usuarios.';

--
-- Volcado de datos para la tabla `logrouser`
--

INSERT INTO `logrouser` (`idUser`, `idLogro`) VALUES
('luis', 1),
('admin', 1),
('victor', 1),
('admin', 2),
('dani', 2),
('luis', 2),
('dani', 3),
('luis', 3),
('victor', 3),
('luis', 4),
('victor', 4),
('luis', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisito`
--

CREATE TABLE IF NOT EXISTS `requisito` (
  `id` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `prioridad` tinyint(4) NOT NULL,
  `impacto` tinyint(4) NOT NULL,
  `dependencias` varchar(150) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(350) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `autor` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla para alojar requisitos';

--
-- Volcado de datos para la tabla `requisito`
--

INSERT INTO `requisito` (`id`, `titulo`, `prioridad`, `impacto`, `dependencias`, `descripcion`, `autor`) VALUES
('RF-001', 'Requisito de prueba', 1, 2, 'RF-003', 'Este requisito es una prueba para comprobar el acceso a la base de datos.', 'luis'),
('RF-002', 'Segundo requisito', 3, 1, '', 'Este es el segundo requisito. Además está editado.', 'admin'),
('RNF-001', 'No funcional', 1, 0, '', 'Este es un requisito no funcional', 'luis'),
('RNF-002', 'Requisito de victor', 1, 1, '', 'Mi primer requisito', 'victor');

--
-- Disparadores `requisito`
--
DROP TRIGGER IF EXISTS `PrimerRequisito`;
DELIMITER //
CREATE TRIGGER `PrimerRequisito` AFTER INSERT ON `requisito`
 FOR EACH ROW BEGIN
IF ((SELECT COUNT(idUser) FROM logrouser WHERE idUser=NEW.autor AND idLogro=1)=0) THEN
		INSERT INTO logrouser VALUES(NEW.autor,1);
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `user` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(12) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `puntos` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Representa a los usuarios del sistema';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`user`, `password`, `nombre`, `apellido`, `puntos`, `admin`) VALUES
('admin', 'admin', 'Administrador', '', 5, 1),
('dani', '1234', 'Daniel', 'Domínguez', 17, 0),
('david', '1234', 'David', 'Cañamares', 6, 0),
('luis', '1234', 'Luis Alberto', 'Santos', 1003, 0),
('victor', '1234', 'Victor Manuel', 'Valle', 107, 0);

--
-- Disparadores `usuario`
--
DROP TRIGGER IF EXISTS `Puntos`;
DELIMITER //
CREATE TRIGGER `Puntos` BEFORE UPDATE ON `usuario`
 FOR EACH ROW BEGIN
IF (NEW.puntos >= 10 AND (SELECT COUNT(idUser) FROM logrouser WHERE idUser=NEW.user AND idLogro=3)=0) THEN
		INSERT INTO logrouser VALUES(NEW.user,3);
	END IF;
IF (NEW.puntos >= 100 AND (SELECT COUNT(idUser) FROM logrouser WHERE idUser=NEW.user AND idLogro=4)=0) THEN
		INSERT INTO logrouser VALUES(NEW.user,4);
	END IF;
IF (NEW.puntos >= 1000 AND (SELECT COUNT(idUser) FROM logrouser WHERE idUser=NEW.user AND idLogro=5)=0) THEN
		INSERT INTO logrouser VALUES(NEW.user,5);
	END IF;
END
//
DELIMITER ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `usuario` (`user`) ON DELETE NO ACTION,
  ADD CONSTRAINT `requisito` FOREIGN KEY (`idrequisito`) REFERENCES `requisito` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `logrouser`
--
ALTER TABLE `logrouser`
  ADD CONSTRAINT `logro` FOREIGN KEY (`idLogro`) REFERENCES `logro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`idUser`) REFERENCES `usuario` (`user`) ON DELETE CASCADE;

--
-- Filtros para la tabla `requisito`
--
ALTER TABLE `requisito`
  ADD CONSTRAINT `AutorRequisito` FOREIGN KEY (`autor`) REFERENCES `usuario` (`user`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
