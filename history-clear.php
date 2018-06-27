<?php

  require('config.php');
  require('models/history.php');

  history_clear();	
  header('Location: ' . HOST . 'history.php');


?>