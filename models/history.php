<?php


function history_addFilm($filmId){
   $history = history_all();
   $existsElement = array_search($filmId, $history);
   if ( $existsElement !== false )
   {
   	  unset($history[$existsElement]);
   }
   array_unshift($history,$filmId);
   while (count($history) > HISTORY_LENGHT) {
   	 array_pop($history);
   } 	
   history_save($history);
}



//===========================

function history_all(){
    $historyArray = array();
    if ( isset($_COOKIE['history']) ) {         
         $historyArray = unserialize($_COOKIE['history']);
    }
    return $historyArray;
}

function history_save($historyArray){
   $exrire =  time() + 60*60*24*7;
   setcookie('history', serialize($historyArray), $exrire);
}


function history_clear(){
   $exrire =  time() - 60;
   $historyArray = array();
   setcookie('history', serialize($historyArray), $exrire);
}

?>