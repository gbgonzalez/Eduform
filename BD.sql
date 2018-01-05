drop database IF EXISTS PDP;

create database PDP;

/*----------------------------------------------------------*/
DROP USER IF EXISTS 'PDPuser'@'localhost';

grant all privileges on PDP.* to PDPuser@localhost identified by "PDPpass";

use PDP;

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    dni INT UNSIGNED NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL,
    address VARCHAR (200),
    password VARCHAR(255),
    role VARCHAR(20),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);


LOCK TABLES users WRITE;

INSERT INTO users (dni, username, address, email, password, role, created)
    VALUES ('11111111','Alumno','Direccion','Alumno@alumno.com','$2y$10$902/oGcJGGkb0TDrUak8/Oa9o7c7sFdKXpvdyNky5REztNP6ztjsy','Alumno',NOW());
INSERT INTO users (dni, username, address, email, password, role, created)
    VALUES ('22222222','GestorContenidos','Direccion','Gestor@gestor.com','$2y$10$DzBAflREv00zcnkxNaVErOwdERZEMESQTqOSO7EQbMrfMzcOeAl86','Gestor de contenidos',NOW());
INSERT INTO users (dni, username, address, email, password, role, created)
    VALUES ('33333333','Administrador','Direccion','Administrador@Administrador.com','$2y$10$vWj2G24C0xp8ftCKp3KqLefOW7MzlR3Vuzz.9Hx7/xvltK2.am98i','Administrador',NOW());

UNLOCK TABLES;

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS subjects;

CREATE TABLE IF NOT EXISTS subjects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(50) DEFAULT NULL,
  description varchar(250) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
);


LOCK TABLES subjects WRITE;

INSERT INTO subjects (name, description, created)
    VALUES ('Ingles B1','Asignatura de Ingles B1',NOW());
INSERT INTO subjects (name, description, created)
    VALUES ('Aleman B1','Asignatura de Aleman B1',NOW());
INSERT INTO subjects (name, description, created)
    VALUES ('Cocina Basico','Asignatura de Cocina Basico',NOW());

UNLOCK TABLES;
/*----------------------------------------------------------*/

DROP TABLE IF EXISTS competences;

CREATE TABLE IF NOT EXISTS competences (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  subject_id int(10) NOT NULL,
  name varchar(50) DEFAULT NULL,
  description varchar(250) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
);


LOCK TABLES competences WRITE;

INSERT INTO competences (subject_id, name, description, created)
    VALUES (1,'Part 1: Transformación de oraciones','Saber transformar oraciones',NOW());
INSERT INTO competences (subject_id, name, description, created)
    VALUES (1,'Parte 2: Mensaje corto (35 – 45 palabras)','Saber redactar correctamente mensajes cortos',NOW());
INSERT INTO competences (subject_id, name, description, created)
    VALUES (1,'Parte 1: Escuchar idioma','Escuchar',NOW());	
INSERT INTO competences (subject_id, name, description, created)
    VALUES (2,'Part 1: Transformación de oraciones','Saber transformar oraciones',NOW());
INSERT INTO competences (subject_id, name, description, created)
    VALUES (2,'Parte 2: Mensaje corto (35 – 45 palabras)','Saber redactar correctamente mensajes cortos',NOW());
INSERT INTO competences (subject_id, name, description, created)
    VALUES (3,'Parte 1: Freir patatas','Saber freir patatas',NOW());

UNLOCK TABLES;
/*----------------------------------------------------------*/

DROP TABLE IF EXISTS categories;

CREATE TABLE IF NOT EXISTS categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(50) DEFAULT NULL,
  description varchar(250) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
);


LOCK TABLES categories WRITE;

INSERT INTO categories (name, description, created) 
	VALUES('Inglés', 'Inglés',NOW());
INSERT INTO categories (name, description, created) 
	VALUES('Aleman', 'Aleman',NOW());
INSERT INTO categories (name, description, created) 
	VALUES('Cocina', 'Cocina',NOW());

UNLOCK TABLES;
/*----------------------------------------------------------*/

DROP TABLE IF EXISTS categoriescompetences;

CREATE TABLE IF NOT EXISTS categoriescompetences (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  competence_id int(10) NOT NULL,
  category_id int(10) NOT NULL
);
  

LOCK TABLES categoriescompetences WRITE;

INSERT INTO categoriescompetences (competence_id, category_id) 
	VALUES (1,1);
INSERT INTO categoriescompetences (competence_id, category_id) 
	VALUES (2,1);
INSERT INTO categoriescompetences (competence_id, category_id) 
	VALUES (3,1);
INSERT INTO categoriescompetences (competence_id, category_id) 
	VALUES (4,2);
INSERT INTO categoriescompetences (competence_id, category_id) 
	VALUES (5,2);
INSERT INTO categoriescompetences (competence_id, category_id) 
	VALUES (6,3);

	
UNLOCK TABLES;

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS userscompetences;

CREATE TABLE IF NOT EXISTS userscompetences (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id int(10) NOT NULL,
  competence_id int(10) NOT NULL,
  booleannote varchar(14) DEFAULT NULL,
  numericnote int(4) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
);
  

LOCK TABLES userscompetences WRITE;

INSERT INTO userscompetences (user_id, competence_id, booleannote, created) 
	VALUES(1,1,'Aprobado',NOW());
INSERT INTO userscompetences (user_id, competence_id, created) 
	VALUES(1,2,NOW());
INSERT INTO userscompetences (user_id, competence_id, created) 
	VALUES(1,3,NOW());	
INSERT INTO userscompetences (user_id, competence_id, numericnote, created) 
	VALUES(1,6,'3',NOW());
INSERT INTO userscompetences (user_id, competence_id, created) 
	VALUES(2,1,,NOW());
INSERT INTO userscompetences (user_id, competence_id, created) 
	VALUES(2,2,NOW());
INSERT INTO userscompetences (user_id, competence_id, created) 
	VALUES(2,3,NOW());	
	

UNLOCK TABLES;


/*----------------------------------------------------------*/

DROP TABLE IF EXISTS contents;

CREATE TABLE IF NOT EXISTS contents (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  competence_id int(10) NOT NULL,
  name varchar(50) DEFAULT NULL,
  description varchar(2000) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
);


LOCK TABLES contents WRITE;

INSERT INTO contents (competence_id, name, description, created) 
	VALUES(1, 'Contenido 1', 'Descripción 1',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(1, 'Contenido 2', 'Descripción 2',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(1, 'Contenido 3', 'Descripción 3',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(2, 'Contenido 1', 'Descripción 1',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(2, 'Contenido 2', 'Descripción 2',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(3, 'Contenido 1', 'Descripción 1',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(3, 'Contenido 2', 'Descripción 2',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(4, 'Contenido 1', 'Descripción 1',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(4, 'Contenido 2', 'Descripción 2',NOW());
INSERT INTO contents (competence_id, name, description, created) 
	VALUES(6, 'Contenido 1', 'Descripción 1',NOW());

UNLOCK TABLES;

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS files;

CREATE TABLE IF NOT EXISTS files (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  content_id int(10) NOT NULL,
  name varchar(50) DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL
);


LOCK TABLES files WRITE;

INSERT INTO files (content_id, name, created) 
	VALUES(1, 'InglesFrases.pdf', NOW());
INSERT INTO files (content_id, name, created) 
	VALUES(1, 'InglesFrasesEchas.pdf', NOW());
INSERT INTO files (content_id, name, created) 
	VALUES(10, 'ClaseCocina.pdf', NOW());
	
UNLOCK TABLES;
