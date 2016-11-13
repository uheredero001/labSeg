<html>
<head>
</head>
<body>
	<a href="paginaProfesor.php">Volver</a>
	<form method="POST" id="editar" action="editarPregunta.php">
		<h2>Edicion de pregunta </h2>
			<p> Codigo Pregunta : <input type="text" required name="codigo" value="" />
			<p> Pregunta : <input type="text" required name="pregunta"  value="" />
			<p> Respuesta: <input type="text" required name="respuesta"value="" /> 
			<p> Comprejidad: <select name="complejidad">
  				<option value="1">1</option> 
  				<option value="2" selected>2</option>
  				<option value="3">3</option>
  				<option value="4">4</option>
  				<option value="5">5</option>
			</select> 
			<input type="submit" value="Modificar"/>
	</form>
	
	<div id="txtHint">
	</div>
</body>
</html>

<?php
session_start();
if(!isset($_SESSION['user'])){
	header('Location: http://uherederosw1617.hol.es/labSeguridad/login.php');
	exit();	
}
else
{	
if(isset($_POST['codigo'])){
	$codigo=$_POST['codigo'];
	$pregunta=$_POST['pregunta'];
	$respuesta=$_POST['respuesta'];
	$complejidad=$_POST['complejidad'];
	$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
	$sql="SELECT * FROM Preguntas WHERE Numero='$codigo'";
	$resultado=mysqli_query($connect,$sql);
	
	$contador=mysqli_num_rows($resultado);	
	if($contador!=1){
	 	echo"Codigo pregunta erroneo.";
	}
	else{
		if(strlen($pregunta)<3||strlen($respuesta)==0||strlen($complejidad)==0){
			echo "Falta algun dato.";
		}
		else{
			$sql="UPDATE Preguntas SET pregunta='$pregunta',respuesta='$respuesta', 
			complejidad='$complejidad' WHERE Numero='$codigo'";
			if(!mysqli_query($connect,$sql)){
				die('Error: ' .mysqli_error($connect));
			}
			else{
				echo "Pregunta $codigo actualizada correctamente.";
			}
		}
	}
}
}
	

?>