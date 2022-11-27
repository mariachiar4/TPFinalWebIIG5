CREATE DATABASE infonete;
USE infonete;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `email` varchar(60) NOT NULL
);

INSERT INTO `usuario` (`nombre`,`id_rol`,`lat`, `lon`, `email`)
VALUES ('Admin', 2, -34.6403247, -58.5658212, 'tpfinalwebiig5@gmail.com'), ('Nicolas', 1, -34.6403247, -58.5658212, 'nicolas.ariel.maldonado@gmail.com');

CREATE TABLE `validacion` (
  `email` varchar(60) NOT NULL PRIMARY KEY,
  `contrasena` varchar(60) NOT NULL,
  `token` varchar(100) NULL,
  `confirmado` int(1) NOT NULL
);

INSERT INTO `validacion` (`email`,`contrasena`,`confirmado`)
VALUES ('tpfinalwebiig5@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),('nicolas.ariel.maldonado@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1);

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
  `descripcion` varchar(250),
  `tipo_catalogo` int(10) NOT NULL,
  `precio_suscripcion` double NOT NULL,
  `facebook_url` varchar(70),
  `instagram_url` varchar(70),
  `twitter_url` varchar(70),
  `link_url` varchar(70),
  `color` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
);

INSERT INTO `publicacion`( `nombre`, `descripcion`, `tipo_catalogo`, `precio_suscripcion`,`facebook_url`,`instagram_url`,`twitter_url`,`link_url`,`color`) 
VALUES ('La Nación',
      'LA NACION ofrece las últimas noticias, fotos y videos de la Argentina y el mundo. Política, economía, deportes y toda la información en tiempo real.',
      2,
      500.00,
      'https://www.facebook.com/lanacion',
      'https://www.instagram.com/lanacioncom/',
      'https://twitter.com/LANACION',
      'https://www.lanacion.com.ar/',
      '#071e91'
      ), 
      ('Billiken',
      'Billiken es una revista infantil argentina de aparición mensual, la más antigua de habla castellana en la actualidad.​​ Fue creada por el periodista Constancio C. Vigil.',
      1,
      350.00,
      'https://www.facebook.com/BILLIKENONLINE',
      'https://www.instagram.com/billikenoficial/',
      'https://twitter.com/BillikenOnline',
      'https://billiken.lat/',
      '#095aab'
      ),
      ('Para Ti',
      'Para Ti es una revista mensual argentina dedicada a la mujer, creado por el periodista Constancio C. Vigil. El primer número fue publicado el 16 de mayo de 1922 a través de Editorial Atlántida.',
      1,
      400.00,
      'https://www.facebook.com/parationline',
      'https://www.instagram.com/paratirevista/',
      'https://twitter.com/ParaTiOnline',
      'https://www.parati.com.ar/',
      '#2b2b2b'
      ),
      ('Gente',
      'Gente es una revista argentina, perteneciente a Editorial Atlántida. Dedicada a los personajes del espectáculo y la farándula, es una de las mayores revistas del corazón en Argentina.',
      1,
      550.00,
      'https://www.facebook.com/GENTEONLINE',
      'https://www.instagram.com/revistagenteok/',
      'https://twitter.com/genteonline',
      'https://www.gente.com.ar/',
      '#ab0303'
      ),
      ('Puro Diseño',
      'Es la mayor multiplataforma de difusión, venta y muestra de diseño de Argentina y Latinoamérica. Desde hace 20 años genera encuentros y alianzas estratégicas.',
      1,
      700.50,
      'https://www.facebook.com/purodisenolat',
      'https://www.instagram.com/feriapurodiseno/',
      'https://twitter.com/PuroDisenoLat',
      'https://purodiseno.lat/',
      '#910757'
      ),
      ('Clarín',
      'Clarín es un periódico argentino de tendencia conservadora con sede en la ciudad de Buenos Aires. Fue fundado el 28 de agosto de 1945, por Roberto Noble.',
      2,
      400.00,
      'https://www.facebook.com/clarincom/',
      NULL,
      'https://twitter.com/clarincom',
      'https://www.clarin.com/',
      '#ab0215'
      ),
      ('Tiempo Argentino',
      'Tiempo Argentino es un diario dominical de Argentina, editado en la ciudad de Buenos Aires que pertenece a la cooperativa de trabajadores "Por Más Tiempo"',
      2,
      350.99,
      'https://www.facebook.com/DiarioTiempoArgentino',
      'https://www.instagram.com/tiempoarg/',
      'https://twitter.com/tiempoarg',
      'https://www.tiempoar.com.ar/',
      '#05657d'
      ),
      ('Olé',
      'Olé es un diario argentino de deportes, editado en Buenos Aires desde el 23 de mayo de 1996, por el Grupo Clarín en formato tabloide.',
      2,
      350.99,
      'https://www.facebook.com/diarioole',
      'https://www.instagram.com/diario.ole/',
      'https://twitter.com/diarioole',
      'https://www.ole.com.ar/',
      '#1b7302'
      );

