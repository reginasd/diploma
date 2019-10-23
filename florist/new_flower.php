<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/florist/includes/head_section.php'); ?>

	<title>Админ | Создание подборки</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/florist/includes/navbar.php') ?>

	<div class="container content">
		<?php include(ROOT_PATH . '/florist/includes/menu.php') ?>
		<?php $supflowers = getAllColors();	?>
		<div class="action create-supply-div"><br>
			<h1 class="page-title">Добавить поставку</h1><br>
			<form method="post" id="flowersForm" action="<?php echo BASE_URL . 'florist/create_supply.php'; ?>">
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<h4 align="left">Дата поставки: <input type="date" id="localdate" name="date"/></h4><br>
				<input type="text" id="supplier" name="supplier" placeholder="Поставщик">
				<input type="text" id="suppsum" name="suppsum" placeholder="Сумма поставки">
				<div id="selectflows">
				<select name="topic_id" id="selflower">
					<option value="" selected disabled>Выберите цвета</option>
					<?php foreach ($supflowers as $sflow): ?>
						<option value="<?php echo $sflow['id']; ?>">
							<?php echo $sflow['color_name']; ?>
						</option>
					<?php endforeach ?>
				</select>
			
				<input type="text" name="kolvo" id="kolvo" placeholder="Количество">
				<input type="text" name="flowsum" id="flowsum" placeholder="Сумма за цветок"></div>
				<button class="btn" type="button" onclick="cloneSelect()">Добавить цветок</button><br><br><br><br><br>
					<button class="btn" name="create_supply">Сохранить поставку</button>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->
	</div>
</body>
</html>

<script>
	CKEDITOR.replace('body');
</script>