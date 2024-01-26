CREATE DATABASE tienda;
USE tienda;

CREATE TABLE usuarios(
id int(255) NOT NULL AUTOINCREMENT,
nombre varchar(100) NOT NULL,
apellidos varchar(255),
email varchar(255) NOT NULL,
telefono varchar(255),
password varchar(255) NOT NULL,
rol varchar(20),
imagen varchar(255),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;

INSERT INTO usuarios VALUES(NULL, 'Admin', '', 'admin@admin.com', '123', 'admin', NULL);

CREATE TABLE pedidos(
id int(255) NOT NULL AUTOINCREMENT,
usuario_id int(255) NOT NULL,
direccion varchar(255),
coste flaot(200,2) NOT NULL,
estado varchar(20) NOT NULL,
fecha date NOT NULL,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB;

CREATE TABLE categorias(
id int(255) NOT NULL AUTOINCREMENT,
nombre varchar(100) NOT NULL,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE productos(
id int(255) NOT NULL AUTOINCREMENT,
categoria_id int(255) NOT NULL,
nombre varchar(100) NOT NULL,
descripcion varchar(255),
precio float(100,2) NOT NULL,
stock int(255) NOT NULL,
aferta varchar(2),
fecha date NOT NULL,
imagen varchar(255),
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDB;

CREATE TABLE lineas_pedidos(
id int(255) NOT NULL AUTOINCREMENT,
pedido_id int(255) NOT NULL,
producto_id int(255) NOT NULL,
unidades int(255) NOT NULL,
CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDB;
