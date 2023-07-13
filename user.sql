-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `db_user`;

-- Switch to the database
USE `db_user`;

-- Create the `users` table
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;