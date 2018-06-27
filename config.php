<?php

	define('MYSQL_SERVER','localhost');
	define('MYSQL_USER','root');
	define('MYSQL_PASSWORD','');
	define('MYSQL_DB','filmoteka');
	define('HOST',"http://".$_SERVER['HTTP_HOST']."/");
	define('ROOT',dirname(__FILE__)."/");
	define('HISTORY_LENGHT',5);
	session_start(); 
?>