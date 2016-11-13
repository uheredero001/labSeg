
<?php
session_start();
if(isset($_SESSION['user'])){
	session_destroy();
	header('Location: http://uherederosw1617.hol.es/labSeguridad/layout.html');
}
else{
	header('Location: http://uherederosw1617.hol.es/labSeguridad/login.php');
	exit();
}
?>