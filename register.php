<?php  include('config.php'); ?>
<?php  include('includes/registration_login.php'); ?>
<?php  include('includes/head_section.php'); ?>

<title>Dione | Регистрация </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="register.php" ><br>
			<h2>Регистрация</h2>
			<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<input  type="text" name="user_name" placeholder="Фамилия Имя">
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Имя пользователя">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input type="tel" name="phone" placeholder="Номер телефона">
			<input type="password" name="password_1" placeholder="Пароль">
			<input type="password" name="password_2" placeholder="Подтвердите пароль">
			<button type="submit" class="btn" name="reg_user">Зарегистрироваться</button>
			<p>
				Уже зарегистрированы? <a href="login.php">Войти</a>
			</p>
		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
<?php include( ROOT_PATH . '/includes/footer.php'); ?>