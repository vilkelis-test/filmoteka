<?php

 $addErrors = array();
 $actionResult = array();
 
 $link = mysqli_connect('localhost','root','','filmoteka');

 if (mysqli_connect_error()) {
 	die('Ошибка подключения к базе данных');
 }  

if (array_key_exists('action', $_GET) and $_GET['action'] == 'delete') {
	$query = "delete from films where id = ".mysqli_real_escape_string($link, $_GET['id'])." LIMIT 1";

	if ($result = mysqli_query($link, $query)) {

		if ( mysqli_affected_rows($link) > 0) {

			$actionResult['notify'] = 'Запись удалена успешно.';

		}

	} else {

		$actionResult['error'] = 'Ошибка удаления записи.';

	}	

}

if (array_key_exists('add-film', $_POST)) {


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
			$query = "insert into films (title, genre, year) values (
			'".mysqli_real_escape_string($link, $_POST['title'])."',
			'".mysqli_real_escape_string($link, $_POST['genre'])."',
			".mysqli_real_escape_string($link, $_POST['year']).")";

			if ($result = mysqli_query($link, $query)) {

				$actionResult['info'] = 'Запись добавлена успешно.';

			} else {

				$actionResult['error'] = 'Ошибка добавления записи.';

			}


		}

}	

$query = "select * from films";
$films = array();

if ($result = mysqli_query($link, $query)) {
	while ($row = mysqli_fetch_array($result) )
	{
		$films[] = $row;
	}
}


?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <title>Фильмотека</title>
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

      <h1 class="title-1"> Фильмотека</h1>

      <?php 

        foreach ($films as $key => $value) {

       ?> 	
      <div class="card mb-20">
      	<div class="card__header">
        	<h4 class="title-4"><?php echo $value['title']?></h4>
        	<div class="card__edit-buttons">
	        	<a class="button button--edit" href="edit.php?id=<?=$value['id']?>">Редактировать</a>
	        	<a class="button button--delete" href="?action=delete&id=<?=$value['id']?>">Удалить</a>
        	</div>
    	</div>
        <div class="badge"><?php echo $value['genre']?></div>
        <div class="badge"><?php echo $value['year']?></div>
      </div>
      <?php 

  		}

      ?>

      <div class="panel-holder mt-80 mb-40">
        <div class="title-4 mt-0">Добавить фильм</div>
        <form action="index.php" method="POST">
		<?php 

			foreach($addErrors as $key => $value) { 

		?>	
			<div class="error"><?php echo $value?></div>

		<?php 
		
		}

		?>
          <label class="label-title">Название фильма</label>
          <input class="input" type="text" placeholder="Такси 2" name="title"
			<?php 
			  if(count($addErrors) > 0) {
			 ?>
			 value = "<?php echo $_POST["title"]?>"
			<?php
			  }
			 ?>
          />
          <div class="row">
            <div class="col">
              <label class="label-title">Жанр</label>
              <input class="input" type="text" placeholder="комедия" name="genre"
				<?php 
				  if(count($addErrors) > 0) {
				 ?>
				 value = "<?php echo $_POST["genre"]?>"
				<?php
				  }
				 ?>
              />
            </div>
            <div class="col">
              <label class="label-title">Год</label>
              <input class="input" type="text" placeholder="2000" name="year"
				<?php 
				  if(count($addErrors) > 0) {
				 ?>
				 value = "<?php echo $_POST["year"]?>"
				<?php
				  }
				 ?>
              />
            </div>
          </div><input class="button" type="submit" name="add-film" value="Добавить">
        </form>
      </div>
    </div><!-- build:jsLibs js/libs.js -->
    <script src="libs/jquery/jquery.min.js"></script><!-- endbuild -->
<!-- build:jsVendor js/vendor.js -->
    <script src="libs/jquery-custom-scrollbar/jquery.custom-scrollbar.js"></script><!-- endbuild -->
<!-- build:jsMain js/main.js -->
    <script src="js/main.js"></script><!-- endbuild -->
    <script defer="defer" src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>