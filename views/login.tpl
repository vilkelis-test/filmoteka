<h1 class="title-1">Вход администратора</h1>
<div class="panel-holder mt-0 mb-20">
<?php	if (!isAdmin()){	?>

		<form action="login.php" method="POST">
			  

			<?php 

				foreach($addErrors as $key => $value) { 

			?>	
				<div class="error"><?php echo $value?></div>

			<?php 
			
			}

			?>
			<label class="label-name">Имя пользователя</label>
			<input class="input" type="text" placeholder="Введите имя пользователя" name="username"/>
			
			<label class="label-password">Пароль</label>
			<input class="input" type="password" placeholder="Введите пароль" name="userpassword"/>
			
			<input class="button" type="submit" name="login" value="Войти">
		</form>
<?php	}else{	
?>
	<form action="logout.php" method="GET">
     <p>Вы уже вошли как администратор. Хотите выйти?</p>
	 <input class="button" type="submit" name="logout" value="Выйти">
	</form>
<?php 
		} 
?>	
</div>