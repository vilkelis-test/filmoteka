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

	return $film; //mysqli_affected_rows($link) > 0;
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

	$query = "insert into films (title, genre, year) values (
	'".mysqli_real_escape_string($link, $values['title'])."',
	'".mysqli_real_escape_string($link, $values['genre'])."',
	".mysqli_real_escape_string($link, $values['year']).")";

	$result = mysqli_query($link, $query);

 	if(!$result){
 		die(mysqli_error($link));
 	}

	return true;

}

function film_update($link, $values)
{
    $id =  $values['id'];
	$query = "update films set 
	title = '".mysqli_real_escape_string($link, $values['title'])."',
	genre = '".mysqli_real_escape_string($link, $values['genre'])."',
	year = ".mysqli_real_escape_string($link, $values['year']).
	" where id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	$result = mysqli_query($link, $query);

 	if(!$result){
 		die(mysqli_error($link));
 	}

	return true;

}

function film_delete($link, $id)
{
	$query = "delete from films where id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	return mysqli_query($link, $query);

}

?>