<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $nombre = $_POST["nombre"];
	   $latitud = $_POST["latitud"];
	   $longitud = $_POST["longitud"];
	   $_SESSION["page_id"]="mantenimiento_lugares.php";
	   
	   	$sql = "Insert into Lugar(nombre,latitud,longitud,Activo) values ('".$nombre."',".$latitud.",".$longitud.",'ACT');";
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  