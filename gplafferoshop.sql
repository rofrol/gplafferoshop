# FOREIGN KEY: http://dev.mysql.com/doc/refman/5.0/en/innodb-foreign-key-constraints.html

DROP DATABASE IF EXISTS gplafferoshop;
CREATE DATABASE gplafferoshop;
USE gplafferoshop;
CREATE TABLE products (
   id int NOT NULL auto_increment,
   name varchar(128) NOT NULL,
   price decimal(15,4) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE customers (
   id int NOT NULL auto_increment,
   name varchar(128) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=INNODB;

# czy products_id nie musi byc NOT NULL?
CREATE TABLE transactions (
   id int NOT NULL auto_increment,
   tdate date,
   products_id int,
   price decimal(15,4) NOT NULL,
   quantity int NOT NULL,
   customers_id int,
   PRIMARY KEY (id),
   INDEX ind_products_id (products_id),
   FOREIGN KEY (products_id) REFERENCES products(id)
     ON DELETE CASCADE
) ENGINE=INNODB;


INSERT INTO products VALUES ( '1', 'lada', '20.33');
INSERT INTO products VALUES ( '2', 'piec', '23.20');

INSERT INTO customers VALUES ( '1', 'Jan');
INSERT INTO customers VALUES ( '2', 'Marek');

INSERT INTO transactions VALUES ( '1', '2008-03-12', '1', '23.5', '2', '1');
INSERT INTO transactions VALUES ( '2', '2008-03-03', '2', '25.32', '1', '2');

