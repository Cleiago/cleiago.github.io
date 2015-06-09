<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="tabela.css">
	<title>Exercícios de Programação 2: WEB</title>
</head>
<body>
	<?php 
		echo "<h2> Bem Vindo ".$_POST["nome"]." ".$_POST["snome"]."!</h2>";
	 ?>
	<div>
		<?php 
			$linhas = 10;;
			$colunas = 10;

			echo "<h3>Tabela de Multiplcação</h3>";
			echo "<table>";
			for ($i=1; $i<=$linhas; $i++){
				echo "<tr>";
				for ($j=1; $j<=$colunas; $j++){
					echo "<td>". $i*$j ."</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		 ?>
	</div>
	<div>
		<?php 
			$colegas = ["Gabriel", "Cleiton", "Dayan", "Dionatan", "Diogo"];
			echo "<h3>Exercícios</h3>";
			
			echo "<p>";
			foreach ($colegas as $nome) {
				echo $nome."</br>";
			}
			echo "</p>";
			
			sort($colegas);
			echo "<p>";
			foreach ($colegas as $nome) {
				echo $nome."</br>";
			}
			echo "</p>";

			echo "<p>".strtoupper($colegas[array_rand($colegas)])."</p>";
		 ?>
	</div>
	<div>
		<?php 
			$altura = $_POST["altura"];
			$largura = $_POST["largura"];
			$unidade = $_POST["units"];

			area($altura,$largura,$unidade);

			function area(&$alt, &$lar, &$units) {
				$area = $alt*$lar;
				echo "Um retangulo de largura ".$lar.$units." e altura ".$alt.$units." tem uma área de ".$area.$units."².";
				return $area;
			}
		 ?>
	</div>
	<div>
		<?php 
			class Cachorro {
				private $nome;
				private $numPernas;
				
				public function __construct($nome) {
					$this->nome = $nome;
					$numPernas = 4;
				}

				public function latir() {
					echo "<p><strong>AU! AU! AU!<strong></p>";
				}
			}

			$poodle = new Cachorro('Toby');
			$schnauzer = new Cachorro('Bilu');

			$poodle->latir();
			$schnauzer->latir();
		 ?>
	</div>
</body>
</html>