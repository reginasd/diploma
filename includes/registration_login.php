<?php
	// объявление переменных
	$username = "";
	$email    = "";
	$errors = array(); 

	// Регистрация пользователя
	if (isset($_POST['reg_user'])) {
		// получение информации из формы
		$user_name = esc($_POST['user_name']);
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$phone = esc($_POST['phone']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// проверка правильно ли заполнена форма
		if (empty($user_name)) {  array_push($errors, "Введите ваше имя и фамилию!"); }
		if (empty($username)) {  array_push($errors, "Введите имя пользователя!"); }
		if (empty($email)) { array_push($errors, "Введите почту!"); }
		if (empty($phone)) { array_push($errors, "Введите Ваш номер телефона!"); }
		if (empty($password_1)) { array_push($errors, "Введите пароль!"); }
		if ($password_1 != $password_2) { array_push($errors, "Пароли не совпадают :(");}

		// Проврека, чтобы пользователи не повторялись. 
		// почта, ноиер телефона и имя пользователя должны быть уникальным
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' OR user_phone='$phone' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // если такой пользователь сущетсвует
			if ($user['username'] === $username) {
			  array_push($errors, "Пользователь с таким именем уже существует!");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Данный Email уже используется!");
			}
			if ($user['user_phone'] === $phone) {
			  array_push($errors, "Данный номер телефона уже используется!");
			}
		}
		// Регистрация, если нет ошибок
		if (count($errors) == 0) {
			$password = md5($password_1);//шифрование пароля
			$query = "INSERT INTO users (username, email, password, created_at, updated_at, user_name, user_phone) 
					  VALUES('$username', '$email', '$password', now(), now(), '$user_name', '$phone')";
			mysqli_query($conn, $query);

			// Получить id созданного пользователя
			$reg_user_id = mysqli_insert_id($conn); 

			// Включить сессию для зарегистрированного пользователя
			$_SESSION['user'] = getUserById($reg_user_id);

			// Если пользователь админ, перенаправить в администрирование
			if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "Вход успешно выполнен";
				// перенаправить в администрирование
				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "Вход успешно выполнен";
				// перенаправить в общую среду
				header('location: index.php');				
				exit(0);
			}
		}
	}

	// Вход
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Введите имя пользователя"); }
		if (empty($password)) { array_push($errors, "Введите пароль"); }
		if (empty($errors)) {
			$password = md5($password); // шифрование пароля
			$sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				// получить id пользователя
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				// Включить сессию для пользователя
				$_SESSION['user'] = getUserById($reg_user_id); 

				// Если пользователь - админ, перенаправить
				if ( in_array($_SESSION['user']['role'], ["Admin"])) {
					$_SESSION['message'] = "Вы успешно вошли!";
					// Перенаправить в администрирование
					header('location: ' . BASE_URL . '/admin/dashboard.php');
					exit(0);
				} 
				else if ( in_array($_SESSION['user']['role'], ["Author"])) {
					$_SESSION['message'] = "Вы успешно вошли!";
					// Перенаправить в кабинет флориста
					header('location: ' . BASE_URL . '/florist/dashboard.php');
					exit(0);
				} 
				else {
					$_SESSION['message'] = "Вы успешно вошли!";
					// Перенаправить в общую среду
					header('location: index.php');				
					exit(0);
				}
			} else {
				array_push($errors, 'Неверное имя пользователя и/или пароль');
			}
		}
	}
	// получение информации из формы
	function esc(String $value)
	{	
		// присоединение БД
		global $conn;

		$val = trim($value); // удалить пробелы
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Получить информацию о пользователе через его id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// Возвращает информацию о пользователе в формате: 
		// ['id'=>1 'username' => 'Regina', 'email'=>'r@r.com', 'password'=> '12345']
		return $user; 
	}
?>