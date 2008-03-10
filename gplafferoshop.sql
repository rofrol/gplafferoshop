DROP DATABASE IF EXISTS gplafferoshop;
CREATE DATABASE gplafferoshop;
USE gplafferoshop;
CREATE TABLE products (
   products_id int NOT NULL auto_increment,
   name varchar(128) NOT NULL,
   PRIMARY KEY (products_id)
);
CREATE TABLE customers (
   customers_id int NOT NULL auto_increment,
   name varchar(128) NOT NULL,
   PRIMARY KEY (customers_id)
);

INSERT INTO products VALUES ( '1', 'lada');

INSERT INTO customers VALUES ( '1', 'Jan');