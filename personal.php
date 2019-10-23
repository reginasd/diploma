<?php require_once('config.php') ?>
<?php
if(!empty($_POST['flower'])){
 
    $flowers = $_POST['flower'];
 
 
 
    $sql = '';
    $i = 0;
 
    foreach($flowers as $item){
         if($i === 0){
            $sql .= 'INSERT INTO orders(client_id, order_flower_id, quantity, status, sum, packaging_id, date, duedate, note)
              VALUES (
                  "'.$item['client_id'].'",
                  "'.$item['order_flower_id'].'",
                  "'.$item['quantity'].'",
                  "'.$item['status'].'",
                  "'.$item['sum'].'",
                  "'.$item['packaging_id'].'",
                  now(),
                  "'.$item['duedate'].'",
                  "'.$item['note'].'"
              )';
            $i++;
        }else{
            $sql .= ', VALUES (
              "'.$item['client_id'].'",
              "'.$item['order_flower_id'].'",
              "'.$item['quantity'].'",
              "'.$item['status'].'",
              "'.$item['sum'].'",
              "'.$item['packaging_id'].'",
              now(),
              "'.$item['duedate'].'",
              "'.$item['note'].'"
          )';
        }
    }
 
    //echo $sql;
 
   mysqli_query($conn, $sql);   /* запись в базу */
   
     //header("Location: korzina.php"); /* Перенаправление браузера  если нужно */
    //exit;
}
?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<?php
if (isset($_POST['save_btn'])) {
	  $errors = array(); 
		// получение информации из формы
		$wuser_name = $_POST['user_name'];
		$wusername = $_POST['username'];
		$wemail = $_POST['email'];
		$wphone = $_POST['phone'];
		$wuserid = $_SESSION['user']['id'];
		// проверка правильно ли заполнена форма
		/*if (empty($wuser_name)) {  array_push($errors, "Введите ваше имя и фамилию!"); }
		if (empty($wusername)) {  array_push($errors, "Введите имя пользователя!"); }
		if (empty($wemail)) { array_push($errors, "Введите почту!"); }
		if (empty($wphone)) { array_push($errors, "Введите Ваш номер телефона!"); }*/

		// Сохранение, если нет ошибок
		if (count($errors) == 0) {
			$query = 'UPDATE users SET username="'.$wusername.'", email="'.$wemail.'", updated_at=now(), user_name="'.$wuser_name.'", user_phone="'.$wphone.'"
						WHERE id="'.$wuserid.'"';
			mysqli_query($conn, $query);
			
				header('location: personal.php');				
				exit(0);
			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Dione | Личный кабинет </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
	
		<!-- // navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php') ?>
	<?php include( ROOT_PATH . '/includes/banner.php') ?>
	<?php if ($logged) { ?>
		<!-- Page content -->
		
		<div class="content">
			<h2 class="content-title">Личный кабинет</h2>
			<hr>
			<!-- more content still to come here ... --><br>
			<h3>Личные данные</h3>
			<br>
			
			<?php
			
			$result = mysqli_query($conn,"SELECT * FROM users WHERE username='" . $_SESSION['user']['username'] . "'");
			
			$surname = mysqli_fetch_assoc($result);
			$userid = $surname['id'];
			$username = $surname['username'];
			$user_name = $surname['user_name'];
			$email = $surname['email'];
			$phone = $surname['user_phone'];
			//echo $_SESSION['user']['username'];
			echo "Имя: " . $user_name . "<br>";
			echo "Логин: " . $username . "<br>";
			echo "Почта: " . $email . "<br>";
			echo "Номер телефона: " . $phone . "<br>";
			echo "Дата регистрации: " . $surname['created_at'] . "<br>";
			?><br>
			<button class="btn" type="submit" onclick="show('block')" name="bouquet_btn"> Изменить информацию </button>
			<br>
			<!-- Всплывающее окно-->
			<div id="window">
			<img class="close" onclick="show('none')" src="/static/images/close.png">
			<br><h3>Введите новые данные:</h3><br>
			
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
			<form method="post" id="changing">
			<input  type="text" name="user_name"  value="<?php echo $user_name ?>" placeholder="Фамилия Имя"><br>
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Имя пользователя"><br>
			<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email"><br>
			<input type="tel" name="phone"  value="<?php echo $phone; ?>" placeholder="Номер телефона"><br>
				<button class="btn" type="submit" name="save_btn"> Сохранить информацию </button></form>
			</div>
			<h3>Заказы</h3>
			<?php
			//Проверка есть ли заказы у данного пользователя
			$result = mysqli_query($conn,"SELECT id FROM orders WHERE client_id='" . $userid . "' LIMIT 1");
			$row = mysqli_fetch_array($result);
			if (empty($row))
			{
				echo "Кажется, у вас еще нет ни одного заказа! <a href=\"index.php\" class=\"btn btn-default\">Исправить!</a>";
			}
			//если есть, вывод заказов
			else {
				$result = mysqli_query($conn,"SELECT *
												FROM orders 
												WHERE client_id='" . $userid . "'
												ORDER BY date DESC");
												
				echo "<table border='0'>
					<thead>
						<th><p align=\"center\">№<p></th>
						<th>Цветы&nbsp;в&nbsp;заказе&nbsp;&nbsp;&nbsp;</th>
						<th>Упаковка</th>
						<th>Кол-во</th>
						<th>Сумма заказа</th>
						<th>Дата заказа</th>
						<th>Дата доставки</th>
						<th>Заметка&nbsp;к&nbsp;заказу&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Статус</th>
					</thead>
					<tbody>";
				while($row = mysqli_fetch_array($result))
				{
				echo "<tr>";
				$order_flower_id = $row['order_flower_id'];
				echo "<td>#" . $row['id'] . "</td>";
				echo "<td>";
				$query = "SELECT flowers.name, colors.color_name, order_flower.quantity 
												FROM flowers, colors, flower_color, order_flower 
												WHERE order_flower.flower_color_id=flower_color.id 
												AND flower_color.flower_id=flowers.id 
												AND flower_color.color_id=colors.id 
												AND order_flower.order_id='$order_flower_id'";
				$result1 = mysqli_query($conn, $query);
				while($row1 = mysqli_fetch_array($result1)) 
				{ 
					echo $row1['name'] . " " . $row1['color_name'] . " " . $row1['quantity'] . " шт. <br>";
				}
				$packid = $row['packaging_id'];
				$query3 = "SELECT packaging.packname from packaging WHERE packaging.id='$packid'";
				$result3 = mysqli_query($conn, $query3);
				while ($row3 = mysqli_fetch_array($result3)){
					echo "<td>" . $row3['packname'] . "</td>";
				}
				echo "<td>" . $row['quantity'] . " шт.</td>";
				echo "<td>" . $row['sum'] . "</td>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['duedate'] . "</td>";
				echo "<td>" . $row['note'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				
				echo "</tr>";
				}
				echo "</tbody></table>";
			}
			?>
		
		
		</div>
		<?php } else {?>
		<h2>Личный кабинет доступен только авторизированным пользователям.</h2>
		<a href="register.php" class="btn btn-default">Регистрация</a>
		<?php } ?>
		<!-- footer -->
	<?php include( ROOT_PATH . '/includes/footer.php') ?>
	<script type="text/javascript">

					//Функция показа окна
			function show(state){

					document.getElementById('window').style.display = state;			
					document.getElementById('wrap').style.display = state; 			
			}
			
		</script>