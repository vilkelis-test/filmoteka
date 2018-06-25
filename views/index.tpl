  <h1 class="title-1"> Фильмотека</h1>

  <?php 

    foreach ($films as $key => $film) { 
    ?>

    <div class="card mb-20">
		<div class="row">	
			<div class='col-auto'>
				<div class="img-on-list">
				<?php 
				 if ( $film['photo_file'] != '')	
				 { ?>
				<img  src="<?=HOST . '/data/films/min/' . $film['photo_file']?>" alt="<?=$film['title']?>">
				<?php 
				 } else { ?>
				<div class="img-on-list__nophoto"></div>
				 <?php } ?>

				</div>
			</div>
			<div class="col">
				<div class="card__header">
					<h4 class="title-4"><?php echo $film['title']?></h4>
					<div class="card__edit-buttons">
						<a class="button button--edit" href="edit.php?id=<?=$film['id']?>">Редактировать</a>
						<a class="button button--delete" href="index.php?action=delete&id=<?=$film['id']?>">Удалить</a>
					</div>
				</div>
				<div class="badge"><?php echo $film['genre']?></div>
				<div class="badge"><?php echo $film['year']?></div>
				<div class="mt-20">
				<a class="button" href="one.php?id=<?=$film['id']?>">Подробнее</a>
				</div>
			</div>
		</div>
	</div>		

<?php
	}

  ?>


