<?php


function films_all($link){

	$query = "select * from films";
	$films = array();

	if ($result = mysqli_query($link, $query)) {
		while ($row = mysqli_fetch_array($result) )
		{
			$films[] = $row;
		}
	}

	return $films;

}

function film_one($link, $id)
{
	$query = "select * from films where id = ".mysqli_real_escape_string($link, $_GET['id'])." LIMIT 1";

	$result = mysqli_query($link, $query);

	if(!$result){
 		die(mysqli_error($link));
 	}

	$film = mysqli_fetch_array($result);

    if(mysqli_affected_rows($link) == 0)
    {
    	$film = array();
    }
	return $film;  
}

function film_check($link, $values){

		$addErrors = array();

		if ($values['title'] == '') {
			$addErrors[] = 'Необходимо ввести название фильма.';
		}
		
		if ($values['genre'] == '') {
			$addErrors[] = 'Необходимо ввести жанр фильма.';
		}
		
		if ($values['year'] == '') {
			$addErrors[] = 'Необходимо ввести год фильма.';
		} elseif ( ! is_numeric($values['year']) ) {
			$addErrors[] = 'Год должен быть числом.';
		} elseif ( strlen($values['year']) > 11) {
			$addErrors[] = 'В поле год указано слишком большое число.';
		} 

		return $addErrors;
}

function film_create($link, $values)
{

	$query = "insert into films (title, genre, year, ";
	
	if (array_key_exists('photo_file', $values) ) {
		$query = $query ." photo_file ,";
	}

	$query = $query . " description	) values (
	'".mysqli_real_escape_string($link, $values['title'])."',
	'".mysqli_real_escape_string($link, $values['genre'])."',
	".mysqli_real_escape_string($link, $values['year']).", ";
	
	if (array_key_exists('photo_file', $values) ) {
	  $query = $query ." '".mysqli_real_escape_string($link, $values['photo_file'])."', ";
	}

	$query = $query ." '".mysqli_real_escape_string($link, $values['description'])."') ";

	$result = mysqli_query($link, $query);

 	if(!$result){
 		die(mysqli_error($link));
 	}

	return true;

}

function film_update($link, $values){

    $id =  $values['id'];
	$query = "update films set 
	title = '".mysqli_real_escape_string($link, $values['title'])."',
	genre = '".mysqli_real_escape_string($link, $values['genre'])."',
	year = ".mysqli_real_escape_string($link, $values['year']).", ";
	
	if (array_key_exists('photo_file', $values) ) {
		$query = $query ." photo_file = '".mysqli_real_escape_string($link, $values['photo_file'])."', ";
	}

	$query = $query . "	description = '".mysqli_real_escape_string($link, $values['description'])."' 
	 where id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	$result = mysqli_query($link, $query);

 	if(!$result){
 		die(mysqli_error($link));
 	}

	return true;

}

function film_delete($link, $id)
{

    $film = film_one($link, $id);
    if ( array_key_exists('photo_file',$film) ) {
    	unlink(ROOT.'data/films/full/'.$film['photo_file']);
    	unlink(ROOT.'data/films/min/'.$film['photo_file']);	
    }

	$query = "delete from films where id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	return  mysqli_query($link, $query);
	
}


function film_photo_load($files, $db_file_name)
{
	$result = array();
	$result['db_file_name'] = $db_file_name;
	$result['loaded'] = false;
	$errors = array();	
	$result['errors'] = $errors;
	if ( isset($files['photo']['name']) && $files['photo']['tmp_name'] != ""  ) {
		$fileName = $files["photo"]["name"];
		$fileTmpLoc = $files["photo"]["tmp_name"];
		$fileType =  $files["photo"]["type"];
		$fileSize =  $files["photo"]["size"];
		$fileErrorMsg =  $files["photo"]["error"];
		$kaboom = explode(".", $fileName);
		$fileExt = end($kaboom);

		list($width, $height) = getimagesize($fileTmpLoc);
		if($width < 10 || $height < 10){
			$errors[] = 'Слишком маленький размер изображения';
		}

		if ( count($errors) == 0 ) {
			if ( $db_file_name == '' )
			{
				$db_file_name = rand(10000000, 99999999) . "." . $fileExt;
			}
			$result['db_file_name'] = $db_file_name;
			if($fileSize > 10485760) {
				$errors[] = 'Размер изображения не должен привышать > 10mb';
			} else if (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName) ) {
				$errors[] = 'Неизвестный формат файла. Поддерживаются файлы jpg, jpeg, gif или png';
			} else if ($fileErrorMsg == 1) {
				$errors[] = 'Не известная ошибка загрузки файла';
			}
		}

		if ( count($errors) == 0 ) {

			$photoFolderLocation = ROOT . 'data/films/full/';
			$photoFolderLocationMin = ROOT . 'data/films/min/';
			
			$uploadfile = $photoFolderLocation . $db_file_name;
			$moveResult = move_uploaded_file($fileTmpLoc, $uploadfile);

			if ($moveResult != true) {
				$errors[] = 'Не удалось загрузить файл';
			}
		}

        if ( count($errors) == 0 ) {
			require_once( ROOT . "/functions/image_resize_imagick.php");
			$target_file =  $photoFolderLocation . $db_file_name;
			$resized_file = $photoFolderLocationMin . $db_file_name;
			$wmax = 137;
			$hmax = 200;
			$img = createThumbnail($target_file, $wmax, $hmax);
			$img->writeImage($resized_file);
		}

		if ( count($errors) == 0 ) {
		  $result['loaded'] = true;
		}

		$result['errors'] = $errors;
	}
    return $result;
}

?>