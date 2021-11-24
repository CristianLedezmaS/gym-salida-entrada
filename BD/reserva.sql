/*
Navicat MySQL Data Transfer

Source Server         : conexion 3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : reserva

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-11-24 16:44:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cita
-- ----------------------------
DROP TABLE IF EXISTS `cita`;
CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `paciente` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `fk2` (`usuario`),
  KEY `fk3` (`paciente`),
  KEY `fk4` (`doctor`),
  CONSTRAINT `fk2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `fk3` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id_paciente`),
  CONSTRAINT `fk4` FOREIGN KEY (`doctor`) REFERENCES `doctor` (`id_doctor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cita
-- ----------------------------

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `id_doctor` int(11) NOT NULL AUTO_INCREMENT,
  `area` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_doctor`),
  KEY `fk6_idx` (`area`),
  CONSTRAINT `fk6` FOREIGN KEY (`area`) REFERENCES `especialidad` (`id_especialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of doctor
-- ----------------------------

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `ruc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES ('1', 'SUMAQ KIRU', '987456321', 'av. los incas', '78945612378');

-- ----------------------------
-- Table structure for especialidad
-- ----------------------------
DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE `especialidad` (
  `id_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(255) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_especialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of especialidad
-- ----------------------------
INSERT INTO `especialidad` VALUES ('1', 'Anatomia', '1');
INSERT INTO `especialidad` VALUES ('2', 'Cardiologia', '1');
INSERT INTO `especialidad` VALUES ('3', 'Cirugia', '1');
INSERT INTO `especialidad` VALUES ('4', 'Ginecologia', '1');
INSERT INTO `especialidad` VALUES ('5', 'Hematologia', '1');
INSERT INTO `especialidad` VALUES ('6', 'dd', '1');

-- ----------------------------
-- Table structure for paciente
-- ----------------------------
DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of paciente
-- ----------------------------

-- ----------------------------
-- Table structure for tipo_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_usuario
-- ----------------------------
INSERT INTO `tipo_usuario` VALUES ('1', 'administrador');
INSERT INTO `tipo_usuario` VALUES ('2', 'usuario');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk1_idx` (`tipo_usuario`),
  CONSTRAINT `fk1` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', '1', 'isai ismael', 'sandoval ccaccro', 'isai', '202cb962ac59075b964b07152d234b70', 'isai.ismael1999@gmail.com', '1');
