<?php

 $addErrors = array();
 $actionResult = array();
 $film = array();
 
 $link = mysqli_connect('localhost','root','','filmoteka');

 if (mysqli_connect_error()) {
 	die('Ошибка подключения к базе данных');
 }  


if (array_key_exists('update-film', $_POST) and array_key_exists('id', $_GET) ) {


		if ($_POST['title'] == '') {
			$addErrors[] = 'Необходимо ввести название фильма.';
		}
		
		if ($_POST['genre'] == '') {
			$addErrors[] = 'Необходимо ввести жанр фильма.';
		}
		
		if ($_POST['year'] == '') {
			$addErrors[] = 'Необходимо ввести год фильма.';
		} elseif ( ! is_numeric($_POST['year']) ) {
			$addErrors[] = 'Год должен быть числом.';
		} elseif ( strlen($_POST['year']) > 11) {
			$addErrors[] = 'В поле год указано слишком большое число.';
		} 

		if (count($addErrors) == 0)
		{
			$query = "update films set 
			title = '".mysqli_real_escape_string($link, $_POST['title'])."',
			genre = '".mysqli_real_escape_string($link, $_POST['genre'])."',
			year = ".mysqli_real_escape_string($link, $_POST['year']).
			" where id = ".mysqli_real_escape_string($link, $_GET['id'])." LIMIT 1";

			if ($result = mysqli_query($link, $query)) {

				$actionResult['info'] = 'Запись изменена успешно.';

			} else {

				$actionResult['error'] = 'Ошибка изменения записи.';

			}

		}

}	

if ( ! array_key_exists('id', $_GET) ) {

	$actionResult['error'] = 'Не указан обязательный параметр';

}	else {

	$query = "select * from films where id = ".mysqli_real_escape_string($link, $_GET['id'])." LIMIT 1";

	if ($result = mysqli_query($link, $query)) {

		$film = mysqli_fetch_array($result);

		if ( mysqli_affected_rows($link) == 0)
		{
			$actionResult['error'] = 'Фильм не найден. Возможно он был удален другим пользователем.';
		}

	}

}

if( count($addErrors) > 0){
	 $film = $_POST;
	 $film['id'] = $_GET['id'];
}


?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <title>Редактирование фильма</title>
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

      <?php 
 	
 			foreach ($actionResult as $key => $value) {

				echo '<div class="'.$key.'">'.$value.'</div>';	

 			}

      ?>	

      <h1 class="title-1">Фильм <?=$film['title']?></h1>

      <div class="panel-holder mt-0 mb-20">
        <div class="title-4 mt-0">Редактировать фильм</div>
        <form action="edit.php?id=<?=$film['id']?>" method="POST">
		<?php 

			foreach($addErrors as $key => $value) { 

		?>	
			<div class="error"><?php echo $value?></div>

		<?php 
		
		}

		?>
          <label class="label-title">Название фильма</label>
          <input class="input" type="text" placeholder="Такси 2" name="title" value="<?=$film['title']?>"/>
          <div class="row">
            <div class="col">
              <label class="label-title">Жанр</label>
              <input class="input" type="text" placeholder="комедия" name="genre" value="<?=$film['genre']?>"/>
            </div>
            <div class="col">
              <label class="label-title">Год</label>
              <input class="input" type="text" placeholder="2000" name="year" value="<?=$film['year']?>"/>
            </div>
          </div><input class="button" type="submit" name="update-film" value="Сохранить">
        </form>       
      </div>
       <a href="index.php" class="button">На главную</a>
    </div><!-- build:jsLibs js/libs.js -->
    <script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
<!-- build:jsVendor js/vendor.js -->
    <script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script><!-- endbuild -->
<!-- build:jsMain js/main.js -->
    <script src="js/main.js"></script><!-- endbuild -->
    <script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>