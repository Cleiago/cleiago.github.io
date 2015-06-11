<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="authentication.css ">
	<title>Login</title>
</head>
<body>
	<?php 
	if(isset($_SESSION["login"])){
		echo "<p>Usuário Conectado</p>";
		if(isset($_GET['url'])){
			echo "<meta http-equiv=\"refresh\" content=\"1; url=".$_GET['url']."\">";
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
		}
	}else if(isset($_POST["submit"])){
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		$banco = conectadb($dbHostname, $dbUsername, $dbPassword);

		selectdb($banco, $dbDatabase);

		$login = $_POST["login"];
		$senha = $_POST["pass"];
		$query = "SELECT name FROM User WHERE login ='".$login."' AND password ='".$senha."'";
		$resultado = query($banco, $query);

		if(mysqli_num_rows($resultado)>0){
			$_SESSION['login'] = $login;
			echo "<p>Usuário Conectado</p>";
			echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
			if(isset($_GET['url'])){
				echo "<meta http-equiv=\"refresh\" content=\"1; url=".$_GET['url']."\">";
			}
			exit;
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?user=".false."\">";
			exit;
		}
	}else {
		echo "<form name='autentication' action='' method='post'>
				<p>
					<label for='idlogin'>Login</label>
					<input type='text' id='idlogin' name='login' size='15' maxlength='15'>
				</p>
				<p>
					<label for='idpass'>Senha</label>
					<input type='password' id='idpass' name='pass' size='15' maxlength='15'>
				</p>
				<p style='text-align: center'>
					<input type='submit' name='submit' value='Conectar'>
				</p>
			</form>";
	}

	if(isset($_GET["user"])){
		echo "<p>Login e/ou senha inválidos</p>";
	}
	?>
</body>
</html>