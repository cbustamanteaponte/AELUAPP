<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idEvento = $_POST["idEvento"];
	   $_SESSION["page_id"]="mantenimiento_noticias.php";
	   
	   $sql = "UPDATE EVENTO SET Activo=NULL"
			  ." WHERE EventoID=".$idEvento;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  