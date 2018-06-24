      <h1 class="title-1">Фильм <?=$film['title']?></h1>
      <div class="panel-holder mt-0 mb-20">
        <div class="title-4 mt-0">Редактировать фильм</div>
        <form action="edit.php?id=<?=$film['id']?>" method="POST">
 		  
 		  <?php

 		    include('views/film-card.tpl');

 		  ?>

          <input class="button" type="submit" name="update-film" value="Сохранить">
        </form>
      </div>