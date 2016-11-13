<html>
<head>
<script>
	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		 } 
	}
	function funcionVer() {
		xmlhttp.open("POST","verPreguntas.php",true); 
		xmlhttp.send();
	}
	function funcionInsertar(){
		xmlhttp.open("POST","gestionarPregunta.php",true); 
		xmlhttp.send();
	}
	
</script>
</head>

<body>
<form method="post" accept-charset="UTF-8"> 
	<h2>Edicion de pregunta </h2>
		<p> Pregunta : <input type="text" required name="pregunta"  value="" />
		<p> Respuesta: <input type="text" required name="respuesta"value="" /> 
		<p> Comprejidad: <select name="complejidad">
  			<option value="1">1</option> 
  			<option value="2" selected>2</option>
  			<option value="3">3</option>
  			<option value="4">4</option>
  			<option value="5">5</option>
		</select> 
		<p> Tema: <input type="text" requires name="tema" value="" />
		<p><input type="submit" value="Insertar Pregunta" onClick="funcionInsertar()"/>
</form>

<input type="button" onClick="funcionVer()" value="Ver Preguntas"/>

<div id="txtHint">
	<b>Los datos de las preguntas se mostrarán aquí ...</b>
</div>

<span><a href='layout.html'>Inicio</a></spam>
</body>
</html>

<?php
	session_start();
if(isset($_SESSION['user'])){
	if(isset($_POST['pregunta'])){
	$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
	if ($connect) {
		$respuesta=$_POST["respuesta"];
		$pregunta=$_POST["pregunta"];
		$complejidad=$_POST["complejidad"];
		$tema=$_POST['tema'];
		$email=$_SESSION['user'];
		if(strlen($pregunta)==0||strlen($respuesta)==0){
			echo "Pregunta o respuesta invalidas.";
		}
		else{
		$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
		$numero=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM Preguntas"));
		$sql="INSERT INTO Preguntas (pregunta,respuesta,complejidad,email,Numero,Tema) VALUES ('$pregunta','$respuesta','$complejidad','$email','$numero','$tema')";
			if(!mysqli_query($connect,$sql)){
				die('Error: ' .mysqli_error($connect));
			}
			else{
				$hora=date("H:i:s", time());
				$ip=$_SERVER['REMOTE_ADDR'];
				$identificadorAccion=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM Acciones"));
				$resultado=mysqli_query($connect,"SELECT MAX(identificador) FROM Conexiones");
				$identificadorConexion = mysql_fetch_row($resultado);
				mysqli_close($resultado);
				$tipo="insertar pregunta";
				$sql="INSERT INTO Acciones(IdentificadorA,IdentificadorC,email,tipo,hora,ip) VALUES ('$identificadorAccion','$identificadorConexion[0]','$email','$tipo','$hora','$ip')";
				if(!mysqli_query($connect,$sql)){
					die('Error: ' .mysqli_error($connect));
				}
				echo " Pregunta introducida correctamente. <br />";
			}
		mysqli_close($connect);
		}
	}
		
	}
}
else{
	header('Location: http://uherederosw1617.hol.es/labSeguridad/login.php');
	exit();
}
	

?>