CREATE TABLE `edicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_publicacion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `precio` double NOT NULL
);

INSERT INTO `edicion` (`id_publicacion`,`nombre`,`fecha_creacion`, `precio`)
VALUES (1, "Edicion 22/11/2022", '2022-11-17 00:01:14', 500);

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

INSERT INTO `edicion_seccion` (`id_edicion`,`id_seccion`)
VALUES (1, 1),(1, 2) ,(1, 3);

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
  `fecha_inicio` date NOT NULL, 
  `fecha_fin` date NOT NULL  
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
  `contenido` text NOT NULL
);

INSERT INTO `articulo` (`id_estado`, `id_edicionSeccion`, `id_usuarioCreador`, `lat`, `lon`, `titulo`, `bajada`, `fotos`, `contenido`)
VALUES 
(3,1,2,50.4528093,30.5950632, "Guerra Rusia-Ucrania", "Restablecido el transporte de pasajeros en barco tras un ataque con drones en Crimea", "UNYWVILFGNETPBECITYICTGHTI.webp", "El transporte de pasajeros en barco ha quedado restablecido este martes después de que se haya interrumpido de forma breve tras registrarse un ataque con drones en la ciudad de Sebastopol, en Crimea, que se ha saldado con dos vehículos no tripulados derribados. La Dirección para el Desarrollo de la Infraestructura de Transporte por Carretera de Sebastopol ha informado de que el tráfico se ha restablecido después de que el servicio quedase paralizado por razones de seguridad ante un ataque con drones en la ciudad."),
(3,2,2, -34.5687087, -58.4653407, "El método “antiage” de un grupo de mujeres que intriga a los vecinos de Belgrano R", "Con un promedio de 80 años, bailan en la Plaza Castelli todos los domingos, a las 11; mantenerse activas física y mentalmente es la gran guía","HGTO25CG4REOPLW53F7GTVY7WA.webp", "“Bailamos porque nos hace sentir vivos”, explica Gustavo Zunino, el coordinador, de 53 años, cuando alguien se acerca a ver ese espectáculo que tiene embelesados a los vecinos de Belgrano. Un grupo de casi 20 autodenominadas “bataclanas”, con un promedio de 80 años, se junta todos los domingos en la Plaza Castelli, a metros de la estación de Belgrano R, para bailar. A veces, vestidas para charlestón, con plumas y coronitas. Otras , con tutús y badanas, para hacer danza clásica. Llevan música y aunque llueva o haya mucho sol se dedican a disfrutar. No les importa ni les preocupa quién las mire."),
(3,3,2, -34.6082106, -58.3817415, "Se vende Edesur: las razones por las cuales Enel se va de la Argentina", "El grupo italiano anunció hoy que venderá sus activos en la Argentina, que incluye la concesión de la distribuidora Edesur, las generadoras Generación Costanera y Dock Sud","LKPR5SIGOZFWFHWFHXW2FOBSLE.webp", "Para entender la salida del país de la empresa italiana Enel, a cargo de la concesión de Edesur, hay que recordar las palabras que dijo hace un año el CEO y general manager de la empresa a nivel mundial, Francesco Starace: “Nuestra posición es quedarnos en la Argentina y ver qué pasa. No queremos irnos, queremos saber cuál es la política [energética] que adoptará [el Gobierno] el año que viene, y según eso veremos cuál es la mejor decisión para nosotros”."   )
