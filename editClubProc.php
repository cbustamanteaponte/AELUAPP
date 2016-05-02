<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idClub = $_POST["idClub"];
	   $nombre = $_POST["nombre"];
	   
	   $_SESSION["page_id"]="mantenimiento_clubs.php";
	   
		$sql = "UPDATE Club SET NOMBRE='".$nombre."' "
				." WHERE ClubID=".$idClub;  
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  