DROP DATABASE IF EXISTS gplafferoshop;
CREATE DATABASE gplafferoshop;
USE gplafferoshop;
CREATE TABLE products (
   id int NOT NULL auto_increment,
   name varchar(128) NOT NULL,
   PRIMARY KEY (id)
);
CREATE TABLE customers (
   id int NOT NULL auto_increment,
   name varchar(128) NOT NULL,
   PRIMARY KEY (id)
);

INSERT INTO products VALUES ( '1', 'lada');

INSERT INTO products VALUES ( '2', 'piec');

INSERT INTO customers VALUES ( '1', 'Jan');

INSERT INTO customers VALUES ( '2', 'Marek');