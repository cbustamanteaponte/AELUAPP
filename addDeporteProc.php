<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $nombre = $_POST["nombre"];
	   $_SESSION["page_id"]="mantenimiento_deportes.php";
	   
	   	$sql = "Insert into deporte(Nombre,Activo) values ('".$nombre."','ACT');";
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  