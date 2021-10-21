USE student_space;

-- 1.	Drop all tables in the correct order.
DROP TABLE orders;
DROP TABLE product;
DROP TABLE customer;
DROP TABLE registration;


-- 2.	Create all tables without any constraints 
CREATE TABLE product
(
	item_no			numeric(4),
	item_name		varchar(30),  
	price					numeric(9,2),  
	inventory			numeric		-- Number of this item currently in stock (Assume 5 for all)
);

CREATE TABLE customer
(
	cc_no				numeric(16),   
	exp_mo			numeric(2),   
	exp_yr				numeric(4),   
	name_first			varchar(20),   
	name_last 		varchar(20),   
	email				varchar(20),  
	address1			varchar(50),   
	address2			varchar(50),  
	city					varchar(20),   
	state				varchar(2),   
	zip					numeric(5),   
	country				varchar(20),
	phone				varchar(15),   
	fax					varchar(15),   
	mail_list			numeric(1)	--	Contains 1 – On mailing list
                                                --               0 -  Off mailing List
);

CREATE TABLE orders
(
	quantity			numeric,
	date_sold			date,
	item_no			numeric(4),  
	cc_no				numeric(16)   
);

CREATE TABLE registration
(
	username			varchar(16), 
	password			binary(16),   
	email				varchar(50)
);


-- 3.	Create all primary key constraints
ALTER TABLE product
	ADD CONSTRAINT product_item_no_pk PRIMARY KEY(item_no);

ALTER TABLE customer
	ADD CONSTRAINT customer_cc_no_pk PRIMARY KEY(cc_no);
	
ALTER TABLE orders
	ADD CONSTRAINT orders_item_cc_pk PRIMARY KEY(item_no, cc_no);
	
ALTER TABLE registration
	ADD CONSTRAINT registration_username_pk PRIMARY KEY(username);
	
	
-- 4.	Create all foreign key constraints 	
ALTER TABLE orders
	ADD CONSTRAINT orders_item_no_fk FOREIGN KEY(item_no)
	REFERENCES product(item_no);
	
ALTER TABLE orders
	ADD CONSTRAINT orders_cc_no_fk FOREIGN KEY(cc_no)
	REFERENCES customer(cc_no);	
	

-- 5.	Create all not null constraints
ALTER TABLE product
	MODIFY item_name varchar(30)   NOT NULL;
	
ALTER TABLE product
	MODIFY price numeric(9,2) NOT NULL;
	
ALTER TABLE product
	MODIFY inventory numeric NOT NULL;
	
COMMIT;


-- 6.	Insert all initial rows in product table for all products
INSERT INTO product
	VALUES(0, 'Moose Boots', 250.00, 5); 
	
INSERT INTO product
	VALUES(1, 'Caribou Skin Boots', 300.00, 5); 	
	
INSERT INTO product
	VALUES(2, 'Brown Rabbit Slippers', 150.00, 5); 	
	
INSERT INTO product
	VALUES(3, 'Snow Rabbit Slippers', 150.00, 5); 	
	
INSERT INTO product
	VALUES(4, 'Earring', 1000.00, 5); 	
	
INSERT INTO product
	VALUES(5, 'Necklace', 500.00, 5); 	
	
INSERT INTO product
	VALUES(6, 'Hair Clip', 75.00, 5); 	
	
INSERT INTO product
	VALUES(7, 'Pendant', 400.00, 5); 	
	
INSERT INTO product
	VALUES(8, 'Dog Sled', 1000.00, 5); 	
	
INSERT INTO product
	VALUES(9, 'Wood Carving', 500.00, 5); 	

INSERT INTO product
	VALUES(10, 'Wood Carving', 1500.00, 5); 	
	
INSERT INTO product
	VALUES(11, 'Ivory Carvings', 2500, 5); 	
	
COMMIT;
	
	
	
	
	
	
	
	
	
	
	
	
	