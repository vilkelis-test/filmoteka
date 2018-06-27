<?php

require('config.php');
require('database.php');
require('models/films.php');
require('models/history.php');
require('functions/session_tools.php');

$actionResult = array();

$link = db_connect();

include('delete.php');

$films = array();
$history = history_all();
foreach($history as $index => $filmId){
  $film = film_one($link, $filmId);
  array_push($films,$film);
}

$active_page = "history.php";
$pageTitle = 'История';
include('views/head.tpl');
include('views/notifications.tpl');
include('views/history.tpl');
include('views/footer.tpl');

?>
