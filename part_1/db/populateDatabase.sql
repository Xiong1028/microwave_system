
INSERT INTO `path_general`(path_name,path_length,description, note) 
VALUES ('Pah 01',13.0,'Demonstration path','A note about path 1, the first demo path'),
 ('Pah 02',10.0,'Demonstration1 path1','A note about path 1, the second demo path'),
 ('Pah 03',12.0,'Demonstration2 path2','A note about path 1, the third demo path'),
 ('Pah 04',11.0,'Demonstration3 path3','A note about path 1, the fifthy demo path');
--set @varIdPath = LAST_INSERT_ID();

INSERT INTO `path_endPoints`(path_ID,dist_from_start,grd_height, atn_height) 
VALUES (1,0,50,40),
 (2,0,55,41),
 (3,0,58,42),
 (4,0,57,43);

INSERT INTO `path_midPoints`(path_ID,dist_from_start,grd_height, trn_type,obstr_height,obstr_type)
VALUES(1,0.1,50,'Grassland',10,'Trees'),
(1,0.2,45,'Grassland',1,'Brush'),
(2,0.3,48,'Rough rock',0,'None'),
(2,0.4,52,'Rough rock',0,'None'),
(1,0.5,60,'Smooth rock',0,'None'),
(2,0.6,61,'Grassland',20,'Trees'),
(1,0.7,60,'Lake',0,'None'),
(1,0.8,60,'Lake',0,'None'),
(2,0.9,60,'Lake',0,'None'),
(2,1,61,'Rough rock',5,'Building'),
(1,1.1,70,'Bare soil',2,'Trees'),
(1,1.2,53,'Grassland',10,'Trees'),
(2,1.3,66,'Grassland',20,'Trees'),
(2,1.4,80,'Grassland',3,'Trees');

