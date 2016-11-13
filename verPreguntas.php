
<?php
$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
if ($connect) {
	$sql = "SELECT * FROM Preguntas";
	$result = mysqli_query($connect,$sql);
	echo '<table border=1> <tr> <th> PREGUNTA </th> <th> RESPUESTA </th> <th> COMPLEJIDAD </th> <th> EMAIL </th> 
		<th> NUMERO </th> <th> TEMA </th></tr>';
	
		
    	while($row = mysqli_fetch_array($result)) {
    		echo '<tr> 
    		<td><font size="3">' .$row["pregunta"]. '</td> 
    		<td><font size="3">' .$row["respuesta"]. '</td> 
    		<td><font size="3">' .$row["complejidad"]. '</td> 
    		<td><font size="3">' .$row["email"]. '</td> 
    		<td><font size="3">' .$row["Numero"]. '</td> 
    		<td><font size="3">' .$row["Tema"]. '</td>
    		</tr>';
    	
    	}
    	echo '</table>';
    	mysqli_close($result);
    	$hora=date("H:i:s", time());
		$ip=$_SERVER['REMOTE_ADDR'];
		$identificadorAccion=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM Acciones"));
		$identificadorConexion=null;
		$tipo="ver pregunta";
		$email=null;
		$sql="INSERT INTO Acciones(IdentificadorA,IdentificadorC,email,tipo,hora,ip) VALUES ('$identificadorAccion','$identificadorConexion','$email','$tipo','$hora','$ip')";
		if(!mysqli_query($connect,$sql)){
						die('Error: ' .mysqli_error($connect));
		}
}
mysqli_close($connect);
?>