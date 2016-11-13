<html>
<head>
<head>
<body>
	 <a href="gestionarPregunta.php">Editar Pregunta</a>
	 <a href="insertarPregunta.php">Insertar Pregunta</a> 
	 <a href="logout.php">Log Out</a>
	 <a href="creditos.html">Creditos</a>
</body>
</html>


<?php
session_start();
if(isset($_SESSION['user'])){
	echo "Bienvenido: ";
	echo $_SESSION['user'];
}
else{
	header('Location: http://uherederosw1617.hol.es/labSeguridad/login.php');
	exit();
}
?>