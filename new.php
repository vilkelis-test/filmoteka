<?php

require('config.php');
require('database.php');
require('models/films.php');
require('functions/session_tools.php');

if (!isAdmin())
{	
    header('Location: ' . HOST . 'admin-error.php');
    return false;
}

$actionResult = array();
$addErrors = array();

$link = db_connect();

$film = $_POST;
if ( array_key_exists('add-film', $film) ) {
	
    $addErrors = film_check($link,$film);
	 
    $film['photo_file'] = '';
	if ( count($addErrors) == 0 ) {
		$file_upload_res = film_photo_load($_FILES, $film['photo_file']);
		if (count($file_upload_res['errors']) > 0){
          $addErrors = $file_upload_res['errors'];
		} else {
		  $film['photo_file'] = $file_upload_res['db_file_name'];
		}
	}

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

$active_page = "new.php";
$pageTitle = 'Новый фильм';
include('views/head.tpl');
include('views/notifications.tpl');
include('views/new-film.tpl');
include('views/footer.tpl');

?>