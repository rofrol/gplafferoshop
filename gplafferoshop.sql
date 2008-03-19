# FOREIGN KEY: http://dev.mysql.com/doc/refman/5.0/en/innodb-foreign-key-constraints.html

DROP DATABASE IF EXISTS gplafferoshop;
CREATE DATABASE gplafferoshop;
USE gplafferoshop;
CREATE TABLE products (
   products_id int NOT NULL auto_increment,
   products_name varchar(128) NOT NULL,
   products_price decimal(15,4) NOT NULL,
   PRIMARY KEY (products_id)
) ENGINE=INNODB;

CREATE TABLE customers (
   customers_id int NOT NULL auto_increment,
   customers_name varchar(128) NOT NULL,
   PRIMARY KEY (customers_id)
) ENGINE=INNODB;

# czy products_id nie musi byc NOT NULL?
CREATE TABLE transactions (
   transactions_id int NOT NULL auto_increment,
   transactions_date date,
   products_id int,
   transactions_price decimal(15,4) NOT NULL,
   transactions_quantity int NOT NULL,
   customers_id int,
   PRIMARY KEY (transactions_id),
   INDEX ind_products_id (products_id),
   FOREIGN KEY (products_id) REFERENCES products(products_id)
     ON DELETE CASCADE
) ENGINE=INNODB;


INSERT INTO products VALUES ( '1', 'lada', '20.33');
INSERT INTO products VALUES ( '2', 'piec', '23.20');

INSERT INTO customers VALUES ( '1', 'Jan');
INSERT INTO customers VALUES ( '2', 'Marek');

INSERT INTO transactions VALUES ( '1', '2008-03-12', '1', '23.5', '2', '1');
INSERT INTO transactions VALUES ( '2', '2008-03-03', '2', '25.32', '1', '2');

