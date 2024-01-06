CREATE DATABASE PRUEBA;
USE PRUEBA;
create table producto (
	codproducto INT PRIMARY KEY NOT NULL,
    producto VARCHAR(50) NOT NULL,
    fkcategoria INT NOT NULL,
    
    CONSTRAINT producto FOREIGN KEY (fkcategoria) REFERENCES categorias (codcategoria)
);

create table categorias (
	codcategoria INT PRIMARY KEY NOT NULL,
    categoria VARCHAR(50) NOT NULL
);

DELIMITER $$
CREATE PROCEDURE sp_MostrarProducto (IN __codproducto INT) 
BEGIN 
	SELECT producto.codproducto AS 'codigo', producto.producto, categorias.categoria FROM producto 
	INNER JOIN categorias ON producto.fkcategoria = categorias.codcategoria WHERE codproducto = __codproducto; 
END;
$$

call sp_MostrarProducto(2);