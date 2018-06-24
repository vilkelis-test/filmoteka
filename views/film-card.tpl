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

	
