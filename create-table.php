<?php

/*
* Autor: https://programistyczny.blogspot.com
*/

$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

$dbh->exec("CREATE TABLE IF NOT EXISTS `users` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `registered_timestamp` int(10) NOT NULL,
 `username` varchar(30) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(255) NOT NULL,
 `ip` varchar(100) NOT NULL,
 PRIMARY KEY (`id`)
 )");
