<?php 
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
		}
	}
?>