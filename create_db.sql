CREATE DATABASE IF NOT EXISTS bonappetit;
USE bonappetit;

CREATE TABLE IF NOT EXISTS user_types (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(20) NOT NULL,
	UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS users (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email varchar(75) NOT NULL,
	first_name varchar(50) NOT NULL,
	last_name varchar(50) NOT NULL,
	password varchar(150) NOT NULL,
	user_type INT NOT NULL,
	date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
	status TINYINT NOT NULL,
	FOREIGN KEY (user_type) REFERENCES user_types(id)
);

create user 'bonappetit'@'localhost' identified by 'bonappetit';
grant ALL on bonappetit.* to 'bonappetit'@'localhost';