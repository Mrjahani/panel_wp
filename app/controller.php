<?php 

// require 'validate.php';

$errors = [];

// if ($_SERVER["REQUEST_METHOD"] == 'GET') {
// 	header('location: ./../login.php');
// }

function make_token_session()
{
	if (empty($_SESSION['token'])) {
	    if (function_exists('mcrypt_create_iv')) {
	        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	    } else {
	        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	    }
	}
}

function register_user($data)
{
	if (isset($_POST['token'])) {
		if (hash_equals($_SESSION['token'] , $_POST['token'])) {

			// $errors[] = validate_email($data['email']);
			if (! filter_var($data['email'] , FILTER_VALIDATE_EMAIL)) {
				$errors[]= 'email not valid';
			}
			// $errors[] = validate_password($data['password']);
			if (! mb_strlen($data['password']) <= 8 ) {
				$errors[] = 'Password must not be less than 8 characters ';
			}
			// var_dump($errors);die();

			if(isset($errors) && $errors == Null){
				$password = password_hash($data['password'], PASSWORD_DEFAULT);
				$pdo = new PDO("mysql:host=127.0.0.1;dbname=php_physicotherapy" , 'newuser','password');
				$sql = $pdo->prepare('insert into users (name , family , email , password) values (:name , :family , :email , :password)');
				$sql->execute([
					'name'=>$data['name'],
					'family'=>$data['family'],
					'email'=>$data['email'],
					'password'=>$password,
				]);
				$user = $sql->fetchAll(PDO::FETCH_ASSOC);
				$_SESSION['login'] = $user;
				header('location: base.php');
			}
			
		}else{
			$errors [] = 'The token sent is invalid ';
		}

	}
	$_SESSION['errors'] = $errors;
}

function login_user($email , $password){
	if (isset($_POST['token'])) {
		if (hash_equals($_SESSION['token'] , $_POST['token'])) {

			$pdo = new PDO('mysql:host=127.0.0.1;dbname=php_physicotherapy' , 'newuser','password');
			$sql = $pdo->prepare('select * from users where email = :email');
			$sql->execute([
				'email' => $email
			]);
			$user = $sql->fetch(PDO::FETCH_ASSOC);
			if (isset($user) && $user != '') {
				if(password_verify($password, $user['password'])){
					$_SESSION['login'] = $user;
					header('location: register.php');
				}else{
					$errors [] = 'The password entered is incorrect';
				}
			}else{
				$errors [] = 'The email sent is invalid ';
			}
			
		}else{
				$errors [] = 'The token sent is invalid ';
		}
	}
	$_SESSION['errors'] = $errors;

}

function change_password($password , $new_password)
{
	$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
	if (password_verify($password, $_SESSION['login']['password'])) {
		if (mb_strlen($password) > 8) {
			$pdo = new PDO("mysql:host=127.0.0.1;dbname=php_physicotherapy" , "newuser","password");
			$stmt = $pdo->prepare("update users set password = :password where id = {$_SESSION['login']['id']}");
			$stmt->execute([
				'password' => $password_hash,
			]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			return 'ok';
		}else{
			$errors [] = 'رمز عبور جدید نباید از 8 کاراکتر کمتر باشد.';
		}
		
	}else{
		$errors [] = 'پسورد قبلی اشتباه می باشد.';
	}
	$_SESSION['errors'] = $errors;
}
