CREATE TABLE IF NOT EXISTS `students` (
    `id_student` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(50),
    `cc` varchar(25) NOT NULL,
    `schedule` int(25) NOT NULL,
    `email` varchar(100),
    PRIMARY KEY (`id_student`)
)  ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

INSERT INTO `students` (`name`,`cc`,`schedule`,`email`) VALUES
('roberto','123456789', 1,'roberto@email.com'),
('david','142357689', 1,'david@email.com'),
('cirstian','342517688', 1,'cristian@email.com'),
('javier','9685463128', 1,'javier@email.com'),
('sebastian','123987654', 1,'sabastian@email.com'),
('moises','456732180', 1,'moises@email.com'),
('roberto','231458670', 1,'robertorc@email.com'),
('beatriz','1029837465', 1,'beatriz@email.com'),
('elena','120934765', 1,'elena@email.com');

CREATE TABLE IF NOT EXISTS `examens`(
    `id_examen` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `score` int(25) NOT NULL,
    `id_subject` smallint(5) unsigned,
    `exam_name` varchar(250),
    `id_student` smallint(5) unsigned,
    FOREIGN KEY (`id_student`) REFERENCES `students`(`id_student`),
    FOREIGN KEY (`id_subject`) REFERENCES `subjtects`(`id_subject`),
    PRIMARY KEY (`id_examen`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `examens`(`score`,`subject`,`exam_name`,`id_student`)VALUES
(2,4,'to write somthing',8),
(1,5,'hacer un milagro',2),
(5,1,'calcular algo',1),
(5,2,'describir toda la existencia',5),
(5,2,'describir toda la existencia',6),
(5,1,'calcular algo',4),
(2,4,'to write somthing',3),
(1,5,'hacer un milagro',7),
(2,4,'to write somthing',8),
(1,5,'hacer un milagro',1),
(5,1,'calcular algo',3),
(5,2,'describir toda la existencia',5);

CREATE TABLE IF NOT EXISTS `subjtects`(
    `id_subjtect` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `name`varchar(50) NOT NULL,
    PRIMARY KEY (`id_subjtect`)
    )ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `subjtects`(`name`) VALUES
('matematicas'),
('fisica'),
('Quimica'),
('ingles'),
('religion');