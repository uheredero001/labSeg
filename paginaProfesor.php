<html>
<head>
	<script>
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		 } 
		}
		function funcionVer(){
			xmlhttp.open("POST","verPreguntas.php",true); 
			xmlhttp.send();
		}
	</script>
</head>
<body>
	<input type="button" value="verPreguntas" onClick="funcionVer()"/>
	<a href="editarPregunta.php">EditarPreguntas</a>
	<a href="logout.php">Log Out</a>
	<a href="creditos.html">Creditos</a>
<div id="txtHint">
</div>
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