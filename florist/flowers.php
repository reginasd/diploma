<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/florist/includes/head_section.php'); ?>

<!-- Get all florist posts from DB -->
<?php $posts = getAllFlowers(); ?>
	<title>Dione | Управление цветами</title>
</head>
<body>
	<!-- florist navbar -->
	<?php include(ROOT_PATH . '/florist/includes/navbar.php') ?>

	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/florist/includes/menu.php') ?>
		
		<!-- Display records from DB-->
		<div class="table-div"  style="width: 80%;"><br><br>
			<h1 class="page-title" align="center">Управление цветами</h1><br>
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>

			<?php if (empty($posts)): ?>
				<h1 style="text-align: center; margin-top: 20px;">В базе данных нет постов</h1>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>№</th>
						<th>Цветок</th>
						<th>Цвет</th>
						<th>Кол-во</th>
						<th><small>Изменить</small></th>
						<th><small>Удалить</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
					<?php $myid=$post['id']; ?>
						<tr>
							<td><?php echo $post['id']; ?></td>
							
							<td><?php $result1 = mysqli_query($conn, "SELECT flowers.name 
																		FROM flowers, flower_color 
																		WHERE flower_color.flower_id=flowers.id 
																		AND flower_color.id='$myid'");
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['name'] . "<br>";
							} ?></td>
							<td><?php $result1 = mysqli_query($conn, "SELECT colors.color_name 
																		FROM colors, flower_color 
																		WHERE flower_color.color_id=colors.id 
																		AND flower_color.id='$myid'");
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['color_name'] . "<br>";
							} ?></td>
							<td><input type="text" value="<?php echo $post['quantity']; ?>"></input></td>
							<td>
								<a class="fa fa-floppy-o btn save"
									href="create_post.php?edit-post=<?php echo $post['id'] ?>">
								</a>
							</td>
							<td>
								<a  class="fa fa-trash btn delete" 
									href="create_post.php?delete-post=<?php echo $post['id'] ?>">
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