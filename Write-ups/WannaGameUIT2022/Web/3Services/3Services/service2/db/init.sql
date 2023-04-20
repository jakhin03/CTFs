CREATE USER 'user2'@'%' IDENTIFIED WITH mysql_native_password BY 'user2password';

CREATE DATABASE IF NOT EXISTS user2_db;
GRANT ALL PRIVILEGES ON user2_db.* TO 'user2'@'%';

USE user2_db;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
);