<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idPartido = $_POST["idPartido"];
	   $_SESSION["page_id"]="mantenimiento_partidos.php";
	   
	   $sql = "UPDATE PARTIDO SET ACTIVO=NULL"
			  ." WHERE PartidoID=".$idPartido;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  