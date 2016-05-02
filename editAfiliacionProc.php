<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idAfiliacion = $_POST["idAfiliacion"];
	   $deporteID = $_POST["deporteID"];
	   $categoriaID = $_POST["categoriaID"];
	   $clubID = $_POST["clubID"];
	   
	   $_SESSION["page_id"]="mantenimiento_afiliaciones.php";
	   
		$sql = "UPDATE DeporteCategoriaClub SET DeporteID=".$deporteID.", CategoriaID=".$categoriaID.", ClubID=".$clubID
				." WHERE DeporteCategoriaClubID=".$idAfiliacion;  
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  