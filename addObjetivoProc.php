<?php  
   session_start();
   
   	if (!isset($_SESSION["usuario"])){
		session_destroy();
		echo "sesion no valida";
		echo "<br><IMG SRC='error.png'>";		
	}
	else{ 
		
	   $userid = $_SESSION["usuario"];
	   $objetivo = $_POST["objetivo"];
	   $item = $_POST["item"];
	   $categoria = $_POST["categoria"];
	   $unidad = $_POST["unidad"];
	   $meta = $_POST["meta"];
	   $peso = $_POST["peso"];	   
	   if (! isset($_POST["calculo"])){
			$calculo = 0;
	   }else{
			$calculo = $_POST["calculo"];
	   }
	   $fecha = $_POST["fecha"];
	   $acciones = addslashes($_POST["acciones"]);
	   $_SESSION["page_id"]="objetivos.php";
	   
	   //echo "calculo=".$calculo;

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
		/*
		echo $userid;
		echo  $objetivo;
		echo $item;
		echo  $categoria;
		echo  $meta;
		echo  $peso;
		echo  $calculo;
		echo  $acciones;
	  */
		// sql preparado para sustituir  
		//$sql = "select id_RH, nombre from localidades where id = :id";  
			ini_set('default_charset', 'ISO-8859-1'); 
		$sql = "INSERT INTO OBJETIVOS(ID_RH,OBJETIVO,INDICADOR,CATEGORIA,UND_MEDIDA,META,PESO,CALC_INV,ACCIONES,FECHA) values('".$userid."','".$objetivo."','".$item."','".$categoria."','"
				.$unidad."',".$meta.",".$peso.",".$calculo.",'".$acciones."','".$fecha."')";  
		
		//
		// preparamos el statement para la consulta  
		$st = oci_parse($conn, $sql);  
		  
		// aplicamos la sustitución como si fuera un prepare statement  
		//$miId = 101;  
		//oci_bind_by_name($s, ":id", $miId);  
		  
		// ejecutamos la query  
		oci_execute($st);  
	  
		//echo "INSERTADO";


		// liberamos los recursos   
		oci_free_statement($st);  
		  
		// cerramos la conexion  
		oci_close($conn);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  