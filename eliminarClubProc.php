<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idClub = $_POST["idClub"];
	   $_SESSION["page_id"]="mantenimiento_clubs.php";
	   
	   $sql = "UPDATE CLUB SET Activo=NULL"
			  ." WHERE ClubID=".$idClub;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  