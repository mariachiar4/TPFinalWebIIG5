CREATE DATABASE tpfinalpw2grupo5;
USE tpfinalpw2grupo5;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL
);

/*SOLO SI HABIAS CREADO LA TABLA USUARIO CON CAMPO PASSWORD*/
ALTER TABLE `usuarios` DROP `password`;

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL,
  `tipo_publicacion` int(50) NOT NULL,
  `precio_suscripcion` double DEFAULT NOT NULL,
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
CREATE TABLE `edicion_seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_edicion` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL
);

CREATE TABLE `validacion` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` varchar(100) NULL,
  `confirmado` int(1) NOT NULL
);
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(50) NOT NULL
);
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