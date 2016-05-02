<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $deporteID = $_POST["deporteID"];
	   $categoriaID = $_POST["categoriaID"];
	   $clubID = $_POST["clubID"];
	   $_SESSION["page_id"]="mantenimiento_afiliaciones.php";
	   
	   	$sql = "Insert into DeporteCategoriaClub(DeporteID,CategoriaID,ClubID) values (".$deporteID.",".$categoriaID.",".$clubID.");";
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  