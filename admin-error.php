<?php

require('config.php');
require('database.php');
require('models/films.php');
require('functions/session_tools.php');


$actionResult = array();
$addErrors = array();

$actionResult['error'] = 'Необходимы права администратора.';

$active_page = "admin-error.php";
$pageTitle = 'Ошибка доступа';
include('views/head.tpl');
include('views/notifications.tpl');
include('views/footer.tpl');

?>
