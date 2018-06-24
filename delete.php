<?php

if (array_key_exists('action', $_GET) and $_GET['action'] == 'delete') {
	
	if ( film_delete($link, $_GET['id']) ) {

		if ( mysqli_affected_rows($link) > 0) {

			$actionResult['notify'] = 'Запись удалена успешно.';

		}

	} else {

		$actionResult['error'] = 'Ошибка удаления записи.';

	}	

}

?>