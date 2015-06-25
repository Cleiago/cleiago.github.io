<?php 
	require_once 'extrafunc.php';
	require_once 'logindb.php';
	require_once 'fcnsdb.php';
	$banco = conectadb($dbHostname,$dbUsername,$dbPassword);
	selectdb($banco,$dbDatabase);
	
	if(isset($_GET["ccpf"])){
		$ccpf = $_GET["ccpf"];

		echo $ccpf;
		$query = "SELECT codp FROM aluga WHERE cpf='$ccpf' AND dtdev IS NULL GROUP BY 1";
		$productOptions = query($banco,$query);

		SelectValues($productOptions);
	}else{
		exit();
	}
 ?>