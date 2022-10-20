CREATE DATABASE tpfinalpw2grupo5;
USE tpfinalpw2grupo5;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `password` varchar(40) NOT NULL
) 