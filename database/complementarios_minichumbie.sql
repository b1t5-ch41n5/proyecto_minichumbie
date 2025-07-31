
drop database if exists complementarios_minichumbie ; 
create database if not exists complementarios_minichumbie; 
use complementarios_minichumbie;
create table credenciales (
id_usuario tinyint primary key auto_increment,
nombre_de_usuario varchar(20) not null, 
hash_de_contrasena varchar(64) not null
);


create table categoria (
id_categoria int  primary key auto_increment,
nombre_de_categoria varchar(20) not null
);

create table  acceso_usuario (
id_registro int not null primary key auto_increment ,
id_user tinyint not null , 
id_categoria int not null,
FOREIGN KEY (id_user) REFERENCES  credenciales(id_usuario)  ON UPDATE CASCADE,
FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria) ON UPDATE CASCADE
);



create table fabricante_aditivos (
id_fab int primary key auto_increment,
id_categoria int not null ,
nombre varchar(20) not null ,
foreign key (id_categoria) REFERENCES categoria(id_categoria)
);

create table fabricante_lubricantes (
id_fab tinyint primary key auto_increment,
id_categoria int not null ,
nombre varchar(20) not null ,
foreign key (id_categoria) REFERENCES categoria(id_categoria)
);



create table aditivos_item (
id_aditivo int primary key auto_increment,
id_fabricante int not null, 
referencia varchar(50) not null,
id_categoria int not null,
disponibles tinyint not null,
precio int not null,
FOREIGN KEY (id_categoria) references  categoria(id_categoria) on update cascade,
FOREIGN KEY (id_fabricante) REFERENCES fabricante_aditivos(id_fab) ON UPDATE CASCADE
);

create table aditivos_imagenes (
id_imagen int primary key auto_increment,
id_item int not null , 
ubicacion  varchar(70) ,
FOREIGN KEY (id_item) REFERENCES  aditivos_item(id_aditivo) on update cascade 
);

create table lubricante_item (
id_lubricante int primary key auto_increment,
id_fabricante tinyint not null, 
referencia varchar(50) not null,
id_categoria int not null,
disponibles tinyint not null,
precio int not null ,
FOREIGN KEY (id_fabricante) references  fabricante_lubricantes(id_fab) on update cascade
);
 
create table ventaAditivos(
id_venta int primary key auto_increment, 
id_categoria int not null ,
id_item int not null,
precio int not null , 
fecha_de_la_venta timestamp DEFAULT current_timestamp,
foreign KEY (id_item) REFERENCES aditivos_item(id_aditivo) on update cascade,
foreign key (id_categoria) REFERENCES categoria(id_categoria) on update cascade 
);


INSERT INTO credenciales VALUES(0,'mini' ,'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f') ;

insert into categoria values (0,'Lubricantes'), (0,'Aditivos'); 

INSERT INTO acceso_usuario VALUES(0,1,1);
INSERT INTO acceso_usuario VALUES(0,1,2);

insert into fabricante_aditivos VALUES (0,2,'crc');
insert into fabricante_aditivos VALUES (0,2,'petrolabs');
insert into fabricante_aditivos VALUES (0,2,'simoniz');


select * from fabricante_aditivos ;

insert into aditivos_item values(0,1,'crc ecologico',2,10,20000);
insert into aditivos_item values(0,1,'crc 6 en 1',2,10,20000);
insert into aditivos_item values(0,1,'crc aditivo gasolina',2,10,20000);
insert into aditivos_item values(0,1,'crc super octane',2,10,20000);
insert into aditivos_item values(0,1,'crc limpiador de inyectores',2,10,20000);

INSERT INTO aditivos_imagenes VALUES (0,1,'crc-ecologico.jpg');
INSERT INTO aditivos_imagenes VALUES (0,2,'crc-6 en 1.jpg');
INSERT INTO aditivos_imagenes VALUES (0,3,'crc-aditivo gasolina.jpg');
INSERT INTO aditivos_imagenes VALUES (0,4,'crc-super octane.jpg');
INSERT INTO aditivos_imagenes VALUES (0,5,'crc-limpiador inyectores.jpg');

insert into aditivos_item values(0,2,'petrolabs power diesel',2,10,12000);
insert into aditivos_item values(0,2,'petrolabs super concentrado',2,10,12000);

INSERT INTO aditivos_imagenes VALUES (0,6,'petrolabs power diesel.jpg');
INSERT INTO aditivos_imagenes VALUES (0,7,'petrolabs super concentrado.jpg');


insert into aditivos_item values(0,3,'simoniz aditivo gazolina',2,10,20000);
insert into aditivos_item values(0,3,'simoniz limipiador de inyectores diesel',2,10,20000);
insert into aditivos_item values(0,3,'simoniz limipiador de inyectores carburador',2,10,20000);
insert into aditivos_item values(0,3,'simoniz mejorador de oactanaje',2,10,20000);

INSERT INTO aditivos_imagenes VALUES (0,8,'simoniz aditivo gasolina.jpg');
INSERT INTO aditivos_imagenes VALUES (0,9,'simoniz limpiador de inyectores diesel.jpg');
INSERT INTO aditivos_imagenes VALUES (0,10,'simoniz limpiador de inyectores y carburador.jpg');
INSERT INTO aditivos_imagenes VALUES (0,11,'simoniz mejorador de octanaje.jpg');
