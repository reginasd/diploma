<?php  include('../config.php'); ?>
<div class="header">
	<div class="logo">
		<a href="<?php echo BASE_URL .'florist/dashboard.php' ?>">
			<h1>Dione - Кабинет флориста</h1>
		</a>
	</div>
	<div class="user-info">
		<span><?php echo $_SESSION['user']['username'] ?></span> &nbsp; &nbsp; <a href="<?php echo BASE_URL . '/logout.php'; ?>" class="logout-btn">Выйти</a>
	</div>
</div>