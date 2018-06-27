  <h1 class="title-1">Недавно просмотренные фильмы</h1>


  <?php 
    if (count($films) > 0) {

	    foreach ($films as $key => $film) { 
		    include('views/index-item.tpl');
		} 

	} else {

	 echo '<div class="notify"> Нет записей </div>';

	}
  ?>

 <?php 
    if (count($films) > 0) {
?>    
<div class="mt-20 mb-20">
	<a class="button" href="history-clear.php">Очистить историю</a>
</div>
 <?php 
   }
?>   
