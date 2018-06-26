<?php

require('config.php');
require('database.php');
require('models/films.php');
require('functions/session_tools.php');

$actionResult = array();


$link = db_connect();

include('delete.php');

$films = films_all($link);


$active_page = "index.php";
$pageTitle = 'Фильмотека';
include('views/head.tpl');
include('views/notifications.tpl');
include('views/index.tpl');
include('views/footer.tpl');

?>

