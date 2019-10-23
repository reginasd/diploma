<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/registration_login.php') ?>
<!DOCTYPE html>
<html>
<head>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Dione | Корзина </title>
</head>
<body>
	<div class="container">
		<!-- // navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php') ?>
	<?php include( ROOT_PATH . '/includes/banner.php') ?>
	<?php if ($logged) { ?>
		<div class="content">
			<h2 class="content-title">Корзина</h2>
			<hr><br>
			<br>			
			<?php
			$userid = $_SESSION['user']['id'];
			if (isset($_POST['empty_btn'])){
				$emptybasket = mysqli_query($conn,"DELETE FROM basket WHERE client_id='$userid'");
			}
			//Проверка есть ли у данного пользователя букеты в корзине
			$result = mysqli_query($conn,"SELECT id FROM basket WHERE client_id='" . $userid . "' LIMIT 1");
			$row = mysqli_fetch_array($result);
			if (empty($row))
			{
				echo "Кажется, у вас еще нет товаров в корзине! <a href=\"index.php\" class=\"btn btn-default\">Исправить!</a>";
			}
			//если есть, вывод заказов
			else {
			
					$result = mysqli_query($conn,"SELECT * FROM basket WHERE client_id='$userid' ORDER BY id DESC");
					
					echo "<form method=\"post\" action=\"personal.php\" id=\"flowersForm\"><table border='0'>
					<thead>
					<tr>
					<th></th>
					<th>Номер заказа</th>
					<th>Цветок</th>
					<th>Цвет</th>
					<th>Количество</th>
					<th>Упаковка</th>
					<th>Количество</th>
					<th>Сумма</th>
					<th>Заметка_к_заказу</th>
					<th>Дата_доставки</th>
					</tr>
					</thead>
					<tbody id=\"table_flowers\">";
					$pomogite = 0;
					while($row = mysqli_fetch_array($result))
					{
						$korzinaid = $row['id'];
					echo "<tr key='$pomogite'>";
					$helpme = $row['order_flower_id'];
					echo "<td><input class=\"bouquet_checkbox\" type=\"checkbox\" value='$helpme'></input></td>";
					echo "<td>" . $korzinaid . "</td>";
					echo "<td>"; 
					
					$query="SELECT flowers.name, colors.color_name, order_flower.quantity 
														FROM order_flower, flowers, colors, flower_color 
														WHERE order_flower.flower_color_id=flower_color.id 
														AND flower_color.flower_id=flowers.id 
														AND flower_color.color_id=colors.id 
														AND order_flower.order_id='$helpme'";
					$result1 = mysqli_query($conn, $query);
					while($row1 = mysqli_fetch_array($result1)) 
					{ 
						echo $row1['name'] . "<br>";
					} 
						echo "</td>";
						echo "<td>";
						$result1 = mysqli_query($conn, $query);
					while($row1 = mysqli_fetch_array($result1)) 
					{ 
						echo $row1['color_name'] . "<br>";
					}
						echo "</td>";
						echo "<td>";
						$result1 = mysqli_query($conn, $query);
					while($row1 = mysqli_fetch_array($result1)) 
					{ 
						echo $row1['quantity'] . " шт.<br>";
					}
					echo "</td>";								
					echo "<td>". $row['packaging_id'] . "</td>";
					echo "<td id=\"quantity\"><input class=\"bouquet_count\" type=\"number\" min=\"1\" value=".$row['quantity']."></input></td>";
					
					echo "<td>" .$row['sum'] . "</td>";
					echo "<td><input type=\"text\" name=\"notename\" id=\"note\"></td>";
					echo "<td><input type=\"date\" name=\"datename\"></td>";
					echo "</tr>";
					$pomogite++;
					}
					echo "</tbody></table><br>";
					echo "<p align=\"right\"><h3>Сумма выбранных товаров: <label id=\"itog\">0</label><div id=\"error\"></div></h3><br>";
					echo "<button class=\"btn\" type=\"submit\" name=\"order_btn\">Сделать заказ</button></p></form>
					<form method=\"post\" id=\"emptyForm\">
					<button class=\"btn\" type=\"submit\" name=\"empty_btn\">Очистить корзину</button>
					</form>";
			}
			
		 } else {?>
		<h2>Корзина доступна только авторизированным пользователям.</h2>
		<a href="register.php" class="btn btn-default">Регистрация</a>
		<?php } ?>
		<!-- footer -->
	<?php include( ROOT_PATH . '/includes/footer.php') ?>

	<script>
