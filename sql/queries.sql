CREATE DATABASE test1_mysql;

CREATE TABLE `Users` (
                        `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                        `NAME` varchar(255) NOT NULL,
                        `MAIL` varchar(255) NOT NULL,
                        `PASSWORD` varchar(255) NOT NULL,
                        `ROLE_ID` int(10) NOT NULL,
                        PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO Users (ID, NAME, MAIL, PASSWORD, ROLE_ID) VALUES ('1','Сергей','test@mail.ru','123456','1');
INSERT INTO Users (ID, NAME, MAIL, PASSWORD, ROLE_ID) VALUES ('2','Алексей','test2@mail.ru','654321','1');

CREATE TABLE `Roles` (
                        `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
                        `ROLE` varchar(255) NOT NULL,
                        PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO Roles (ROLE) VALUES ('Админ');
INSERT INTO Roles (ROLE) VALUES ('Гость');


