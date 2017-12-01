
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
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    address VARCHAR (200),
    password VARCHAR(255),
    role VARCHAR(20),
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

LOCK TABLES `users` WRITE;

INSERT INTO users (dni, username, address, email, password, role, created)
    VALUES ('11111111','Alumno','Direccion','Alumno@alumno.com','$2y$10$902/oGcJGGkb0TDrUak8/Oa9o7c7sFdKXpvdyNky5REztNP6ztjsy','Alumno',NOW());
INSERT INTO users (dni, username, address, email, password, role, created)
    VALUES ('22222222','Gestor de contenidos','Direccion','Gestor@gestor.com','$2y$10$R/d9zlAVF0X21yWYYaFSTORV3r7b6UXmWPNA69euZaR5zNau3u.NK','Gestor de contenidos',NOW());
INSERT INTO users (dni, username, address, email, password, role, created)
    VALUES ('33333333','Administrator','Direccion','Administrator@Administrator.com','$2y$10$/ryAXZZf5SAOTJsZvILpZOSy0Yo8AdYR6MLxhSt72rMnZpwgCm67e','Administrator',NOW());

UNLOCK TABLES;

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS subjects;

CREATE TABLE subjects (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	description VARCHAR(250),
	created DATETIME DEFAULT NULL,
	modified DATETIME DEFAULT NULL
);


LOCK TABLES `subjects` WRITE;

INSERT INTO subjects (name, description, created)
    VALUES ('Ingles B1','Asignatura de Ingles B1',NOW());
INSERT INTO subjects (name, description, created)
    VALUES ('Aleman B1','Asignatura de Aleman B1',NOW());
INSERT INTO subjects (name, description, created)
    VALUES ('Cocina B1','Asignatura de Cocina B1',NOW());

UNLOCK TABLES;
/*----------------------------------------------------------*/

DROP TABLE IF EXISTS competences;

CREATE TABLE competences (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        subject_id INT(10) NOT NULL,
        name VARCHAR(50),
		description VARCHAR(250),
        created DATETIME DEFAULT NULL,
        modified DATETIME DEFAULT NULL
);

LOCK TABLES `competences` WRITE;

INSERT INTO competences (name, subject_id, description, created)
    VALUES ('Writing B1', '1', 'Asignatura de Ingles B1',NOW());
INSERT INTO competences (name, subject_id, description, created)
    VALUES ('Writing B1', '2','Asignatura de Aleman B1',NOW());
INSERT INTO competences (name, subject_id, description, created)
    VALUES ('Cortar B1', '3','Asignatura de Cocina B1',NOW());

UNLOCK TABLES;

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        subject_id INT(10) NOT NULL,
        name VARCHAR(50),
		description VARCHAR(250),
        created DATETIME DEFAULT NULL,
        modified DATETIME DEFAULT NULL
);

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS usercompetencecategories;

CREATE TABLE usercompetencecategories (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(10) NOT NULL,
        competence_id INT(10) NOT NULL,
        categorie_id INT(10) NOT NULL,
        booleannote VARCHAR(14),
        numericnote INT(4),
        created DATETIME DEFAULT NULL,
        modified DATETIME DEFAULT NULL
);


/*----------------------------------------------------------*/

DROP TABLE IF EXISTS contents;

CREATE TABLE contents (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        competence_id INT(10) NOT NULL,
        name VARCHAR(50),
		description VARCHAR(250),
        created DATETIME DEFAULT NULL,
        modified DATETIME DEFAULT NULL
);

/*----------------------------------------------------------*/

DROP TABLE IF EXISTS file;

CREATE TABLE file (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        content_id INT(10) NOT NULL,
        name VARCHAR(50),
		store VARCHAR(250),
        created DATETIME DEFAULT NULL,
        modified DATETIME DEFAULT NULL
);
