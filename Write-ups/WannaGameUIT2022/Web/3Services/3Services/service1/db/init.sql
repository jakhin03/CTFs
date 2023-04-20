CREATE USER 'user1'@'%' IDENTIFIED WITH mysql_native_password BY 'user1password';

CREATE DATABASE IF NOT EXISTS user1_db;
GRANT ALL PRIVILEGES ON user1_db.* TO 'user1'@'%';

USE user1_db;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(20) UNIQUE NOT NULL,
  `password` varchar(32) NOT NULL,
  `num` int(6) NOT NULL,
  `hobby` varchar(32) NOT NULL
);

CREATE TABLE `user_images` (
  `username` varchar(20) UNIQUE NOT NULL,            
  `image` varchar(30) NOT NULL 
);

INSERT INTO `users` (`username`, `password`, `num`, `hobby`) VALUES('admin', md5('REDACTED'), 1999, 'no');

INSERT INTO `user_images` (`username`, `image`) VALUES('admin', '');