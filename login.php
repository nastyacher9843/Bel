<?php 
include_once("header.php");

if ($request->action) {
	$data = ["errors" => []];
	switch ($request->action) {
		case "register":
		if ($_SESSION['id']) {
			header("Location: /");
		}
		if (strlen($request->login) < 4) {
			$data['errors']['register']['login'] = "Лагін павінен быць не менш 4 сімвалаў";
		}
		
		if (strlen($request->name) < 1) {
			$data['errors']['register']['name'] = "Імя павінна быць не менш за 1 сімвала";
		}

		if (strlen($request->password) < 6) {
			$data['errors']['register']['password'] = "Пароль павінен быць не менш 6 сімвалаў";
		}

		if ($request->password != $request->repeat) {
			$data['errors']['register']['repeat'] = "Паролі не супадаюць";
		}

		if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
			$data['errors']['register']['email'] = "Email ня карэктны";
		}

		if (!$request->human) {
			$data['errors']['register']['human'] = "Робатам ўваход забаронены";	
		}

		$user = $mysqli->query("SELECT * FROM users WHERE username='" . $request->login . "'");
		$user = $user->num_rows;
		if ($user > 0) {
			$data['errors']['register']['registered'] = "Гэты лагін ужо заняты";	
		}

		if (sizeof($data['errors']['register']) > 0) {
			$data['errors']['register_message'] = "Выпраўце памылкі!";
		} else {
			if ($mysqli->query("INSERT INTO users (username, password, email, name) VALUES ('" . $request->login . "', '" . md5($request->password) . "', '" . $request->email . "', '" . $request->name . "')")) {
				$_SESSION['id'] = $mysqli->insert_id;
				header("Location: /");
			}
		}

		break;
		case "login":
		if ($_SESSION['id']) {
			header("Location: /");
		}
		$user = $mysqli->query("SELECT * FROM users WHERE username='" . $request->login . "' AND password = '" . md5($request->password) . "'");
		if ($user->num_rows == 0) {
			$data['errors']['login'] = "Данныя ўведзены няправільна";	
		} else {
			$user = $user->fetch_object();
			$_SESSION['id'] = $user->id;
			header("Location: /");
		}
		break;
		case "logout":
		unset($_SESSION['id']);
		header("Location: /");
		break;
	}
}

include_once("login_template.php");
include_once("footer.php");
?>