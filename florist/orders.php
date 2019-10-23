<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/florist/includes/head_section.php'); ?>

<!-- Get all florist posts from DB -->
<?php $posts = getAllOrders(); ?>
	<title>Dione | Управление заказами</title>
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
			<br><h1 class="page-title" align="center">Управление заказами</h1><br>
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>
			<?php if (empty($posts)): ?>
			<br><br><br><br><br><br>
				<h2 style="text-align: center; margin-top: 20px;">В базе данных нет заказов</h2>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>№</th>
						<th>Цветы</th>
						<th>Кол-во</th>
						<th>Упаковка</th>
						<th>Клиент</th>
						<th>Дата заказа</th>
						<th>Дата доставки</th>
						<th>Сумма</th>
						<th>Заметка</th>
						<th>Статус&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th><small>Сохранить</small></th>
						<th><small>Удалить</small></th>
					</thead>
					<tbody>			<form method="get" action="orders.php">
					<?php foreach ($posts as $key => $post): ?>
					<?php $order_id=$post['order_flower_id']; ?>
						<tr>
							<td><?php echo $order_id; ?></td>
							<?php $query = "SELECT flowers.name, colors.color_name, order_flower.quantity 
												FROM flowers, colors, flower_color, order_flower 
												WHERE order_flower.flower_color_id=flower_color.id 
												AND flower_color.flower_id=flowers.id 
												AND flower_color.color_id=colors.id 
												AND order_flower.order_id='$order_id'";
							?>
							<td>
							<?php $result1 = mysqli_query($conn, $query);
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['name'] . " " . $row1['color_name'] . " " . $row1['quantity'] . " шт. <br>";
							} ?>
							</td>
							<td><?php echo $post['quantity']; ?></td>
							<td><?php $result1 = mysqli_query($conn, "SELECT packaging.packname 
																		FROM packaging, orders 
																		WHERE orders.packaging_id=packaging.id 
																		AND orders.order_flower_id='$order_id'");
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['packname'] . "<br>";
							} ?></td>
							<td><?php $result1 = mysqli_query($conn, "SELECT * 
																		FROM users, orders 
																		WHERE orders.client_id=users.id 
																		AND orders.order_flower_id='$order_id'");
							while($row1 = mysqli_fetch_array($result1)) 
							{ 
							echo $row1['user_name'] . "<br>";
							echo "Тел.:" .$row1['user_phone'] . "<br>";
							echo "Почта:" . $row1['email'] . "<br>";
							} ?></td>
							<td><?php echo $post['date']; ?></td>
							<td><?php echo $post['duedate']; ?></td>
							<td><?php echo $post['sum']; ?></td>
							<td><?php echo $post['note']; ?></td>
							<?php $currentstatus = $post['status']; ?>
							<td>
							
							<select class="staselect">
								<option value="<?php echo $currentstatus; ?>" selected disabled><?php echo $currentstatus; ?></option>
								<option value="Обработка">Обработка</option>
								<option value="Оплачен">Оплачен</option>
								<option value="Готов к самовывозу">Готов к самовывозу</option>
								<option value="Завершен">Завершен</option>
								<option value="Отменен">Отменен</option>
							</select>
							
										</td>
										
							<td>
								<a  class="fa fa-floppy-o btn save" 
									href="orders.php?update-status-order=<?php echo $order_id; ?>">
								</a>
							</td>	
							<td>
								<a  class="fa fa-trash btn delete" 
									href="orders.php?delete-order=<?php echo $order_id; ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
				
			<?php endif ?>
		</div>
	</div>
</body>
<script>
var staselect = document.getElementsByClassName('staselect');

[].forEach.call(staselect, function(item) {
	var str = '&status_select=' + item.value,
		a = item.parentElement.nextElementSibling.firstElementChild;
	
	a.setAttribute('href', a.getAttribute('href') + str);
	
	item.addEventListener('click', function(){
		var href = this.parentElement.nextElementSibling.firstElementChild, //берем ссылку из кнопки "сохранить" П
			split = href.getAttribute('href').split('='); //разбиваем строку на массив
		split[split.length - 1] = this.value; //записываем в последний элемент массива нужный статус
		var result = split.join('='); //делаем из массива строку
		href.setAttribute('href', result); //записываем в href итоговое значение
		console.log(href);
	});
});
</script>
</html>