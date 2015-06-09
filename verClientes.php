<!DOCTYPE html>
<html>
<head>
	<title>Ver Clientes</title>
	<meta charset='UTF-8'>
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

			}else{
				echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?user=".false."&url=verClientes.php\">";
				exit;
			}
		}else{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=authentication.php?url=verClientes.php\">";
		}
	?>
</head>
<body>
	<?php 
		$query = "SELECT * FROM Cliente";
		PullValues(query($banco,$query));

		function PullValues($result){     
			if (@mysqli_num_rows($result) == 0){ 
				echo("<b>Query completed. No results returned.</b><br>"); 
			}else { 
				echo "<table border='1'> 
					<thead> 
					<tr>"; 
				for($i = 0;$i < mysqli_num_fields($result);$i++) 
				{ 
					echo "<th>" . mysqli_fetch_field($result)->name . "</th>"; 
				}
				echo "</tr> 
					</thead> 
					<tbody>"; 
				for ($i = 0; $i < mysqli_num_rows($result); $i++) 
				{ 
					echo "<tr>"; 
					$row = mysqli_fetch_row($result); 
					for($j = 0;$j < mysqli_num_fields($result);$j++)  
					{ 
						echo("<td>" . $row[$j] . "</td>"); 
					} 
					echo "</tr>"; 
				} 
				echo "</tbody> 
					</table>"; 
			}  //end else 
		}		
	 ?>
</body>
</html>