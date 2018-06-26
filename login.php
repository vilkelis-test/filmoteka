<?php

require('config.php');
require('functions/session_tools.php');

$actionResult = array();
$addErrors = array();

if ( isset($_POST['login']) ) {
	$userName = 'admin';
	$userPassword = '123456';

	if ( $_POST['username'] == $userName ) {
		if ( $_POST['userpassword'] == $userPassword ) {

			$_SESSION['user'] = 'admin';
			header('Location: ' . HOST . 'index.php');
		}
	}
	else{
	$addErrors[] = 'Неверное имя пользователя или пароль';
	}

}


$active_page = "login.php";
$pageTitle = 'Вход администратора';
include('views/head.tpl');
include('views/notifications.tpl');
include('views/login.tpl');
include('views/footer.tpl');

?>

