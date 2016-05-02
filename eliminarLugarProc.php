<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idLugar = $_POST["idLugar"];
	   $_SESSION["page_id"]="mantenimiento_lugares.php";
	   
	   $sql = "UPDATE LUGAR SET Activo=NULL"
			  ." WHERE LugarID=".$idLugar;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  