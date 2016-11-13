<html>
  <head>
	<title>Registro</title>
		<script>
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		 	} 
		}
		function vervalores(){
		var sAux="";
		var frm = document.getElementById("registro");
		for (i=0;i<frm.elements.length;i++)
		{ 
		sAux += "NOMBRE: " + frm.elements[i].name + " "; 
		sAux += "VALOR: " + frm.elements[i].value + "\n" ;
		} 
		alert(sAux); 
		}
		
		function validacion(){
			var frm = document.getElementById("registro");
				if((/^\s+$/.test(frm.elements[0].value) || frm.elements[0].value.length==0 || frm.elements[0].value == null)){
					alert("Nombre incorrecto o vacio.");
					return false;
				}
				if((/^\s+$/.test(frm.elements[1].value) || frm.elements[1].value.length==0 || frm.elements[1].value == null)){
					alert("Apellidos incorrectos o campo vacio.");
					return false;
				}
				if(!(/[a-z]{3,}[0-9]{3}@(ikasle.)?ehu.e(u)?s/.test(frm.elements[2].value))) {
  					alert("Correo electronico incorrecto o campo vacio.");
  					return false;
				}
				if(frm.elements[3].value.length<6 || frm.elements[3].value == null){
					alert("Password incorrecto o campo vacio.");
					return false;
				}
				if(frm.elements[4].value.length<6 || frm.elements[4].value == null ||frm.elements[4].value!=frm.elements[3].value){
					alert("Confirmacion password erronea.");
					return false;
				}
				if((!(/^[6|9]{1}\d{8}$/.test(frm.elements[5].value)) || frm.elements[5].value.length==0 || frm.elements[5].value == null)){
					alert("Telefono incorrecto o campo vacio.");
					return false;
				}
				if(((frm.elements[6].value != "inglenieria del software" && frm.elements[6].value != "computacion" && 
				frm.elements[6].value != "ingenieria de computadores") || frm.elements[6].value.length==0 || frm.elements[5].value == null)){
					return false;
				} 
			return true;
		}
		function funcionRegistrar(){
			xmlhttp.open("POST","registrar.php",true); 
			xmlhttp.send();
		}
		</script>
 </head>
 
 <body>
  <div id='page-wrap'>
  <header class='main' id='h1'>
		<h2>Formulario de registro</h2>
	<form action="registrar.php" method="post" id='registro' name='registro' onSubmit='return validacion()'>
        <legend>Rellene los campos:</legend>
             <label>Nombre</label>
                <input id="registro" name="nombre" type="text"  />
            <br/>
           	 <label>Apellidos</label>
           	 	<input id="registro" name="apellidos" type="text"  />
           	 <br/>
           	 <label>Email</label>
                <input id="registro" name="email" type="text"  />
            <br/>
             <label>Password</label>
                <input id="registro" name="password" type="password"  />
            <br/>
             <laber>Confime Password</label>
             	<input id="registro" name="password2" type="password"/>
            <br/>
             <label>Telefono</label>
                <input id="registro" name="telefono" type="text"  />
            <br/>
             <label>Especialidad</label>
                 <select id="registro" name="especialidad" >
                	<option value="ingenieria de computadores">ingenieria de computadores</option>
                	<option value="ingenieria de software">ingenieria de software</option>
                	<option value="computacion">computacion</option>
                </select>
           <br/>
           <button id="resgistro" type="submit" value="Regsitrar" onClick="funcionRegistrar()"> Enviar </button>
           <br/>
         
	</form>

		<span><a href='layout.html'>Inicio</a></spam>
    </header>
  </div>
  <div id="txtHint">
  </div>
  </body>
</html>
<?php
if(isset($_POST["email"])){
$connect=mysqli_connect("mysql.hostinger.es","u906430108_u","4QYzSiq7","u906430108_quiz");
if ($connect) {	
		require_once('lib/nusoap.php');
		require_once('lib/class.wsdlcache.php');
		$cliente=new nusoap_client('http://cursodssw.hol.es/comprobarmatricula.php?wsdl',true);
		$nombre=$_POST["nombre"];
		$apellidos=$_POST["apellidos"];
		$email=$_POST["email"];
		$password=$_POST["password"];
		$telefono=$_POST["telefono"];
		$especialidad=$_POST["especialidad"];
		$resultado=$cliente->call('comprobar',array('x'=>$email));
		if(strlen($email)==0||strlen($nombre)==0||strlen($password)==0||strcmp($resultado,"NO")==0){
			echo "Error: hay algun dato invalido <br />";
		
		}
		else{
		
			$sql="INSERT INTO Usuario(Nombre,Apellidos,Email,Password,Telefono,Especialidad) VALUES ('$nombre','$apellidos','$email','$password','$telefono','$especialidad')";
		
			if(!mysqli_query($connect,$sql)){
		
				die('Error: ' .mysqli_error($connect));
			}
			else{
				echo " 1 fila introducida. <br />";
			}	
		
		}


mysqli_close($connect);
}
}
?>