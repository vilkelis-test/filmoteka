<h1 class="title-1">Информация о фильме</h1>

<div class="card mb-20">
	<div class="card__header">
		<h4 class="title-4"><?php echo $film['title']?></h4>
		<div class="card__edit-buttons">
			<a class="button button--edit" href="edit.php?id=<?=$film['id']?>">Редактировать</a>
			<a class="button button--delete" href="?action=delete&id=<?=$film['id']?>">Удалить</a>
		</div>
	</div>
	<div class="badge"><?php echo $film['genre']?></div>
	<div class="badge"><?php echo $film['year']?></div>
</div>