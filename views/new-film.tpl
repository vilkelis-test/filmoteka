  <h1 class="title-1">Новый фильм</h1>

      <div class="panel-holder mb-40">
        <div class="title-4 mt-0">Добавить фильм</div>
 		<form enctype="multipart/form-data" action="new.php" method="POST">
 		  
 		  <?php

 		    include('views/film-card.tpl');

 		  ?>

          <input class="button" type="submit" name="add-film" value="Добавить">
        </form>
      </div>