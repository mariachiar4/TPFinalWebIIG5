CREATE DATABASE infonete;
USE infonete;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `email` varchar(60) NOT NULL
);

CREATE TABLE `validacion` (
  `email` varchar(60) NOT NULL PRIMARY KEY,
  `contrasena` varchar(60) NOT NULL,
  `token` varchar(100) NULL,
  `confirmado` int(1) NOT NULL
);
CREATE TABLE `catalogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL
);

INSERT INTO `catalogo` (`nombre`)
VALUES ('Revista'),
      ('Diario');


CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL,
  `tipo_catalogo` int(50) NOT NULL,
  `precio_suscripcion` double NOT NULL
);
CREATE TABLE `edicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `precio` double NOT NULL
);
CREATE TABLE `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL
);
INSERT INTO `seccion` (`nombre`)
VALUES ('Internacional'),
      ('Sociedad'),
      ('Economia'),
      ('Cultura'),
      ('Deportes'),
      ('Policiales'),
      ('Entretenimiento');

CREATE TABLE `edicion_seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_edicion` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL
);

CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL
);

INSERT INTO `rol` (`nombre`)
VALUES ('Contenidista'),
      ('Administrador'),
      ('Lector');

CREATE TABLE `suscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL
);
CREATE TABLE `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_usuario` int(11) NOT NULL,
  `id_edicion` int(11) NOT NULL,
  `fecha` datetime NOT NULL
);
CREATE TABLE `estado_articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL
);

INSERT INTO `estado_articulo` (`nombre`)
VALUES ('Draft'),
      ('A publicar'),
      ('Publicado'),
      ('Dado de baja');

CREATE TABLE `articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_estado` int(11) NOT NULL,
  `id_edicionSeccion` int(11) NOT NULL,
  `id_usuarioCreador` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `titulo` varchar(400) NOT NULL,
  `bajada` varchar(400) NOT NULL,
  `fotos`  varchar(400) NOT NULL,
  `contenido` json NOT NULL
);







