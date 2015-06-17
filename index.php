<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="index.css">
	<title>Cleiago Comics</title>
</head>
<body>
	<h1>Cleiago Comics</h1>
	<?php 
		if(isset($_SESSION["login"])){
			echo "<p><a href=\"cadClientes.php\"><button>Cadastrar Clientes</button></a></p>";
			echo "<p><a href=\"verClientes.php\"><button>Lista de Clientes</button></a></p>";
			echo "<p><a href=\"cadProdutos.php\"><button>Cadastrar Produtos</button></a></p>";
			echo "<p><a href=\"verProdutos.php\"><button>Lista de Produtos</button></a></p>";
			echo "<p><a href=\"aluga.php\"><button>Empréstimo</button></a></p>";
			echo "<p><a href=\"devolucao.php\"><button>Devolução</button></a></p>";
			echo "<p><a href=\"compra.php\"><button>Compra</button></a></p>";
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=index.php\">";
		}
	?>
</body>
</html>