<?php  include('../config.php'); ?>
	<?php include(ROOT_PATH . '/florist/includes/admin_functions.php'); ?>
	<?php include(ROOT_PATH . '/florist/includes/head_section.php'); ?>
	<title>Dione | Кабинет флориста</title>
</head>
<body>
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL .'florist/dashboard.php' ?>">
				<h1>Dione - флорист</h1>
			</a>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<div class="user-info">
				<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; 
				<a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">Выйти</a>
			</div>
		<?php endif ?>
	</div>
	<div class="container dashboard">
		<br>
		<h1>Кабинет флориста</h1>
		<br>
		<div class="stats">
			<a href="orders.php" class="first">
				<span>42</span> <br>
				<span>Новые заказы</span>
			</a>
			<a href="posts.php">
				<span>42</span> <br>
				<span>Опубликованные посты</span>
			</a>
			<a href="supply.php">
				<span>42</span> <br>
				<span>Новые поставки</span>
			</a>
		</div>
		<br><br><br>
		<div class="buttons">
			<a href="supply.php">Добавить поставку</a>
			<a href="posts.php">Добавить букет</a>
		</div>
	</div>
</body>
</html>