<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idServicio = $_POST["idServicio"];
	   $_SESSION["page_id"]="mantenimiento_servicios.php";
	   
	   $sql = "UPDATE SERVICIO SET Activo=NULL"
			  ." WHERE ServicioID=".$idServicio;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  