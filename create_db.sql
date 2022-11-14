CREATE DATABASE IF NOT EXISTS bonappetit;
USE bonappetit;

CREATE TABLE IF NOT EXISTS user_type (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(20) NOT NULL,
	UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS user (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email varchar(75) NOT NULL,
	first_name varchar(50) NOT NULL,
	last_name varchar(50) NOT NULL,
	password varchar(150) NOT NULL,
	user_type INT NOT NULL,
	date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	status TINYINT NOT NULL,
	FOREIGN KEY (user_type) REFERENCES user_type(id)
);

CREATE TABLE IF NOT EXISTS menu_category (
	name varchar(50) NOT NULL PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS menu_item (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(30) NOT NULL,
	description varchar(250) DEFAULT NULL,
	price  DECIMAL(10,2) NOT NULL,
	active TINYINT NOT NULL DEFAULT 1,
	category varchar(50) NOT NULL,
	UNIQUE (name),
	FOREIGN KEY (category) REFERENCES menu_category(name)
);

CREATE TABLE IF NOT EXISTS ingredient (
	name varchar(30) NOT NULL PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS menu_item_ingredient (
	menu_item INT NOT NULL,
	ingredient_name varchar(30) NOT NULL,
	serving_size DECIMAL(5,2) NOT NULL DEFAULT 1.0,
	FOREIGN KEY (menu_item) REFERENCES menu_item(id),
	FOREIGN KEY (ingredient_name) REFERENCES ingredient(name),
	PRIMARY KEY (menu_item, ingredient_name)
);

CREATE TABLE IF NOT EXISTS restaurant (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(30) NOT NULL,
	address varchar(120) NOT NULL,
	cuisine_type varchar(30) NOT NULL,
	back_story varchar(1500) NOT NULL
);

CREATE TABLE IF NOT EXISTS restaurant_table (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	table_number INT NOT NULL,
	max_chairs INT NOT NULL,
	restaurant_id INT NOT NULL,
	UNIQUE (table_number, restaurant_id),
	FOREIGN KEY (restaurant_id) REFERENCES restaurant(id)
);

CREATE TABLE IF NOT EXISTS reservation_table (
	reservation_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	reservation_date DATE NOT NULL,
	reservation_time TIME NOT NULL,
	name varchar(50) NOT NULL,
	phone varchar(50) NOT NULL,
	email varchar(75) NOT NULL,
	restaurant_table_id INT DEFAULT NULL,
	party_size INT NOT NULL,
	FOREIGN KEY (restaurant_table_id) REFERENCES restaurant_table(id)  
);

create user 'bonappetit'@'localhost' identified by 'bonappetit';
grant ALL on bonappetit.* to 'bonappetit'@'localhost';