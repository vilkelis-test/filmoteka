  <h1 class="title-1"> Фильмотека</h1>

  <?php 

    foreach ($films as $key => $film) { 
	    include('views/index-item.tpl');
	}

  ?>


