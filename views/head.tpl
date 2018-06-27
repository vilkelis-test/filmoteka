<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <title><?=$pageTitle?></title>
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <![endif]-->
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/><!-- build:cssVendor css/vendor.css -->
    <link rel="stylesheet" href="libs/normalize-css/normalize.css"/>
    <link rel="stylesheet" href="libs/bootstrap-4-grid/grid.min.css"/>
    <link rel="stylesheet" href="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.css"/><!-- endbuild -->
<!-- build:cssCustom css/main.css -->
    <link rel="stylesheet" href="./css/main.css"/><!-- endbuild -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic-ext" rel="stylesheet">
<!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="container user-content pt-35">
      <div class="header__nav ml-0 mb-30"> 
        <?php if ( @$active_page == "index.php") { ?>
          <span class="header__nav-link header__nav-link--active">Все фильмы</span>
        <?php }else{  ?>
          <a class="header__nav-link" href="index.php">Все фильмы</a>
        <?php } ?>
   
        <?php if ( @$active_page == "history.php") { ?>
          <span class="header__nav-link header__nav-link--active">История</span>
        <?php }else{  ?>
          <a class="header__nav-link" href="history.php">История</a>
        <?php } ?>

        <?php 
        if ( isAdmin() ) {
                if ( @$active_page == "new.php") { ?> 
           <span class="header__nav-link header__nav-link--active">Добавить фильм</span>
          <?php }else{  ?>
            <a class="header__nav-link" href="new.php">Добавить фильм</a>
          <?php }  
         } ?>


          <?php 
          if ( !isAdmin() ) {
               if ( @$active_page == "login.php") { ?> 
           <span class="header__nav-link header__nav-link--active">Вход админ.</span>
          <?php }else{  ?>
            <a class="header__nav-link" href="login.php">Вход админ.</a>
          <?php } 
           } ?>



          <?php 
          if ( isAdmin() ) {
               if ( @$active_page == "logout.php") { ?> 
           <span class="header__nav-link header__nav-link--active">Выход</span>
          <?php }else{  ?>
            <a class="header__nav-link" href="logout.php">Выход</a>
          <?php } 
           } ?>

      </div>
