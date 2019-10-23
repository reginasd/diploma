<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf8'>
<link rel="stylesheet" href="http://sergey-oganesyan.ru/wp-content/uploads/2014/01/stylepromer.css" type="text/css" />
<title>Всплывающее окно на javascript - Seo блог sergey-oganesyan.ru</title>
<style type="text/css">
	
	#wrap{
		display: none;
		opacity: 0.8;
		position: fixed;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		padding: 16px;
		background-color: rgba(1, 1, 1, 0.725);
		z-index: 100;
		overflow: auto;
	}
	
	#window{
		width: 400px;
		height: 600px;
		margin: 50px auto;
		display: none;
		background: #fff;
		z-index: 200;
		position: fixed;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		padding: 16px;
	}
	
	.close{
		margin-left: 364px;
		margin-top: 4px;
		cursor: pointer;
	}
	
</style>
</head>
<body>
		<script type="text/javascript">

					//Функция показа
			function show(state){

					document.getElementById('window').style.display = state;			
					document.getElementById('wrap').style.display = state; 			
			}
			
		</script>
					<!-- Задний прозрачный фон-->
		<div onclick="show('none')" id="wrap"></div>

					<!-- Само окно-->
			<div id="window">
						
						 <!-- Картинка крестика-->
				<img class="close" onclick="show('none')" src="http://sergey-oganesyan.ru/wp-content/uploads/2014/01/close.png">
					
						<!-- Картинка ipad'a-->
				<img  style="margin: 20px 0 0 50px;" src="http://sergey-oganesyan.ru/wp-content/uploads/2014/01/ipad.png">
				
				<center>
							
					<a href="http://sergey-oganesyan.ru/javascript-s-primerami/kak-sdelat-vsplyvayushee-okno.html" class="myButton">Вернуться к статье</a> 
					<a class="myButton" href="http://sergey-oganesyan.ru/">sergey-oganesyan.ru</a>
				</center>
				
			</div>

		<center><button class="myButton" onclick="show('block')">Показать окно</button></center>	
		
		<center><br>
			<a href="http://sergey-oganesyan.ru/javascript-s-primerami/kak-sdelat-vsplyvayushee-okno.html" class="myButton">Вернуться к статье</a> 
			<a class="myButton" href="http://sergey-oganesyan.ru/">sergey-oganesyan.ru</a>
		</center>
		
</body>
</html>