var bouquet_count = document.getElementsByClassName('bouquet_count'),
    bouquet_checkbox = document.getElementsByClassName('bouquet_checkbox'),
    table_flowers = document.getElementById('table_flowers'),
    flowersForm = document.getElementById('flowersForm');
[].forEach.call(bouquet_count, function(item) {
    item.addEventListener('input', function() {
        var s = this.parentElement.nextElementSibling,
            itog = document.getElementById('itog'),
            check = this.parentElement.previousElementSibling.
            previousElementSibling.previousElementSibling.
            previousElementSibling.previousElementSibling.
            previousElementSibling.firstElementChild
        if(!this.hasAttribute('summ')){
            this.setAttribute('summ', s.innerHTML);
        }
        var summ = this.value * this.getAttribute('summ');
        if(check.checked){
            itog.innerHTML = +itog.innerHTML - + s.innerHTML;
        }
        s.innerHTML = summ;
        check.checked = false;
    })
});
[].forEach.call(bouquet_checkbox, function(item) {
    item.addEventListener('input', function() {
      var date = item.parentElement.parentElement.lastElementChild.firstElementChild.value,
          error = document.getElementById('error'),
          note_1 = item.parentElement.parentElement.lastElementChild.previousElementSibling.firstElementChild.value,
          check_1 = true;  
      if(date.length === 0){
        this.checked = false;
        check_1 = false;
        error.innerHTML = 'Выберите дату';
      }
      if(note_1.length === 0){
        this.checked = false;
        check_1 = false;
        error.innerHTML = 'Напишите заметку';
      }
      if(check_1 === true){
        error.innerHTML = '';
        var itog = document.getElementById('itog'),
            s = this.parentElement.nextElementSibling.
            nextElementSibling.nextElementSibling.
            nextElementSibling.nextElementSibling.
            nextElementSibling.nextElementSibling;
        if(this.checked){
          [].forEach.call(table_flowers.children, function(item) {
            var i = item.getAttribute('key'),
              check = item.firstElementChild.firstElementChild.checked;
              if(check === true){
                var obj = {   // вставляем наши инпуты в объект
                  'client_id' : <?php echo $_SESSION['user']['id']; ?>,
                  'order_flower_id' : item.firstElementChild.firstElementChild.value,
                  'quantity' : item.firstElementChild.nextElementSibling.nextElementSibling.
                    nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.
                    firstElementChild.value,
                  'status' : 'Обработка',
                  'sum' : item.lastElementChild.previousElementSibling.previousElementSibling.innerHTML,
                  'packaging_id' : item.lastElementChild.previousElementSibling.previousElementSibling.
                    previousElementSibling.previousElementSibling.innerHTML,
         
                  'duedate' : item.lastElementChild.firstElementChild.value,
                  'note' : item.lastElementChild.previousElementSibling.firstElementChild.value
                }
                for (key in obj) {  //проходимся циклом по объекту и создаем скрытые input
                  input = document.createElement("input");
                  input.type = "text";
                  input.setAttribute('name', 'flower['+i+']['+key+']');
                  input.type = 'hidden';
                  input.value = obj[key];
                  flowersForm.appendChild(input);
                }
                console.log(obj);
              }
          })
            itog.innerHTML = +s.innerHTML + +itog.innerHTML;
        }else{
            itog.innerHTML = +itog.innerHTML - +s.innerHTML;
        }
      }
    })
});
</script>