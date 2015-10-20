USE carpeta
;




CREATE TABLE imagen
(
	id INT NOT NULL AUTO_INCREMENT,
	dir VARCHAR(255) NOT NULL,
	id_carpeta INT NOT NULL,
	PRIMARY KEY (id),
	INDEX IXFK_imagen_carpeta (id_carpeta ASC)

) 
;


CREATE TABLE carpeta
(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(150) NOT NULL,
	id_perfil INT NOT NULL,
	PRIMARY KEY (id),
	INDEX IXFK_carpeta_perfil (id_perfil ASC)

) 
;


CREATE TABLE perfil
(
	id INT NOT NULL AUTO_INCREMENT,
	nombre_apellido VARCHAR(255) NOT NULL,
	Pais VARCHAR(150),
	email VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)

) 
;


CREATE TABLE usuario
(
	nickname VARCHAR(150) NOT NULL,
	id INT NOT NULL AUTO_INCREMENT,
	password VARCHAR(10) NOT NULL,
	id_perfil INT,
	PRIMARY KEY (id),
	UNIQUE UQ_usuario_nickname(nickname),
	INDEX IXFK_usuario_perfil (id_perfil ASC)

) 
;





ALTER TABLE imagen ADD CONSTRAINT FK_imagen_carpeta 
	FOREIGN KEY (id_carpeta) REFERENCES carpeta (id)
	ON DELETE NO ACTION ON UPDATE CASCADE
;

ALTER TABLE carpeta ADD CONSTRAINT FK_carpeta_perfil 
	FOREIGN KEY (id_perfil) REFERENCES perfil (id)
	ON DELETE NO ACTION ON UPDATE CASCADE
;

ALTER TABLE usuario ADD CONSTRAINT FK_usuario_perfil 
	FOREIGN KEY (id_perfil) REFERENCES perfil (id)
	ON DELETE NO ACTION ON UPDATE CASCADE
;
