<?php
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 

	// Добавить в таблицу order_flower и orders
	if (isset($_POST['bouquet_btn'])) {
		// receive all input values from the form
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) {  array_push($errors, "Введите имя пользователя!"); }
		if (empty($email)) { array_push($errors, "Введите почту!"); }
		if (empty($password_1)) { array_push($errors, "Введите пароль!"); }
		if ($password_1 != $password_2) { array_push($errors, "Пароли не совпадают :(");}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Пользователь с таким именем уже существует!");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Данный Email уже используется!");
			}
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
					  VALUES('$username', '$email', '$password', now(), now())";
			mysqli_query($conn, $query);

			// get id of created user
			$reg_user_id = mysqli_insert_id($conn); 

			// put logged in user into session array
			$_SESSION['user'] = getUserById($reg_user_id);

			// if user is admin, redirect to admin area
			if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "You are now logged in";
				// redirect to admin area
				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "You are now logged in";
				// redirect to public area
				header('location: index.php');				
				exit(0);
			}
		}
	}



	// escape value from form
	function esc(String $value)
	{	
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// returns user in an array format: 
		// ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user; 
	}
?>