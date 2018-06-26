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
if (array_key_exists('update-film', $film) and array_key_exists('id', $_GET) ) {

    $film['id'] =  $_GET['id'];
    $addErrors = film_check($link,$film);  
	 
	if ( count($addErrors) == 0 ) {
		$old_film = film_one($link,$film['id']);
  		$film['photo_file'] = $old_film['photo_file'];
		$file_upload_res = film_photo_load($_FILES, $film['photo_file']);
		if (count($file_upload_res['errors']) > 0){
          $addErrors = $file_upload_res['errors'];
		} elseif ($file_upload_res['loaded'] == true) {
		  $film['photo_file'] = $file_upload_res['db_file_name'];
		}
	}

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

$active_page = "edit.php";
$pageTitle = 'Редактировать фильм';
include('views/head.tpl');
include('views/notifications.tpl');
if ( array_key_exists('id', $film) )
{
	include('views/edit-film.tpl');
}
include('views/footer.tpl');

?>

