<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="authentication.css ">
	<title>Login</title>
</head>
<body>
	<?php 
	if(isset($_COOKIE["login"]) && isset($_COOKIE["pass"])){
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		$banco = conectadb($dbHostname, $dbUsername, $dbPassword);

		selectdb($banco, $dbDatabase);

		$login = $_COOKIE["login"];
		$senha = $_COOKIE["pass"];
		$query = "SELECT name FROM user WHERE login ='".$login."' AND password ='".$senha."'";
		$resultado = query($banco, $query);

		if(mysqli_num_rows($resultado)>0){
			echo "<p>Usuário Conectado</p>";
			echo "<p><a href=\"cadClientes.php\"><button>Cadastrar Clientes</button></a></p>";
			echo "<p><a href=\"verClientes.php\"><button>Lista de Clientes</button></a></p>";
			echo "<p><a href=\"cadProdutos.php\"><button>Cadastrar Produtos</button></a></p>";
			echo "<p><a href=\"verProdutos.php\"><button>Lista de Produtos</button></a></p>";
			if(isset($_GET['url'])){
			echo "<meta http-equiv=\"refresh\" content=\"1; url=".$_GET['url']."\">";
			}
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?user=".false."\">";
			exit;
		}
	}else if(isset($_POST["submit"])){
		require_once 'fcnsdb.php';
		require_once 'logindb.php';
		$banco = conectadb($dbHostname, $dbUsername, $dbPassword);

		selectdb($banco, $dbDatabase);

		$login = $_POST["login"];
		$senha = $_POST["pass"];
		$query = "SELECT name FROM user WHERE login ='".$login."' AND password ='".$senha."'";
		$resultado = query($banco, $query);

		if(mysqli_num_rows($resultado)>0){
			$umdia = strtotime("+1 day",time());
			setcookie("login",$login,$umdia);
			setcookie("pass",$senha,$umdia);
			echo "<p>Usuário Conectado</p>";
			echo "<p><a href=\"cadClientes.php\"><button>Cadastrar Clientes</button></a></p>";
			echo "<p><a href=\"verClientes.php\"><button>Lista de Clientes</button></a></p>";
			echo "<p><a href=\"cadProdutos.php\"><button>Cadastrar Produtos</button></a></p>";
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