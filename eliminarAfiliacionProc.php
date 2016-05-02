<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idAfiliacion = $_POST["idAfiliacion"];
	   $_SESSION["page_id"]="mantenimiento_afiliaciones.php";
	   
	   $sql = "DELETE FROM DeporteCategoriaClub"
			  ." WHERE DeporteCategoriaClubID=".$idAfiliacion;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  