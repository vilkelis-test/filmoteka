  <h1 class="title-1">Добавить новый фильм</h1>

      <div class="panel-holder mb-40">
        <div class="title-4 mt-0">Добавить фильм</div>
 		<form action="new.php" method="POST">
 		  
 		  <?php

 		    include('views/film-card.tpl');

 		  ?>

          <input class="button" type="submit" name="add-film" value="Добавить">
        </form>
      </div>