<?php  
   session_start();
   
   	if (!isset($_SESSION["usuario"])){
		session_destroy();
		echo "sesion no valida";
		echo "<br><IMG SRC='error.png'>";		
	}
	else{ 
		
		$userid = $_SESSION["usuario"];
		$idColaborador = $_POST["idColaborador"];
		$nombre = $_POST["nombre"];
		$cod = $_POST["cod"];
		$puesto =  $_POST['puesto'];
		$gerencia_corp =  $_POST['gerencia_corp'];
		$gerencia =  $_POST['gerencia'];
		$area =  $_POST['area'];
		$gerencia_asoc =  $_POST['gerencia_asoc'];
		$id_eval =  $_POST['id_eval'];
		$nombre_eval =  $_POST['nombre_eval'];			
		$email_eval =  $_POST['email_eval'];	
	   	   
		// conectamos de no forma no persistente  
		//$conn = oci_connect("SF_EVADES", "evadesprep", "172.16.2.143:1521/M4PREP");  
		$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.2.143)(PORT = 1521)))(CONNECT_DATA = (SID = M4PREP)))"; 

		$conn = oci_connect("SF_EVADES","evadesprep",$db,'al32utf8') or die( "Could not connect to Oracle database!");
		// controlmos el error  
		if (!$conn) {  
			$e = oci_error();  
			echo $e['message']."<br>";  
		   //exitexit;  
		}


		//echo $unidad;
		$sql = "UPDATE USUARIOS SET  NOMBRE='".$nombre."',PUESTO='".$puesto."',GERENCIA_CORP='".$gerencia_corp."',COD=".$cod.",GERENCIA_ASOC='"
				.$gerencia_asoc."',GERENCIA='".$gerencia."',AREA='".$area."',ID_EVAL='".$id_eval."',NOMBRE_EVAL='".$nombre_eval."',EMAIL_EVAL='".$email_eval."'"
				." WHERE ID_RH='".$idColaborador."'";  
		//echo $sql;
		//echo "chau";
		//echo '<script>alert("'.$sql.'")</script>';
		// preparamos el statement para la consulta  
		$st = oci_parse($conn, $sql);  
		  		  
		// ejecutamos la query  
		oci_execute($st);  
	  
		//echo "INSERTADO";


		// liberamos los recursos   
		oci_free_statement($st);  
		  
		// cerramos la conexion  
		oci_close($conn);
		
		echo "<br> Cambio Realizado<br>";
		
	}
?>  