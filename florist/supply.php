<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/florist/includes/head_section.php'); ?>

<!-- Get all florist posts from DB -->
<?php $posts = getAllSupplies(); ?>
	<title>Dione | Управление поставками</title>
</head>
<body>
	<!-- florist navbar -->
	<?php include(ROOT_PATH . '/florist/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/florist/includes/menu.php') ?>
		
		<!-- Display records from DB-->
		<div class="table-div"  style="width: 80%;">
		<br>
			<br><h1 class="page-title" align="center">Управление поставками</h1><br>
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>

			<?php if (empty($posts)): ?>
			<br><br><br><br><br><br>
				<h2 style="text-align: center; margin-top: 20px;">В базе данных нет поставок</h2>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>№</th>
						<th>Цветы</th>
						<th>Цвета</th>
						<th>Кол-во</th>
						<th>Цена</th>
						<th>Дата поставки</th>
						<th>Поставщик</th>
						<th>Сумма</th>
						<th><small>Удалить</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
					<?php $supply_id=$post['supply_flower'] ?>
						<tr>
							<td><?php echo $supply_id; ?></td>
							<?php $query = "SELECT flowers.name, colors.color_name, supply_flower.quantity, supply_flower.sum 
							FROM flowers, colors, flower_color, supply_flower 
							WHERE supply_flower.flower_color_id=flower_color.id AND 
							flower_color.flower_id=flowers.id AND 
							flower_color.color_id=colors.id AND 
							supply_flower.supply_id='$supply_id'";
							?>
							<td>
							<?php $result1 = mysqli_query($conn, $query);
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['name'] . "<br>";
							} ?>
							</td>
							<td>
							<?php $result1 = mysqli_query($conn, $query);
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['color_name'] . "<br>";
							} ?>
							</td>
							<td>
							<?php $result1 = mysqli_query($conn, $query);
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['quantity'] . "<br>";
							} ?>
							</td>
							<td><?php $result1 = mysqli_query($conn, $query);
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['sum'] . "<br>";
							} ?></td>
							<td><?php echo $post['supplydate']; ?></td>
							<td><?php echo $post['supplier']; ?></td>
							<td><?php echo $post['sum']; ?></td>
							<td>
								<a  class="fa fa-trash btn delete" 
									href="supply.php?delete-supply=<?php echo $post['supply_flower'] ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>