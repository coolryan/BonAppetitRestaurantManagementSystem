-- Filename: create_db.sql
-- Author: Ryan Setaruddin
-- BCS 350- Web Database Developement
-- Professor Kaplan
-- Date: Novermber 26, 2022
-- Purpose: To create databases and tables

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
	phone varchar(20) default null
	first_name varchar(50) NOT NULL,
	last_name varchar(50) NOT NULL,
	password varchar(150) NOT NULL,
	user_type INT NOT NULL,
	date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	status TINYINT NOT NULL,
	FOREIGN KEY (user_type) REFERENCES user_type(id)
);

-- Categories to separate menu items
CREATE TABLE IF NOT EXISTS menu_category (
	name varchar(50) NOT NULL PRIMARY KEY
);

-- Items available on the meu
CREATE TABLE IF NOT EXISTS menu_item (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(30) NOT NULL,
	description varchar(250) DEFAULT NULL,
	price DECIMAL(10,2) NOT NULL,
	active TINYINT NOT NULL DEFAULT 1,
	category varchar(50) NOT NULL,
	image_path varchar(100),
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
	restaurant_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(30) NOT NULL,
	address varchar(120) NOT NULL,
	cuisine_type varchar(30) NOT NULL,
	back_story varchar(1500) NOT NULL
);

-- Tables available at restaurants
CREATE TABLE IF NOT EXISTS restaurant_table (
	restaurant_table_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	table_number INT NOT NULL,
	max_chairs INT NOT NULL,
	restaurant_id INT NOT NULL,
	UNIQUE (table_number, restaurant_id),
	FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id)
);

-- Reservations for eating at the restaurant
CREATE TABLE IF NOT EXISTS reservation_table (
	reservation_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	party_size INT NOT NULL,
	reservation_date DATE NOT NULL,
	reservation_time TIME NOT NULL,
	patron_name varchar(50) NOT NULL,
	patron_phone varchar(50) NOT NULL,
	patron_email varchar(75) NOT NULL,
	restaurant_table_id INT DEFAULT NULL,
	FOREIGN KEY (restaurant_table_id) REFERENCES restaurant_table(restaurant_table_id)  
);

CREATE TABLE IF NOT EXISTS staff_schedule (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_id INT NOT NULL,
	start_datetime DATETIME NOT NULL,
	end_datetime DATETIME NOT NULL,
	FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS meal_order (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	restaurant_table_id INT DEFAULT NULL,
	in_store TINYINT NOT NULL DEFAULT 1,
	server_id INT DEFAULT NULL,
	order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	tip DECIMAL(10,2) NOT NULL,
	FOREIGN KEY (server_id) REFERENCES user(id),
	FOREIGN KEY (restaurant_table_id) REFERENCES restaurant_table(restaurant_table_id)
);

-- Specific items related to an order
CREATE TABLE IF NOT EXISTS meal_order_menu_item (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	meal_order_id INT NOT NULL,
	menu_item_id INT,
	instructions varchar(250) DEFAULT NULL,
	FOREIGN KEY (meal_order_id) REFERENCES meal_order(id),
	FOREIGN KEY (menu_item_id) REFERENCES menu_item(id)
);

create user 'bonappetit'@'localhost' identified by 'bonappetit';
grant ALL on bonappetit.* to 'bonappetit'@'localhost';