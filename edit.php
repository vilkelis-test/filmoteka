<?php

require('config.php');
require('database.php');
require('models/films.php');

$actionResult = array();
$addErrors = array();

$link = db_connect();

$film = $_POST;
if (array_key_exists('update-film', $film) and array_key_exists('id', $_GET) ) {

    $film['id'] =  $_GET['id'];
    $addErrors = film_check($link,$film);
	 
	if ( count($addErrors) == 0 ) {
		$result = film_update($link, $film);
		if ( $result ) {
			$actionResult['info'] = "Фильм был успешно изменен!";
		} else { 
			$actionResult['error'] = "Ошибка изменения фильма!";
		}
	}
}

if( count($addErrors) > 0){
	$film = $_POST;
	$film['id'] = $_GET['id'];
}
else{
	$film = film_one($link, $_GET['id']);

	if ( !array_key_exists('id', $film) )
	{
			$actionResult['error'] = 'Фильм не найден. Возможно он был удален другим пользователем.';
	}
}

$pageTitle = 'Редактировать фильм';
include('views/head.tpl');
include('views/notifications.tpl');
if ( array_key_exists('id', $film) )
{
	include('views/edit-film.tpl');
}
include('views/footer.tpl');

?>

