<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idAcademia = $_POST["idAcademia"];
	   $_SESSION["page_id"]="mantenimiento_academias.php";
	   
	   $sql = "UPDATE ACADEMIA SET Activo=NULL"
			  ." WHERE AcademiaID=".$idAcademia;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  