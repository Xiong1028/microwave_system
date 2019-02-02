DROP DATABASE IF EXISTS lamp2project_group2;
CREATE DATABASE lamp2project_group2 default charset utf8;


DROP user IF EXISTS 'lamp2user'@'localhost';
DROP user IF EXISTS 'lamp2user'@'127.0.0.1';
DROP user IF EXISTS  'lamp2user'@'::1';

GRANT all privileges ON lamp2project_group2.* TO 'lamp2user'@'localhost' IDENTIFIED BY 'Test123!';
GRANT all privileges ON lamp2project_group2.* TO 'lamp2user'@'127.0.0.1' IDENTIFIED BY 'Test123!';
GRANT all privileges ON lamp2project_group2.* TO 'lamp2user'@'::1' IDENTIFIED BY 'Test123!'; 


USE lamp2project_group2;

DROP TABLE IF EXISTS `path_general`;
CREATE TABLE `path_general`
(
	`path_ID` int(11) not null auto_increment,
	`path_name` varchar(100) not null unique,
	`path_length` float(3,1) not null,
	`description` text not null,
	`note`	text,
	 primary key (`path_ID`)
);


DROP TABLE IF EXISTS `path_ends`;
CREATE TABLE `path_ends`
(
	`path_ends_ID` int(11) not null auto_increment,
	`path_ID` int(11) not null,
	`distance_from_start` float(3,1) not null,
	`ground_height` float(3,1) not null,
	`antenna_height` float(3,1) not null,
	primary key(`path_ends_ID`),
	FOREIGN KEY(`path_ID`) REFERENCES path_general(`path_ID`)
);


DROP TABLE IF EXISTS `path_midPoint`;
CREATE TABLE `path_midPoint`
(
	`path_midpoint_ID` int(11) not null auto_increment,
	`path_ID` int(11) not null,
	`distance_from start` float(3,1) not null,
	`ground_height` float(3,1) not null,
	`terrain_type` varchar(50) not null,
	`obstruction_height` float(3,1) not null,
	`obstruction_type` varchar(50) not null,
	primary key(`path_midpoint_ID`),
	FOREIGN KEY(`path_ID`) REFERENCES path_general(`path_ID`)
);
