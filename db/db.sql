DROP DATABASE lamp2project_group2 IF EXISTS;
CREATE DATABASE lamp2project_group2 default charset utf8;



GRANT all privileges ON lamp2project_group2.* TO 'lamp2user'@'localhost' IDENTIFIED BY '!Lamp2!';  
GRANT all privileges ON lamp2project_group2.* TO 'lamp2user'@'127.0.0.1' IDENTIFIED BY '!Lamp2!';  
GRANT all privileges ON lamp2project_group2.* TO 'lamp2user'@'::1' IDENTIFIED BY '!Lamp2!';  

USE lamp2project_group2;

CREATE TABLE Ipath1(
	id int(11) not null auto_increment,
	
	primary key (id)
);