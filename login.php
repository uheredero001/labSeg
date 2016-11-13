<html>
<head>
<head>
<body>
<form action="http://uherederosw1617.hol.es/labSeguridad/login.php" method="post" accept-charset="UTF-8"> 
	<h2>Identificación de usuario </h2>
		<p> Email : <input type="email" required name="email"  value="" />
		<p> Password: <input type="password" required name="password" value="" /> 
		<p> <input id="input_2" type="submit" value="Entrar" />
</form>
<span><a href='layout.html'>Inicio</a></spam>
<body>
</html>
<?php
if(isset($_POST["password"]))
	$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
	if ($connect) {
		session_start();
		$email=$_POST["email"];
		$password=$_POST["password"];
		$sql="SELECT * FROM Usuario WHERE email='$email' and password='$password'";
		$resultado=mysqli_query($connect,$sql);
		$contador=mysqli_num_rows($resultado);
		mysqli_close($resultado);
		if($contador==1){
			$sql="SELECT * FROM Conexiones";
			$resultado=mysqli_query($connect,$sql);
			$identificador=mysqli_num_rows($resultado);
			mysqli_close($resultado);
			$hora=date("H:i:s", time());
			$_SESSION['user']=$email;
			$_SESSION['passw']=$password;
			if(strcmp($email,"web000@ehu.es")==0){
				header('Location: http://uherederosw1617.hol.es/labSeguridad/paginaProfesor.php');
			}
			else{
				header('Location: http://uherederosw1617.hol.es/labSeguridad/PaginaLogin.php');
			}
		}
		else{
			echo"DATOS INCORRECTOS.";
		}

		mysqli_close($connect);
	}

?>