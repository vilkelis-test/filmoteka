	<?php 

		foreach($addErrors as $key => $value) { 

	?>	
		<div class="error"><?php echo $value?></div>

	<?php 
	
	}

	?>
<label class="label-title">Название фильма</label>
<input class="input" type="text" placeholder="Такси 2" name="title" value="<?=@$film['title']?>"/>
<div class="row">
	<div class="col">
	  <label class="label-title">Жанр</label>
	  <input class="input" type="text" placeholder="комедия" name="genre" value="<?=@$film['genre']?>"/>
	</div>
	<div class="col">
	  <label class="label-title">Год</label>
	  <input class="input" type="text" placeholder="2000" name="year" value="<?=@$film['year']?>"/>
	</div>
</div>

<div class="mb-20">
	<label class="label-title">Описание фильма</label>
	<textarea class="textarea" placeholder="Очень интересный фильм" name="description" ><?=@$film['description']?></textarea> 
</div>
<div class="mb-20">
    <label class="label-title">Изображение</label>
    <p>Изображение jpg или png, рекомендуемая ширина 400px и больше, высота от 600px и более, вес до 10Мб.</p>
    <input class="inputfile" type="file" name="photo" id="file-2" >
    <label for="file-2">Выбрать файл</label><span class="needed"></span>
    <div class="img-post-uploaded mb-25">
		<?php 
		 if ( @$film['photo_file'] != '')	
		 { ?> 
    	<img class="img-post-uploaded__img" src="<?=HOST . 'data/films/full/' . $film['photo_file']?>">
		<?php 
		 } else { ?>
        <div class="img-edit__nophoto"></div>
		 <?php } ?>
    </div>
</div>
	
