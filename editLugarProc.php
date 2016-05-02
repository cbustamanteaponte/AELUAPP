<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idLugar = $_POST["idLugar"];
	   $nombre = $_POST["nombre"];
	   $latitud = $_POST["latitud"];
	   $longitud = $_POST["longitud"];
	   
	   $_SESSION["page_id"]="mantenimiento_lugares.php";
	   
		$sql = "UPDATE LUGAR SET nombre='".$nombre."', latitud=".$latitud.",longitud=".$longitud
				." WHERE LugarID=".$idLugar;  
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  