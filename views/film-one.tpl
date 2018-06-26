<h1 class="title-1">Информация о фильме</h1>
<div class="card mb-20">
	<div class="row">	
		<div class='col-auto'>
		   
				<?php 
				 if ( @$film['photo_file'] != '')	
				 { ?> 
		    	<img class="img-post-uploaded__img" src="<?=HOST . 'data/films/full/' . $film['photo_file']?>">
				<?php 
				 } else { ?>
		        <div class="img-edit__nophoto"></div>
				 <?php } ?>
	 				
		</div>
		<div class="col">
			<div class="card__header">
				<h4 class="title-4"><?php echo $film['title']?></h4>
				<?php if ( isAdmin() ) { ?>
				<div class="card__edit-buttons">
					<a class="button button--edit" href="edit.php?id=<?=$film['id']?>">Редактировать</a>
					<a class="button button--delete" href="index.php?action=delete&id=<?=$film['id']?>">Удалить</a>		
				</div>
				<?php } ?>
			</div>
			<div class="badge"><?php echo $film['genre']?></div>
			<div class="badge"><?php echo $film['year']?></div>
			<div class="user-content">
				<p><?=$film['description']?></p>
			</div>
		</div>
	</div>
</div>