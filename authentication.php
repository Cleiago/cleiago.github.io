<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset='UTF-8'>
	<link rel="stylesheet" type="text/css" href="mainCSS.css ">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>     
</head>
<body class="fundo">
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
		$query = "SELECT name FROM user WHERE login ='".$login."' AND password ='".$senha."'";
		$resultado = query($banco, $query);
	}
		
	?>
	<nav>
   		<div class="nav-wrapper">
      		<a href="#" class="brand-logo right">CLEIAGO</a>
      		<ul id="nav-mobile" class="left hide-on-med-and-down">
        		<li><a href="">COMICS</a></li>
      		</ul>
    	</div>
  	</nav>
		<div class="bg-transparent container">
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
			$query = "SELECT name FROM user WHERE login ='".$login."' AND password ='".$senha."'";
			$resultado = query($banco, $query);

			if(mysqli_num_rows($resultado)>0){
				$_SESSION['login'] = $login;
				echo "<p>Usuário Conectado</p>";
				echo "<meta http-equiv=\"refresh\" content=\"0; url=\"index.php\">";
				if(isset($_GET['url'])){
					echo "<meta http-equiv=\"refresh\" content=\"1; url=".$_GET['url']."\">";
				}
				exit;
			}else{
				echo "<meta http-equiv=\"refresh\" content=\"0; url=\"authentication.php?user=".false."\">";
				exit;
			}
		}else {
			echo "<form name='autentication' action='' method='post'>
					<p>
						<label for='idlogin'>Login</label>
						<input class=\"white-text text-darken-2\" type='text' id='idlogin' name='login' size='15' maxlength='15'>
					</p>
					<p>
						<label for='idpass'>Senha</label>
						<input class=\"white-text text-darken-2\" type='password' id='idpass' name='pass' size='15' maxlength='15'>
					</p>
					<button class=\"red lighten-2 btn waves-effect waves-light\" type=\"submit\" name=\"submit\" value=\"Conectar\">Submit
    					<i class=\"mdi-content-send right\"></i>
  					</button>
				</form>";
		}

		if(isset($_GET["user"])){
			echo "<p class= \"white-text text-darken-2\">Login e/ou senha inválidos</p>";
		}
		?>
	</div>
	
	
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      	<script type="text/javascript" src="js/materialize.min.js"></script>
      	<script type="text/javascript" src="JavaScript.js"></script>
	</body>
</html>