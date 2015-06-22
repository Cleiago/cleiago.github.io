<head>
	<meta charset='UTF-8'>
</head>

<?php 
	function PrintTable($result){     
		if (@mysqli_num_rows($result) == 0){ 
			echo("<b>Query completed. No results returned.</b><br>"); 
		}else { 
			echo "<table border='1' class='tablesorter'> 
				<thead> 
				<tr>"; 
			for($i = 0;$i < mysqli_num_fields($result);$i++) 
			{ 
				$name = mysqli_fetch_field($result)->name;
				echo "<th id='".$name."'>" . $name . "</th>"; 
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
		}
	}

	function SelectValues($result){
		if (@mysqli_num_rows($result) == 0){
			echo "<option selected disabled>Nenhum item encontrado</option>";
		}else {
			echo "<option selected disabled>Selecione...</option>";
			for ($i=0; $i < mysqli_num_rows($result); $i++) { 
				for ($j=0; $j < mysqli_num_fields($result); $j++) { 
					$valor = mysqli_fetch_row($result)[$j];
					echo "<option value=".$valor.">".$valor."</option>";
				}
			}
		}
	}
?>