<?php if (isset($_SESSION['user']['username'])) { ?>
	<div class="logged_in_info">
		<span>Добро пожаловать, <?php echo $_SESSION['user']['username']; ?></span>
		|
		<span><a href="logout.php">Выйти</a></span>
	</div> <?php $logged=1 ?>
<?php }else{ ?>
	<div class="banner">
		<div class="welcome_msg">
			<h1>Флористическая студия</h1>
			<p> 
			    У цветов не бывает будней, <br> 
			    они всегда одеты празднично. <br>
				<span>- Малкольм де Шазаль</span>
			</p>
			<a href="register.php" class="btn">Сделать заказ</a>
		</div>

		<div class="login_div">
			<form action="<?php echo BASE_URL . 'index.php'; ?>" method="post" >
				<h2>Войти</h2>
				<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>
				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Имя пользователя">
				<input type="password" name="password"  placeholder="Пароль"> 
				<button class="btn" type="submit" name="login_btn">Войти</button>
			</form>
		</div>
	</div>
<?php } ?>