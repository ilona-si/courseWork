<?php
$dbhost = "localhost"; 			// Имя хоста БД
$dbusername = "root"; 			// Пользователь БД
$dbpass = ""; 					// Пароль к базе
$dbname = "shop_db"; 				// Имя базы
$db = mysql_connect ($dbhost, $dbusername, $dbpass); 
	if (!$db)
		echo ("Не могу подключиться к серверу базы данных!");
	if(!@mysql_select_db($dbname)) 
		die ("Не могу подключиться к базе данных $dbname!");
mysql_query("SET NAMES 'cp1251'");
mysql_query("SET CHARACTER SET 'cp1251'");
?>