<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idDeporte = $_POST["idDeporte"];
	   $nombre = $_POST["nombre"];
	   
	   $_SESSION["page_id"]="mantenimiento_deportes.php";
	   
		$sql = "UPDATE DEPORTE SET NOMBRE='".$nombre."' "
				." WHERE DeporteID=".$idDeporte;  
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  