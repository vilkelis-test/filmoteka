<?php

require('config.php');
require('database.php');
require('models/films.php');
require('functions/session_tools.php');

$actionResult = array();
$addErrors = array();

$link = db_connect();
$film = film_one($link,$_GET['id']);
if ( !array_key_exists('id', $film) )
{
	$actionResult['error'] = 'Фильм не найден. Возможно он был удален другим пользователем.';
}

$active_page = "one.php";
$pageTitle = 'Просмотр фильма';
include('views/head.tpl');
include('views/notifications.tpl');

if ( array_key_exists('id', $film) )
{
	include('views/film-one.tpl');
}

include('views/footer.tpl');

?>
