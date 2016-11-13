<span><a href='layout.html'>Inicio</a></spam>
<?php
		echo '<table border=1> <tr> <th> PREGUNTA </th> <th> COMPLEJIDAD </th> <th> TEMATICA </th>';
		$preguntas=simplexml_load_file("preguntas.xml");
		
    	foreach($preguntas->xpath("//assessmentItem")as $preg) {
    		echo '<tr> 
    		<td><font size="3">' .$preg->itemBody->p. '</td> 
    		<td><font size="3">' .$preg["complexity"]. '</td> 
    		<td><font size="3">' .$preg["subject"]. '</td>  
    		</tr>';
    	
    	}
    	echo '</table>';
    	

?>