<?php

require('config.php');
require('database.php');
require('models/films.php');

$actionResult = array();
$addErrors = array();

$link = db_connect();

$film = $_POST;
if ( array_key_exists('add-film', $film) ) {
	
    $addErrors = film_check($link,$film);
	 
	if ( count($addErrors) == 0 ) {
		$result = film_create($link, $film);
		if ( $result ) {
			$actionResult['info'] = "Фильм был успешно добавлен!";
			$film = array();
		} else { 
			$actionResult['error'] = "Ошибка добавления фильма!";
		}
	}
}
else{
	$film = array();
}

$pageTitle = 'Добавить фильм';
include('views/head.tpl');
include('views/notifications.tpl');
include('views/new-film.tpl');
include('views/footer.tpl');

?>