/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50536
Source Host           : localhost:3306
Source Database       : efix

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-05-18 09:41:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ambientes`
-- ----------------------------
DROP TABLE IF EXISTS `ambientes`;
CREATE TABLE `ambientes` (
  `idambientes` int(11) NOT NULL,
  `piso` varchar(45) DEFAULT NULL,
  `aulas` varchar(45) DEFAULT NULL,
  `facultad` int(11) DEFAULT NULL,
  `codigo_aula` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idambientes`),
  KEY `fk_ambientes_idx` (`codigo_aula`),
  KEY `fk_ambientes_facultad_idx` (`facultad`),
  CONSTRAINT `fk_ambientes` FOREIGN KEY (`codigo_aula`) REFERENCES `ambientes` (`idambientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ambientes_facultad` FOREIGN KEY (`facultad`) REFERENCES `facultad` (`idfacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ambientes
-- ----------------------------
INSERT INTO `ambientes` VALUES ('1', 'piso', null, '1', null, '1');
INSERT INTO `ambientes` VALUES ('2', 'piso ii', null, '1', null, '1');
INSERT INTO `ambientes` VALUES ('3', 'piso1', null, '1', null, '0');
INSERT INTO `ambientes` VALUES ('4', null, '01', '1', '1', '1');

-- ----------------------------
-- Table structure for `averias`
-- ----------------------------
DROP TABLE IF EXISTS `averias`;
CREATE TABLE `averias` (
  `idaverias` int(11) NOT NULL,
  `descripcion` text,
  `tipo` int(11) DEFAULT NULL,
  `longitud` text,
  `latitud` text,
  `imagen` text,
  `estado` int(11) DEFAULT NULL,
  `ambiente` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `observacion_solicitud` text,
  `fecha` date DEFAULT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `sugerencia` text,
  PRIMARY KEY (`idaverias`),
  KEY `fk_averias_ambiente_idx` (`ambiente`),
  KEY `fk_averias_usuario` (`usuario`),
  CONSTRAINT `fk_averias_ambiente` FOREIGN KEY (`ambiente`) REFERENCES `ambientes` (`idambientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_averias_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of averias
-- ----------------------------
INSERT INTO `averias` VALUES ('1', 'no funciona la pc', '2', null, null, '1234567803012014110132', '1', '4', '1', 'oo', '2014-05-07', '2014-05-08', null);
INSERT INTO `averias` VALUES ('2', 'monitor malogrado', '2', null, null, null, '1', '4', '1', 'se antendio ...', '2014-05-08', '2014-05-08', null);
INSERT INTO `averias` VALUES ('3', 'cable roto', '2', null, null, null, '1', '4', '1', 'mmm', '2014-05-08', null, null);
INSERT INTO `averias` VALUES ('4', 'no enciende el proyecto', '2', null, null, null, '1', '4', '1', null, '2014-05-13', null, null);

-- ----------------------------
-- Table structure for `facultad`
-- ----------------------------
DROP TABLE IF EXISTS `facultad`;
CREATE TABLE `facultad` (
  `idfacultad` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `longitud` text,
  `latitud` text,
  `altura` text,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idfacultad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of facultad
-- ----------------------------
INSERT INTO `facultad` VALUES ('1', 'Ingenieria de Sistemas', '-76.379261', '-6.484866', '1200', '1');
INSERT INTO `facultad` VALUES ('2', 'Ciencias Agrarias\r\n', '-76.379808', '-6.486887', null, '1');
INSERT INTO `facultad` VALUES ('3', 'Ciencias de la Salud', '-76.379926', '-6.485049', null, '1');
INSERT INTO `facultad` VALUES ('4', 'Ingenieria Agroindrustrial', '-76.380296', '-6.486748', null, '1');
INSERT INTO `facultad` VALUES ('5', 'Ingenieria Civil y Arquitectura', '-76.37917', '-6.48694', null, '1');
INSERT INTO `facultad` VALUES ('6', 'Derecho y Ciencias Politicas', '-', '-', null, '1');
INSERT INTO `facultad` VALUES ('7', 'Medicina Humanas', '-76.379481\r\n', '-6.484744\r\n', null, '1');
INSERT INTO `facultad` VALUES ('8', 'Ciencias Economicas', '-76.379062\r\n', '-6.487697\r\n', null, '1');
INSERT INTO `facultad` VALUES ('9', 'Educacion y Humanidades', '-76.379668\r\n', '-6.485698\r\n', null, '1');
INSERT INTO `facultad` VALUES ('10', 'Auditoria', '-76.3791', '-6.485783', null, '1');
INSERT INTO `facultad` VALUES ('11', 'Comedor', '-76.37814', '-6.486945', null, '1');
INSERT INTO `facultad` VALUES ('12', 'Planta Piloto', '-76.38079', '-6.485309', null, '1');
INSERT INTO `facultad` VALUES ('13', 'Oficina de CC.BB', '-76.377877', '-6.484232', null, '1');
INSERT INTO `facultad` VALUES ('14', 'Hospital Solidario', '-76.380253', '-6.484184', null, '1');
INSERT INTO `facultad` VALUES ('15', 'OBU', '-76.377614', '-6.484344', null, '1');
INSERT INTO `facultad` VALUES ('16', 'Laboratorios Basicos', '-76.37955', '-6.485991', null, '1');
INSERT INTO `facultad` VALUES ('17', 'Fibra Optica', '-76.379186', '-6.485789', null, '1');

-- ----------------------------
-- Table structure for `inventario`
-- ----------------------------
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE `inventario` (
  `idinventaria` int(11) DEFAULT NULL,
  `codigo` text,
  `nombre` text,
  `ambiente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inventario
-- ----------------------------

-- ----------------------------
-- Table structure for `modulo`
-- ----------------------------
DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo` (
  `idmodulo` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `submodulo` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `icono` text,
  PRIMARY KEY (`idmodulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modulo
-- ----------------------------
INSERT INTO `modulo` VALUES ('1', 'GESTION AVERIAS', '#', null, '1', '1', 'icon-list');
INSERT INTO `modulo` VALUES ('2', 'ANALISIS DATOS', '#', null, '1', '2', 'icon-coffee');
INSERT INTO `modulo` VALUES ('3', 'SEGURIDAD', '#', null, '1', '3', 'icon-user');
INSERT INTO `modulo` VALUES ('4', 'AVERIAS', 'controller=Averia', '1', '1', '1', null);
INSERT INTO `modulo` VALUES ('5', 'FACULTAD', 'controller=Facultad', '1', '1', '2', null);
INSERT INTO `modulo` VALUES ('6', 'AMBIENTES', 'controller=Ambiente', '1', '1', '3', null);
INSERT INTO `modulo` VALUES ('10', 'Perfil', 'controller=Perfil', '3', '1', '1', null);
INSERT INTO `modulo` VALUES ('11', 'Personal', 'controller=User', '3', '1', '2', null);
INSERT INTO `modulo` VALUES ('12', 'PERMISOS', 'controller=_Permisos', '3', '1', '3', null);
INSERT INTO `modulo` VALUES ('13', 'MODULOS', 'controller=Modulo', '3', '1', '4', null);
INSERT INTO `modulo` VALUES ('14', 'Aulas/Oficinas', 'controller=Aula', '1', '1', '4', null);

-- ----------------------------
-- Table structure for `perfil`
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idperfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'administrador', '1');

-- ----------------------------
-- Table structure for `permiso`
-- ----------------------------
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `modulo` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `editar` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL,
  `insertar` int(11) DEFAULT NULL,
  `acceder` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpermiso`),
  KEY `fk_modulo_has_perfil_perfil1_idx` (`perfil`),
  KEY `fk_modulo_has_perfil_modulo1_idx` (`modulo`),
  CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`idmodulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permiso
-- ----------------------------
INSERT INTO `permiso` VALUES ('1', '1', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('2', '2', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('3', '3', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('4', '4', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('5', '5', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('6', '6', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('10', '10', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('11', '11', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('12', '12', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('13', '13', '1', '1', '1', '1', '1');
INSERT INTO `permiso` VALUES ('14', '14', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `span`
-- ----------------------------
DROP TABLE IF EXISTS `span`;
CREATE TABLE `span` (
  `idspan` int(11) NOT NULL,
  `imei` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idspan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of span
-- ----------------------------

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `nombres` text,
  `domicilio` text,
  `telefono` text,
  `profesion` varchar(45) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `usuario` varchar(10) DEFAULT NULL,
  `clave` text,
  `estado` varchar(45) DEFAULT NULL,
  `foto` text,
  PRIMARY KEY (`idusuario`),
  KEY `fk_usuario_perfil1_idx` (`perfil`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`idperfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', '1', '46901755', 'lenin', 'jr.', '', 'ing..sistemas', 'M', '2014-05-01', 'lenin', 'dcb7a6bcf47c7a30205cea3fd33f77ba', '1', '114052014120516');
INSERT INTO `usuario` VALUES ('2', '1', '23123123', 'ADMIN', 'ADMIN', '21323232', 'ADMIN', null, '2014-05-01', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', '14052014040515');

-- ----------------------------
-- View structure for `v_usuario`
-- ----------------------------
DROP VIEW IF EXISTS `v_usuario`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_usuario` AS select `u`.`idusuario` AS `item`,`p`.`descripcion` AS `Perfil`,`u`.`nombres` AS `Usuario`,`u`.`profesion` AS `profesion` from (`usuario` `u` join `perfil` `p`) where (`u`.`perfil` = `p`.`idperfil`) ;

-- ----------------------------
-- View structure for `vista_ambiente`
-- ----------------------------
DROP VIEW IF EXISTS `vista_ambiente`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_ambiente` AS select `ambientes`.`idambientes` AS `idambientes`,`ambientes`.`piso` AS `piso`,`facultad`.`nombre` AS `ambiente` from (`ambientes` join `facultad` on((`ambientes`.`facultad` = `facultad`.`idfacultad`))) where ((`ambientes`.`estado` <> 0) and isnull(`ambientes`.`codigo_aula`)) ;

-- ----------------------------
-- View structure for `vista_aula`
-- ----------------------------
DROP VIEW IF EXISTS `vista_aula`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_aula` AS select `ambientes`.`idambientes` AS `nro`,`ambientes`.`aulas` AS `aulas`,`am`.`piso` AS `piso`,`facultad`.`nombre` AS `facultad` from ((`ambientes` join `facultad` on((`facultad`.`idfacultad` = `ambientes`.`facultad`))) join `ambientes` `am` on((`am`.`idambientes` = `ambientes`.`codigo_aula`))) where (`ambientes`.`estado` <> 0) ;

-- ----------------------------
-- View structure for `vista_averia`
-- ----------------------------
DROP VIEW IF EXISTS `vista_averia`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_averia` AS select `averias`.`idaverias` AS `codigo_averia`,`averias`.`fecha` AS `fecha`,`averias`.`descripcion` AS `descripcion`,(case `averias`.`estado` when 1 then 'software' when 2 then 'hardware' when 3 then 'red' end) AS `tipo`,`ambientes`.`piso` AS `ambiente`,`facultad`.`nombre` AS `facultad`,`averias`.`estado` AS `estado` from (((`ambientes` join `ambientes` `am` on((`am`.`codigo_aula` = `ambientes`.`codigo_aula`))) join `averias` on((`averias`.`ambiente` = `am`.`idambientes`))) join `facultad` on((`facultad`.`idfacultad` = `am`.`facultad`))) ;

-- ----------------------------
-- View structure for `vista_facultad`
-- ----------------------------
DROP VIEW IF EXISTS `vista_facultad`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_facultad` AS select `facultad`.`idfacultad` AS `nro`,`facultad`.`nombre` AS `nombre`,`facultad`.`longitud` AS `longitud`,`facultad`.`latitud` AS `latitud`,`facultad`.`altura` AS `altura` from `facultad` where (`facultad`.`estado` <> 0) ;

-- ----------------------------
-- View structure for `vista_modulo`
-- ----------------------------
DROP VIEW IF EXISTS `vista_modulo`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_modulo` AS select `modulo`.`idmodulo` AS `idmodulo`,`modulo`.`descripcion` AS `descripcion` from `modulo` where isnull(`modulo`.`submodulo`) ;

-- ----------------------------
-- View structure for `vista_modulos`
-- ----------------------------
DROP VIEW IF EXISTS `vista_modulos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_modulos` AS select `m`.`idmodulo` AS `idmodulo`,`mm`.`descripcion` AS `padre`,`m`.`descripcion` AS `descripcion`,`m`.`url` AS `url`,`m`.`orden` AS `orden`,(case `m`.`estado` when '1' then 'Activo' else 'Inactivo' end) AS `estado` from (`modulo` `m` left join `modulo` `mm` on((`mm`.`idmodulo` = `m`.`submodulo`))) ;

-- ----------------------------
-- View structure for `vista_perfil`
-- ----------------------------
DROP VIEW IF EXISTS `vista_perfil`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_perfil` AS select `perfil`.`idperfil` AS `nro`,`perfil`.`descripcion` AS `perfil` from `perfil` where (`perfil`.`estado` = 1) ;

-- ----------------------------
-- Procedure structure for `usp_modulo`
-- ----------------------------
DROP PROCEDURE IF EXISTS `usp_modulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_modulo`(op  int,id int,submodulo int,descripcion text,url text,orden int,estado int)
BEGIN
declare max_id int;
if(op=1)then 
set max_id=(select max(idmodulo)+1 from modulo);
if(max_id is null)then set max_id=1;end if;
insert into modulo(modulo.idmodulo,modulo.submodulo,modulo.descripcion,modulo.url,modulo.orden,estado)
values(max_id,submodulo,descripcion,url,orden,estado);
end if;
if(op=2)then
update modulo set modulo.submodulo=submodulo,modulo.descripcion=descripcion,modulo.url=url,
modulo.orden=orden,estado=estado
 where modulo.idmodulo=id; 
end if;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `usp_perfil`
-- ----------------------------
DROP PROCEDURE IF EXISTS `usp_perfil`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil`(op  int,descrip text,id int)
BEGIN
declare max_id int;
if(op=1)then 
set max_id=(select max(idperfil)+1 from perfil);
if(max_id is null)then set max_id=1;end if;
insert into perfil(idperfil,descripcion,estado)values(max_id,descrip,1);
end if;
if(op=2)then
update perfil set descripcion=descrip where idperfil=id; 
end if;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `usp_permiso`
-- ----------------------------
DROP PROCEDURE IF EXISTS `usp_permiso`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_permiso`(_perfil int,_modulo int,_modificar int,_eliminar int,_insertar int,_acceder int,_permiso int)
BEGIN
	#Routine body goes here...
DECLARE max_id int;
if(_permiso=0)then 
set max_id=(SELECT max(idpermiso)+1 from permiso);
if(max_id is null)then  set max_id=1; end if;
insert into permiso(idpermiso,modulo,perfil,editar,eliminar,insertar,acceder)
VALUES(max_id,_modulo,_perfil,_modificar,_eliminar,_insertar,_acceder);
end if;
if(_permiso<>0)then 
UPDATE permiso set  modulo=_modulo,perfil=_perfil,editar=_modificar,eliminar=_eliminar,insertar=_insertar,acceder=_acceder
where idpermiso=_permiso;
end if;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `usp_usuario`
-- ----------------------------
DROP PROCEDURE IF EXISTS `usp_usuario`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario`(op int,_perfil int,_nombres text,_profesion text,_domicilio text,_telefono text,_dni text,_usuario text,_clave text,_fecha_n date,_foto text, id int)
BEGIN
	#Routine body goes here...
DECLARE max_id int; 
if(op=1)then
set max_id=(SELECT max(idusuario)+1 from usuario);
if(max_id is null)then 
set max_id=1;
end if;
INSERT into usuario(idusuario,perfil,dni,nombres,domicilio,telefono,profesion,fecha_nacimiento,usuario,clave,estado,foto)
VALUES(max_id,_perfil,_dni,_nombres,_domicilio,_telefono,_profesion,_fecha_n,_usuario,_clave,1,_foto);
 end if;
if(op=2)then 
UPDATE usuario set perfil=_perfil,dni=_dni,nombres=_nombres,domicilio=_domicilio,telefono=_telefono,profesion=_profesion,fecha_nacimiento=_fecha_n,foto=_foto,usuario=_usuario,clave=_clave
where idusuario=id;
end if;
END
;;
DELIMITER ;
