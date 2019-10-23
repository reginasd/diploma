<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/florist/includes/post_functions.php'); ?>
<?php
$errors = array();
	$supply_id = 0; 
	$result = mysqli_query($conn,"SELECT supply_flower FROM supply ORDER BY supply_flower DESC LIMIT 1");
	$supplies = mysqli_fetch_assoc($result);
	$supply_id = $supplies['supply_flower'];
	$supply_id++;
if(!empty($_POST['flower'])){
    $flowers = $_POST['flower'];
    $sql = '';
	$sql2 = '';
	$sql3 = '';
	$supplier = $_POST["supplier"];
	$suppsum = $_POST["suppsum"];
	$supplydate = $_POST["date"];
	if (empty($supplier)) {  array_push($errors, "Введите поставщика!"); }
	if (empty($suppsum)) {  array_push($errors, "Введите сумму поставки!"); }
	if (empty($supplydate)) {  array_push($errors, "Введите дату!"); }
	if (count($errors) == 0) {
    foreach($flowers as $key => $item){
         if($key === 0){
			 //добавляем последний цветок в поставку
            $sql .= 'INSERT into supply_flower(supply_id, flower_color_id, quantity, sum)
             VALUES ('.$item['supply_id'].', '.$item['flower_color_id'].' , '.$item['quantity'].' , '.$item['sum'].')';
			 //обновляем кол-во для последнего цветка
			 $sql3 .= 'UPDATE flower_color SET quantity = quantity + '.$item['quantity'].'
							WHERE id = '.$item['flower_color_id'].'; ';
        }else{
			//добавляем след. цветы в поставку
            $sql .= ', ('.$item['supply_id'].', '.$item['flower_color_id'].' , '.$item['quantity'].' , '.$item['sum'].')';
			//обновляем кол-во след.цветов
			$sql3 .= 'UPDATE flower_color SET quantity = quantity + '.$item['quantity'].'
							WHERE id = '.$item['flower_color_id'].';';
        }
    }
	//добавляем саму поставку
	$sql2 .= 'INSERT INTO supply(supply_flower, supplydate, supplier, sum) 
				VALUES ("'.$supply_id.'", "'.$supplydate.'", "'.$supplier.'" , "'.$suppsum.'")'; 
		
    mysqli_query($conn, $sql);
	mysqli_query($conn, $sql2);
	mysqli_query($conn, $sql3);
	$_SESSION['message'] = "Поставка успешно добавлена!";
    header("Location: create_supply.php"); /* Перенаправление браузера */
    exit;
	
	}
}
?>

<?php include(ROOT_PATH . '/florist/includes/head_section.php'); ?>

<?php $supflowers = getAllSupplyFlowers();	?>

	<title>Админ | Добавить поставку</title>
</head>
<body>
	<?php include(ROOT_PATH . '/florist/includes/navbar.php') ?>

	<div class="container content">
	
		<?php include(ROOT_PATH . '/florist/includes/menu.php') ?>
		
		<div class="action create-supply-div"><br>
			<h1 class="page-title">Добавить поставку</h1><br>
			<form method="post" id="flowersForm" action="<?php echo BASE_URL . 'florist/create_supply.php'; ?>">
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<h4 align="left">Дата поставки: <input type="date" id="localdate" name="date"/></h4><br>
				<input type="text" id="supplier" name="supplier" placeholder="Поставщик">
				<input type="text" id="suppsum" name="suppsum" placeholder="Сумма поставки">
				<div id="selectflows">
				<select name="topic_id" id="selflower">
					<option value="" selected disabled>Выберите цветок</option>
					<?php foreach ($supflowers as $sflow): ?>
						<option value="<?php echo $sflow['id']; ?>">
							<?php echo $sflow['name'] . " ";
								echo $sflow['color_name'];
							?>
						</option>
					<?php endforeach ?>
				</select>
			
				<input type="text" name="kolvo" id="kolvo" placeholder="Количество">
				<input type="text" name="flowsum" id="flowsum" placeholder="Сумма за цветок"></div>
				<button class="btn" type="button" onclick="cloneSelect()">Добавить цветок</button><br><br><br><br><br>
					<button class="btn" name="create_supply">Сохранить поставку</button>
			</form>
		</div>
	</div>
</body>
<script>
var flowercount = 0;
function cloneSelect() {
    var selflower = document.getElementById("selflower"),
        kolvo = document.getElementById("kolvo"),
        flowsum = document.getElementById("flowsum"),
        flowersForm = document.getElementById("flowersForm");
    if(selflower.value.length !== 0 && kolvo.value.length !== 0 && flowsum.value.length !== 0){  //если все поля заполнены
        var obj = {   // вставляем наши инпуты в объект
            'flower_color_id': selflower.value,
            'supply_id': <?php echo $supply_id; ?>,
            'quantity' : kolvo.value,
            'sum' : flowsum.value
        }
 
        for (key in obj) {  //проходимся циклом по объекту и создаем скрытые input
            input = document.createElement("input");
            input.type = "text";
            input.setAttribute('name', 'flower['+flowercount+']['+key+']');
            input.type = 'hidden';
            input.value = obj[key];
            flowersForm.appendChild(input);
        }
 
        flowercount++
 
        // очищаем поля
        selflower.value = 0;
        kolvo.value = '';
        flowsum.value = '';
    }else{
        console.log("Заполните все поля");
    }
}
</script>

</html>
