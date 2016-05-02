<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $nombre = $_POST["nombre"];
	   $_SESSION["page_id"]="mantenimiento_clubs.php";
	   
	   	$sql = "Insert into Club(Nombre,Activo) values ('".$nombre."','ACT');";
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  