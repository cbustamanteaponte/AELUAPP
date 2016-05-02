<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idDeporte = $_POST["idDeporte"];
	   $_SESSION["page_id"]="mantenimiento_deportes.php";
	   
	   $sql = "UPDATE DEPORTE SET ACTIVO=NULL"
			  ." WHERE DeporteID=".$idDeporte;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  