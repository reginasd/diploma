<?php require_once('config.php') ?>
<?php  include('includes/registration_login.php'); ?>
<!DOCTYPE html>
<html>
<style>
img {
	width: 150px;
	display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
<head>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
	<title>Dione | Флористическая студия </title>
</head>
<body>
	<!-- container - wraps whole page -->
	<div class="container">
		
		<!-- // navbar -->
	<?php include( ROOT_PATH . '/includes/navbar.php') ?>
	<?php include( ROOT_PATH . '/includes/banner.php') ?>
	
		<!-- Page content -->
		<div class="content">
			<h2 class="content-title">Составить букет</h2>
			<hr>
			<!-- more content still to come here ... --><br>
			<h3>Выберите свой идеальный букет!</h3>
			<?php
			
			$result = mysqli_query($conn,"SELECT * FROM flowers");
			
			echo "<table id=\"table_flowers\"border='0'>
			<tr>
			<th>Изображение</th>
			<th>Название</th>
			<th>Цвет</th>
			<th>Кол-во</th>
			<th>Цена(р.)</th>
			<th>Сумма</th>
			</tr>";
			$pomogite = 0;
			while($row = mysqli_fetch_array($result))
			{
			echo "<tr key='$pomogite'>";
			echo "<td><img src='/static/images/" . $row['image'] . "' class=\"post_image\" alt=\"\"></td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>"; 
			$helpme = $row['id'];
			$result1 = mysqli_query($conn,"SELECT colors.color_name,  flowers.id
																	FROM colors, flower_color, flowers 
																	WHERE flower_color.color_id=colors.id 
																	AND flower_color.flower_id=flowers.id 
																	AND flowers.id='$helpme'");
																	
			
			while($row1 = mysqli_fetch_array($result1)) 
			{ 
			echo $row1['color_name'] . "<br>";
			} 
			echo "</td>";
			echo "<td class=\"price\">";
			$result1 = mysqli_query($conn,"SELECT colors.color_name,  flower_color.id, flower_color.quantity
																	FROM colors, flower_color, flowers 
																	WHERE flower_color.color_id=colors.id 
																	AND flower_color.flower_id=flowers.id 
																	AND flowers.id='$helpme'");
			while($row1 = mysqli_fetch_array($result1)) 
			{ 
			$flowquant = $row1['quantity'];
			$flower_color = $row1['id'];
			echo "<input type=\"number\" min=\"0\" max='$flowquant' id='$flower_color' class=\"flowers\"><br>";
			}
			echo "</td>";
			echo "<td id=\"price\">" . $row['price'] . "</td>";
			echo "<td></td>";
			echo "</tr>";
			$pomogite++;
			}
			echo "</table>";
			?>
			
			
			<h3>Итог - <label id="itog">0</label> рублей</h3><br>
		   
			<h3>Выберите упаковку:</h3>
			<?php
			
			$result = mysqli_query($conn,"SELECT * FROM packaging");
			

			//echo "<form method='post' class=\"package\">";
			while($row = mysqli_fetch_array($result))
			{
			$packageid = $row['id'];
			$packprice = $row['price'];
			echo "<input type=\"radio\" class=\"pack-radio\" name=\"pack\" id='$packageid' value='$packprice'/>";
			echo $row['packname'] . " ";
			echo $row['price'] . " р.<br>";
			}
			?>
			<h2>Цена букета с упаковкой - <label id="total">0</label> рублей</h2><br>
		<button id="insert" class="btn" type="submit" name="bouquet_btn"> Добавить в корзину </button>
		
			
		
		<?php 
			$order_id = 0; 
			$result = mysqli_query($conn,"SELECT order_id FROM order_flower ORDER BY order_id DESC LIMIT 1");
			$orders = mysqli_fetch_assoc($result);
			$order_id = $orders['order_id'];
			$order_id++;
		?>
		</div>
		

		<!-- footer -->
	<?php include( ROOT_PATH . '/includes/footer.php') ?>
	</body>
	<script>
    var flowers = document.getElementsByClassName('flowers'),
        radio = document.getElementsByClassName('pack-radio'),
        label_itog = document.getElementById('itog'),
        packprice = document.getElementById('packprice'),
        total = document.getElementById('total'),
        insert = document.getElementById('insert');
 
    [].forEach.call(flowers, function(item) {
        item.addEventListener('input', function() {
          var price = price_item(item), // получаем цену
            col = summ_flover(item),  // сумма
            key = item.parentElement.parentElement.getAttribute('key');
            summFlover(price, col, key); //передаем в функцию цену,сумму, ключ
        });
    });
    [].forEach.call(radio, function(item) {
        item.addEventListener('input', function() {
          if(label_itog.innerHTML != 0){
            total.innerHTML = +item.value + +label_itog.innerHTML;
          }else{
            this.checked = false;
          }
        });
    });
   function summFlover(price, col, key){
     var summ = 0,
         itog = 0,
         k = -1;
      [].forEach.call(flowers, function(item) {
          var item_key = item.parentElement.parentElement.getAttribute('key');
          if(item_key === key){
            summ += +item.value;
          }
      });
      col.innerHTML = summ * price;   //записываем сумму отдельных цветов
      [].forEach.call(flowers, function(item) {
          var key = item.parentElement.parentElement.getAttribute('key');
          if(k !== key){
            k = key
            itog += +item.parentElement.parentElement.children[5].innerHTML;
          }
      });
      label_itog.innerHTML = itog;  //записываем сумму всех цветов
   }
   function price_item(item){
      if(item.parentNode.nextSibling){
         return item.parentNode.nextSibling.innerHTML;
      }else{
        if(item.parentElement.parentElement.previousSibling.children.length === 6){
          return item.parentElement.parentElement.previousSibling.children[4].innerHTML;
        }else{
          return price_item(item.parentElement.parentElement.previousSibling.children[1].children[0]);
        }
      }
   }
   function summ_flover(item){
     if(item.parentNode.nextSibling){
       return item.parentNode.nextSibling.nextSibling;
     }else{
      if(item.parentElement.parentElement.previousSibling.children.length === 6){
        return item.parentElement.parentElement.previousSibling.children[5];
      }else{
        return summ_flover(item.parentElement.parentElement.previousSibling.children[1].children[0]);
      }
     }
   }
   function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
        if (xhr.status==500) { console.log(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
  }
   insert.onclick = function() {
    var order_id = <?=$order_id?>,
    order = '',
	order_flower_id = <?=$order_id?>,
    flower_color_id = '',
    client_id = <?=$_SESSION['user']['id']?>,    //$_SESSION['user']['id']
    quantity = '';
    var i = 0;
    [].forEach.call(flowers, function(item) {
      var id = item.getAttribute('id');
      if(item.value.length !== 0){
        if(i === 0){
          flower_color_id = id;
          order = order_id;
          quantity = item.value;
        }else{
          flower_color_id += ',' + id;
          order += ',' + order_id;
          quantity += ',' + item.value;
        }
        i++;
      }
    });
 
    [].forEach.call(radio, function(item) {
      if(item.checked === true){
        var post = {
        'order_id':order,
		'order_flower_id':order_flower_id,
        'flower_color_id':flower_color_id,
        'quantity':quantity,
        'packaging_id': item.getAttribute('id'),
        'client_id': client_id,
        'sum': total.innerHTML
        };
		
		//console.log(post);
		
         postAjax('order_flower.php', post, function(data){
          //var json = JSON.parse(data);
          //console.log(json);
		  location.href='korzina.php';
		  
      }); 
      }
    })
    };
    </script>
	
	</html>
	